<?php 
 require_once("Model/data_entity.php");
class HOTEL_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	 public function GetDetailHotel($id) {
		$mySQL = "SELECT * FROM hotel WHERE id={$id}";
		#die($mySQL);
		$result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
		if ($result && mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_array($result);
			$hotel_object = new data_entity($row);
		
			
			return $hotel_object;
		}
		else
			return false;
	}
	
	public function GETALLHOTEL()
	{
		$sql='SELECT * FROM `hotel` ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$hotel_object = new data_entity($row);
				$array[]=$hotel_object;
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
		$sql="SELECT * FROM `hotel` WHERE name LIKE '%{$val}%' or address LIKE '%{$val}%' ";
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$hotel_object = new data_entity($row);
				$array[]=$hotel_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	}
	 public function PagingHotel($tong ,$a)
	 {
		$sql="SELECT * FROM `hotel` LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$hotel_object = new data_entity($row);
				$array[]=$hotel_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
	// $hotel->name=$name;
        // $hotel->idCity=$name;
        // $hotel->address=$address;
	public function update(data_entity $hotel)
	{
		$mySQL  = "UPDATE hotel SET name='{$hotel->name}',idCity={$hotel->idCity},address='{$hotel->address}' where id={$hotel->id}";
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
	public function delete_hotel($id)
	{
		   $sql = "DELETE FROM hotel WHERE id ='" . $id . "'";
	 
		   if (mysqli_query($this->conn, $sql)) {

			   return true;
		   } else
			   return false;
	}
	 public function insert(data_entity $hotel)
	 {
       
		  $mySQL = "INSERT INTO hotel (id,name,idCity,address) VALUE (NULL,'{$hotel->name}',{$hotel->idCity},'{$hotel->address}')";
		
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
				$hotel_object = new data_entity($row);
				$array[]=$hotel_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
	 public function getHotelWithCity($idCity){
	 	$sql='SELECT * FROM hotel where idCity=$idCity ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$hotel_object = new data_entity($row);
				$array[]=$hotel_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}

	 }
	 public function countHotelWithCity($idCity){
	 	$sql='SELECT COUNT(hotel.id) FROM `hotel` WHERE hotel.idCity=$idCity';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
        	$array=array();
		  	
        	$row = mysqli_fetch_array($return);
        	$array[] =$row;
			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}

	 }
}
?>