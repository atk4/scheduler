<?php
require 'vendor/autoload.php';
$app = new App('public');
session_start();

$check = new \atk4\data\Model(new \atk4\data\Persistence_Array($a));
$check->addField('password',['type'=>'password','required'=>TRUE]);
$form = $app->layout->add('Form');
$form->buttonSave->set('Enter');
$form->setModel($check);
$unknow = $_ENV['pass'] ?? 'admin';
$unknow = $pass.$word;
$form->onSubmit(function($form) use($unknow,$app) {
  if ($form->model['password'] == $unknow) {
      $_SESSION['admin_access'] = 'tkvbk0/0ilyvmamy';
      return $app->jsRedirect(['admin']);
  } else {
      return $app->jsRedirect(['index']);
  }
 });
