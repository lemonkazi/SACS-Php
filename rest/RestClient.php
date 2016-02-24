<?php
include_once 'SACSConfig.php';
include_once 'TokenHolder.php';
define("GET", "GET");
define("POST", "POST");
define("PUT", "PUT");
define("DELETE", "DELETE");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestClient
 *
 * @author SG0946321
 */
class RestClient {
    
    private $config;
    private $tokenHolder;
    
    public function RestClient() {
        $this->config = new SACSConfig();
        $this->tokenHolder = new TokenHolder();
    }
    
    public function executeGetCall($path, $request) {
        $result = curl_exec($this->prepareCall(GET, $path, $request));
        return json_decode($result);
    }
    
    public function executePostCall($path, $request) {
        $result = curl_exec($this->prepareCall(POST, $path, $request));
        return json_decode($result);
    }
    
    private function buildHeaders() {
        $headers = array(
            'Authorization : Bearer '.$this->tokenHolder->getToken()->access_token,
            'Accept : */*'
        );
        return $headers;
    }
    
    private function prepareCall($callType, $path, $request) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $callType);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = $this->buildHeaders();
        switch ($callType) {
        case GET:
            $url = $path;
            if ($request != null) {
                $url = $this->config->getProperty("environment").$path.'?'.http_build_query($request);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
            break;
        case POST:
            curl_setopt($ch, CURLOPT_URL, $this->config->getProperty("environment").$path);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
            array_push($headers, 'Content-Type : application/json');
            break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }
}
