<?php
require_once('Model/data_entity.php');

class roomtype_model{
	var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
    }

	public function select(){
		

		$sql= 'select * from roomtype';
		$result=mysqli_query($this->conn,$sql);
		$roomtypes=array();
 		if($result){
			while($row = mysqli_fetch_array($result)){
				$type = new data_entity($row);
				$roomtypes[]=$type;
			}
			return $roomtypes;
		}
		else{
			print("room type model - slect:  loi");
		}
	}
	public function getType($idHotel){

		$query = " SELECT DISTINCT t.* from roomtype as t JOIN room as r on r.roomType=t.id where r.idHotel = $idHotel ";
		$result=mysqli_query($this->conn,$query);
		$roomtypes=array();

 		if(mysqli_num_rows($result)){
			while($row = mysqli_fetch_array($result)){
				$type = new data_entity($row);
				$roomtypes[]=$type;
			}
			return $roomtypes;
		}
		else{
			print("room type model - slect:  loi");
			return $roomtypes;
		}

	}
	public function GetDetailHotel($id) {
		$mySQL = "SELECT * FROM hotel WHERE id={$id}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$hotel_object = new HOTEL();
			$hotel_object->id = $row['id'];
			$hotel_object->idCity = $row['idCity'];
			$hotel_object->name = $row['name'];
			$hotel_object->address = $row['address'];
			//var_dump($typeroom_object);
			return $hotel_object;
		}
		else{
			return false;
		}
	}

}


?>