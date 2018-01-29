<?php
require_once("application/models/DB.php");
require_once("application/models/dao/Rebranding.php");

class RebrandingListener extends RequestListener {
	public function run() {
		if(empty($this->request->getValidator()->getPathParameters())) return;
		$routes = (array) $this->application->getXML()->routes;
		foreach($routes["route"] as $route) {
			if($route["url"]==$this->request->getValidator()->getPage()) {
				if(!empty($route["rebrand_tables"])) {
					// attempt to rebrand
					$tables = explode(",",(string) $route["rebrand_tables"]);
					$ppv = new Rebranding($this->request->getValidator()->getPage());
					$success = $ppv->validate($tables, $this->request->getValidator()->getPathParameters());
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