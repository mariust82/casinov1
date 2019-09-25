<?php
/**
 * Created by PhpStorm.
 * User: Liviu
 * Date: 3/1/2018
 * Time: 11:37 AM
 */

interface IPageInfo
{
    /**
     * @return Head
     */
    public function getHead();

    /**
     * @return Body
     */
    public function getBody();
}
