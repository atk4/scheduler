<?php

require 'vendor/autoload.php';
$app = new App('public');

$teacher = new Model\Teacher($app->db);
$teacher->setOrder('name');
$grid = $app->add('Grid');
$grid->setModel($teacher);
$grid->addQuickSearch(['name']);
$grid->addDecorator('name', new \atk4\ui\TableColumn\Link('parentslist.php?id={$id}'));
