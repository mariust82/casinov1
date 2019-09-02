<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticlesCommon
 *
 * @author matan
 */
class ArticlesModel {
    private $items;
    
    public function __construct($items) {
        $this->items = $items;
    }
    
    public function getUploadsFolders()
    {
        $uploadsFolders = [];
        foreach ($this->items['results'] as $item) {
            $uploadsFolders[$item->id] = "/upload" . $this->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] .= "/" . str_replace(" ", "_", $item->title) . "_thumbnail.jpg?" . strtotime("now");
        }
        
        return $uploadsFolders;
    }
    
}
