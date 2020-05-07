<?php
require_once("entities/Article.php");
require_once("entities/Rating.php");
require_once("entities/TmsContentValue.php");
require_once("application/models/ResultSetWrapper.php");
require_once("vendor/lucinda/queries/src/Select.php");

class Articles
{
    const DB_TABLE = "articles";
    const DB_TABLE_RATINGS = "articles__ratings";

    private $parentSchema;

    public function __construct($parentSchema)
    {
        $this->parentSchema = $parentSchema;
    }

    public function getInfoByRoute($route)
    {
        $blogPosts = array();

        $results = SQL(
            "
            SELECT a.*
            FROM articles a 
            WHERE is_draft = 0 AND deleted = 0 AND a.url = :url;",
            array(':url' => "$route")
        );

        while ($row = $results->toRow()) {
            $blogPost = new BlogPost($row['id']);
            $blogPost->id = $row['id'];
            $blogPost->name = $row['title'];
            $blogPost->readingTime = $row['min_read'];
            $blogPost->content = $row['content'];
            $blogPost->titleImageDesktop = $row['titleImageDesktop'];
            $blogPost->titleImageMobile = $row['titleImageMobile'];
            $blogPost->thumbnail = $row['thumbnail'];
            $blogPost->postDate = $row['date_added'];
            $blogPost->routeId = $row['route_id'];
            $blogPosts[] = $blogPost;
        }

        return array_shift($blogPosts);
    }
    
    public function getArticleTags($id) {
        return SQL("SELECT t1.name FROM tags AS t1 JOIN articles_tags AS t2 ON (t1.id = t2.tag_id) JOIN articles AS t3 ON (t2.article_id = t3.id) WHERE t3.id = :id",[':id'=>$id])->toList();
    }

    public function getInfoByName($name = '')
    {
        //DB('SET NAMES UTF8');
        $name = preg_replace('/[^\da-z]/i', ' ', urldecode($name)); //allow only alphanumeric, case insensitive and -
        $results = SQL("
        SELECT articles.* FROM articles
        WHERE is_draft = 0 AND deleted = 0 AND articles.`title`=:name LIMIT 1
        ", [':name' => $name]);
        $results = ResultSetWrapper::from($results)->toList(new Article(), ['rating' => new Rating()]);
        if (!$results) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }
        return $results[0];
    }

    public function getList($filters = [], $offset = 0, $limit = 15)
    {
        $output = ['results' => [], 'total' => 0];
        //DB('SET NAMES UTF8');
        $query_vars = [];
        $select = new Lucinda\Query\Select("articles","a");
        $select->fields()->add("SQL_CALC_FOUND_ROWS a.*")->add("a.likes","`rating.likes`")->add("a.dislikes","`rating.dislikes`")->add("a.content")->add("at.value","type");
        $select->joinInner("article__types","at")->on(["a.type_id"=>"at.id"]);
        
        $where =  $select->where();
        $where->set("a.deleted", 0);
        $where->set("a.is_draft", 0);
        if (!empty($filters['id_not_in'])) {
            $where->setIn("a.id", ":id1", FALSE);
            $query_vars[':id1'] = $filters['id_not_in'][0];
        }
        if (isset($filters['id'])) {
            $query_vars[':id2'] = (int)$filters['id'];
            $where->set("a.id", ":id2");
        }
        if (isset($filters['type'])) {
            $type_id = $this->getArticleTypeId($filters['type']);
            $query_vars[':id3'] = (int)$type_id;
            $where->set("a.type_id", ":id3");
        }
        
        if (isset($filters['name'])) {
            $query_vars[':id4'] = $filters['name'];
            $where->set("a.`url`", ":id4");
        }
        $select->orderBy()->add("a.id",Lucinda\Query\OrderByOperator::DESC);
        $select->limit($limit, $offset);
        $resultSet = SQL($select->toString(), $query_vars);
        $foundRows = (int)SQL('SELECT FOUND_ROWS()')->toValue();
        $results = [];
        while ($row = $resultSet->toRow()) {
            $article = new Article();
            $rating = new Rating();
            $rating->likes = $row['likes'];
            $rating->dislikes = $row['dislikes'];
            $article->id = $row['id'];
            $article->type = $row['type'];
            $article->title = $row['title'];
            $article->url = $row['url'];
            $article->date_added = $row['date_added'];
            $article->min_read = $row['min_read'];
            $article->titleImageDesktop = $row['titleImageDesktop'];
            $article->titleImageMobile = $row['titleImageMobile'];
            $article->thumbnail = $row['thumbnail'];
            $article->description = $row['content'];
            $article->rating = $rating;
            $results[] = $article;
        }
        $output['results'] = $results;
        $output['total'] = $foundRows;
        return $output;
    }
    
    private function getArticleTypeId($type)
    {
        return SQL("SELECT id FROM article__types WHERE `value` = :id", [':id'=>$type])->toValue();
    }

    public function getItemFromId($id = 0)
    {
        $items = $this->getList(['id' => $id], 0, 1);
        return !empty($items['total']) ? $items['results'][0] : false;
    }

    public static function updateLikes()
    {
        SQL("UPDATE articles
            SET
            articles.likes=0,
            articles.dislikes=0");
        SQL("UPDATE articles
            INNER JOIN (SELECT article_id, COUNT(DISTINCT id) nr FROM articles__ratings WHERE is_like=1 GROUP BY article_id) likes ON likes.article_id=articles.id
            SET
            articles.likes=likes.nr");
        SQL("UPDATE articles
            INNER JOIN (SELECT article_id, COUNT(DISTINCT id) nr FROM articles__ratings WHERE is_like=0 GROUP BY article_id) dislikes ON dislikes.article_id=articles.id
            SET
            articles.dislikes=dislikes.nr");
    }
}
