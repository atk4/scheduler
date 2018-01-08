<?php

require 'vendor/autoload.php';

$app = new App('admin');

date_default_timezone_set('UTC');

if (isset($_GET['check'])) {
  $check = $_GET['check'];
  if ($check == 'lessens') {
    $crud = $app->add('CRUD');
    $crud->setModel(new Model\Subject($app->db));
  } elseif ($check == 'teachers') {
    $crud = $app->add('CRUD');
    $crud->setModel(new Model\Teacher($app->db));
  } elseif ($check == 'list') {
    $crud = $app->add('CRUD');
    $crud->setModel(new Model\Vecaki($app->db));
  }

}
