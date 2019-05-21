<?php
require_once("application/models/dao/Casinos.php");

class CasinoTermsVisitController extends Lucinda\MVC\STDOUT\Controller
{
    public function run() {
        $casino_id =  $this->request->attributes()->get('validation_results')->get('name');
        // get link
        $casino = new Casinos();
        $termsLink = $casino->getTermsLink($casino_id);
        if(!$termsLink) throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        // redirect to link
        header("Location: ".$termsLink);
        exit();
    }
}