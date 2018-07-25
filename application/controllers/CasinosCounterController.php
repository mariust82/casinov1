<?php
require_once("BaseController.php");
require_once("hlis/server_caching/src/CacheManager.php");
require_once("hlis/server_caching/src/CacheKey.php");
/**
 * Controller
 */
abstract class CasinosCounterController extends BaseController {
    public function service() {
        $object = $this->getCounter();
        $this->response->setAttribute("results", $this->getResults($object));
    }

    protected function getResults(CasinoCounter $object) {
        $cacheManager = new CacheManager(new CacheKey(
            "casinos_counter_".get_class($object)
        ));
        if($results = $cacheManager->get()) {
            return $results;
        } else {
            $counts = $object->getCasinosCount();
            $cacheManager->set($counts);
            return $counts;
        }
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