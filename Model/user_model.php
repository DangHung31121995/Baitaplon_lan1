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
    public function insert(data_entity $user)
    {
      $query=mysqli_query($this->conn,'select * from user');
      $fields=array();
      $values_insert=array();
      $data=mysqli_fetch_fields($query);
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
      // print("signup_model: insert : query: ".$query);
      $result=mysqli_query($this->conn,$query);


      // print("signup_model: insert : result: ". $result);
      // print($resull); =1 neu insert thanh cong 
      if($result){
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
        foreach($value1 as $k=>$value2)
        {
          if(is_string($k))
          {
            if($update->$k !='null' )
            {
              $updates[]="$k='$update->$k'";
            }
          }
        }
        break;
      }
      if(count($updates)>0)
      {
        $updates_sql=implode(',',$updates);
        $query="UPDATE user set {$updates_sql} where id='{$id}'";
        print("usermodel: update: query update: ".$query);
        $result=mysqli_query($this->conn,$query);
      }
      echo "<script language='javascript'>alert('Cập nhật thành công')</script>";
    }
    public function delete($id)
    {
      $query="delete from user where id='{$id}'";
      $result=mysqli_query($this->conn,$query);
    }
  }

}

?>