<?php
  require_once('Model/data_entity.php');
  class booking_model{
    var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
    }

    public function getIdRoomIdType( $id_hotel,  $startDate, $endDate){
    	$query =" SELECT  DISTINCT r.id, r.roomType from  room as r WHERE r.id NOT IN (SELECT r2.id FROM room as r2 JOIN bookdetail as bd on bd.idRoom = r2.id WHERE (($startDate <=bd.inDate AND $endDate >=bd.inDate) OR ($startDate>=bd.inDate AND $startDate<=bd.outDate ) )) AND r.idHotel=$id_hotel ";

    	// idroom, id type
    	$result=mysqli_query($this->conn,$query);
    	// print_r($result);

    	
    	$datas =array();
    	// check mang rong
    	// if(empty($datas)){
    	// 	print("rong");
    	// }

    	if(mysqli_num_rows($result)>0){
    		foreach ($result as $key => $value) {
    				$datas[] = new data_entity($value);
  			}
  		}

  		return $datas;
    }
    public function countTypeWithDate($idHotel,$startDate, $endDate){
    	$query =" SELECT COUNT(r.id) as num, r.roomType FROM  room as r 
    	where r.idHotel = $idHotel AND (r.id  NOT IN (SELECT DISTINCT r2.id FROM room as r2 JOIN bookdetail as bd on bd.idRoom = r2.id 
    	WHERE (($startDate <= bd.inDate AND $endDate >=bd.inDate) OR $startDate<=bd.outDate AND $startDate >= bd.inDate ) )) 
    	group BY r.roomType ";


    	// idroom, id type
    	$result=mysqli_query($this->conn,$query);
    	// print('result');
    	// print_r($result);

    	
    	$datas =array();
    	// check mang rong
    	// if(empty($datas)){
    	// 	print("rong");
    	// }

    	if(mysqli_num_rows($result)>0){
    		foreach ($result as $key => $value) {
    				$datas[] = new data_entity($value);
  			}
  		}

  		return $datas;
    }
}

?>