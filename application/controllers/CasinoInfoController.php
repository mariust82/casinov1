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

		$this->response->attributes()->set("country", $this->request->attributes()->get("country"));
		// get casino info
		$object = new CasinoInfo($this->request->attributes()->get('validation_results')->get('name'), $this->request->attributes()->get("country")->id);
        $info = $object->getResult();

		if(empty($info)){
		    throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }

        $this->response->attributes()->set("casino", (array) $info);
        $this->response->attributes()->set("user_score",
            $object->getUserVote(
            $info->id,
            $this->request->attributes()->get('ip')) == FALSE ? 0: $object->getUserVote($info->id,  $this->request->attributes()->get('ip')));
        $this->response->attributes()->set('user_score_class',$object->getScoreClass($this->response->attributes()->get('user_score')));

        // get reviews
        $object = new CasinoReviews();
        $total = $object->getAllTotal($info->id);

        if($total>0) {
            $this->response->attributes()->set("total_reviews",$total);
            $this->response->attributes()->set("reviews", $object->getAll($info->id, 0, 0));
        } else {
            $this->response->attributes()->set("total_reviews", 0);
            $this->response->attributes()->set("reviews", array());
        }
        $this->response->attributes()->set('country_status',$this->get_country_status($info->is_country_accepted));
        $this->response->attributes()->set('add_text',$this->containsCasino($info->name));
     //   var_dump($this->response->attributes()->get('BOOM'));die();
	}

	protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->attributes()->set("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes()->get("casino")["name"]));
    }

    private function get_country_status($name)
    {
        if ($name) {
            $string = 'accepted';
        } else {
            $string = 'not-accepted';
        }

        return $string;
    }

    private function containsCasino($name)
    {
        return strpos($name, 'Casino');
    }

}
