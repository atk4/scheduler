<?php

require 'vendor/autoload.php';


$app = new App('admin');


/****************************************************************
 * You can now remove the text below and write your own Web App *
 *                                                              *
 * Thank you for trying out Agile Toolkit                       *
 ****************************************************************/

// Default installation gives warning, so update php.ini the remove this line
date_default_timezone_set('UTC');


$tabs = $app->add('Tabs');

$tabs->addTab('Subjects')->add('CRUD')->setModel(new Model\Subject($app->db));
$tabs->addTab('Teachers')->add('CRUD')->setModel(new Model\Teacher($app->db));

$tabs->addTab('Vecaki')->add('CRUD')->setModel(new Model\Vecaki($app->db));
