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


$app->add(['Button', 'send testing sms'])->on('click',  function() use($app) {
    $app->sms->messages->create(
    // the number you'd like to send the message to
    '+44 7427599339',
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+15017250604',
        // the body of the text message you'd like to send
        'body' => 'Hey Jenny! Good luck on the bar exam!'
    ));
});
