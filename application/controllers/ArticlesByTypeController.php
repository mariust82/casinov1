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
        $this->category = $this->request->getValidator()->parameters('category');
        $this->offset = 0;
        $this->filter = ['type'=> $this->category];
    }
}
