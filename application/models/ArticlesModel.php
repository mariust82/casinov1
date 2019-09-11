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
    
    public function getUploadsFolders($items)
    {
        $uploadsFolders = [];
        foreach ($items['results'] as $item) {
            $this->uploadFodler = $this->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] = "/upload" . $this->uploadFodler;
            $img = end(explode('/', $item->thumbnail));
            var_dump($img);
            $uploadsFolders[$item->id] .= "/" .  . "?" . strtotime("now");
        }
        return $uploadsFolders;
    }
    
}
