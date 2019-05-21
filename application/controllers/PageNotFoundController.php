<?php
require_once("BaseController.php");

class PageNotFoundController extends BaseController{
    public function service() {
        $this->response->setStatus(404);
    }
    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}