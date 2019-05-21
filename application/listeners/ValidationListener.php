<?php
require_once("vendor/lucinda/framework-engine/src/validation/ValidationBinder.php");
/**
 * Binds STDOUT MVC API with Parameters Validation API based on contents of <routes> stdout.xml tag for request/path parameters validation.
 *
 * Sets attribute:
 * - validation_results: (Lucinda\RequestValidator\ResultsList) stores validation results for each parameter
 */
class ValidationListener extends \Lucinda\MVC\STDOUT\RequestListener {
    /**
     * {@inheritDoc}
     * @see \Lucinda\MVC\STDOUT\Runnable::run()
     */
    public function run() {
        $binder = new Lucinda\Framework\ValidationBinder($this->request);
        if(!$binder->getResults()->hasPassed()) throw new Lucinda\MVC\STDOUT\PathNotFoundException();
        $this->request->attributes()->set("validation_results", $binder->getResults());
    }
}
