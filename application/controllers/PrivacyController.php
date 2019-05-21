<?php
require_once("BaseController.php");

class PrivacyController extends BaseController{
    public function service() {}
    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}