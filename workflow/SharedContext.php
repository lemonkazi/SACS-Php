<?php

class SharedContext {

    private $results;
    
    public function addResult($key, $result) {
        $this->results[$key] =  $result;
    }
    
    public function getResult($key) {
        return $this->results[$key];
    }
}
