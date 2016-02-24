<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SharedContext
 *
 * @author SG0946321
 */
class SharedContext {
    //put your code here
    private $results;
    
    public function addResult($key, $result) {
        $this->results[$key] =  $result;
    }
    
    public function getResult($key) {
        return $this->results[$key];
    }
}
