<?php

require 'vendor/autoload.php';
$app = new App('public');

$menu = $app->add('Menu');
$menu->addClass('vertical');

$subject = new Model\Subject($app->db);
foreach($subject as $row) {
    $submenu = $menu->addMenu($row['name']);
    $teacher = $subject->ref('Teacher');
    foreach($teacher as $rows) {
      $subsubmenu = $submenu->addMenu($rows['name']);
      $timeslot = $teacher->ref('Time');
    //  foreach($timeslot as $rowss) {
        //add free timeslots (by hand)
        $min=0;
        for ($hour=17;$hour<=19;$hour++) {

          for ($i=1;$i<=12;$i++) {

              if ($min>=60) {
                $min=0;
              }
              if($min<10) {
                $time = $hour.':0'.$min;
              }else {
                $time = $hour.':'.$min;
              }
              echo $time;
              $subsubmenu->addItem($time);
              $min=$min+5;
              //$subsubmenu->addItem($rowws['name']);
            }
        }
      //  $subsubmenu->addItem($rowss['name']);
        $subsubmenu->on('click', function() use($app) {
          $form = $app->layout->add('Form');
          //fix form
          $parents =  new Model\Vecaki($app->db);
          $form->setModel($parents);
          $form->onSubmit(function($form) {
            $form->model->save();
            return $form->success('Вы оформили заявку!');
          });
        });
    //  }
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


$button = $app->layout->add(['Button','admin','icon'=>'space shuttle']);
$button->link(['admin']);
