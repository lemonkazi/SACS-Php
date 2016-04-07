<?php
include_once 'configuration/SACSConfig.php';

class Auth {
    
    private $config;
    
    public function Auth() {
        $this->config = new SACSConfig();
    }
    
    public function callForToken() {
        $ch = curl_init($this->config->getRestProperty("environment")."/v2/auth/token");
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
        $credentials = $this->config->getRestProperty("formatVersion").":".
                $this->config->getRestProperty("userId").":".
                $this->config->getRestProperty("group").":".
                $this->config->getRestProperty("domain");
        $secret = base64_encode($this->config->getRestProperty("clientSecret"));
        return base64_encode(base64_encode($credentials).":".$secret);
    }
}
