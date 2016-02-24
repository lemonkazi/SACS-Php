<?php
include_once 'workflow/Activity.php';
include_once 'activities/BargainFinderMaxActivity.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstaFlightActivity
 *
 * @author SG0946321
 */
class InstaFlightActivity implements Activity {

    
    
    public function run(&$sharedContext) {
        
        $call = new RestClient();
        $lpcResult = $sharedContext->getResult("LeadPriceCalendar");
        
        $url = $lpcResult->FareInfo[0]->Links[0]->href;
        $result = $call->executeGetCall($url, null);
        $sharedContext->addResult("InstaFlight", $result);
        return new BargainFinderMaxActivity();
    }

}
