<?php

class SACSConfig {
    
    private $restConfig;
    private $soapConfig;
    
    function SACSConfig() {
        $this->restConfig = parse_ini_file("SACSRestConfig.ini");
        //$this->soapConfig = parse_ini_file("SACSSoapConfig.ini");
    }
    
    public function getRestProperty($propertyName) {
        return $this->restConfig[$propertyName];
    }
    
    public function getSoapProperty($propertyName) {
        return $this->soapConfig[$propertyName];
    }
}
