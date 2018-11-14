<?php
require_once("entities/CasinoReview.php");

class CasinoReviews
{
    const LIMIT = 100;
    const LIMIT_REPLIES = 100;

    public function getAllTotal($casinoID) {
        return DB("SELECT COUNT(id) AS nr FROM casinos__reviews WHERE casino_id = :casino_id AND parent_id = 0",array(":casino_id"=>$casinoID))->toValue();
    }

    public function getAll($casinoID, $page, $parentID = 0) {

        $output = array();

        // get main reviews
        $resultSet = DB("
            SELECT t1.*, t2.code AS country, t3.value AS rating
            FROM casinos__reviews AS t1
            INNER JOIN countries AS t2 ON t1.country_id = t2.id
            LEFT JOIN casinos__ratings AS t3 ON t1.casino_id = t3.casino_id AND t1.ip = t3.ip
            WHERE t1.casino_id = :casino_id
            ORDER BY t1.date DESC 
            LIMIT ".self::LIMIT." OFFSET ".($page*self::LIMIT)."
        ",array(":casino_id"=>$casinoID));

      //  var_dump($resultSet);  die();

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

    public function insert($casinoID, CasinoReview $review) {

        if(!$casinoID)
            return false;

        return DB("
        INSERT INTO casinos__reviews
        SET 
          casino_id = :casino,
          ip = :ip,
          country_id = :country,
          name = :name,
          email = :email,
          body = :body,
          parent_id = :parent,
          invision_review_id = :invision_review_id,
          invision_url = :invision_url
        ", array(
            ":casino"=>$casinoID,
            ":ip"=>$review->ip,
            ":country"=>$review->country,
            ":name"=>$review->name,
            ":email"=>$review->email,
            ":body"=>$review->body,
            ":parent"=>$review->parent,
            ":invision_review_id" => $review->review_invision_id,
            ":invision_url" => $review->invision_url
        ))->getInsertId();
    }


    public function getAllReviewsByInvisionIds(array $invisionCommentsIds = []){

        if(empty($invisionCommentsIds)){
            return;
        }

        $idsSqlFormat = implode(', ', array_keys($invisionCommentsIds));

        $q = " SELECT *
                FROM casinos__reviews 
                WHERE invision_review_id IN ($idsSqlFormat)
              ";

        return DB($q)->toList();
    }

    public function updateCommentsFromInviosn($invisionComments){

        //get invsion reviews from our database
        $reviews = $this->getAllReviewsByInvisionIds($invisionComments);

        // group reviews by invision id
        $reviewGrouppedById = [];
        $casino_id = null;

        foreach ($reviews as $review){

            $reviewGrouppedById[$review['invision_review_id']] = $review;
            if(empty($casino_id))
                $casino_id = $review['casino_id'];
        }

        $newCommentsFromInvision = [];
        $updateComments = [];
        foreach($invisionComments as $invisionComment){

            if(!empty($reviewGrouppedById[$invisionComment['id']])){

                $review = $reviewGrouppedById[$invisionComment['id']];

                //remove review from list
                unset($reviewGrouppedById[$invisionComment['id']]);

                if($invisionComment['hidden'] != $review['hidden']){
                    $updateComments[$review['id']] = $invisionComment;
                    continue;
                }

                if($invisionComment['content'] != $review['body']){
                    $updateComments[$review['id']] = $invisionComment;
                    continue;
                }

            }else{
                $newCommentsFromInvision[]  = $invisionComment;
            }
        }


        if(!empty($newCommentsFromInvision)){

            //add new comments
            foreach ($newCommentsFromInvision as $comment){
                $review = new CasinoReview();
                $review->name = $comment['author']['name'];
                $review->email = !empty($comment['author']['email']) ? $comment['author']['email'] : 'accounts@hliscorp.com';
                $review->body = $comment['content'];
                $review->ip = $comment['author']['registrationIpAddress'];
                $review->country = 34;
                $review->parent = 0;
                $review->review_invision_id = $comment['id'];
                $review->hidden = !empty($comment['hidden']) ? 1 : 0 ;
                $review->invision_url = $comment['url'];

                $object = new CasinoReviews();
                $id = $object->insert($casino_id, $review);
            }
        }

        if(!empty($updateComments)){

            //update comments
            foreach($updateComments as $id => $comment){
                DB ("
                  UPDATE casinos__reviews SET
                  body = :body,
                  hidden = :hidden
                  WHERE id = :id",
                   array(
                       ':body' => $comment['content'],
                       ':hidden' => !empty($comment['hidden']) ? 1 :0,
                       ':id' => $id
                   )
                );
            }
        }

        // not working .. the deleted comments have hidden flag
        /*if(!empty($reviewGrouppedById)){
            $ids = implode(', ', $reviewGrouppedById);
            DB("DELETE casinos__reviews WHERE review_invision_id IN($ids)");
        }*/
    }
}