<?php
// bonus-by-casino/24h-casino-free-spins
// bonus-by-software/saucify-free-spins
class PathParameterValidator {
	private $pagePattern;
	private $redirectURI;
	
	public function __construct($pagePattern) {
		$this->pagePattern = $pagePattern;
	}
	
	public function validate($tables, $pathParameters) {
		$success = true;
		$redirectURI = $this->pagePattern;
		$i=0;
		foreach($pathParameters as $oldValue) {
			$newValue = DB::execute("
			SELECT new FROM rebranding__aliases AS t1
			INNER JOIN rebranding__tables AS t2 ON t1.table_id=t2.id
			WHERE t2.name=:table_name AND t1.old=:old_value
			",array(":table_name"=>$tables[$i], ":old_value"=>str_replace("-", " ", $oldValue)))->toValue();
			if($newValue) $success= false;
//			$redirectURI = preg_replace("/\(\*\)/",($newValue?strtolower(str_replace(" ","-",$newValue)):$oldValue),$redirectURI,1);
                        $redirectURI = preg_replace("/\([^()]*\)/",($newValue?strtolower(str_replace(" ","-",$newValue)):$oldValue),$redirectURI,1);
			++ $i;
		}
		
		if(!$success) {
			$this->redirectURI = "/".$redirectURI;
		}
		
		return $success;
	}
	
	public function getRedirectURI() {
		return $this->redirectURI;
	}
}