<?php
require_once("entities/CasinoReview.php");
require_once 'application/models/dao/ReviewStatuses.php';

class CasinoReviews
{
    const LIMIT = 5;
    const LIMIT_REPLIES = 5;

    public function getAllTotal($casinoID)
    {
        return SQL("SELECT COUNT(id) AS nr FROM casinos__reviews WHERE casinos__reviews.status != 3 AND casino_id = :casino_id AND parent_id = 0", array(":casino_id"=>$casinoID))->toValue();
    }

    public function getAllVotes($casinoID){
        return SQL("SELECT COUNT(value) from casinos__ratings WHERE casino_id = :casino_id and status != 3", array(":casino_id" => $casinoID))->toValue();
    }

    public function getUserVotes($casino_id){
        return SQL("SELECT value from casinos__ratings WHERE casino_id = :casino_id", array(":casino_id" => $casino_id));
    }

    public function getMoreReplies($page, $parentID)
    {
        $output = array();
    
        $resultSet = SQL("
                SELECT tt1.id, t1.name, t1.email, t1.body, t1.parent_id, t1.likes, t1.`date`,
                   t1.title, t2.code AS country
                FROM casinos__reviews AS t1
                INNER JOIN countries AS t2 ON t1.country_id = t2.id
                WHERE t1.status != 3 AND t1.parent_id = ".$parentID."  
                ORDER BY t1.date ASC
                LIMIT ".self::LIMIT_REPLIES." OFFSET ".($page*self::LIMIT_REPLIES)."
            ");
        while ($row = $resultSet->toRow()) {
            $object = new CasinoReview();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->email = $row["email"];
            $object->body = $row["body"];
            $object->country = $row["country"];
            $object->date = $row["date"];
            $object->likes = $row["likes"];
            $object->parent_id = (integer) $row['parent_id'];
            $output[] = $object;
        }
        return array_values($output);
    }

    public function getAll($casinoID, $page, $parentID = 0)
    {
        $output = array();
        // get main reviews
        $resultSet = SQL("
            SELECT t1.id, t1.name, t1.email, t1.body, t1.parent_id, t1.likes, t1.`date`,
                   t1.title, t2.code AS country, t3.value AS rating
            FROM casinos__reviews AS t1
            INNER JOIN countries AS t2 ON t1.country_id = t2.id
            LEFT JOIN casinos__ratings AS t3 ON t1.casino_id = t3.casino_id AND t1.ip = t3.ip
            WHERE t1.status != 3 AND  t1.casino_id = :casino_id
            AND t1.parent_id = 0
            ORDER BY t1.date DESC 
            LIMIT " . self::LIMIT . " OFFSET " . ($page * self::LIMIT),
            array(":casino_id" => $casinoID));

        while ($row = $resultSet->toRow()) {
            $object = new CasinoReview();
            $object->id = $row["id"];
            $object->title = $row["title"];
            $object->name = $row["name"];
            $object->email = $row["email"];
            $object->body = $row["body"];
            $object->country = $row["country"];
            $object->date = $row["date"];
            $object->likes = $row["likes"];
            $object->rating = (integer) $row["rating"];
            $object->parent_id = (integer) $row['parent_id'];
            $output[$row["id"]] = $object;
        }
        if (empty($output)) {
            return $output;
        }

        // get answers to main reviews
        if ($parentID==0) {
            $resultSet = SQL("
                SELECT count(id) AS nr, parent_id 
                FROM casinos__reviews 
                WHERE casinos__reviews.status != 3 AND  parent_id IN (".implode(",", array_keys($output)).")
                GROUP BY parent_id
                ");
            while ($row = $resultSet->toRow()) {
                $output[$row["parent_id"]]->total_children = $row["nr"];
                
                $res = SQL("
                SELECT t1.id, t1.name, t1.email, t1.body, t1.parent_id, t1.likes, t1.`date`,
                   t1.title, t2.code AS country
                FROM casinos__reviews AS t1
                INNER JOIN countries AS t2 ON t1.country_id = t2.id
                WHERE t1.status != 3 AND t1.parent_id = ".$row["parent_id"]."
                ORDER BY t1.date ASC
                LIMIT ".self::LIMIT_REPLIES."
            ");
                while ($row = $res->toRow()) {
                    $object = new CasinoReview();
                    $object->id = $row["id"];
                    $object->title = $row["title"];
                    $object->name = $row["name"];
                    $object->email = $row["email"];
                    $object->body = $row["body"];
                    $object->country = $row["country"];
                    $object->date = $row["date"];
                    $object->likes = $row["likes"];
                    $object->parent_id = (integer) $row['parent_id'];
                    $output[$row["parent_id"]]->children[] = $object;
                }
            }
        }
        return array_values($output);
    }

    public function incrementLikes($id, $ip)
    {
        $reviewID = SQL("SELECT id FROM casinos__reviews_likes WHERE review_id = :review_id AND ip = :ip", array(":review_id"=>$id, ":ip"=>$ip))->toValue();
        if ($reviewID) {
            return 0;
        } else {
            SQL("INSERT INTO casinos__reviews_likes SET review_id = :review_id, ip = :ip", array(":review_id"=>$id, ":ip"=>$ip));
        }
        return SQL("UPDATE casinos__reviews SET likes = likes + 1 WHERE id=:id", array(":id"=>$id))->getAffectedRows();
    }

    public function insert($casinoID, CasinoReview $review)
    {
        if (!$casinoID) {
            return false;
        }

        return SQL("
        INSERT INTO casinos__reviews
        SET 
          casino_id = :casino,
          ip = :ip,
          country_id = :country,
          name = :name,
          email = :email,
          body = :body,
          parent_id = :parent,
          status = :status,
          title = :title
        ", array(
            ":casino"=>$casinoID,
            ":ip"=>$review->ip,
            ":country"=>$review->country,
            ":name"=>$review->name,
            ":email"=>$review->email,
            ":body"=>$review->body,
            ":parent"=>$review->parent,
            ":status" => $review->status,
            ":title" => $review->title
        ))->getInsertId();
    }

    public function getCountryStatusText($status)
    {
        return str_replace("-", " ", $status);
    }
}
