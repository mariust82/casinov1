<?php
namespace CMS;

require_once(dirname(__DIR__,3)."/hlis/widgets/src/parameters/input/Text.php");
require_once(dirname(__DIR__,3)."/hlis/widgets/src/parameters/input/TextArea.php");

class Tms implements Widget
{
    private $variablesFolder;
    private $schema;

    public function __construct()
    {
        // define variables folder
        $this->variablesFolder = dirname(__DIR__)."/tms_variables";

        // remember detection
        $constant = "TMS_SCHEMA";
        if (!defined($constant)) {
           $xml = simplexml_load_file(dirname(__DIR__,3)."/stdout.xml");
           define($constant, (string) $xml->servers->sql->{ENVIRONMENT}->server["parent_schema"]);
        }
        $this->schema = constant($constant);
    }

    // route must exist already in tms for this to work
    public function get($remoteID)
    {
        $output = [];

        // get title
        $title = new \CMS\Parameter\Input\Text();
        $title->name = "title";
        $output[] = $title;

        // get description
        $description = new \CMS\Parameter\Input\TextArea();
        $description->name = "description";
        $description->required = true;
        $output[] = $description;

        // feed values
        $resultSet = \SQL("SELECT
        id, title, description
        FROM ".$this->schema.".tms
        WHERE remote_id = :id AND (title<>'' OR description<>'')", [":id"=>$remoteID]);
        while ($row = $resultSet->toRow()) {
            $title->value = $row["title"];
            $description->value = $row["description"];
        }

        return $output;
    }

    public function set($parameters, $remoteID)
    {
        \SQL("DELETE FROM tms WHERE remote_id=:remote_id", [":remote_id"=>$remoteID]);
        \SQL("INSERT INTO tms (title, description, remote_id) VALUES (:title, :description, :remote_id)", [
            ":title"=>(string) $parameters[0]->value,
            ":description"=>(string) $parameters[1]->value,
            ":remote_id"=>$remoteID
        ]);
    }

    public function remove($remoteID)
    {
        \SQL("DELETE FROM tms WHERE remote_id = :remote_id", [":remote_id"=>$remoteID]);
    }

    public function render($remoteID, $extraBindings=array())
    {
        $row = \SQL("SELECT title, description FROM ".$this->schema.".tms WHERE remote_id=:remote_id", [":remote_id"=>$remoteID])->toRow();
        if (empty($row)) {
            return "";
        }
        $title = ($row["title"]?"<h3>".$row["title"]."</h3>":"");
        $variables= new Variables($this->variablesFolder, $extraBindings);
        $description = $variables->process($row["description"]);
        return $title."\n".$description;
    }
}