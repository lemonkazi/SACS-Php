<?php
include_once 'configuration/SACSConfig.php';

class SessionPool {
    private $MEMSIZE    =   512;//  size of shared memory to allocate
    private $SEMKEY     =   1;  //  Semaphore key
    private $SHMKEY     =   2;  //  Shared memory key
    
    private $semaphoreId;
    private $poolSize;
    
    private static $instance;
    
    private $available;
    private $busy;
    
    private function __construct() {
        $config = SACSConfig::getInstance();
        $this->poolSize = $config->getSoapProperty("sessionPoolSize");
        $this->semaphoreId = sem_get($this->SEMKEY, $this->poolSize);
    }
    
    public static function getInstance() {
        if (!SessionPool::$instance) {
            SessionPool::$instance = new SessionPool();
        }
        return SessionPool::$instance;
    }
    
    public function getFromPool($conversationId) {
        
    }
    
    public function returnToPool($conversationId) {
        
    }
}
