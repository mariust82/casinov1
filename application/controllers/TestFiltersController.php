<?php
require_once("application/models/dao/TestFiltersDAO.php");


class TestFiltersController extends \Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        //$mResult = $this->request->getValidator()->parameters("name");
        //$mResult = $this->request->attributes('validation_results')->get('name');
        //$mResult = $this->request->parameters("name");
        $aParameters = $this->request->parameters();


        $object = new TestFiltersDAO();
        $this->response->attributes("casinos", $object->getCasinosInfo($aParameters));
    }
}