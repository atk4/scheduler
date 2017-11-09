<?php
require 'vendor/autoload.php';
$app = new App('public');
$subject = new Model\Subject($app->db);
