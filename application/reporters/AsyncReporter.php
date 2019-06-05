<?php
require_once(dirname(dirname(__DIR__))."/hlis/error_handler/ErrorInfoGenerator.php");

/**
 * Reports errors to DataMother RestAPI
 */
class AsyncReporter implements \Lucinda\MVC\STDERR\ErrorReporter
{
    private $host;
    private $auth_key;

    /**
     * Sets up reporter based on XML.
     *
     * @param \SimpleXMLElement $xml
     * @throws \Lucinda\MVC\STDERR\Exception
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->host = (string) $xml["host"];
        $this->auth_key = (string) $xml["auth_key"];
        if(!$this->host || !$this->auth_key) throw new \Lucinda\MVC\STDERR\Exception("AsyncReporter requires attributes: 'host' and 'auth_key'");
    }

    /**
     * {@inheritDoc}
     * @see \Lucinda\MVC\STDERR\ErrorReporter::report()
     */
    public function report(\Lucinda\MVC\STDERR\Request $request) {
        if(in_array($request->getRoute()->getErrorType(), array(\Lucinda\MVC\STDERR\ErrorType::NONE, \Lucinda\MVC\STDERR\ErrorType::CLIENT))) return;

        $eig = new ErrorInfoGenerator($request->getException());
        $fp = fsockopen("ssl://".$this->host, 443, $err_number, $err_string);
        if(!$fp) return;
        $content = http_build_query(array("data"=>serialize($eig->getInfo())));
        fwrite($fp, "POST /errors HTTP/1.1\r\n");
        fwrite($fp, "Host: ".$this->host."\r\n");
        fwrite($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
        fwrite($fp, "Content-Length: ".strlen($content)."\r\n");
        fwrite($fp, "AuthKey: ".$this->auth_key."\r\n");
        fwrite($fp, "Connection: close\r\n");
        fwrite($fp, "\r\n");
        fwrite($fp, $content);
// 		$result = "";
// 		while (!feof($fp)) $result .= fread($fp,32000);
 		fclose($fp);
// 		die($result);
    }
}