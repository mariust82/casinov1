<?php
class MinificationListener extends \Lucinda\MVC\STDOUT\ResponseListener {
    public function run() {
        if (!in_array(ENVIRONMENT, ["dev", "live"])) {
            return;
        }
        $stream = $this->response->getOutputStream()->get();
        $stream = preg_replace("/([\t\s\n\r]+)/", " ", $stream);
        $this->response->getOutputStream()->clear();
        $this->response->getOutputStream()->write($stream);
    }
}