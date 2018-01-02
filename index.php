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

          $parentss = new Model\Vecaki($app->db);

          $vir = $app->add('VirtualPage');
          $vir->set(function($vir) use ($parentss,$time,$teacher_id) {
            $form = $vir->add('Form');
            $form->setModel($parentss,['student_name','parent_name','contact_phone']);
            $parentss['time'] = $time;
            $parentss['teacher_id'] = $teacher_id;
            $form->onSubmit(function($form) {
              $form->model->save();
              return [$form->success('Вы оформили заявку!'),new \atk4\ui\jsExpression('document.location="index.php"')];
            });
          });

          $parents=$teacher->ref('Vecaki');
          $s=1;
          if($parents->tryLoadAny()->loaded()==TRUE) {
            foreach($parents as $rowss) {
              if ($rowss['time']==$time) {
                $array=[$s=>$time];
                $s=$s+1;
              }
            }
            unset($rowss);
            $check=FALSE;
            for($n=0;$n<=$s;$n++){
              if ($array[$n]==$time) {
                $subsubmenu->addItem([$time,'disabled']);
                $check=TRUE;
              }
            }
            if($check==FALSE){
              $subsubmenu->addItem($time)->on('click', new \atk4\ui\jsModal('Work',$vir));
            }
            }else {
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
