<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 11:05 AM
 */

require_once 'application/models/page_info/InterfaceInfo.php';

class GenericInfo
{

    /**
     * @var InterfaceInfo
     */
    protected $info = null;

    function __construct(InterfaceInfo $info)
    {
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    function getInfo()
    {
        return $this->info->getInfo();
    }
}