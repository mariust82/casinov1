<?php
require_once("application/models/dao/Casinos.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FastPayoutTooltipController
 *
 * @author user
 */
class FastPayoutTooltipController extends Lucinda\MVC\STDOUT\Controller {
    public function run() {
        $dao = new Casinos();
        $this->response->attributes("tooltip", $dao->getWithdrawTimeframes($this->request->parameters("id")));
    }
}
