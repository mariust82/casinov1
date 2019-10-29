<?php
require_once 'plugins/pcms_10casinos/application/models/dao/Tags.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectTagController
 *
 * @author matan
 */
class SelectTagController extends \Lucinda\MVC\STDOUT\Controller{
    public function run() {
        $tags = new Tags($this->application->attributes("parent_schema"));
        $tags->selectTags($this->request->parameters('tags'),$this->request->parameters('article_id'));
    }
}
