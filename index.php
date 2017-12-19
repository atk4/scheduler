<?php
require 'vendor/autoload.php';
$app = new App('public');


$menu = $app->add('Menu');
$menu->addClass('vertical');

$subject = new Model\Subject($app->db);
foreach($subject as $row) {
    $submenu = $menu->addMenu($row['name']);
    $teacher = $subject->ref('Teacher');
    $inter = $teacher->ref('Inter');
    foreach($teacher as $rows) {
      $subsubmenu = $submenu->addMenu($rows['name']);
      $timeslot = $inter->ref('timeslot_id');
      foreach($timeslot as $rowss) {
        $subsubmenu->addItem($rowss['time']);
        $subsubmenu->on('click', function() use($app) {
          $parents = $timeslot->ref('id');
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
