<?php
require_once("entities/PageInfo.php");
class PageInfoDAO
{
    public function getInfoByURL($url, $entity=null) {
        DB("SET NAMES UTF8");
        $row = DB("SELECT * FROM pages WHERE url=:url",array(":url"=>$url))->toRow();

        $object = new PageInfo();
        $object->head_title = $this->feedValues($row["head_title"], $entity);
        $object->head_description = $this->feedValues($row["head_description"], $entity);
        $object->body_title = $this->feedValues($row["body_title"], $entity);
        return $object;
    }

    private function feedValues($string, $entity) {
        return str_replace(array("(name)","(year)","(month)"),array($entity, date("Y"), date("F")), $string);
    }
}