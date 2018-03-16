<?php

require 'vendor/autoload.php';
$app = new App('public');

$button_back = $app->add(['Button','Atgriezties mājaslapā','big primary','icon'=>'home'])
->link(['index']);

$app->add(['ui'=>'divider']);

$teacher = new Model\Teacher($app->db);
$teacher->setOrder('name');
$grid = $app->add('Grid');
$grid->setModel($teacher);
$grid->addQuickSearch(['name']);
$grid->addDecorator('name', new \atk4\ui\TableColumn\Link('parentslist.php?id={$id}'));
