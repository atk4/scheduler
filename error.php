<?php

require 'vendor/autoload.php';
$app = new App('public');

$button_back = $app->add(['Button','Atpakaļ','big primary','icon'=>'undo'])
->link(['parents']);

$app->add(['Message','Diemžēl, šis laiks ir jau aizņemts!','error']);
