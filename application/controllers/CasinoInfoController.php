<?php
require_once("application/models/dao/CasinoInfo.php");
require_once("application/models/dao/CasinoReviews.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");


/*
* Info/review page of casino
* 
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2ac8aa9a-cd45-4dd5-a9ca-4cd88dc4e291/Casino-Review-Page?fullscreen
* @pathParameter name string Name of casino
*/
class CasinoInfoController extends BaseController {

	public function service() {

		$this->response->setAttribute("country", $this->request->getAttribute("country"));
		// get casino info
		$object = new CasinoInfo($this->request->getAttribute('validation_results')->get('name'), $this->request->getAttribute("country")->id);
        $info = $object->getResult();

        $casinoID = $this->request->getAttribute("validation_results")->get('name');
        $countryID = $this->request->getAttribute("country")->id;
        $this->response->setAttribute("can_review",$object->isCountryAccepted($casinoID,$countryID));

		if(empty($info)){
		    throw new PathNotFoundException();
        }

        $this->response->setAttribute("casino", $info);
        $this->response->setAttribute("user_score",
            $object->getUserVote(
            $info->id,
            $this->request->getAttribute('ip')) == FALSE ? 0: $object->getUserVote($info->id,  $this->request->getAttribute('ip')));

        // get reviews
        $object = new CasinoReviews();

        $total = $object->getAllTotal($info->id);

        if($total>0) {
            $this->response->setAttribute("total_reviews",$total);
            $this->response->setAttribute("reviews", $object->getAll($info->id, 0, 0));
        } else {
            $this->response->setAttribute("total_reviews", 0);
            $this->response->setAttribute("reviews", array());
        }
	}

	protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("casino")->name));
    }

}
