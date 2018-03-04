<?php
require_once('Model/data_entity.php');
class city_hotel_model{
	var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
       mysqli_set_charset($this->conn,"utf8");
    }
    public function getHotel($idHotel){
    	$query = "SELECT * FROM hotel WHERE id={$idHotel}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$query) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$hotel_object = new data_entity($row);
		
			return $hotel_object;
		}
		else
			return false;
    }
    public function getCity($idCity){
		$query = "SELECT * FROM city WHERE id={$idCity}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$query) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$city_object = new data_entity($row);
		
			return $city_object;
		}
		else
			return false;

    }
    public function getCityHotel(){
    	$query="SELECT COUNT(h.idCity) as soluong,h.idCity,city.name FROM hotel as h join city on h.idCity=city.id GROUP BY h.idCity";
    	$result = mysqli_query($this->conn,$query) or die(mysqli_error($this->conn));

    	$datas=array();
		if ($result) {
			while($row = mysqli_fetch_array($result)){
				$dem = new data_entity($row);
				$datas[]=$dem;
			}
			return $datas;
		}
		else
			return false;

    }
    public function getHotelWithCity($idCity){
	 	$sql="SELECT * FROM `hotel` where idCity=$idCity ";
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$data = new data_entity($row);
				$array[]=$data;
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