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

		// validate inputs
		$casinoName = $this->request->getValidator()->getPathParameter("name");
		if(!$casinoName) throw new PathNotFoundException();

		// get casino info
		$object = new CasinoInfo(str_replace("-"," ", $casinoName), $this->request->getAttribute("country")->id);
		$info = $object->getResult();
		if(empty($info)) throw new PathNotFoundException();
                $this->response->setAttribute("casino", $info);
                $this->response->setAttribute("user_score", $object->getUserVote($info->id,  $this->request->getAttribute('ip')) == FALSE?0:$object->getUserVote($info->id,  $this->request->getAttribute('ip')));

        // get reviews
        $object = new CasinoReviews();
        $total = $object->getAllTotal($info->id);
        if($total>0) {
            $this->response->setAttribute("total_reviews", $total);
            $this->response->setAttribute("reviews", $object->getAll($info->id, 0, 0));
        } else {
            $this->response->setAttribute("total_reviews", 0);
            $this->response->setAttribute("reviews", array());
        }

	$casinoInfo = $this->response->getAttribute("casino");
        $softwareName = (!empty($casinoInfo->softwares)?$casinoInfo->softwares[0]:"NetEnt");
        $menuBottom = new CasinosMenu($this->request->getAttribute("country")->name, $softwareName, "softwares/".strtolower(str_replace(" ", "-", $softwareName)));
        $this->response->setAttribute("menu_bottom", $menuBottom->getEntries());

	}

	protected function pageInfo(){
        // get page info
        $object = new PageInfoDAO();
        $this->response->setAttribute("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->getAttribute("casino")->name));
    }
}
