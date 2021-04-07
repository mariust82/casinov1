<?php
require_once("application/models/dao/CasinosCompareList.php");
require_once("application/models/dao/CasinoInfo.php");
require_once("application/models/dao/CasinoReviews.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("application/models/CasinoFilter.php");
require_once("BaseController.php");


/*
* Info/review page of casino
*
* @requestMethod GET
* @responseFormat HTML
* @source https://xd.adobe.com/view/7bbdd623-2cdd-4cf4-971f-98d886e7a2b8/screen/2ac8aa9a-cd45-4dd5-a9ca-4cd88dc4e291/Casino-Review-Page?fullscreen
* @pathParameter name string Name of casino
*/
class CasinoInfoController extends BaseController
{
    private $casinoInfo;

    public function service()
    {
        $this->response->attributes("country", $this->request->attributes("country"));
        // get casino info
        $object = new CasinoInfo($this->request->attributes('validation_results')->get('name'), $this->request->attributes("country")->id);
        $info = $object->getResult();

        if (empty($info)) {
            throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        }

        $this->casinoInfo = $info;
        $this->response->attributes("casino", (array) $info);
        $this->response->attributes("casino_score", $object->getCasinoScore($info->id) == false ? 0: $object->getCasinoScore($info->id));
        $this->response->attributes('casino_score_class', $object->getScoreClass($this->response->attributes('casino_score')));
        $this->response->attributes("user_score", $object->getUserScore($info->id,$this->request->attributes('ip')) == false ? 0: $object->getUserScore($info->id, $this->request->attributes('ip'))
        );
        // get reviews
        $object = new CasinoReviews();
        $total = $object->getAllTotal($info->id);
        $total_votes = $object->getAllVotes($info->id);
        $this->response->attributes("reviews_limit", $object::LIMIT);
        $this->response->attributes("replies_limit", $object::LIMIT_REPLIES);
        $this->response->attributes("total_votes", $total_votes);

        if ($total>0) {
            $this->response->attributes("total_reviews", $total);
            $this->response->attributes("reviews", $object->getAll($info->id, 0));
        } else {
            $this->response->attributes("total_reviews", 0);
            $this->response->attributes("reviews", array());
        }
        $this->response->attributes('country_status', $this->get_country_status($info->is_country_accepted));
        $this->response->attributes('add_text', $this->containsCasino($info->name));
        $this->response->attributes('country_status_text', $object->getCountryStatusText($this->response->attributes('country_status')));
        
        // get compare list (CASLI-1685)
        $filter = new CasinoFilter([], $this->request->attributes("country"));
        $object = new CasinosCompareList($filter);
        $this->response->attributes("compare_list", $object->getList($info, 5));
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $position = strpos($_SERVER["REQUEST_URI"], "/", 1);
        $url = ($position?substr($_SERVER["REQUEST_URI"], 1, $position-1):$_SERVER["REQUEST_URI"]);

        $pageInfo = $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("casino")["name"]);
        if(!empty($this->casinoInfo->bonus_free)) {
            $pageInfo->head_description .= ' | Sign up Bonus: '.$this->casinoInfo->bonus_free->amount.' '.$this->casinoInfo->bonus_free->type;
        }elseif (!empty($this->casinoInfo->bonus_first_deposit)) {
            $pageInfo->head_description .= ' | Sign up Bonus: '.$this->casinoInfo->bonus_first_deposit->amount.' '.$this->casinoInfo->bonus_first_deposit->type;
        }

        $this->response->attributes("page_type", $url);
        $this->response->attributes("page_info", $pageInfo);
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
