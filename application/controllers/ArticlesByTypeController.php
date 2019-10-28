<?php
require_once "ArticlesController.php";
require_once("application/models/dao/entities/PageInfo.php");
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
class ArticlesByTypeController extends ArticlesController
{
    protected function init()
    {
        $this->category = $this->request->getValidator()->parameters('category');
        $this->offset = self::LIMIT*$this->page;
        var_dump($this->page);
        var_dump($this->offset);
        $this->filter = ['type'=> $this->category];
    }
    
    protected function pageInfo()
    {
        $object = new PageInfo();
        switch ($this->category) {
            case 'news':
                $object->head_title = "Casino News ".date('Y').": Breaking Casino & Gambling Headlines";
                $object->head_description = "CasinosLists.com brings you the latest online gambling news to date! Browse leading-edge titles, including big casino wins, new games, bonus offers & more!";
                $object->body_title = "Latest Casino and Gaming Industry News in ".date('Y');
                break;
            case 'guides':
                $object->head_title = "Complete Online Casino Guides | CasinosLists.com";
                $object->head_description = "Expand your gambling insight with CasinosList.com's top casino guides! Explore beginner's tips & tricks and expert strategies gathered in one place for you!";
                $object->body_title = "Online Casino Guides";
                break;
        }
        
        $this->response->attributes("page_info", $object);
    }
}
