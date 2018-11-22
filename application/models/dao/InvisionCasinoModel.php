<?php
require_once 'application/models/dao/InvisionDataModel.php';
require_once 'application/models/InvisionApi/src/InvisionApi.php';
require_once 'application/models/dao/Casinos.php';

class InvisionCasinoModel {

    private $data;
    private $invisionModel;
    private $blogId;

    public function __construct(InvisionApi $invisionApi) {

        $this->invisionModel = new InvisionDataModel($invisionApi);
    }

    public function saveCasino($casino_id,$casino_name, $blogId){

        $invisionCasino = $this->invisionModel->addCasinoToInvision($casino_name, $blogId);
        $invision_casino_id =  !empty($invisionCasino['id']) ? $invisionCasino['id'] : '';
        $this->updateCasinoForInvision($casino_id, $invision_casino_id);
        return $invision_casino_id;
    }


    private function updateCasinoForInvision($casino_id, $invision_casino_id){
        $casinoInfoModel = new Casinos();
        $casinoInfoModel->updateCasinoForEntries($casino_id,$invision_casino_id);
    }


}