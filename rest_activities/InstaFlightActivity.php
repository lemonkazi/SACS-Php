<?php
include_once 'workflow/Activity.php';
include_once 'rest_activities/BargainFinderMaxActivity.php';

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
