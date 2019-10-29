<?php
require_once 'plugins/pcms_10casinos/application/models/dao/Tags.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddTagController
 *
 * @author matan
 */
class AddTagController extends \Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $tags = new Tags($this->application->attributes("parent_schema"));
        $tags->addTag($this->request->parameters('tag'));
    }
}
