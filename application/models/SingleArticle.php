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
class SingleArticle extends ArticlesModel
{
    private $titleImageThumbnail = null;
    private $titleImageDesktop = null;
    private $titleImageMobile = null;
    private $items;
    
    public function __construct($items)
    {
        $this->items = $items;
        $this->setUploadPath();
    }
    
    public function denormalize($text)
    {
        $ret = preg_replace('/[- #]/', ' ', $text);
        return $ret;
    }

    private function setUploadPath()
    {
        $object = $this->items['results'][0];
        $folder =  $this->getUploadsFolder($object, 'live');
        
        if ($folder) {
            
            $exp_thumbnail = explode('/', $object->thumbnail);
            $exp_titleImageDesktop = explode('/', $object->titleImageDesktop);
            $exp_titleImageMobile = explode('/', $object->titleImageMobile);
            $thumbnail = end($exp_thumbnail);
            $titleImageDesktop = end($exp_titleImageDesktop);
            $titleImageMobile = end($exp_titleImageMobile);
            
            $this->titleImageThumbnail = '/upload' . $folder . '/' . $thumbnail. "?".strtotime("now");
            $this->titleImageDesktop = '/upload' . $folder . '/' . $titleImageDesktop. "?".strtotime("now");
            $this->titleImageMobile = '/upload' . $folder . '/' . $titleImageMobile. "?".strtotime("now");
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
