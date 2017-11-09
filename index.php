<?php
require 'init.php';

$menu = $app->add('Menu');
$menu->addClass('vertical');

foreach($subject as $row) {
    $submenu = $menu->addMenu($row['name']);
//    $subject->load($row->id);
    $teacher = $subject->ref('Teacher');
    foreach($teacher as $rows) {
      $submenu->addItem($rows['name'],['application', 'name'=>$rows['name'],'phone'=>$rows['contact_phone']]);
    }
    unset($rows);
}
unset($row);

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


//['index', 'subject'=>$row->id]
