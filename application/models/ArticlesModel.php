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
    protected $uploadFodler;
   
    protected function getUploadsFolder($object, $operationType)
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
            case 'publish':
                if (!$object) {
                    return '/blogs/drafts/tmp';
                }
                return '/' . $object->payload->id;
            case 'live':
                return '/' . $object->id;
        }
    }
    
    public function getUploadsFolders($items)
    {
        $uploadsFolders = [];
        foreach ($items['results'] as $item) {
            $this->uploadFodler = $this->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] = "/upload" . $this->uploadFodler;
            $exp = explode('/', $item->thumbnail);
            $img = end($exp);
            $uploadsFolders[$item->id] .= "/" . $img;
        }
        return $uploadsFolders;
    }
    
}
