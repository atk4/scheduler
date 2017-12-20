<?php
date_default_timezone_set('UTC');
require 'vendor/autoload.php';
$app = new App('public');
$subject = new Model\Subject($app->db);
$teacher = $subject->ref('Teacher');
$inter = $teacher->ref('Inter');
$timeslot = $inter->ref('timeslot_id');
$parents = $timeslot->ref('Parents');
$date_day = date('d');
$date_month = date('m');
