<?php 
 require_once("Model/data_entity.php");
class HISTORYBOOKING_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	
	
	public function GETALLHISTORY()
	{
		$sql='SELECT * FROM `historybooking` ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$htrbooking_object = new data_entity($row);
				$array[]=$htrbooking_object;
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
		$sql="SELECT * FROM `historybooking` WHERE id LIKE '%{$val}%' or address LIKE '%{$val}%' ";
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
	 public function PagingHistory($tong ,$a)
	 {
		$sql="SELECT * FROM `historybooking` LIMIT $tong,$a ";

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
	public function delete_history($id)
	{
		   $sql = "DELETE FROM historybooking WHERE id ='" . $id . "'";
	 
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
}
?>