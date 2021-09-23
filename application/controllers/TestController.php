<?php
//require_once("BaseController.php");

require_once("application/models/dao/TestPageDAO.php");


class TestController extends \Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        //$this->request->parameters("offset");
        //$parameter = $this->request->getValidator()->parameters("name");

        $object = new TestPageDAO();
        $this->response->attributes("casinos", $object->getCasinosInfo());
    }
}