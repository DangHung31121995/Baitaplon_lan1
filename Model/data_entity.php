<?php
class data_entity{
    var $data;
    public function __construct($data)
    {
      $this->data=$data;
    }
    function __set($proprety,$value)
    {
      $this->data[$proprety]=$value;
    }
    function __get($proprety)
    {
      return $this->data[$proprety];
    }
  }
?>
