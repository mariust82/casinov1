<?php
require_once("application/models/dao/Casinos.php");

class CasinoTermsVisitController extends Controller
{
    public function run() {
        $casino_id =  $this->request->getAttribute('validation_results')->get('name');
        // get link
        $casino = new Casinos();
        $termsLink = $casino->getTermsLink($casino_id);
        if(!$termsLink) throw new PathNotFoundException();
        // redirect to link
        header("Location: ".$termsLink);
        exit();
    }
}