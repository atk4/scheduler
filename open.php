<?php

require 'vendor/autoload.php';

$app = new App('public');
$app->always_run = false;

$teacher=new Model\Teacher($app->db);
$teacher->load($app->stickyGet('id'));

//$t = new \atk4\core\DebugTrait;
$file_name = '"/tmp/'.$teacher['name'].'.pdf"';
$name = '"'.$teacher['name'].'.pdf"';
//echo $file_name;
//header('Location: '.$file_name);
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename = ".basename($file_name));
@readfile($file_name);
//$t->exec('open '.'"'.$file_name.'"');
//$t->exec('file_get_contents '.'"'.$file_name.'"');
//header('Location: index.php');
