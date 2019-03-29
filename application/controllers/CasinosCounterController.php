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
        $this->response->setAttribute('software_logo_small',$this->getSoftwareLogo($this->response->getAttribute('results')));
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

   private function getSoftwareLogo($logo_name){

        $logo = array();
        $index =0;
        foreach ($logo_name as $key => $value)
        {
            $logo[$index++] = "/public/sync/software_logo_light/80x53/".strtolower(str_replace(" ", "_", $key)).".png";
        }
        return $logo;
    }
}