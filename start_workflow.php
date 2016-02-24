<?php
include_once 'workflow/Workflow.php';
include_once 'activities/LeadPriceCalendarActivity.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$origin = filter_input(INPUT_POST, "origin");
$destination = filter_input(INPUT_POST, "destination");
$departureDate = filter_input(INPUT_POST, "departureDate");
$workflow = new Workflow(new LeadPriceCalendarActivity($origin, $destination, $departureDate));
$result = $workflow->runWorkflow();
//        error_log($dump);
//error_log(json_encode($result));
//echo json_encode($result, JSON_FORCE_OBJECT);
ob_start();
var_dump($result);
$dump = ob_get_clean();
echo $dump;
flush();
