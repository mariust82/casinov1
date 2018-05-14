<?php
class QueryProfilingListener extends RequestListener {
	public function run() {
		// here you can add no matter how many environments you want
		if($this->application->getAttribute("environment")=="dev") {
			 require_once("hlis/sitebase/QueryProfiler.php");
		}
	}
}
