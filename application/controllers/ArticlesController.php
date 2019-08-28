<?php

require_once "BaseController.php";
require_once "application/models/dao/Articles.php";

/*
 * Articles listing
 * 
 * @requestMethod GET
 * @responseFormat HTML
 * @source https://xd.adobe.com/view/0a58ee82-5e30-4ccc-8684-773ff1f88604/screen/a976ee1f-c33f-4a82-bcce-e451e04edc18/Article-List
 */

class ArticlesController extends BaseController {

    const LIMIT = 100;

    protected function pageInfo() {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("selected_entity"), $total_casinos));
    }

    private function getOffset() {
        $offset = 0;
        if (!empty($_GET['page']))
            $offset = ((int) $_GET['page'] - 1) * $this::LIMIT;
        return $offset;
    }

    protected function service() {
        $articles_ctrl = new Articles($this->application->attributes('parent_schema'));
        $items = $articles_ctrl->getList([], $this->getOffset(), self::LIMIT);
        foreach ($items['results'] as $item) {
            $uploadsFolders[$item->id] = "/upload" . $articles_ctrl->getUploadsFolder($item, 'live');
            $uploadsFolders[$item->id] .= "/" . str_replace(" ", "_", $item->title) . "_thumbnail.jpg?" . strtotime("now");
        }

        $this->response->attributes("results", $items['results']);
        $this->response->attributes("total", $items['total']);
        $this->response->attributes("uploadsFolders", $uploadsFolders);
    }

}
