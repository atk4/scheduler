<?php
require 'vendor/autoload.php';



$app = new App('public');

$menu = $app->add('Menu');


$subject = new Model\Subject($app->db);

foreach($subject as $row) {
    $menu->addItem($row['name'], ['index', 'subject'=>$row->id]);
}

$app->stickyGet('subject');

$app->add('LoremIpsum');


// Todo, acc Columns


new Model\Teacher();

