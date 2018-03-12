<?php

require 'vendor/autoload.php';

$app = new App('public');

$teacher=new Model\Teacher($app->db);
$teacher->load($app->stickyGet('id'));

//$t = new \atk4\core\DebugTrait;
$t = $app->add(['Console']);
$file_name = '/tmp/'.$teacher['name'].'.pdf';
$t->exec('open '.'"'.$file_name.'"');
//header('Location: index.php');
