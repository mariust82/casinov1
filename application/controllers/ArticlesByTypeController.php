<?php
require_once "ArticlesController.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticlesByTypeController
 *
 * @author matan
 */
class ArticlesByTypeController extends ArticlesController {
    protected function init() {
        $category = $this->request->getValidator()->parameters('category');
        $this->filter = ['type'=> $category];
    }
}
