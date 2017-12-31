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
      $teacher_id = $teacher->id;
      $subsubmenu = $submenu->addMenu($rows['name']);
      $min=0;
      for ($hour=17;$hour<=18;$hour++) {
        for ($i=1;$i<=12;$i++) {
          if ($min>=60) {
            $min=0;
          }
          if($min<10) {
            $time = $hour.':0'.$min;
          }else {
            $time = $hour.':'.$min;
          }
          $parents=$teacher->ref('Vecaki');
          if($parents->tryLoadAny()->loaded()==TRUE) {
            foreach($parents as $rowss) {
              if ($rowss['time']==$time) {
                $subsubmenu->addItem([$time,'disabled']);
              } else {
                $parents = new Model\Vecaki($app->db);

                $vir = $app->add('VirtualPage');
                $vir->set(function($vir) use ($parents,$time,$teacher_id) {
                  $form = $vir->add('Form');
                  $form->setModel($parents,['student_name','parent_name','contact_phone']);
                  $parents['time'] = $time;
                  $parents['teacher_id'] = $teacher_id;
                  $form->onSubmit(function($form) {
                    $form->model->save();
                    return $form->success('Вы оформили заявку!');
                  });
                });

                $subsubmenu->addItem($time)->on('click', new \atk4\ui\jsModal('Work',$vir));

              }
            }
            unset($rowss);
          } else {
            $parents = new Model\Vecaki($app->db);

            $vir = $app->add('VirtualPage');
            $vir->set(function($app) use ($parents,$time,$teacher_id) {
              $form = $app->add('Form');
              $form->setModel($parents,['student_name','parent_name','contact_phone']);
              $parents['time'] = $time;
              $parents['teacher_id'] = $teacher_id;
              $form->onSubmit(function($form) {
                $form->model->save();
                return $form->success('Вы оформили заявку!');
              });
            });

            $subsubmenu->addItem($time)->on('click', new \atk4\ui\jsModal('Work',$vir));
            }
          $min=$min+5;
        }
      }
        /*$subsubmenu->on('click', function() use($app) {
          $form = $app->layout->add('Form');
          //fix form
          $parents =  new Model\Vecaki($app->db);
          $form->setModel($parents);
          $form->onSubmit(function($form) {
            $form->model->save();
            return $form->success('Вы оформили заявку!');
          });
        });*/
    }
    unset($rows);
}
unset($row);

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


$button2 = $app->layout->add(['Button','Для учителей','icon'=>'student']);
$button2->link(['teachers']);

/*$subsubmenu = $app->add('Button')->on('click', function() use($app) {
  $form = $app->layout->add('Form');
  //fix form
  $parents =  new Model\Vecaki($app->db);
  $form->setModel($parents);
  $form->onSubmit(function($form) {
    $form->model->save();
    return $form->success('Вы оформили заявку!');
  });
}); */

/*$form = $app->layout->add('Form');
//fix form
$parents =  new Model\Vecaki($app->db);
$form->setModel($parents);
$form->onSubmit(function($form) {
  $form->model->save();
  return $form->success('Вы оформили заявку!');
}); */

/*$button = $app->add('Button')->on('click', new \atk4\ui\jsModal(function() use($app) {
  $form = $app->layout->add('Form');
  //fix form
  $parents =  new Model\Vecaki($app->db);
  $form->setModel($parents);
  $form->onSubmit(function($form) {
    $form->model->save();
    return $form->success('Вы оформили заявку!');
  });
})); */

//$button = $app->add('Button')->on('click', new \atk4\ui\jsModal('Lol',$vp = $app->add('VirtualPage')->add('LoremIpsum')));
//$vp = $app->add('VirtualPage');
//$vp->set(function ($p) use () { return new \atk4\ui\jsExpression('document.location="dashboard.php"');

//});

/*$vp = $app->add('VirtualPage');
$vp->set(function($app) {
  $form = $app->layout->add('Form');
  $parents =  new Model\Vecaki($app->db);
  $form->setModel($parents);
  $form->onSubmit(function($form) {
    $form->model->save();
    return $form->success('Вы оформили заявку!');
  });

});

$button = $app->add('Button')->on('click', new \atk4\ui\jsModal('Lol',$vp)); */

$parents = new Model\Vecaki($app->db);

$vir = $app->add('VirtualPage');
$vir->set(function($app) use ($parents) {
  $app->add(['Button','Work']);
  $form = $app->add('Form');
  $form->setModel($parents);
  $form->onSubmit(function($form) {
    $form->model->save();
    return $form->success('Вы оформили заявку!');
  });
});

$app->add(['ui'=>'divider']);

$button = $app->add(['Button','Test'])->on('click', new \atk4\ui\jsModal('Work',$vir));
