<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 10:57 AM
 */

class TotalCasinosInCurrentList extends \TMS\VariablesHolder {

    public function getTotal() {
        return $this->parameters["response"]->attributes()->get("total_casinos");
    }

}