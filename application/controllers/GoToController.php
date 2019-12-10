<?php
require_once("hlis/redirect.php");

class GoToController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
	redirect($this->request->getValidator()->parameters("url"), $this->request->getParameter("utm_medium"));
    }
}
