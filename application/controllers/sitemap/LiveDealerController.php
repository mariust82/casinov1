<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 23-Jul-19
 * Time: 11:20 AM
 */

require_once("AbstractSitemapController.php");
require_once("application/models/AvailableDealersInSite.php");

class LiveDealerController extends AbstractSitemapController{

    public function run() {
        parent::run();

        $this->response->attributes("pages", $this->AddPages(  $this->response->attributes("pages")));
    }

    protected function getItems(){
        $dealers = new AvailableDealersInSite();
        $items = $dealers->getItems();
        return $items;
    }

    protected function getUrlPattern(){
        return "live-dealer/(item)";
    }

    private function getSecondaryUrl(){
        return "features/(item)";
    }

    protected function getPriority() {
        return "0.8";
    }

    private function  AddPages($pages){

        $protocol = $this->request->getProtocol();
        $special_case = new AvailableDealersInSite();
        $items = $special_case->getSpecialCase();
        foreach ($items as $item)
            $pages[] =  $protocol."://".$this->request->getServer()->getName()."/".strtolower(str_replace(" ", "-", str_replace("(item)", htmlspecialchars($item), $this->getSecondaryUrl())));

        return $pages;
   }
}

