<?php
require_once("vendor/lucinda/request-validator/src/Validator.php");

class ParametersValidatorListener extends RequestListener
{
    public function run() {
        $validator = new Lucinda\RequestValidator\Validator(
            "configuration.xml",
            $this->request->getValidator()->getPage(),
            $this->request->getMethod(),
            $this->getParameters());
        $results = $validator->getResults();
        if(!$results->hasPassed()) throw new PathNotFoundException();
        $this->request->setAttribute("validation_results", $validator->getResults());
    }
    private function getParameters() {
        $output = array();
        // get path parameters
        $pathParameters = $this->request->getValidator()->getPathParameters();
        $output = $pathParameters;
        // appends request parameters
        $requestParameters = $this->request->getParameters();
        foreach($requestParameters as $name=>$value) {
            if(isset($output[$name])) continue;
            $output[$name] = $value;
        }
        return $output;
    }
}