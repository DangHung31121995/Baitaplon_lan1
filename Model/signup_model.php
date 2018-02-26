<?php
  require_once('Model/data_entity.php');
  class signup_model{
    var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
       mysqli_set_charset($this->conn,"utf8");
    }
    public function check($user)
    {
      $mySQL=mysqli_query($this->conn,'select * from user');
      if($mySQL)
      {
        while($row=mysqli_fetch_array($mySQL))
        {
          $check=new data_entity($row);
          if($user->username==$check->username)
          {
            echo "<script>alert('Tên đăng nhập đã tồn tại');";
            echo "history.back(-1);</script>";
            exit;
          }
          else if($user->email==$check->email)
          {
            echo "<script>alert('Email đã tồn tại');";
            echo "history.back(-1);</script>";
            exit;
          }
          else if($user->phoneNumber==$check->phoneNumber)
          {
            echo "<script>alert('Số điện thoại đã tồn tại');";
            echo "history.back(-1);</script>";
            exit;
          }
        }
      }
    }
    public function insert(data_entity $user)
    {
      $mySQL=mysqli_query($this->conn,'select * from user');
      $fields=array();
      $values_insert=array();
      $data=mysqli_fetch_fields($mySQL);
      foreach($data as $key=>$value)
      {
        foreach($value as $key=>$value)
        {
          $fields[]=$value;
          $values_insert[]="'{$user->$value}'";
          break;
        }
      }
      $fields=implode(',',$fields);
      $values_insert=implode(',',$values_insert);
      $query="insert into user ($fields) value ($values_insert)";
      // print("signup_model: insert : mysql: ".$query);
      $result=mysqli_query($this->conn,$query);


      // print("signup_model: insert : result: ". $result);
      // print($resull); =1 neu insert thanh cong 
      if($result){
        return true;
      }else{
        return false;
      }
    }
  }
 ?>
