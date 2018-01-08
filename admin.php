<?php

require 'vendor/autoload.php';

$app = new App('admin');

date_default_timezone_set('UTC');

$app->stickyget('check');

if (isset($_GET['check'])) {
  $check = $_GET['check'];
  $crud = $app->add('CRUD');
  if ($check == 'lessens') {
    $crud->setModel(new Model\Subject($app->db));
  } elseif ($check == 'teachers') {
    $crud->setModel(new Model\Teacher($app->db));
  } elseif ($check == 'list') {
    $crud->setModel(new Model\Vecaki($app->db));
  }

}
