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
    $crud->addQuickSearch(['name']);
  } elseif ($check == 'teachers') {
    $crud->setModel(new Model\Teacher($app->db));
    $crud->addQuickSearch(['name','cabinet']);
  }

} else {
  $crud = $app->add('CRUD');
  $crud->setModel(new Model\Vecaki($app->db));
  $crud->addQuickSearch(['student_name','parent_name','contact_phone','time']);
}
