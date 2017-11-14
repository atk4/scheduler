<?php
  require 'init.php';
  $teacher->load($_GET['id']);
  $name = $teacher['name'];
  $phone = $teacher['contact_phone'];
  $header = $app->add(['Header',$name.' ('.$phone.')']);
