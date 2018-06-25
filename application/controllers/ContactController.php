<?php
require_once("BaseController.php");

class ContactController extends BaseController
{
    public function service() {}

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}