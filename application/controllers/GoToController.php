<?php
require_once("hlis/redirect.php");

class GoToController extends Controller
{
    public function run()
    {
        var_dump($this->request->getValidator()->getPathParameter("url"));
	redirect($this->request->getValidator()->getPathParameter("url"), $this->request->getParameter("utm_medium"));
    }
}
