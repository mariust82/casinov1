<?php

require_once "BaseController.php";
require_once "application/models/dao/Articles.php";
require_once "application/models/ArticlesModel.php";

/*
 * Articles listing
 *
 * @requestMethod GET
 * @responseFormat HTML
 * @source https://xd.adobe.com/view/0a58ee82-5e30-4ccc-8684-773ff1f88604/screen/a976ee1f-c33f-4a82-bcce-e451e04edc18/Article-List
 */

class ArticlesController extends BaseController
{
    const LIMIT = 9;
    protected $filter;
    protected $category;
    protected $offset;
    protected $page;
    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("selected_entity"), $total_casinos));
    }
    
    protected function init()
    {
        $this->filter = [];
        $this->category = "blog";
        $this->page = $this->request->getValidator()->parameters('page');
        $this->offset = self::LIMIT*$this->page;
    }

    protected function service()
    {
        $this->init();
        $articles_ctrl = new Articles($this->application->attributes('parent_schema'));
        $items = $articles_ctrl->getList($this->filter, $this->offset, self::LIMIT);
        $upload = new ArticlesModel($items);
        $this->response->attributes("results", $items['results']);
        $this->response->attributes("category", $this->category);
        $this->response->attributes("total", $items['total']);
        $this->response->attributes("uploadsFolders", $upload->getUploadsFolders($items));
    }
}
