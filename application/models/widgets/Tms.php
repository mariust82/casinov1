<?php
namespace CMS;

require_once(dirname(__DIR__,3)."/hlis/widgets/src/Widget.php");
require_once(dirname(__DIR__,3)."/hlis/widgets/src/parameters/Text.php");

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
    public function get($routeURL)
    {
        $output = [];
        $routeID = \SQL("SELECT id FROM ".$this->schema.".tms__routes WHERE value=:value", [":value"=>$routeURL])->toValue();
        if($routeID) {
            $resultSet = \SQL("SELECT
            t2.value AS slot, t3.value AS content_value, t3.id AS content_id
            FROM ".$this->schema.".tms__routes AS t1
            INNER JOIN ".$this->schema.".tms__route_patterns_positions AS t2 ON t1.route_pattern_id = t2.route_pattern_id
            LEFT JOIN ".$this->schema.".tms__content AS t3 ON t3.route_id = t1.id AND t3.position_id = t2.id
            WHERE t1.id = :id", [":id"=>$routeID]);
        } else {
            $resultSet = \SQL("SELECT
            value AS slot, NULL AS content_value, NULL AS content_id
            FROM ".$this->schema.".tms__route_patterns_positions
            WHERE route_pattern_id = :id", [":id"=>$this->getPatternID($routeURL)]);
        }
        while ($row = $resultSet->toRow()) {
            $object = new \CMS\Parameter\Text();
            $object->id = $row["content_id"];
            $object->multiline = (stripos($row["slot"], "title")!==false?false:true);
            $object->name = $row["slot"];
            $object->value = $row["content_value"];
            $output[] = $object;
        }
        return $output;
    }

    public function set($routeURL, $parameters, $userID)
    {
        // get route id
        $routeID = null;
        $patternID = null;
        $info = \SQL("SELECT id, route_pattern_id FROM ".$this->schema.".tms__routes WHERE value=:value", [":value"=>$routeURL])->toRow();
        if (!$info) {
            $patternID = $this->getPatternID($routeURL);
            $routeID = \SQL("INSERT INTO ".$this->schema.".tms__routes SET value=:value, route_pattern_id=:pattern", [
                ":value"=>$routeURL,
                ":pattern"=>$patternID
            ])->getInsertId();
        } else {
            $routeID = $info["id"];
            $patternID = $info["route_pattern_id"];
        }

        // get cms__pattern_slot id
        $positions = \SQL("SELECT id, value FROM ".$this->schema.".tms__route_patterns_positions WHERE route_pattern_id=:pattern", [":pattern"=>$patternID])->toMap("value", "id");

        // write to cms__content
        foreach ($parameters as $parameter) {
            if ($parameter->id) {
                \SQL("UPDATE ".$this->schema.".tms__content SET value=:value, user_id=:user_id WHERE id=:id", [
                    ":id"=>$parameter->id,
                    ":value"=>$parameter->value,
                    ":user_id"=>$userID
                ]);
            } else {
                \SQL("INSERT INTO ".$this->schema.".tms__content SET value=:value, user_id=:user_id, route_id=:route_id, position_id=:position_id", [
                    ":value"=>$parameter->value,
                    ":user_id"=>$userID,
                    ":route_id"=>$routeID,
                    ":position_id"=>$positions[$parameter->name]
                ]);
            }
        }

    }

    public function remove($remoteID, $userID)
    {
        \SQL("UPDATE ".$this->schema.".tms__content SET value='', user_id=:user_id WHERE id=:id", [
            ":id"=>$remoteID,
            ":user_id"=>$userID
        ]);
    }

    public function render($remoteID, $extraBindings=array())
    {
        $value = \SQL("SELECT value FROM ".$this->schema.".tms__content WHERE id=:id", [":id"=>$remoteID])->toValue();
        $variables= new Variables($this->variablesFolder, $extraBindings);
        return $variables->process($value);
    }

    private function getPatternID($routeURL)
    {
        $resultSet = \SQL("SELECT id, value FROM ".$this->schema.".tms__route_patterns ORDER BY id ASC");
        $patternID = 0;
        while ($row = $resultSet->toRow()) {
            $pattern = "/^".str_replace("/", '\/', preg_replace("/\(([a-zA-Z0-9]+)\)/", "(.*)", $row["value"]))."$/";
            if(preg_match($pattern, $routeURL)) {
                $patternID = $row["id"];
                break;
            }
        }
        if (!$patternID) {
            throw new Exception("Route pattern not found for: ".$routeURL);
        }
        return $patternID;
    }
}