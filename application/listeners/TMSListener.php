<?php
require_once("application/models/TMSWrapper.php");

class TMSListener extends RequestListener
{
    public function run() {
        $this->request->setAttribute("tms", new TMSWrapper($this->application, $this->request));
    }
}