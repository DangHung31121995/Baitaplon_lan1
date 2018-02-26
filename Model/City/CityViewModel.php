<?php 
 require_once("Model/data_entity.php");
class CITY_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	}
	
	public function GETALLCITY()
	{
		$sql='SELECT * FROM `city` ';
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$city_object = new data_entity($row);
				$array[]=$city_object;
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
		
		$sql="SELECT * FROM `city` WHERE name LIKE '%{$val}%' ";
	    $result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
                
				$city_object = new data_entity($row);
				$array[]=$city_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	}
	 public function PagingCity($tong ,$a)
	 {
		$sql="SELECT * FROM `city` LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
                
				$city_object = new data_entity($row);
				$array[]=$city_object;
			}

			return  $array;

		}
		else
		{
			  die('loi la '. mysqli_error($this->conn));
		}
	 }
	 public function insert(data_entity $city)
	 {
		
		  $mySQL = "INSERT INTO city (id,name) VALUE (NULL,'{$city->name}')";
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
     public function delete_city($id)
     {
            $sql = "DELETE FROM city WHERE id ='" . $id . "'";
      
            if (mysqli_query($this->conn, $sql)) {

                return true;
            } else
                return false;
     }
     public function update(data_entity $city)
     {
          $mySQL  = "UPDATE city SET name='{$city->name}' where id='{$city->id}'";
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
     
     public function GetDetailCity($id)
     {

     
        $mySQL = "SELECT * FROM city WHERE id={$id}";
      #die($mySQL);
      $result = mysqli_query($this->conn,$mySQL) or die(mysqli_error($this->conn));
      if ($result && mysqli_num_rows($result)>0) 
      {
          $row = mysqli_fetch_array($result);
		  $city_object = new data_entity($row);
		
          return $city_object;
      }
      else
          return false;
     }
	 public function SearchPagingRoom($val,$tong ,$a)
	 {
		$sql="SELECT * FROM `city`  WHERE name LIKE '%{$val}%' LIMIT $tong,$a ";

		$result = mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
		if($result)
		{
          $array=array();
		  $i=0;
		  while($row = mysqli_fetch_array($result))
			{
				$city_object = new data_entity($row);
				$array[]=$city_object;
			  
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