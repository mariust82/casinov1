<?php
class InvisionApi{

    private $api_key;
    private $api_url;

     function __construct ($api_key, $api_url){
        $this->api_key = $api_key;
        $this->api_url = $api_url;
    }

    private function initCurl($endpoint){

        $endpoint_url = $this->api_url. $endpoint;
        return curl_init( $endpoint_url);
    }

    public function addCasinosToInvision(array $casinoData){

        if(empty($casinoData)){
            throw new Exception('casinoData id empty');
        }

        $curl = $this->initCurl('api/blog/entries');

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> $this->api_key.':',
                CURLOPT_POST =>true,
                CURLOPT_POSTFIELDS => $casinoData
            )
        );

        return $this->execute($curl);
    }


    public function  addReviewsToInvision(array $commentData){

        if(empty($commentData)){
            throw new Exception('commentData is empty');
        }

        $curl = $this->initCurl('api/blog/comments');
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> $this->api_key.':',
                CURLOPT_POST =>true,
                CURLOPT_POSTFIELDS => $commentData
            )
        );

        return $this->execute($curl);
    }


    public function getCasinoReviewsFromInvision($casinoId){

        if(empty($casinoId)){
            throw new Exception('CasinoId is empty');
        }

        $curl = $this->initCurl('api/blog/entries/'.$casinoId.'/comments');

        curl_setopt_array( $curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> $this->api_key.':',
            ) );

        return $this->execute($curl);

    }


    private function execute($curl){
        $response = curl_exec($curl);
        return  json_decode($response, true);
    }

}