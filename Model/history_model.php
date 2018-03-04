<?php
require_once('Model/data_entity.php');
class history_model{
	var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
       mysqli_set_charset($this->conn,"utf8");
    }

    public function getWithUser($idUser){
    	$query="SELECT hb.id as idhistory,u.id as iduser, bd.id as idBooking, u.username,h.name,h.address,r.roomName,bd.inDate,bd.outDate,bd.price,hb.dateOfBooking from room as r join roomtype as rt on r.roomType = rt.id 
						join hotel as h on r.idHotel = h.id 
                        join bookdetail as bd on bd.idRoom=r.id 
                        JOIN historybooking as hb on hb.idBookingDetail= bd.id
                        JOIN user as u on u.id	=hb.idCustomer
				where u.id = $idUser   ORDER BY bd.inDate DESC";

		$result=mysqli_query($this->conn,$query);
		$historys=array();
 		if($result){
			while($row = mysqli_fetch_array($result)){
				$his = new data_entity($row);
				$historys[]=$his;
			}
		}
		// print("<pre>");
		// print_r($historys);
		// print("</pre>");

		return $historys;
    }
    public function delHistory($idHistory){

    	$query ="DELETE FROM historybooking as hb WHERE hb.id=$idHistory";

    	$result= mysqli_query($this->conn,$query);

    	if($result){
	 		return true;
    	}else{
    		return false;
    	}

    }
    public function getInformation($idHistory){

		$query =" SELECT hb.id as idhistory,u.id as iduser, bd.id as idBooking, u.username,h.name,h.address,r.roomName,rt.typeName,rt.typeDescription,rt.totalPeople,bd.inDate,bd.outDate,bd.price,hb.dateOfBooking from room as r join roomtype as rt on r.roomType = rt.id 
					join hotel as h on r.idHotel = h.id 
		            join bookdetail as bd on bd.idRoom=r.id 
		            JOIN historybooking as hb on hb.idBookingDetail= bd.id
		            JOIN user as u on u.id	=hb.idCustomer
			where hb.id = $idHistory ";

		$result= mysqli_query($this->conn,$query);

		$information=array();
 		if($result){
			while($row = mysqli_fetch_array($result)){
				$info  = new data_entity($row);
				$information[]=$info;
			}

		}else{

		}
		return $information;

		// Array ( [0] => data_entity Object ( [data] => Array ( [0] => 2 [idhistory] => 2 [1] => 12 [iduser] => 12 [2] => 17 [idBooking] => 17 [3] => b [username] => b [4] => Crutiss Grad [name] => Crutiss Grad [5] => Nguyễn Trãi, Thanh Xuân, Hà Nội [address] => Nguyễn Trãi, Thanh Xuân, Hà Nội [6] => grad_4 [roomName] => grad_4 [7] => 3 nguoi [typeName] => 3 nguoi [8] => co dien va sang trỏng [typeDescription] => co dien va sang trỏng [9] => 3 [totalPeople] => 3 [10] => 1519686000 [inDate] => 1519686000 [11] => 1519858800 [outDate] => 1519858800 [12] => 24 [price] => 24 [13] => 1519749122 [dateOfBooking] => 1519749122 ) ) )



    }

  


}
?>