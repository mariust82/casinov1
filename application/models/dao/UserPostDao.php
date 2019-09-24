<?php
require_once "application/models/dao/PostDao.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPostDao
 *
 * @author matan
 */
class UserPostDao extends PostDao {

    public function __construct($db_table, $filled_parameters) {
        parent::__construct($db_table, $filled_parameters);
    }

    public function getPostQuery() {
        $query = "INSERT INTO `" . $this->db_table . "` SET ";
        $query_vars = [];
        foreach ($this->filled_parameters as $parameter => $value) {
            $query .= "`" . $parameter . "`=:value_of_$parameter, ";
            $query_vars[":value_of_$parameter"] = $value;
        }
        $query = substr($query, 0, strlen($query) - 2);
        return SQL($query, $query_vars);
    }

}
