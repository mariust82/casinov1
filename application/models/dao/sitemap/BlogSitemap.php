<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogSitemap
 *
 * @author user
 */
class BlogSitemap {
    
    private function setBlogCategories() {
        $output = [];
        $res = $this->getAll();
        while($row = $res->toRow()) {
            $output[$row['type'].'/'.strtolower(str_replace(' ','-',$row['title']))] = $row['last_changed'];
        }
        array_multisort($output, SORT_DESC);
        return $output;
    }

    public function getBlogCategories() {
        return $this->setBlogCategories();
    }
    
     private function getAll()
    {
       return SQL("SELECT a.title,a.last_changed,at.value AS type FROM articles AS a INNER JOIN article__types AS at ON a.type_id = at.id WHERE a.deleted = 0 AND a.is_draft = 0 ORDER BY a.id DESC");
    }
}
