<?php
require_once 'ArticlesModel.php';
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
class ArticleUpload extends ArticlesModel
{
    private $article;
    private $titleImageThumbnail = null;
    private $titleImageDesktop = null;
    private $titleImageMobile = null;
    private $object;
    private $operationType;
    public function __construct($items,$article,$object,$operationType)
    {
        parent::__construct($items);
        $this->article = $article;
        $this->object = $object;
        $this->operationType = $operationType;
        $this->setUploadPath();
    }

    private function setUploadPath()
    {
        $this->getUploadsFolders();
        $folder = $this->uploadFodler;
        if ($folder) {
            $this->titleImageThumbnail = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_thumbnail.jpg?".strtotime("now");
            $this->titleImageDesktop = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_image_desktop.jpg?".strtotime("now");
            $this->titleImageMobile = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_image_mobile.jpg?".strtotime("now");
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
