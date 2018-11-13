<?php
require_once 'application/models/InvisionApi/src/InvisionAbstract.php';

class InvisionComments extends InvisionAbstract {


    private $curl;
    public function setEndpoint($endpoint){

        $endpoint_url = InvisionAppEndPoints::API_URL.$endpoint;
        $this->curl = curl_init( $endpoint_url);
    }

    /**
     * @param $commentData
     * entry => casino_id : required
     * author : 0 for quest
     * author_name
     * date
     * ip_address
     *
     */
       public function addComment($commentData){

        curl_setopt_array( $this->curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> InvisionAppEndPoints::API_KEY.':',
                CURLOPT_POST =>true,
                CURLOPT_POSTFIELDS => $commentData
            ) );

        $response = curl_exec( $this->curl );
        return $response;
    }

    public function getAllCommentsFromCasino(){


        curl_setopt_array( $this->curl,
            array(
                CURLOPT_RETURNTRANSFER	=> TRUE,
                CURLOPT_HTTPAUTH	=> CURLAUTH_BASIC,
                CURLOPT_USERPWD		=> InvisionAppEndPoints::API_KEY.':',
            ) );

        $response = curl_exec( $this->curl );
        return $response;
    }
}