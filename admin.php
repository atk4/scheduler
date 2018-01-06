<?php

require 'vendor/autoload.php';

$app = new App('admin');

date_default_timezone_set('UTC');

$admin = $_GET['admin'];

if ($admin == 'lessens') {
  $crud = $app->add('CRUD');
  $crud->setModel(new Model\Subject($app->db));
} elseif ($admin == 'teachers') {
  $crud = $app->add('CRUD');
  $crud->setModel(new Model\Teacher($app->db));
} elseif ($admin == 'list') {
  $crud = $app->add('CRUD');
  $crud->setModel(new Model\Vecaki($app->db));
}
