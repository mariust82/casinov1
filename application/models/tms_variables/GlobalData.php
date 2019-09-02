<?php
/**
 * Created by PhpStorm.
 * User: Alexandru.D
 * Date: 6/21/2018
 * Time: 10:59 AM
 */

class GlobalData extends \TMS\VariablesHolder
{
    public function getTotalCasinosOnSite()
    {
        $casinoCount = SQL("
          SELECT COUNT(id) FROM casinos  
          WHERE is_open = 1
        ")->toValue();
        return $casinoCount;
    }
}
