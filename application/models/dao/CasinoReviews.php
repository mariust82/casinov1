<?php
require_once("entities/CasinoReview.php");

class CasinoReviews
{
    const LIMIT = 5;
    const LIMIT_REPLIES = 3;

    public function getAllTotal($casinoID) {
        return DB("SELECT COUNT(id) AS nr FROM casinos__reviews WHERE casino_id = :casino_id AND parent_id = 0",array(":casino_id"=>$casinoID))->toValue();
    }

    public function getAll($casinoID, $page, $parentID=0) {
        $output = array();

        // get main reviews

        $resultSet = DB("
            SELECT t1.*, t2.code AS country, t3.value AS rating
            FROM casinos__reviews AS t1
            INNER JOIN countries AS t2 ON t1.country_id = t2.id
            LEFT JOIN casinos__ratings AS t3 ON t1.casino_id = t3.casino_id AND t1.ip = t3.ip
            WHERE t1.casino_id = :casino_id AND t1.parent_id = $parentID
            ORDER BY t1.date DESC 
            LIMIT ".self::LIMIT." OFFSET ".($page*self::LIMIT)."
        ",array(":casino_id"=>$casinoID));
        while($row = $resultSet->toRow()) {
            $object = new CasinoReview();
            $object->id = $row["id"];
            $object->name = $row["name"];
            $object->email = $row["email"];
            $object->body = $row["body"];
            $object->country = $row["country"];
            $object->date = $row["date"];
            $object->likes = $row["likes"];
            $object->rating = (integer) $row["rating"];
            $output[$row["id"]] = $object;
        }
        if(empty($output)) return $output;

        // get answers to main reviews
        if($parentID==0) {
            $resultSet = DB("
                SELECT count(id) AS nr, parent_id 
                FROM casinos__reviews 
                WHERE parent_id IN (".implode(",", array_keys($output)).")
                GROUP BY parent_id
                ");
            while($row = $resultSet->toRow()) {
                $output[$row["parent_id"]]->total_children = $row["nr"];
            }

            $resultSet = DB("
                SELECT t1.*, t2.code AS country
                FROM casinos__reviews AS t1
                INNER JOIN countries AS t2 ON t1.country_id = t2.id
                WHERE t1.parent_id IN (".implode(",", array_keys($output)).")
                ORDER BY t1.date DESC
                LIMIT ".self::LIMIT_REPLIES."
            ");
            while($row = $resultSet->toRow()) {
                $object = new CasinoReview();
                $object->id = $row["id"];
                $object->name = $row["name"];
                $object->email = $row["email"];
                $object->body = $row["body"];
                $object->country = $row["country"];
                $object->date = $row["date"];
                $object->likes = $row["likes"];
                $output[$row["parent_id"]]->children[] = $object;
            }
        }

        return array_values($output);
    }

    public function incrementLikes($id, $ip) {
        $reviewID = DB("SELECT id FROM casinos__reviews_likes WHERE review_id = :review_id AND ip = :ip",array(":review_id"=>$id, ":ip"=>$ip))->toValue();
        if($reviewID) {
            return 0;
        } else {
            DB("INSERT INTO casinos__reviews_likes SET review_id = :review_id, ip = :ip",array(":review_id"=>$id, ":ip"=>$ip));
        }
        return DB("UPDATE casinos__reviews SET likes = likes + 1 WHERE id=:id",array(":id"=>$id))->getAffectedRows();
    }

    public function insert($casino, CasinoReview $review) {

        $casinoID = DB("SELECT id FROM casinos WHERE name = :casino",array(":casino"=>$casino))->toValue();
        if(!$casinoID) return false;
        return DB("
        INSERT INTO casinos__reviews
        SET 
          casino_id = :casino,
          ip = :ip,
          country_id = :country,
          name = :name,
          email = :email,
          body = :body,
          parent_id = :parent
        ", array(
            ":casino"=>$casinoID,
            ":ip"=>$review->ip,
            ":country"=>$review->country,
            ":name"=>$review->name,
            ":email"=>$review->email,
            ":body"=>$review->body,
            ":parent"=>$review->parent,
        ))->getInsertId();
    }

    //TEMP
    public function getCasinoId($casino_name){

        $casinoID = DB("SELECT invision_casino_id FROM casinos WHERE name = :casino",array(":casino"=>$casino_name))->toValue();
        return $casinoID;
    }

    public function getReviewsFromInvision($invision_casino_id){

        if(empty($invision_casino_id)){
             [
                 'reviews' => [],
                 'page' => 1,
                 'totalResults' => 0,
                 'totalPages' => 0
             ];
        }

        $invision = new InvisionComments();
        $endPoints = str_replace('{#id}', $invision_casino_id,  InvisionAppEndPoints::$endpoints['entries']['get_entry_comments']['url']);
        $invision->setEndpoint($endPoints);
        $comments =  $invision->getAllCommentsFromCasino();
        $comments = json_decode($comments, true);
        $reviews = [];
        if(!empty($comments['results'])){

            foreach($comments['results'] as $comment){
                $object = new CasinoReview();
                $object->id = $comment["id"];
                $object->name = $comment['author']["name"];
                $object->email = $comment['author']["email"];
                $object->body = $comment["content"];
                $object->country = 'US'; //TBD
                $object->date = $comment["date"];
                $object->likes = 2;// TBD
                $reviews[$comment["id"]]= $object;
            }
        }

        $reviews = [
            'reviews' => $reviews,
            'page' => !empty($comments['page']) ?  $comments['page'] : 1,
            'totalResults' => !empty($comments['totalResults']) ? $comments['totalResults'] : 0 ,
            'totalPages' => !empty($comments['totalPages']) ? $comments['totalPages'] : 1
        ];

        return $reviews;
    }
}