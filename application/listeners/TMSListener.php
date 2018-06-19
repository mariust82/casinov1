<?php
require_once("hlis/tms_client/src/TextsManager.php");

class TMSListener extends ResponseListener
{
    public function run() {
        if(strpos($this->response->headers()->get("Content-Type"),"text/html")!==0) return;

        // gets variables path
        $xml = $this->application->getXML();
        $variables_folder = (string) $xml->application->paths->tms_variables;

        // gets parent schema
        $parent_schema = $this->application->getAttribute("parent_schema");

        // gets texts
        $tms = new \TMS\TextsManager($variables_folder, array("request"=>$this->request, "response"=>$this->response), $parent_schema);
        $this->response->setAttribute("tms", $tms->getTexts());
    }
}