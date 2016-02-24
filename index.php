<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once "workflow/Workflow.php";
        include_once 'activities/LeadPriceCalendarActivity.php';
        $workflow = new Workflow(new LeadPriceCalendarActivity());
        $result = $workflow->runWorkflow();
        var_dump($result);
        ?>
    </body>
</html>
