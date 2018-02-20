<?php
class MockFeeder extends ResponseListener
{
    public function run() {
        $objControllerLocator = new ControllerLocator($this->application, $this->request->getValidator()->getPage());
        $strClassName  = $objControllerLocator->getClassName();
        if($strClassName) {
            $this->development2frontend(dirname(dirname(__DIR__)), $strClassName, $this->response);
        }
    }

    private function development2frontend($frontendProjectLocation, $controllerName, Response $response) {
        $remoteController = $frontendProjectLocation."/application/controllers_frontend/".$controllerName.".php";

        // compose response attributes
        $attributes = json_decode(json_encode($response->toArray()), true);
        $addition = '<?php
class '.$controllerName.' extends Controller {
    public function run() {
        ';
        foreach($attributes as $key=>$value) {
            $addition .= '$this->response->setAttribute("'.$key.'", '.var_export($value,true).');'."\n";
        }
        $addition.='
    }
}
        ';
        file_put_contents($remoteController, $addition);
    }

}