<?php
namespace CasinosLists;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FAQ
 *
 * @author matan
 */
class FAQ implements \CMS\Widget {
    public function get($remoteID) {
        $output = [];

        // get description
        $description = new \CasinosLists\Parameter\Input\FAQ();
        $description->name = "description";
        $description->required = true;
        $output[] = $description;

        // feed values
        $resultSet = \SQL("SELECT
        id, title, description
        FROM ".$this->schema.".faq
        WHERE remote_id = :id AND (title<>'' OR description<>'')", [":id"=>$remoteID]);
        while ($row = $resultSet->toRow()) {
            $description->value = $row["description"];
        }
        
        return $output;
    }

    public function remove($remoteID) {
        \SQL("DELETE FROM faq WHERE remote_id = :remote_id", [":remote_id"=>$remoteID]);
    }

  

    public function set($remoteID, $parameters) {
        \SQL("DELETE FROM faq WHERE remote_id=:remote_id", [":remote_id"=>$remoteID]);
        \SQL("INSERT INTO faq (description, remote_id) VALUES (:description, :remote_id)", [
            ":description"=>(string) $parameters[0]->value,
            ":remote_id"=>$remoteID
        ]);
    }

    public function render($remoteID, $extraBindings = array()) {
        $row = \SQL("SELECT description FROM ".$this->schema.".faq WHERE remote_id=:remote_id", [":remote_id"=>$remoteID])->toRow();
        if (empty($row)) {
            return "";
        }
        $variables= new Variables($this->variablesFolder, $extraBindings);
        $description = $variables->process($row["description"]);
        return $description;
    }

}
