<?php 
 require("Model/data.php");
class ROOM_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	 public function GetDetailRoom($id) {
		$mySQL = "SELECT * FROM room WHERE id={$id}";
		#die($mySQL);

		$result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$room_object = new data_entity($row);
			//var_dump($typeroom_object);
			return $room_object;
		}
		else
			return false;
	}
	
	public function GETALLROOM()
	{
		$sql='SELECT * FROM `room` order by roomName ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
              $room_object = new data_entity($row);
			  $array[]=$room_object;
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
		$sql="SELECT * FROM `room` WHERE roomName LIKE '%{$val}%' ";
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$room_object = new data_entity($row);
				$array[]=$room_object;
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
		$sql="SELECT * FROM `room` LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$room_object = new data_entity($row);
				$array[]=$room_object;
			}
			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
	//$room->roomName=$roomName;
        //$room->roomType=$roomType;
        //$room->idHotel=$idHotel;
		// var_dump($loaiphong);
	public function update(data_entity $room)
	{
		$mySQL  = "UPDATE room SET roomName='{$room->roomName}',roomType={$room->roomType},idHotel='{$room->idHotel}' where id={$room->id}";
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
	public function delete_room($id)
	{
		   $sql = "DELETE FROM room WHERE id ='" . $id . "'";
	 
		   if (mysqli_query($this->conn, $sql)) {

			   return true;
		   } else
			   return false;
	}
	 public function insert(data_entity $room)
	 {
        //$room->roomName=$roomName;
        //$room->roomType=$roomType;
        //$room->idHotel=$idHotel;
		// var_dump($loaiphong);
		  $mySQL = "INSERT INTO room (id,roomName,roomType,idHotel) VALUE (NULL,'{$room->roomName}',{$room->roomType},'{$room->idHotel}')";
		  //echo ($mySQL);
		  $result = mysqli_query($this->conn,$mySQL);
		  //echo (gettype($result));
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
				$room_object = new data_entity($row);
				$array[]=$room_object;
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