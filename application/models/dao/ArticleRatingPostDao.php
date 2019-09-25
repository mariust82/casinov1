<?php
require_once "application/models/dao/PostDao.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleRatingPostDao
 *
 * @author matan
 */
class ArticleRatingPostDao extends PostDao {

    public function __construct($db_table, $filled_parameters) {
        parent::__construct($db_table, $filled_parameters);
    }
    
    public function checkIfexistquery() {
        return SQL("SELECT `id` FROM `" . $this->db_table . "` WHERE ip=:ip AND article_id=:article_id", [':ip' => $this->filled_parameters['ip'], ':article_id' => $this->filled_parameters['id']])->toValue();
    }

    public function getPostQuery($rating_exists) {
        if ($rating_exists) {
            $query = "UPDATE`" . $this->db_table . "` SET ";
        } else {
            $query = "INSERT INTO `" . $this->db_table . "` SET ";
        }
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
        return SQL($query, $query_vars);
    }

}
