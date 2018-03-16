<?php
require 'vendor/autoload.php';
$app = new App('public');
session_start();

$check = new \atk4\data\Model(new \atk4\data\Persistence_Array($a));
$check->addField('password',['type'=>'password','required'=>TRUE]);
$form = $app->layout->add('Form');
$form->setModel($check);
$pass = '2018';
$word = 'Password';
$unknow = $pass.$word;
$form->onSubmit(function($form) use($unknow) {
  if ($form->model['password'] == $unknow) {
      $_SESSION['admin_access'] = 'tkvbk0/0ilyvmamy';
      return new \atk4\ui\jsExpression('document.location = "admin.php" ');
  } else {
      return new \atk4\ui\jsExpression('document.location = "index.php" ');
  }
 });
