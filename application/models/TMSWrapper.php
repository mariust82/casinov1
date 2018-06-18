<?php
class TMSWrapper
{
    private $parent_schema;
    private $variables_folder;
    private $request;

    public function __construct(Application $application, Request $request) {
        // gets variables path
        $xml = $application->getXML();
        $this->variables_folder = (string) $xml->application->paths->tms_variables;

        // sets parent_schema
        $this->parent_schema = $application->getAttribute("parent_schema");

        // sets client request
        $this->request = $request;
    }

    public function getTexts($variables_parameters=array()) {
        require_once("hlis/tms_client/src/TextsManager.php");

        $tms = new \TMS\TextsManager(
            $this->variables_folder,
            $variables_parameters,
            $this->parent_schema);
        return $tms->getTexts();
    }
}