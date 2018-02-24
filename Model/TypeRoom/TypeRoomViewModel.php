<?php 
 require("Model/data.php");
class TYPEROOM_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	 public function GetDetailTypeRoom($id) {
		$mySQL = "SELECT * FROM roomtype WHERE id={$id}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$typeroom_object = new data_entity($row);
		
			//var_dump($typeroom_object);
			return $typeroom_object;
		}
		else
			return false;
	}
	
	public function GETALLTYPEROOM()
	{
		$sql='SELECT * FROM `roomtype` ';
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
	public function SEARCH($val)
	{
		// SELECT sv_id, sv_name, sv_description
		// FROM SINHVIEN
		// WHERE sv_name LIKE '%Cuong%'
		$sql="SELECT * FROM `roomtype` WHERE typeName LIKE '%{$val}%' ";
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
	 public function PagingRoom($tong ,$a)
	 {
		$sql="SELECT * FROM `roomtype` LIMIT $tong,$a ";

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
	
	public function update(data_entity $loaiphong)
	{
		$mySQL  = "UPDATE roomtype SET typeName='{$loaiphong->typeName}',pricePerDay={$loaiphong->pricePerDay},typeDescription='{$loaiphong->typeDescription}' where id={$loaiphong->id}";
		//die ($mySQL);
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
	public function delete_typeroom($id)
	{
		   $sql = "DELETE FROM roomtype WHERE id ='" . $id . "'";
	 
		   if (mysqli_query($this->conn, $sql)) {

			   return true;
		   } else
			   return false;
	}
	 public function insert(data_entity $loaiphong)
	 {
	
		  $mySQL = "INSERT INTO roomtype (id,typeName,pricePerDay,typeDescription) VALUE (NULL,'{$loaiphong->typeName}',{$loaiphong->pricePerDay},'{$loaiphong->typeDescription}')";
		 
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