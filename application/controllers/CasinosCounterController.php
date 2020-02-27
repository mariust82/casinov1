<?php
require_once("BaseController.php");
require_once("application/models/caching/CasinosCounterKey.php");
/**
 * Lucinda\MVC\STDOUT\Controller
 */
abstract class CasinosCounterController extends BaseController
{
    public function service()
    {
        $object = $this->getCounter();
        $this->response->attributes("results", $this->getResults($object));
        $this->init();
    }
    
    protected function init() {}

    protected function getResults(CasinoCounter $object)
    {
        $counts = $object->getCasinosCount();
        return $counts;
    }

    /**
     * Gets counter instance
     *
     * @return CasinoCounter
     */
    abstract protected function getCounter();

    protected function pageInfo()
    {
        $object = new PageInfoDAO();
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }
}
