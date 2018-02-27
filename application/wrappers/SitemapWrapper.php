<?php
/**
 * Created by PhpStorm.
 * User: aherne
 * Date: 27.02.2018
 * Time: 10:44
 */

class SitemapWrapper extends ViewWrapper
{
    public function run() {
        $_VIEW = $this->objResponse->toArray();
        require_once("application/views/sitemap.xml");
    }
}