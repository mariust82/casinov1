<?php
require_once("application/models/DB.php");
//require_once("application/models/dao/Countries.php");
//require_once("application/models/dao/Casinos.php");
//require_once("application/models/dao/Softwares.php");
//require_once("application/models/dao/BankingMethods.php");
//
require_once("application/models/page_info/GenericInfo.php");
require_once("application/models/page_info/XmlPageInfo.php");
require_once("application/models/page_info/ModelPageInfo.php");
require_once("hlis/tms/src/TextsManager.php");

abstract class PageController extends Lucinda\MVC\STDOUT\Controller
{
    /**
     * @var GenericInfo
     */
    protected $pageInfo = null;
    protected $website_info = ['website_name' => 'casinoslists.com'];
    protected $page_info = [
        'head' => [
            'title' => '',
            'description' => ''
        ],
        'body' => [
            'title' => '',
            'subtitle' => '',
            'description' => '',
        ]
    ];

    function __construct(Lucinda\MVC\STDOUT\Application $objApplication, Lucinda\MVC\STDOUT\Request $objRequest, Lucinda\MVC\STDOUT\Response $objResponse)
    {
        parent::__construct($objApplication, $objRequest, $objResponse);
        $this->website_info['date'] = date('F Y');
        $this->website_info['year'] = date('Y');
        $this->pageInfo = new GenericInfo(new ModelPageInfo($this->application, $this->request));
        $this->page_info = $this->pageInfo->getInfo();
        $this->response->attributes("dynamic_vars", $this->getTMSVariables());
    }

    protected function setExtraData()
    {
        $environment = ENVIRONMENT;
        $use_bundle = false;
        if($environment == 'dev' || $environment == 'live') {
            $use_bundle = true;
        }
        $this->response->attributes("use_bundle", $use_bundle);

        $this->response->attributes("page_info", $this->getPageInfo());

        $this->response->attributes("user_country", $this->request->attributes('country'));
//
//        $countries_ctrl = new Countries();
//        $countries = $countries_ctrl->getAllByPosition();
//        $this->response->attributes("countries", $countries);
//
//
//        $casinos_ctrl = new Casinos();
//        $dates = $casinos_ctrl->getHistoryInfoDates();
//        $this->response->attributes("casino_history_dates", $dates);
//
//        $software_ctrl = new Softwares();
//        $softwares = $software_ctrl->getAllByPosition();
//        $this->response->attributes("softwares", $softwares);
//
//        $bankingmethod_ctrl = new BankingMethods();
//        $bankingmethods = $bankingmethod_ctrl->getAllByPosition();
//        $this->response->attributes("payment_methods", $bankingmethods);

        $this->response->attributes("version", $this->application->getVersion());
    }

    public function run()
    {
        $this->setExtraData();
    }

    public function compilePageInfo(&$page_info)
    {
        $keys = array_map('strlen', array_keys($this->website_info));
        array_multisort($keys, SORT_DESC, $this->website_info);
        foreach ($page_info as &$info) {
            if (is_string($info)) {
                foreach ($this->website_info as $wi_var => $wi_val) {
                    $info = str_replace(":$wi_var", $wi_val, $info);
                }
            }
            if (is_array($info)) $this->compilePageInfo($info);
        }
    }

    public function getPageInfo()
    {
        $this->compilePageInfo($this->page_info);
        return $this->page_info;
    }

    protected function getTMSVariables() {
        // gets variables path
        $xml = $this->application->getTag("application");
        $variables_folder = (string) $xml->paths->tms_variables;

        // gets parent schema
        $parent_schema = $this->application->attributes("parent_schema");

        // gets texts
        $tms = new \TMS\TextsManager($variables_folder, array("request"=>$this->request, "response"=>$this->response), $parent_schema);
        return $tms->getTexts();
    }
}
