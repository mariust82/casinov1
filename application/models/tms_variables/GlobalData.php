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
        return SQL("
          SELECT COUNT(id) FROM casinos  
          WHERE is_open = 1
        ")->toValue();
    }
}
