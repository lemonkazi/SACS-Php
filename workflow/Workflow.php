<?php
include_once 'SharedContext.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Workflow
 *
 * @author SG0946321
 */
class Workflow {
    //put your code here
    private $sharedContext;
    private $startActivity;
    
    public function Workflow(&$startActivity) {
        $this->startActivity = $startActivity;
    }
    
    public function runWorkflow() {
        $this->sharedContext = new SharedContext();
        $next = $this->startActivity;
        while($next) {
            $next = $next->run($this->sharedContext);
        }
        return $this->sharedContext;
    }
}
