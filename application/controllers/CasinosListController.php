<?php
require_once("application/models/CasinoFilter.php");
require_once("application/models/CasinoSortCriteria.php");
require_once("application/models/dao/CasinosList.php");
require_once("application/models/dao/CasinosMenu.php");
require_once("BaseController.php");
require_once("application/models/caching/CasinosListKey.php");

abstract class CasinosListController extends BaseController
{
    protected $limit = 100;

    public function service()
    {
        $this->response->attributes("selected_entity", ucwords($this->getSelectedEntity()));
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));

        $menuBottom = new CasinosMenu($this->request->attributes("country")->name, $this->response->attributes("selected_entity"), $this->request->getURI()->getPage());
        $this->response->attributes("menu_bottom", $menuBottom->getEntries());
        $this->response->attributes("country", $this->request->attributes("country"));
        $this->response->attributes("filter", $this->getFilter());
        $this->response->attributes("sort_criteria", $this->getSortCriteria());

        $results = $this->getResults();
        $this->response->attributes("total_casinos", $results["total"]);
        $this->response->attributes("casinos", $results["list"]);
        $this->response->attributes("page_type", $this->get_page_type());
        $this->response->attributes('bonus_free_type', $this->getAbbreviation($this->response->attributes('casinos')));
        $this->init();
       
    }
    
    protected function init() {}

    private function getResults()
    {
        $filter = new CasinoFilter(
            array($this->response->attributes("filter") => $this->response->attributes("selected_entity")),
            $this->request->attributes("country")
        );

        $object = new CasinosList($filter);
        $results = array();
        $results["total"] = $object->getTotal();
        $results["list"] = ($results["total"]>0 ? $object->getResults($this->response->attributes("sort_criteria"), 1, $this->limit) : array());

        return $results;
    }

    abstract protected function getSelectedEntity();

    abstract protected function getFilter();

    protected function getSortCriteria()
    {
        return CasinoSortCriteria::NONE;
    }

    protected function generatePathParameter($name)
    {
        return strtolower(str_replace(" ", "-", $name));
    }

    protected function pageInfo()
    {
        // get page info
        $object = new PageInfoDAO();
        $total_casinos = !empty($this->response->attributes("total_casinos")) ? $this->response->attributes("total_casinos") : '';
        $this->response->attributes("page_info", $object->getInfoByURL($this->request->getValidator()->getPage(), $this->response->attributes("selected_entity"), $total_casinos));
    }

    private function get_page_type()
    {
        $position = strpos($_SERVER["REQUEST_URI"], "/", 1);
        $url = ($position?substr($_SERVER["REQUEST_URI"], 1, $position-1):$_SERVER["REQUEST_URI"]);
        $page = substr($_SERVER["REQUEST_URI"], $position+1);
        if ($page === 'no-deposit-bonus') {
            return 'free_bonus';
        }
        switch ($url) {
            case 'casinos':
                $piece = 'label';
                break;
            case 'softwares':
                $piece = 'software';
                break;
            case 'bonus-list':
                $piece = 'bonus_type';
                break;
            case 'countries-list':
                $piece = 'country';
                break;
            case 'banking':
                $piece = 'banking_method';
                break;
            case 'features':
                $piece = 'feature';
                break;
            case  'live-dealer':
                $piece = 'live_dealer';
        }
        return $piece;
    }

    private function getAbbreviation($casinos)
    {
        $abbr = array();
        $index = 0;
        foreach ($casinos as $casino) {
            $abbr[$index] = null;
            if ($casino->bonus_free) {
                $name = $casino->bonus_free->type;

                $words = explode(" ", $name);
                foreach ($words as $word) {
                    $abbr[$index] .= $word[0];
                }
            }
            $index++;
        }
        return $abbr;
    }
}
