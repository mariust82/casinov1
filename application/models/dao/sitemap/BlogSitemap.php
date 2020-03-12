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
        return SQL("SELECT a.title, at.value AS type FROM articles AS a INNER JOIN article__types AS at ON a.type_id = at.id WHERE a.deleted = 0 AND a.is_draft = 0 ORDER BY a.id DESC")->toMap("title","type");
    }
    
    private function setBlogCategoriesLastMod() {
        return SQL("SELECT a.last_changed WHERE a.deleted = 0 AND a.is_draft = 0 ORDER BY a.id DESC")->toColumn();
    }
    
    public function getBlogCategoriesLastMod() {
        return $this->setBlogCategoriesLastMod();
    }

    public function getBlogCategories() {
        return $this->setBlogCategories();
    }
}
