<?php
require_once("application/models/dao/TestPageDAO.php");


class TestAjaxController extends \Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $openedCasinos = $this->request->parameters('openedCasinos');

        /*echo "<pre>";
        var_dump($openedCasinos);
        die();*/


        $object = new TestPageDAO($openedCasinos);
        $this->response->attributes("casinos", $object->getCasinosInfo());
    }
}