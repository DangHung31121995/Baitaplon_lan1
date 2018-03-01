 <?php

require_once('Model/data_entity.php');
class user_model{
	var $conn;
	public function __construct(){
	  $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
	  mysqli_select_db($this->conn,'roombooking');
     mysqli_set_charset($this->conn,"utf8");
	}

	public function select(){
		$query='select * from user order by id';
		$result=mysqli_query($this->conn,$query);
		$users=array();
		if($result)
		{
			while($row=mysqli_fetch_array($result))
			{
			  $user=new data_entity($row);
			  $users[]=$user;
			}
			return $users;
		}
		else {
  		print mysqli_error($this->conn);
  		return false;
		}
      
  }

  public function checkSignIn(data_entity $user){
    $query="SELECT * from user as u WHERE u.username='{$user->username}'";
    $result=mysqli_query($this->conn,$query);
      if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $row=new data_entity($row);
       /* print_r($row);
     [0] => 3
    [id] => 3
    [1] => 1
    [username] => 1
    [2] => 1
    [password] => 1
    [3] => 1
    [name] => 1
    [4] => Nam
    [sex] => Nam
    [5] => 111a@gmail.com
    [email] => 111a@gmail.com
    [6] => 132
    [cmtnd] => 132
    [7] => 123
    [address] => 123
    [8] => 123
    [phoneNumber] => 123
    [9] => 0
    [isAdmin] => 0*/
        // print('pass: '.$row->password."-----".$user->password);
        if($row->password == $user->password){
          if (!isset($_SESSION)) {
              session_start();
           }
          $_SESSION['user']=$user->username;

          if($row->isAdmin != 0){
            $_SESSION['isAdmin']=$row->isAdmin;
          }
          // print('true');
          return true;


        }else{
           // print('false');
          return false;
        }
      }//end if
    }

  public function getUser($name){
      $query="SELECT * FROM user WHERE user.username='{$name}' ";
      $result=mysqli_query($this->conn,$query);
      if(mysqli_num_rows($result)>0){
        $row  = mysqli_fetch_array($result);
        $user = new data_entity($row);
        return $user;
      }else{
        echo "<script> alert('user_model_getuuser: User không tồn tại'); </script>";
        return false;
      }
    }
  public function insert(data_entity $user)
    {
      $user->id='null';
      
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
      // print($result); =1 neu insert thanh cong 
      if($result){
        if(session_start()==PHP_SESSION_NONE){
          session_start();
        }
        $_SESSION['user']=$user->username;
        if($user->isAdmin !=0){
          $_SESSION['isAdmin']=$user->isAdmin;
        }


        return true;
      }else{
        return false;
      }
    }
    public function getUserbyID($idUser)
    {
      $query = "SELECT * FROM user WHERE id = '{$idUser}' ";
      $result=mysqli_query($this->conn,$query);
      
      if(mysqli_num_rows($result)){
      	$row=mysqli_fetch_array($result);
      	$tt=new data_entity($row);
      	return $tt;
      }else{
      	print("user_model getusserbyid: không tồn tại id");
      	return false;
      }
      
    
    }
    public function update(data_entity $update,$id)
    {
      $query="select * from user order by id";
      $result=mysqli_query($this->conn,$query);
      $row=mysqli_fetch_array($result);
      $users=new data_entity ($row);
      $updates=array();
      foreach($users as $key=>$value1)
      {
        foreach($value1 as $k=>$value2) // $k là trường của phần tử: 0,id,1,username, ....
        {
          // print('<p>');
          // print('k: '.$k);
          if(is_string($k))
          {
            if($update->$k !='null' )
            {
              $updateField = "{$k}"."='"."{$update->$k}"."'";
              // print(gettype($updateField));
              $updates[]=$updateField;
              // print('--update: ');
              // print($update->$k);
            }

          }
           // print('</p>');
        }
        break;
      }

      // print_r($update);
      if(count($updates)>0)
      {
        $updates_sql=implode(',',$updates);
        $query="UPDATE user set {$updates_sql} where id='{$id}'";
        print("usermodel: update: query update: ".$query);
        $result=mysqli_query($this->conn,$query);
        // print('update ok');
        return true;
      }else{
         // print('update fail');
        return false;
      }
      
    }
    public function delete($id)
    {
      $query="delete from user where id='{$id}'";
      $result=mysqli_query($this->conn,$query);
    }
  public function updatePass($username,$pass){
      $query="SELECT * from user as u WHERE u.username='{$username}'";
      $result=mysqli_query($this->conn,$query);
      if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $user=new data_entity($row);
        $user->password=$pass;
        print_r($user);
        $check = $this->update($user,$user->id);
        return $check;
      }
  }

  public function checkForgot($username, $email,$cmtnd){
    $query="SELECT * from user as u WHERE u.username='{$username}'";
    $result=mysqli_query($this->conn,$query);
    // print_r($result);
      if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        // print_r($row);
        $user=new data_entity($row);

        if(strcmp($user->email,$email)!=0){
          echo "<script>alert('Email Không Chính Xác');</script>";
          echo "<script>history.back(-1);</script>";
            return false;
        }
        if(strcmp($user->cmtnd,$cmtnd)){
          echo "<script>alert('Số cmnt Không Chính Xác');</script>";
          echo "<script>history.back(-1);</script>";
          return false;
            
        }

        return true;
      }else{
        echo "<script>alert('Tài Khoản không Tồn Tại');</script>";
        echo "<script>history.back(-1);</script>";
        return false;
      }

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

}

?>