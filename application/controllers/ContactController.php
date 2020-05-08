<?php
require_once("BaseController.php");

class ContactController extends BaseController
{
    public function service()
    {
    }

    protected function pageInfo()
    {
        $object = new PageInfoDAO();
        $this->response->attributes("page_type", substr($_SERVER["REQUEST_URI"], 1));
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
