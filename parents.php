<?php

require 'vendor/autoload.php';
$app = new App('public');

$col = $app->add('Columns');
$subject= new Model\Subject($app->db);

$c1 = $col->addColumn();
$c2 = $col->addColumn();
$c3 = $col->addColumn();
$c4 = $col->addColumn();
$mes = $c4->add(['Message','Lietošanas instrukcija','massive info']);
$mes->text->addParagraph('Lai pabridināt skolotāju par jūsu ierašanas laiku, lūdzu izvēlaties priekšmetu, skolotāja vārdu un vēlamo laiku.');

$table_s = $c1->add(['Table','very basic selectable'])->addStyle('cursor', 'pointer');
$table_s->setModel($subject, [$subject->title_field]);
$table_s->on('click', 'tr', $c2->jsReload(['pr'=>$table_s->jsRow()->data('id')]));

if (isset($_GET['pr'])) {
$subject->load($_GET['pr']);
$teacher = $subject->ref('Teacher');
$table_t = $c2->add(['Table','very basic selectable'])->addStyle('cursor', 'pointer');
$table_t->setModel($teacher,[$teacher->title_field]);
$table_t->on('click', 'tr', $c3->jsReload(['t'=>$table_t->jsRow()->data('id')]));
}

if(isset($_GET['t'])) {
  $menu = $c3->add('Menu');
  $menu->addClass('vertical');
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
      $teacher= new Model\Teacher($app->db);
      $teacher_id = $teacher->load($_GET['t']);
      $parentss = new Model\Vecaki($app->db);
      $vir = $app->add('VirtualPage');
      $vir->set(function($vir) use ($parentss,$time,$teacher_id) {
        $form = $vir->add('Form');
        $form->setModel($parentss,['student_name','parent_name','contact_phone']);
        $parentss['time'] = $time;
        $parentss['teacher_id'] = $teacher_id;
        $form->onSubmit(function($form) {
          $form->model->save();
          return [$form->success('Jūsu pieprasījums ir iesniegts!'),new \atk4\ui\jsExpression('document.location="parents.php"')];
        });
      });
      $s=1;
      $parents=$teacher_id->ref('Vecaki');
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
          if (isset($array[$n]) && $array[$n]==$time) {
            $menu->addItem([$time,'disabled']);
            $check=TRUE;
          }
        }
        if($check==FALSE){
          $menu->addItem($time)->on('click', new \atk4\ui\jsModal('Work',$vir));
        }
        }else {
          $menu->addItem($time)->on('click', new \atk4\ui\jsModal('Work',$vir));
        }
      $min=$min+5;
    }
  }
}

$button = $c4->add(['Button','admin','icon'=>'key']);
$button->link(['admin','check'=>'list']);


$button2 = $c4->add(['Button','Skolotājiem','icon'=>'student']);
$button2->link(['teachers']);

$app->add(['ui'=>'divider']);

$app->add(['Label','This app is made by Colibri School students','red right ribbon'])
->link('http://colibrischool.lv');
