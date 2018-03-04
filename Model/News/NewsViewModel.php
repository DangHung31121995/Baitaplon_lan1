<?php 
 require_once("Model/data_entity.php");
class NEWS_MODEL{
	private $conn;

	public function __construct() {
		$this->conn = mysqli_connect('localhost','root');
		mysqli_query($this->conn,"USE roombooking");
		mysqli_query($this->conn,"SET NAMES 'utf8'");
	
	}
	 public function GetDetailNews($id) {
		$mySQL = "SELECT * FROM news WHERE id={$id}";
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
	
	public function GETALLNEWS()
	{
		$sql='SELECT * FROM news order by news.date DESC ';
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
		$sql="SELECT * FROM `news` WHERE name LIKE '%{$val}%' ";
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
	 public function PagingNews($tong ,$a)
	 {
		$sql="SELECT * FROM `news` LIMIT $tong,$a ";

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
	
	public function update(data_entity $news)
	{
		$mySQL  = "UPDATE news SET name='{$news->name}',idCity={$news->idCity},content='{$news->content}',shortContent='{$news->shortContent}',date='{$news->date}',image='{$news->image}' where id={$news->id}";
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
	public function delete_news($id)
	{
		   $sql = "DELETE FROM news WHERE id ='" . $id . "'";
	 
		   if (mysqli_query($this->conn, $sql)) {

			   return true;
		   } else
			   return false;
    }
    // $news->idCity=$idCity;
    // $news->name=$name;
    // $news->content=$content;
    // $news->shortContent=$shortContent;
    // $news->date=$date;
    // $news->image=$destination;
	 public function insert(data_entity $news)
	 {
		// $new_typerom->totalPeople=$totalPeople;
		// $new_typerom->image=$destination;
	
		  $mySQL = "INSERT INTO news (id,idCity,name,content,shortContent,date,image) VALUE (NULL,{$news->idCity},'{$news->name}','{$news->content}','{$news->shortContent}','{$news->date}','{$news->image}')";
		
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