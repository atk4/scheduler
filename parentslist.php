<?php

require 'vendor/autoload.php';
$app = new App('public');

$crumb = $app->add('BreadCrumb');
$crumb->addCrumb('Mājaslapā', ['index']);
$crumb->addCrumb('Skolotāji', ['teachers']);
$app->add(['ui'=>'hidden divider']);


$app->add(['ui'=>'divider']);

$teacher=new Model\Teacher($app->db);
$teacher->load($app->stickyGet('id'));
$parents= $teacher->ref('Vecaki');
$parents->setOrder('parent_name');
$grid = $app->add('Grid');
$grid->setModel($parents);

$button_print = $app->add(['Button','Izdrukāt','small green','iconRight'=>'file pdf'])
->link(['print','id'=>$_GET['id']]);
