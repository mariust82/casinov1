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
        $folder = $this->getUploadsFolder();
        if ($folder) {
            $this->titleImageThumbnail = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_thumbnail.jpg?".strtotime("now");
            $this->titleImageDesktop = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_image_desktop.jpg?".strtotime("now");
            $this->titleImageMobile = '/upload' . $folder . '/' . str_replace(" ", "_", $this->article->title). "_image_mobile.jpg?".strtotime("now");
        }
    }
    
        public function getUploadsFolder($object, $operationType)
    {
        if (empty($object)) {
            return null;
        }

        switch ($operationType) {
            case'draft':
                if (!$object) {
                    return '/blogs/drafts/tmp';
                }
                return '/blogs/drafts/' . $object->id;
                break;
            case 'publish':
                if (!$object) {
                    return '/blogs/drafts/tmp';
                }
                return '/blogs/published/' . $object->payload->id;
                break;
            case 'live':
                return '/blogs/published/' . $object->id;
                break;
        }
    }
    
    private function getUploadsFolder()
    {
        if (empty($this->object)) {
            return null;
        }

        switch ($this->operationType) {
            case'draft':
                if (!$this->object) {
                    return '/blogs/drafts/tmp';
                }
                return '/blogs/drafts/' . $this->object->id;
                break;
            case 'publish':
                if (!$this->object) {
                    return '/blogs/drafts/tmp';
                }
                return '/blogs/published/' . $this->object->payload->id;
                break;
            case 'live':
                return '/blogs/published/' . $this->object->id;
                break;
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
