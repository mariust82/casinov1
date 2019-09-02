<?php
require_once("entities/Article.php");
require_once("entities/Rating.php");
require_once("entities/TmsContentValue.php");
require_once("application/models/ResultSetWrapper.php");

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
            SELECT a.*, tcnt.value as `tms_value`
            FROM articles a LEFT JOIN {$this->parentSchema}.tms__content tcnt
            ON a.route_id=tcnt.route_id
            WHERE a.title LIKE :title;",
            array(':title' => "%$route%")
        );

        while ($row = $results->toRow()) {
            $blogPost = new BlogPost($row['id']);
            $blogPost->id = $row['id'];
            $blogPost->name = $row['title'];
            $blogPost->readingTime = $row['min_read'];
            $blogPost->content = $row['tms_value'];
            $blogPost->titleImageDesktop = "";
            $blogPost->titleImageMobile = "";
            $blogPost->thumbnail = "";
            $blogPost->postDate = $row['date_added'];
            $blogPost->routeId = $row['route_id'];
            $blogPosts[] = $blogPost;
        }

        return $blogPosts;
    }

    public function getInfoByName($name = '')
    {
        //DB('SET NAMES UTF8');
        $name = preg_replace('/[^\da-z]/i', ' ', urldecode($name)); //allow only alphanumeric, case insensitive and -
        $results = SQL("
        SELECT articles.* FROM articles
        WHERE articles.`title`=:name LIMIT 1
        ", [':name' => $name]);
        $results = ResultSetWrapper::from($results)->toList(new Article(), ['rating' => new Rating()]);
        if (!$results) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }
        return $results[0];
    }

    public function getList($filters = [], $offset = 0, $limit = 9)
    {
        $output = ['results' => [], 'total' => 0];
        //DB('SET NAMES UTF8');
        $query_vars = [];
        $query = "
            SELECT SQL_CALC_FOUND_ROWS a.*, a.likes as `rating.likes`, a.dislikes as `rating.dislikes`, tcnt.value, at.value AS type
            FROM articles a JOIN article__types at ON a.type_id = at.id LEFT JOIN {$this->parentSchema}.tms__content tcnt
            ON a.route_id=tcnt.route_id
            WHERE 1=1 
            ";
        if (!empty($filters['id_not_in'])) {
            $query .= " AND a.id NOT IN (" . implode(',', $filters['id_not_in']) . ") ";
        }
        if (isset($filters['id'])) {
            $query .= "\nAND a.id=:id";
            $query_vars[':id'] = (int)$filters['id'];
        }
        if (isset($filters['type'])) {
            $type_id = $this->getArticleTypeId($filters['type']);
            $query .= "\nAND a.type_id=:id";
            $query_vars[':id'] = (int)$type_id;
        }
        $query .= "
            ORDER BY a.id DESC
            LIMIT $offset, $limit";
        $resultSet = SQL($query, $query_vars);
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
            $article->date_added = $row['date_added'];
            $article->min_read = $row['min_read'];
            $article->description = $row['value'];
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
