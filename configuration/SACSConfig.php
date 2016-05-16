<?php
class SACSConfig {
    
    private $restConfig;
    private $soapConfig;
    private static $instance = null;
    
    private function __construct() {
        $this->restConfig = parse_ini_file("SACSRestConfig.ini");
        $this->soapConfig = parse_ini_file("SACSSoapConfig.ini");
    }
    
    public static function getInstance() {
        if (SACSConfig::$instance === null) {
            SACSConfig::$instance = new SACSConfig();
        }
        return SACSConfig::$instance;
    }
    
    public function getRestProperty($propertyName) {
        return $this->restConfig[$propertyName];
    }
    
    public function getSoapProperty($propertyName) {
        return $this->soapConfig[$propertyName];
    }
}
