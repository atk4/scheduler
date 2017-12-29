<?php

require 'vendor/autoload.php';
$app = new App('public');

$teacher=new Model\Teacher($app->db);
$teacher->load($app->stickyGet('id'));
$parents= $teacher->ref('Vecaki');
$parents->setOrder('parent_name');
$grid = $app->add('Grid');
$grid->setModel($parents);
