<?php
require_once("hlis/tms/src/TextsManager.php");

class TmsWrapper{

    private $application;
    private $request;
    private $response;


    public function __construct(Lucinda\MVC\STDOUT\Application $application, Lucinda\MVC\STDOUT\Request $request, Lucinda\MVC\STDOUT\Response $response)
    {
        $this->application = $application;
        $this->request = $request;
        $this->response  = $response;
    }

    private function getParentSchema(){

        return $this->application->attributes("parent_schema");
    }

    private function getVariablesFolder(){

        return $this->application->getTag("application")->paths->tms_variables;
    }


    public function getText(){

        $tms = new \TMS\TextsManager(
            $this->getVariablesFolder(),
            array(
                "request"=>$this->request,
                "response"=>$this->response
            ),
            $this->getParentSchema());
        return $tms->getTexts();
    }

}