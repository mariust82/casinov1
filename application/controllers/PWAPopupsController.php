<?php

/**
 * Class PWAPopupsController
 */
class PWAPopupsController extends Lucinda\MVC\STDOUT\Controller
{

    /**
     * @inheritDoc
     */
    public function run()
    {
        $this->response->attributes("isInstalled", $this->request->parameters("isInstalled") ?? false);
        $this->response->attributes("pwaDevice", $this->request->parameters("device"));
    }

}