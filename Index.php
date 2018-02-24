<?php
  $controller_name=filter_input(INPUT_GET,'controller');
  if(empty($controller_name))
  {
    $controller_name='trangchu';
  }
  require_once 'Controller/'. strtoupper($controller_name).'_CONTROLLER.php';
   $controller_name = strtoupper($controller_name).'_CONTROLLER';
   $new_controller_object = new $controller_name();
    $new_controller_object->run();
 ?>