<?php
require_once("application/models/DB.php");
require_once("application/models/dao/Rebranding.php");

/**
 * Performs automatic redirection of pages containing rebranded path parameters to final correct destination by matching
 * value of "rebrand_tables" attribute @ <route> tag with rebranding__tables, then rebranding__aliases.
 *
 * If one or more path parameters point to rebranded entities, a HTTP 301 redirection takes place, otherwise execution
 * continues.
 */
class RebrandingListener extends Lucinda\MVC\STDOUT\RequestListener {
    public function run() {
        if(empty($this->request->getValidator()->parameters())) return;
        $routes = (array) $this->application->getTag("routes");
        foreach($routes["route"] as $route) {
            if($route["url"]==$this->request->getValidator()->getPage()) {
                if(!empty($route["rebrand_tables"])) {
                    // attempt to rebrand
                    $tables = explode(",",(string) $route["rebrand_tables"]);
                    $ppv = new Rebranding($this->request->getValidator()->getPage());
                    $success = $ppv->validate($tables, $this->request->getValidator()->parameters());
                    if(!$success) {
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$ppv->getRedirectURI());
                        exit();
                    }
                }
            }
        }
    }
}