<?php 
 require_once("Model/data_entity.php");
class USER_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	 public function GetDetailUsers($id) {
		$mySQL = "SELECT * FROM user WHERE id={$id}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$news_object = new data_entity($row);
		
			//var_dump($typeroom_object);
			return $news_object;
		}
		else
			return false;
	}
	
	public function GETALLUSER()
	{
		$sql='SELECT * FROM `user` ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$news_object = new data_entity($row);
				$array[]=$news_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	}
	public function SEARCH($val)
	{
		// SELECT sv_id, sv_name, sv_description
		// FROM SINHVIEN
		// WHERE sv_name LIKE '%Cuong%'
		$sql="SELECT * FROM `user` WHERE name LIKE '%{$val}%'or username LIKE '%{$val}%' ";
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$news = new data_entity($row);
				$array[]=$news;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	}
	 public function PagingUser($tong ,$a)
	 {
		$sql="SELECT * FROM `user` LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$news_object = new data_entity($row);
				$array[]=$news_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
	//  $users->username=$username;
	//  $users->password=$password;
	//  $users->name=$name;
	//  $users->email=$email;
	//  $users->cmtnd=$cmtnd;
	//  $users->phoneNumber=$phoneNumber;
	//  $users->isAdmin=$isAdmin;
	//  $users->address=$address;
	//  $users->sex=$sex;
	//  $users->id=$id;
	public function update(data_entity $news)
	{
		$mySQL  = "UPDATE user SET username='{$news->username}',password={$news->password},sex='{$news->sex}',name='{$news->name}',email='{$news->email}',cmtnd={$news->cmtnd},phoneNumber={$news->phoneNumber},isAdmin={$news->isAdmin},address='{$news->address}' where id={$news->id}";

		
		 $result = mysqli_query($this->conn,$mySQL);
		 if($result)
		 {
			 return true;
		 }
		 else
		 {
			 return false;
		 }
	}
	public function delete_user($id)
	{
		   $sql = "DELETE FROM user WHERE id ='" . $id . "'";
	 
		   if (mysqli_query($this->conn, $sql)) {

			   return true;
		   } else
			   return false;
    }
    // $users->username=$username;
    // $users->password=$password;
    // $users->name=$name;
    // $users->email=$email;
    // $users->cmtnd=$cmtnd;
    // $users->phoneNumber=$phoneNumber;
    // $users->isAdmin=$isAdmin;
	 public function insert(data_entity $news)
	 {
		// $new_typerom->totalPeople=$totalPeople;
		// $new_typerom->image=$destination;
	
		  $mySQL = "INSERT INTO user (id,username,sex,address,password,name,email,cmtnd,phoneNumber,isAdmin) VALUE (NULL,'{$news->username}','{$news->sex}','{$news->address}','{$news->password}','{$news->name}','{$news->email}',{$news->cmtnd},{$news->phoneNumber},{$news->isAdmin})";
		 
		  $result = mysqli_query($this->conn,$mySQL);
		 
		  if($result)
		  {
			  return true;
		  }
		  else
		  {
			  return false;
		  }
	 }
	 public function SearchPagingRoom($val,$tong ,$a)
	 {
		$sql="SELECT * FROM `roomtype`  WHERE typeName LIKE '%{$val}%' LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$typeroom_object = new data_entity($row);
				$array[]=$typeroom_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
}
?>