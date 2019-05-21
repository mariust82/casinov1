<?php
require_once("hlis/tms/src/TextsManager.php");

class TMSListener extends Lucinda\MVC\STDOUT\ResponseListener
{
    public function run() {
        if(strpos($this->response->headers()->get("Content-Type"),"text/html")!==0) return;

        // gets variables path
        $xml = $this->application->getTag("application");
        $variables_folder = (string) $xml->paths->tms_variables;

        // gets parent schema
        $parent_schema = $this->application->attributes()->get("parent_schema");

        // gets texts
        $tms = new \TMS\TextsManager($variables_folder, array("request"=>$this->request, "response"=>$this->response), $parent_schema);
        $this->response->attributes()->set("tms", $tms->getTexts());
    }
}