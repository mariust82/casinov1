<?php
require_once("hlis/error_handler/ErrorInfoGenerator.php");

class AsyncLogger extends Logger
{
    protected function log($info, $level)
    {
        $eig = new ErrorInfoGenerator($info);
        Async::send("errors", array("data"=>serialize($eig->getInfo())));
    }
}
