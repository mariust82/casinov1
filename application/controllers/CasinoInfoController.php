<?php
require_once("application/models/dao/CasinoInfo.php");

/*
* Info/review page of casino
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2ac8aa9a-cd45-4dd5-a9ca-4cd88dc4e291/Casino-Review-Page?fullscreen
* @pathParameter name string Name of casino
*/
class CasinoInfoController extends Controller {
	public function run() {
		$this->response->setAttribute("country", $this->request->getAttribute("country"));

		// validate inputs
		$casinoName = $this->request->getValidator()->getPathParameter("name");
		if(!$casinoName) throw new PathNotFoundException();

		// get casino info
		$object = new CasinoInfo(str_replace("-"," ", $casinoName), $this->request->getAttribute("country")->id);
		$info = $object->getResult();
		if(empty($info)) throw new PathNotFoundException();
        $this->response->setAttribute("casino", $info);

        // get reviews
        $reviews = $object->getReviews($info->id);
        $this->response->setAttribute("reviews", $reviews["rows"]);
        $this->response->setAttribute("total_reviews", $reviews["total"]);
	}
}
