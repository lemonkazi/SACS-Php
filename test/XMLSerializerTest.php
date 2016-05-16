<?php
include_once 'soap/XMLSerializer.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of XMLSerializerTest
 *
 * @author SG0946321
 */
class XMLSerializerTest extends PHPUnit_Framework_TestCase {
    
    public function testShouldReturnXmlWithNamespaceAndAttributesFromArray() {
        $testArray = array("mom" => array(
            "_attributes" => array("good" => "true"),
            "son" => array(
                "daughter" => array(
                    "_attributes" => array("sex" => "f"),
                    "_value" => "Erica"
                ),
                "grandson" => array(
                    "_value" => "Eric"
                )
            ),
            "_namespace" => "http://heaven.com"
            
        ));
        $result = XMLSerializer::generateValidXmlFromArray($testArray);
        echo $result;
        $this->assertEquals(0, strpos($result, "<mom"));
        $this->assertNotEquals(0, strpos($result, 'good="true"'));
        $this->assertNotEquals(0, strpos($result, '>Erica</daughter>'));
        $this->assertNotEquals(0, strpos($result, 'xmlns="http://heaven.com"'));
    }
    
    public function testShouldReturnXmlWithNamespaceAndAttributesFromObject() {
        $testObject = new stdClass();
        $testObject->_attributes = array("good" => "true");
        $testObject->_namespace = "http://heaven.com";
        $testObject->son = new stdClass();
        $testObject->son->daughter = "Erica";
        echo XMLSerializer::generateValidXmlFromObj($testObject);
    }
}
