<?php
  $controller_name=filter_input(INPUT_GET,'controller');
  if(empty($controller_name))
  {
    $controller_name='Admin';
  }
  require_once 'Controller/'. strtoupper($controller_name).'_CONTROLLER.php';
   $controller_name = strtoupper($controller_name).'_CONTROLLER';
   $new_controller_object = new $controller_name();
    $new_controller_object->run();
 ?>

<!--
 //session_start();
  //if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
   
  }
  //else
  {
   // include __DIR__.'/html_file.php';
  }
  //print_r ($_SESSION['admin_name']);
  // echo ($_SESSION['admin_name']);
//?