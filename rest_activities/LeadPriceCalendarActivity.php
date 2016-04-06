<?php
include_once 'workflow/Activity.php';
include_once 'rest/RestClient.php';
include_once 'rest_activities/InstaFlightActivity.php';

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
        $result = $call->executeGetCall("/v2/shop/flights/fares", $this->getRequest($this->origin, $this->destination, $this->departureDate));
        $sharedContext->addResult("LeadPriceCalendar", $result);
        return new InstaFlightActivity();
    }
    
    private function getRequest($origin, $destination, $departureDate) {
        $request = array(
                "lengthofstay" => "5",
                "pointofsalecountry" => "US",
                "origin" => $origin,
                "destination" => $destination,
                "departuredate" => $departureDate
        );
        return $request;
    }
}
