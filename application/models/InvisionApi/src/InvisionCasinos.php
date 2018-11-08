<?php
require_once 'application/models/InvisionApi/src/InvisionAbstract.php';

class InvisionCasinos extends InvisionAbstract {

    private $curl;
    const DEV_CASINOLIST_BLOG_ID = 1;

    public function setEndpoint($endpoint){
        $endpoint_url = InvisionAppEndPoints::API_URL.$endpoint;
        $this->curl = curl_init( $endpoint_url);
    }

    public function addCasinos($casinoData){

        if(empty($casinoData)){
            throw new Exception('no casino data');
        }

        $casinoData['blog'] = self::DEV_CASINOLIST_BLOG_ID;

        curl_setopt_array(
            $this->curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> InvisionAppEndPoints::API_KEY.':',
                CURLOPT_POST =>true,
                CURLOPT_POSTFIELDS => $casinoData
            )
        );

        $response = curl_exec(  $this->curl );

        return $response;
    }

    public function editCasino($id){

    }

    public function deleteCasino($id){

    }


}