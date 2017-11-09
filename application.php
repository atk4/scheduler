<?php
  require 'init.php';
  $name = $_GET['name'];
  $phone = $_GET['phone'];
  $header = $app->add(['Header',$name.' ('.$phone.')']);
