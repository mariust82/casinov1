<?php
require_once("hlis/mobile_detection/DeviceDetection.php");

class MobileDetectionListener extends ResponseListener {
    public function run() {
        $md = DeviceDetection::getInstance();
        $this->response->setAttribute("is_mobile", ($md->is_mobile() && !$md->is_tablet()));
    }
}