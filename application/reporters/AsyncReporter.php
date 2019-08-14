<?php
require_once(dirname(dirname(__DIR__))."/hlis/error_handler/ErrorInfoGenerator.php");
require_once(dirname(dirname(__DIR__))."/hlis/Async.php");

/**
 * Reports errors to DataMother RestAPI
 */
class AsyncReporter implements \Lucinda\MVC\STDERR\ErrorReporter
{

    /**
     * Sets up reporter based on XML.
     *
     * @param \SimpleXMLElement $xml
     * @throws \Lucinda\MVC\STDERR\Exception
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $host = (string) $xml["host"];
        $auth_key = (string) $xml["auth_key"];
        if(!$host || !$auth_key) throw new \Lucinda\MVC\STDERR\Exception("AsyncReporter requires attributes: 'host' and 'auth_key'");
	Async::setup($host, $auth_key);
    }

    /**
     * {@inheritDoc}
     * @see \Lucinda\MVC\STDERR\ErrorReporter::report()
     */
    public function report(\Lucinda\MVC\STDERR\Request $request) {
        if(in_array($request->getRoute()->getErrorType(), array(\Lucinda\MVC\STDERR\ErrorType::NONE, \Lucinda\MVC\STDERR\ErrorType::CLIENT))) return;

        $eig = new ErrorInfoGenerator($request->getException());
        Async::send("errors", array("data"=>json_encode($eig->getInfo())));
    }
}
