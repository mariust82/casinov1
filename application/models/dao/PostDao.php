<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PostDao
 *
 * @author matan
 */
class PostDao {
    protected $db_table, $filled_parameters;

    public function __construct($db_table, $filled_parameters) {
        $this->db_table = $db_table;
        $this->filled_parameters = $filled_parameters;
    }
}
