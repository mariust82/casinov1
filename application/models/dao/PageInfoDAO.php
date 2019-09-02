<?php
require_once("entities/PageInfo.php");
class PageInfoDAO
{
    public function getInfoByURL($url, $entity=null, $casinos_number = '')
    {
        $row = SQL("SELECT * FROM pages WHERE url=:url", array(":url"=>$url))->toRow();
        $object = new PageInfo();
        $object->head_title = $this->feedValues($row["head_title"], $entity, $casinos_number);
        $object->head_description = $this->feedValues($row["head_description"], $entity, $casinos_number);
        $object->body_title = $this->feedValues($row["body_title"], $entity, $casinos_number);

        return $object;
    }

    private function feedValues($string, $entity, $casinos_number)
    {
        return str_replace(array("(name)","(year)","(month)" ,"(casinosNumber)"), array($entity, date("Y"), date("F"), $casinos_number), $string);
    }
}
