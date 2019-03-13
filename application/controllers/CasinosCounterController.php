<?php
require_once("BaseController.php");
require_once("application/models/caching/CasinosCounterKey.php");
require_once ('application/Tms/TmsWrapper.php');
/**
 * Controller
 */
abstract class CasinosCounterController extends BaseController {
    public function service() {

        $object = $this->getCounter();
        $this->response->setAttribute("results", $this->getResults($object));
        $tms = new TmsWrapper($this->application,$this->request, $this->response);
        $tmsText = $tms->getText();
        $this->response->setAttribute("tms", $tmsText);
    }

    protected function getResults(CasinoCounter $object) {
        $counts = $object->getCasinosCount();
        return $counts;
    }

    /**
     * Gets counter instance
     *
     * @return CasinoCounter
     */
    abstract protected function getCounter();

    protected function pageInfo(){
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage()));
    }


}