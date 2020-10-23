<?php
/**
 * Checks in DB if path parameters have been rebranded and generates redirection link in case they had.
 */
class Rebranding
{
    private $pagePattern;
    private $redirectURI;

    /**
     * Rebranding constructor.
     *
     * @param string $pagePattern Current route url pattern.
     */
    public function __construct($pagePattern)
    {
        $this->pagePattern = $pagePattern;
    }

    /**
     * Validates path parameters based on rebranding tables
     *
     * @param string[] $tables List of entities to locate in rebranding__tables.
     * @param string[] $pathParameters List of path parameter values
     * @return boolean Whether or not request passes (no rebrand is needed) or must be rebranded (value=false).
     */
    public function validate($tables, $pathParameters)
    {
        $success = true;
        $redirectURI = $this->pagePattern;
        $i=0;
        foreach ($pathParameters as $oldValue) {
            if (empty($tables[$i])) {
                continue;
            }
            $newValue = SQL("
			SELECT new FROM rebranding__aliases AS t1
			INNER JOIN rebranding__tables AS t2 ON t1.table_id=t2.id
			WHERE t2.name=:table_name AND t1.old=:old_value
			", array(":table_name"=>$tables[$i], ":old_value"=>str_replace("-", " ", $oldValue)))->toValue();
            if ($newValue) {
                $success= false;
            }
            $redirectURI = preg_replace("/\([^()]*\)/", ($newValue?strtolower(str_replace(" ", "-", $newValue)):$oldValue), $redirectURI, 1);

            if($redirectURI == 'banking/paysafe-card'){
                $success = false;
            }
            ++ $i;
        }
        
        if (!$success) {
            $this->redirectURI = "/".$redirectURI;
        }
        
        return $success;
    }

    /**
     * Gets relative path app must redirect to.
     *
     * @return string
     */
    public function getRedirectURI()
    {
        return ($this->redirectURI == '/banking/paysafe-card') ? '/banking/paysafecard' : $this->redirectURI;
    }
}
