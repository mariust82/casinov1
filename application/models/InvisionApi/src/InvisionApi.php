<?php
class InvisionApi{

    private $api_key;
    private $api_url;

     function __construct ($api_key, $api_url){
        $this->api_key = $api_key;
        $this->api_url = $api_url;
    }



    public function addCasinosToInvision(array $casinoData){

        if(empty($casinoData)){
            throw new Exception('casinoData id empty');
        }
        return $this->execute('api/blog/entries', true, $casinoData);
    }


    public function  addReviewsToInvision(array $commentData){

        if(empty($commentData)){
            throw new Exception('commentData is empty');
        }

        return $this->execute('api/blog/comments', true, $commentData);
    }


    public function getCasinoReviewsFromInvision($casinoId){

        if(empty($casinoId)){
            throw new Exception('CasinoId is empty');
        }

        return $this->execute('api/blog/entries/'.$casinoId.'/comments', false);
    }


    private function execute($endpoint, $is_post=true, $data = []){

        $endpoint_url = $this->api_url. $endpoint;
        $curl = curl_init( $endpoint_url);

        $curlOption = [
            CURLOPT_RETURNTRANSFER	=> TRUE,
            CURLOPT_RETURNTRANSFER	=> TRUE,
            CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
            CURLOPT_USERPWD		=> $this->api_key.':',

        ];

        if(!empty($is_post)){
            $curlOption[CURLOPT_POST] = true;
        }

        if(!empty($data) && !empty($is_post)){
            $curlOption[CURLOPT_POSTFIELDS] = $data;
        }

        curl_setopt_array($curl, $curlOption );
        $response = curl_exec($curl);
        return  json_decode($response, true);
    }

}