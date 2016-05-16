<?php

class TravelItineraryReadActivity implements Activity {

    private $config;
    
    public function __construct() {
        $this->config = SACSConfig::getInstance();
    }

    public function run(&$sharedContext) {
        $soapClient = new SACSSoapClient("TravelItineraryReadRQ");
        $soapClient->setLastInFlow(true);
        $doc = new DOMDocument();
        $doc->loadXML($sharedContext->getResult("PassengerDetailsRS"));
        $pnr = $doc->getElementsByTagName("ItineraryRef")->item(0)->getAttributeNode("ID")->value;
        $xmlRequest = $this->getRequest($pnr);
        $sharedContext->addResult("TravelItineraryReadRQ", $xmlRequest);
        $sharedContext->addResult("TravelItineraryReadRS", $soapClient->doCall($sharedContext, $xmlRequest));
        return null;
                
    }

    private function getRequest($pnr) {
        $requestArray = array(
            "TravelItineraryReadRQ" => array(
                "_namespace" => "http://services.sabre.com/res/tir/v3_6",
                "_attributes" => array(
                    "Version" => $this->config->getSoapProperty("TravelItineraryReadRQVersion")
                ),
                "MessagingDetails" => array(
                    "SubjectAreas" => array(
                        "SubjectArea" => "PNR"
                    )
                ),
                "UniqueID" => array(
                    "_attributes" => array("ID" => $pnr)
                )
            )
        );
        return XMLSerializer::generateValidXmlFromArray($requestArray);
    }
}
