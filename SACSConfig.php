<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SACSConfig
 *
 * @author SG0946321
 */
class SACSConfig {
    
    var $config;
    
    function SACSConfig() {
        $this->config = parse_ini_file("SACSConfig.ini");
    }
    
    public function getProperty($propertyName) {
        return $this->config[$propertyName];
    }
}
