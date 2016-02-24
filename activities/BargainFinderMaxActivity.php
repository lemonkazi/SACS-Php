<?php

include_once 'workflow/Activity.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BargainFinderMaxActivity
 *
 * @author SG0946321
 */
class BargainFinderMaxActivity implements Activity {

    public function run(&$sharedContext) {

        $call = new RestClient();
        $origin = $sharedContext->getResult("origin");
        $destination = $sharedContext->getResult("destination");
        $departureDate = $sharedContext->getResult("departureDate");
        $result = $call->executePostCall("/v1.8.6/shop/flights?mode=live", $this->getRequest($origin, $destination, $departureDate));
        $sharedContext->addResult("BargainFinderMax", $result);
        return null;
    }

    private function getRequest($origin, $destination, $departureDate) {
        $request = '{
            "OTA_AirLowFareSearchRQ": {
		"OriginDestinationInformation": [
			{
                            "DepartureDateTime": "'.$departureDate.'T00:00:00",
                            "DestinationLocation": {
				"LocationCode": "'.$destination.
                            '"},
                            "OriginLocation": {
                                "LocationCode": "'.$origin.
                            '"},
                            "RPH":"1"
			}
		],
		"POS": {
                    "Source": [
                        {
                            "RequestorID": {
                                "CompanyName": {
                                    "Code": "TN"
				},
				"ID": "REQ.ID",
				"Type": "0.AAA.X"
                            }
			}
                    ]
		},
		"TPA_Extensions": {
                    "IntelliSellTransaction": {
                        "RequestType": {
                            "Name": "50ITINS"
			}
                    }
		},
		"TravelerInfoSummary": {
                    "AirTravelerAvail": [
                        {
                            "PassengerTypeQuantity": [
                                {
                                    "Code": "ADT",
                                    "Quantity": 1
				}
                            ]
			}
                    ]
		}
            }
        }';
        return $request;
    }

}
