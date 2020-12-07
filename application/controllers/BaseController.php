<?php
require_once("application/models/dao/TopMenu.php");
require_once("application/models/dao/PageInfoDAO.php");
require_once("hlis/tms/src/VariablesHolder.php");
require_once("hlis/widgets/src/ContentManager.php");
abstract class BaseController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
        $specificPage = $this->request->getURI()->getPage();
        if($specificPage == 'games/slots') {
            $this->response->setStatus(301);
            $this->response->redirect('/games/classic-slots');
        }
        if($specificPage == 'casinos/popular') {
            $this->response->setStatus(301);
            $this->response->redirect('/casinos/best');
        }
        $country = $this->request->attributes("country");
        $this->response->attributes("country", $country);
        $menu = new TopMenu($this->request->getValidator()->getPage(), $specificPage, $country);
        $this->response->attributes("menu_top", $menu->getEntries());
        $this->service();
        $this->pageInfo();
        $this->response->attributes('is_mobile', $this->request->attributes("is_mobile"));
        $this->response->attributes("version", $this->application->getVersion());
        $this->response->attributes("use_bundle", (in_array(ENVIRONMENT, ["dev","live"])?true:false));
        $contentManager = new \CMS\ContentManager(
            $this->request->getURI()->getPage()?$this->request->getURI()->getPage():"index",
            $this->application->attributes("parent_schema"),
            (string) $this->application->getTag("application")->paths->widgets,
            ["response"=>$this->response, "request"=>$this->request]
        );
        $this->response->attributes("widgets", $contentManager->getTexts(true));
    }

    abstract protected function service();

    abstract protected function pageInfo();

}
