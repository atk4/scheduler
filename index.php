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
    }
    unset($rows);
}
unset($row);

$button = $app->layout->add(['Button','admin','icon'=>'space shuttle']);
$button->link(['admin']);


$button2 = $app->layout->add(['Button','Для учителей','icon'=>'student']);
$button2->link(['teachers']);


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
