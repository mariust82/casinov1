<?php
require_once("BaseController.php");

class TestController extends BaseController
{
    public function service()
    {
    }

    protected function pageInfo()
    {
        $this->request->parameters("offset");

        $object = new TestPageDAO();
        $this->response->attributes("casinos", $object->getCasinosInfo());
    }
}