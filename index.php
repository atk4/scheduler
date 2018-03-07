<?php

require 'vendor/autoload.php';
$app = new App('public');

$button1 = $app->add(['Button','Vecākiem','massive red']);
$button1->link(['parents']);
$button2 = $app->add(['Button','Skolotājiem','massive green right floated']);
$button2->link(['teachers']);
<<<<<<< HEAD
=======

$reminder = $app->add(['ui'=>'horizontal divider header']);
$reminder->set('Esat punktuāli. Ne atnāciet pēc 19:00.');

$app->add(['ui'=>'hidden divider']);

$app->add(['Label','This app is made by Colibri School students','red right ribbon'])
->link('http://colibrischool.lv');
>>>>>>> fc794cb968ca261e721f8b98900b0495d2559602
