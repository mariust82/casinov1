<?php
require_once("BaseController.php");

class TermsController extends BaseController
{
    public function service()
    {
    }

    protected function pageInfo()
    {
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
