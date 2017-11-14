<?php
  require 'init.php';
  $teacher->load($_GET['id']);
  $name = $teacher['name'];
  $phone = $teacher['contact_phone'];
  $header = $app->add(['Header',$name.' ('.$phone.')']);
//$timeslot = $day->ref('Timeslot');
  $menu = $app->add('Menu');
  for($i=7;$i<=14;$i++) {
    $date_day=$date_day+1;
    if (isset($check)){
      if($date_month==[1,3,5,7,9,11]){
        if($date_day+$i>31){
          $date_month = $date_month+1;
          $check=TRUE;
        }
      } else{
          if($date_month<>28){
            if($date_day+$i>28){
              $date_month = $date_month+1;
              $check=TRUE;
            }
          }else{
            $date_month = $date_month+1;
            $check=TRUE;
          }
        }
    }

    $menuitem= $menu->addMenu($date_day.'.'.$date_month);
  }
