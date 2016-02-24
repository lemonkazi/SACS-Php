<?php
include_once './SACSConfig.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author SG0946321
 */
class Auth {
    
    private $config;
    
    public function Auth() {
        $this->config = new SACSConfig();
    }
    
    public function callForToken() {
        //echo 'executing call for token <br/>';
        $ch = curl_init($this->config->getProperty("environment")."/v2/auth/token");
        $headers = array(
            'Authorization : Basic '.$this->buildCredentials(),
            'Accept : */*',
            'Content-Type : application/x-www-form-urlencoded'
        );
        $vars = "grant_type=client_credentials";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
    
    private function buildCredentials() {
        $credentials = $this->config->getProperty("formatVersion").":".
                $this->config->getProperty("userId").":".
                $this->config->getProperty("group").":".
                $this->config->getProperty("domain");
        $secret = base64_encode($this->config->getProperty("secret"));
        return base64_encode(base64_encode($credentials).":".$secret);
    }
}
