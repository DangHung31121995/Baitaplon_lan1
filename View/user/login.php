
<?php
$conn =mysqli_connect("localhost","root","");
mysqli_select_db($conn,'roombooking');
mysqli_set_charset($conn,"utf8");
if(!empty($_POST['user']))
{
    $username = trim($_POST['user']);
    $password = trim($_POST['password']);
    //neu dang nhap dung


    if($username == 'a' && $password == 'b')
    {
       $array = array(
            'check'=>true,
            'user'=>$username,
            'mess'=>'ok'
       );
       // session_start();
       // $_SESSION['user']=$username;
       print json_encode($array);
    }else{
       $array = array(
            'check'=>false,
            'mess'=>'ok'
       );
       print json_encode($array);
    }
}
?>