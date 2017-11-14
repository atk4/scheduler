<?php
  require 'init.php';
  $teacher->load($_GET['id']);
  $name = $teacher['name'];
  $phone = $teacher['contact_phone'];
  $header = $app->add(['Header',$name.' ('.$phone.')']);
//$timeslot = $day->ref('Timeslot');
  $menu = $app->add('Menu');
  for($i=14;$i<=21;$i++) {
    $date_day=$date_day+1;
    if (!isset($check)){
      if(($date_month==1) and ($date_month==3)and ($date_month==5) and ($date_month==7)and ($date_month==9)and ($date_month==11)){
        if($date_day>31){
          $date_month = $date_month+1;
          $check=TRUE;
          $date_day = $date_day-31;
        }
      } else{
          if($date_month==2){
            if($date_day>28){
              $date_day = $date_day-28;
              $date_month=$date_month+1;
              $check=TRUE;
            }
          }else{
            if($date_day>30){
              $date_day = $date_day-30;
              $date_month=$date_month+1;
              $check=TRUE;
            }
          }
        }
    }
    $menuitem= $menu->addMenu($date_day.'.'.$date_month);
  }
