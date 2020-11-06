<?php
require_once("AbstractSitemapController.php");

class LiveDealerController extends AbstractSitemapController
{
    public function run()
    {
        parent::run();
        $this->response->attributes("sitemap", $this->addLiveDealer($this->response->attributes("sitemap")));
    }

    protected function getItems()
    {
        return ["Roulette"=>date("Y-m-d"),"Blackjack"=>date("Y-m-d"),"Baccarat"=>date("Y-m-d"),"Craps"=>date("Y-m-d"),"Live Dealer"=>date("Y-m-d")];
    }

    protected function getUrlPattern()
    {
        return "live-dealer/(item)";
    }

    private function getSecondaryUrl()
    {
        return "features/(item)";
    }

    protected function getPriority()
    {
        return "0.8";
    }

    private function addLiveDealer($pages)
    {
        $protocol = $this->request->getProtocol();
        $hostName = $this->request->getServer()->getName();
        $pages[4]->loc = $protocol."://".$hostName."/".strtolower(str_replace(" ", "-", str_replace("(item)", htmlspecialchars("Live Dealer"), "features/(item)")));
        return $pages;
    }
}
