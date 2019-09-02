<?php
require_once "ArticlesController.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticlesLoadMoreController
 *
 * @author matan
 */
class ArticlesLoadMoreController extends ArticlesController {
    protected function init() {
        $this->category = $this->request->attributes('validation_results')->get('category');
        $this->offset = ((int) $this->request->attributes('validation_results')->get('page')) * self::LIMIT;
        $this->filter = $this->category == 'blog' ? [] : ['type'=> $this->category];
    }
}
