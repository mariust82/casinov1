<?php
require_once 'application/models/InvisionApi/src/InvisionAbstract.php';

class InvisionUsers extends InvisionAbstract {


    public function setEndpoint($endpoint){
        $endpoint_url = InvisionAppEndPoints::API_URL.$endpoint;
        $curl = curl_init( $endpoint_url);
        return $curl ;
    }

    public function addUser(array $userData){

    }

    public function removeUser($id){
        
    }

    public function editUser($id){

    }
}