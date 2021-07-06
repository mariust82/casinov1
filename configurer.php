<?php
require_once("hlis/configurer/SiteConfigurer.php");
$configurer = new hlis\configurer\SiteConfigurer($argv[1]);
$configurer->populate();
