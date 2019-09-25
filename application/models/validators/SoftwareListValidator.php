<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 23.08.2019
 * Time: 09:47
 */

class SoftwareListValidator extends \Lucinda\RequestValidator\ParameterValidator
{
    public function validate($value)
    {
        $softwares = explode(",", $value);

        $statement = \Lucinda\SQL\ConnectionSingleton::getInstance()->createStatement();
        foreach ($softwares as $i=>$name) {
            $softwares[$i] = $statement->quote($name);
        }

        $results = SQL("SELECT id FROM game_manufacturers WHERE name IN (".implode(",", $softwares).")")->toColumn();

        return sizeof($results) == sizeof($softwares) ? $results : null;
    }
}
