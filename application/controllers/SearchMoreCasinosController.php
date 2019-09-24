<?php
require_once("application/models/dao/CasinosSearch.php");

/*
* Searches for casinos after show 5 more @ advanced search is clicked
*
* @requestMethod GET
* @responseFormat JSON
* @source
* @pathParameter page integer Results page for searched casinos
* @requestParameter value string Value of searched string
*/
class SearchMoreCasinosController extends Lucinda\MVC\STDOUT\Controller
{
    const LIMIT = 5;

    public function run()
    {
        $page = (integer) $this->request->getValidator()->parameters("page");

        $object = new CasinosSearch($_GET["value"]);
        $this->response->attributes("results", $object->getResults(self::LIMIT, self::LIMIT*$page));
    }
}
