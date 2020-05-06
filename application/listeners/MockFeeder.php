<?php

class MockFeeder extends \Lucinda\MVC\STDOUT\ResponseListener
{
    public function run()
    {
        if (in_array(ENVIRONMENT, array("dev","live"))) {
            return;
        }
        $controllerPath = $this->application->routes($this->request->getValidator()->getPage())->getController();
        if ($controllerPath) {
            $this->development2frontend(dirname(dirname(__DIR__)), $controllerPath, $this->response);
        }
    }

    private function development2frontend($frontendProjectLocation, $controllerPath, \Lucinda\MVC\STDOUT\Response $response)
    {
        $remoteController = $frontendProjectLocation."/application/controllers_frontend/".$controllerPath.".php";
        $controllerName = $controllerPath;
        if ($position = strrpos($controllerName, "/")) {
            $controllerName = substr($controllerPath, $position+1);
            $folder = $frontendProjectLocation."/application/controllers_frontend/".substr($controllerPath, 0, $position);
            if (!file_exists($folder)) {
                mkdir($folder);
            }
        }
        
        // compose response attributes
        $attributes = json_decode(json_encode($response->attributes()), true);
        $addition = '<?php
class '.$controllerName.' extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        ';
        foreach ($attributes as $key=>$value) {
            $addition .= '$this->response->attributes("'.$key.'", '.var_export($value, true).');'."\n";
        }
        $addition.='
    }
}
        ';
        file_put_contents($remoteController, $addition);
    }
}
