<?php
include_once 'workflow/Workflow.php';
include_once 'rest_activities/LeadPriceCalendarActivity.php';

$origin = filter_input(INPUT_POST, "origin");
$destination = filter_input(INPUT_POST, "destination");
$departureDate = filter_input(INPUT_POST, "departureDate");
$workflow = new Workflow(new LeadPriceCalendarActivity($origin, $destination, $departureDate));
$result = $workflow->runWorkflow();
ob_start();
var_dump($result);
$dump = ob_get_clean();
echo $dump;
flush();
