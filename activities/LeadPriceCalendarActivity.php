<?php
include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';
include_once 'activities/InstaFlightActivity.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LeadPriceCalendarActivity
 *
 * @author SG0946321
 */
class LeadPriceCalendarActivity implements Activity {

    private $origin, $destination, $departureDate;
    
    public function LeadPriceCalendarActivity($origin, $destination, $departureDate) {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
    }
    
    public function run(&$sharedContext) {
        $sharedContext->addResult("origin", $this->origin);
        $sharedContext->addResult("destination", $this->destination);
        $sharedContext->addResult("departureDate", $this->departureDate);
        $call = new RestClient();
        $result = $call->executeGetCall("/v2/shop/flights/fares", $this->getRequest());
        $sharedContext->addResult("LeadPriceCalendar", $result);
        return new InstaFlightActivity();
    }
    
    private function getRequest() {
        $request = array(
                "lengthofstay" => "5",
                "pointofsalecountry" => "US",
                "origin" => "LAX",
                "destination" => "JFK"
        );
        return $request;
    }
}
