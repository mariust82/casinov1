<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleUpload
 *
 * @author matan
 */
class ArticleUpload
{
    private $uploadsFolder;
    private $article;
    private $titleImageThumbnail = null;
    private $titleImageDesktop = null;
    private $titleImageMobile = null;
    
    public function __construct($uploadsFolder, $article)
    {
        $this->uploadsFolder = $uploadsFolder;
        $this->article = $article;
        $this->setUploadPath();
    }

    private function setUploadPath()
    {
        if ($this->uploadsFolder) {
            $this->titleImageThumbnail = '/upload' . $this->uploadsFolder . '/' . str_replace(" ", "_", $this->article->title). "_thumbnail.jpg?".strtotime("now");
            ;
            $this->titleImageDesktop = '/upload' . $this->uploadsFolder . '/' . str_replace(" ", "_", $this->article->title). "_image_desktop.jpg?".strtotime("now");
            ;
            $this->titleImageMobile = '/upload' . $this->uploadsFolder . '/' . str_replace(" ", "_", $this->article->title). "_image_mobile.jpg?".strtotime("now");
            ;
        }
    }
    
    public function getTitleImageThumbnail()
    {
        return $this->titleImageThumbnail;
    }
    
    public function getTitleImageDesktop()
    {
        return $this->titleImageDesktop;
    }
    
    public function getTitleImageMobile()
    {
        return $this->titleImageMobile;
    }
}
