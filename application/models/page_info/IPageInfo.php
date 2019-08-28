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
    function getHead();

    /**
     * @return Body
     */
    function getBody();
}