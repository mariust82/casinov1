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
        var_dump($items);
        $uploadsFolders = [];
        foreach ($items['results'] as $item) {
            $this->uploadFodler = $this->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] = "/upload" . $this->uploadFodler;
            $uploadsFolders[$item->id] .= "/" . str_replace(" ", "_", $item->title) . "_thumbnail.jpg?" . strtotime("now");
        }
        return $uploadsFolders;
    }
    
}
