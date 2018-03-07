<?php

require 'vendor/autoload.php';
$app = new App('public');

$button1 = $app->add(['Button','Vecākiem','massive red']);
$button1->link(['parents']);
$button2 = $app->add(['Button','Skolotājiem','massive green right floated']);
$button2->link(['teachers']);
