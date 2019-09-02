<?php
require_once "UserPost.php";
require_once "application/models/dao/Articles.php";

class ArticleRatingPost extends UserPost
{
    protected $db_table = 'articles__ratings';
    protected $post_error_msg = 'Rating was not saved! Please try again!';
    protected $parameters = [
        'id' => ['default' => 0, 'check' => ['articleExists' => 'Article not found!']],
        'ip' => [
            'default' => 0,
            'check' => [
//                'ipCanBeUsedForArticle' => [
//                    'max' => 1,
//                    'time_limit' => false,
//                    'error_msg' => 'You already voted with this IP on this article!'
//                ],
                'ipCanBeUsed' => [
                    'max' => 10,
                    'time_limit' => 60 * 10,
                    'error_msg' => 'You can vote a maximum of 10 articles per hour from the same IP!'
                ]
            ]
        ],
        'is_like' => 1
    ];

    final protected function checkIpCanBeUsedForArticle($parameter, $settings = [])
    {
        $value = $this->getParamValue($parameter);
        $query = "SELECT COUNT(*) FROM `" . $this->db_table . "` WHERE `ip`=:ip AND article_id=:article_id";
        $query_vars = [":ip" => $value, ":article_id" => $this->filled_parameters['id']];
        if (!empty($settings['time_limit']) && !!$settings['time_limit']) {
            $time_limit = $settings['time_limit'];
            $query .= " AND `date`>=:date ";
            $query_vars[":date"] = strtotime("now -$time_limit seconds");
        }
        $found = SQL($query, $query_vars)->toValue();
        if (!empty($settings['max']) && !!$settings['max']) $allowed = $found < $settings['max'];
        else $allowed = !$found;
        if (!$allowed) $this->setError($this->getDefaultErrorMsg($settings, "IP not allowed to post in this section!"));
        return $allowed;
    }

    final protected function checkArticleExists($parameter, $settings)
    {
        $exists = !!(SQL("SELECT id FROM `" . Articles::DB_TABLE . "` WHERE id=:id", [":id" => $this->getParamValue($parameter)])->toValue());
        if (!$exists) {
            $this->setError($this->getDefaultErrorMsg($settings, "Article does not exists!"));
        }
        return $exists;
    }
    
    public function checkIfPost() {
        if (!$this->post()) {
            throw new UserPostException(json_encode($this->getErrors()));
        }
    }

    private function post()
    {
        if ($this->canPost()) {
            $rating_exists = SQL("SELECT `id` FROM `" . $this->db_table . "` WHERE ip=:ip AND article_id=:article_id", [':ip' => $this->filled_parameters['ip'], ':article_id' => $this->filled_parameters['id']])->toValue();
            if ($rating_exists)
                $query = "UPDATE`" . $this->db_table . "` SET ";
            else
                $query = "INSERT INTO `" . $this->db_table . "` SET ";
            $query_vars = [];
            foreach ($this->filled_parameters as $parameter => $value) {
                if ($parameter == 'id') {
                    $parameter = 'article_id';
                }
                $query .= "`" . $parameter . "`=:value_of_$parameter, ";
                $query_vars[":value_of_$parameter"] = $value;
            }
            $query = substr($query, 0, strlen($query) - 2);
            if (!empty($rating_exists)) {
                $query .= " WHERE `id`=:id ";
                $query_vars[':id'] = $rating_exists;
            }
            try {
                $item = SQL($query, $query_vars);
                $item_id = !!$rating_exists ? $rating_exists : $item->getInsertId();
                Articles::updateLikes();
                return $item_id;
            } catch (Exception $e) {
                $this->setError($this->post_error_msg);
                return false;
            }
        }
        return false;
    }
}