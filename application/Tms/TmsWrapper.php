<?php

/**
 * a wrapper class for TMS, to keep implementation in one place
 * it return just the tms text.
 */

require_once("hlis/tms/src/TextsManager.php");

class TmsWrapper{

    private $application;
    private $request;
    private $response;


    public function __construct($application, $request, $response)
    {
        $this->application = $application;
        $this->request = $request;
        $this->response  = $response;

        return $this->getText();
    }

    private function getXML(){
        return $this->application->getXML();
    }

    private function getParentSchema(){

        return $this->application->getAttribute("parent_schema");
    }

    private function getVariablesFolder(){

        return $this->getXML()->application->paths->tms_variables;
    }


    public function getText(){

        $tms = new \TMS\TextsManager(
            $this->getVariablesFolder(),
            array(
                "request"=>$this->request,
                "response"=>$this->response
            ),
            $this->getParentSchema());

        return $tms;
    }

}