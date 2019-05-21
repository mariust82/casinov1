<?php
require_once("hlis/mobile_detection/DeviceDetection.php");

class MobileDetectionListener extends Lucinda\MVC\STDOUT\RequestListener {
    public function run() {
        $md = DeviceDetection::getInstance();
        $this->request->attributes()->set("is_mobile", ($md->is_mobile() && !$md->is_tablet()));
    }
}