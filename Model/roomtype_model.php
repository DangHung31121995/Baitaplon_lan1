<?php
require_once('Model/data_entity.php');

class roomtype_model{

	public function select(){
		require_once('connect.php');

		$sql= 'select * from roomtype';
		$result=mysqli_query($conn,$sql);
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