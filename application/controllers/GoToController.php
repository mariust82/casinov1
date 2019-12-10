<?php
require_once("hlis/redirect.php");

class GoToController extends Lucinda\MVC\STDOUT\Controller
{
    public function run()
    {
	redirect($this->request->getValidator()->getPathParameter("url"), $this->request->getParameter("utm_medium"));
    }
}
