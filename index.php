<?php
require 'init.php';

$menu = $app->add('Menu');
$menu->addClass('vertical');

foreach($subject as $row) {
    $submenu = $menu->addMenu($row['name']);
//    $subject->load($row->id);
    foreach($teacher as $rows) {
      $submenu->addMenu($rows['name']);
      foreach($timeslot as $rowss) {
        $subsubmenu = $submenu->addItem($rowss['time'])->on('click', function() use($app) {
          $form = $app->layout->add('Form');
          $form->setModel($parents);
          $form->onSubmit(function($form) {
            $form->model->save();
            return $form->success('Вы оформили заявку!');
          });
        });
      }
      unset($rowss);
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
