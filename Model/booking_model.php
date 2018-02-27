<?php
  require_once('Model/data_entity.php');
  class booking_model{
    var $conn;
    public function __construct(){
      $this->conn=mysqli_connect('localhost','root','')or die('khong the ket noi');
      mysqli_select_db($this->conn,'roombooking');
       mysqli_set_charset($this->conn,"utf8");
 
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


      $query_room =" SELECT r.id, r.roomType FROM  room as r 
      where r.idHotel = $idHotel AND (r.id  NOT IN (SELECT DISTINCT r2.id FROM room as r2 JOIN bookdetail as bd on bd.idRoom = r2.id 
      WHERE (($startDate <= bd.inDate AND $endDate >=bd.inDate) OR $startDate<=bd.outDate AND $startDate >= bd.inDate ) ))";


    	// idroom, id type
    	$result=mysqli_query($this->conn,$query);
      $result_room=mysqli_query($this->conn,$query_room);
    	// print('result');
    	// print_r($result_room);

    	
    	$datas =array();
    	// check mang rong
    	// if(empty($datas)){
    	// 	print("rong");
    	// }
    

    	if(mysqli_num_rows($result)>0){
    		foreach ($result as $key => $countAndType) {//countAndType Array ( [num] => 3 [roomType] => 1 );
             $data = new data_entity($countAndType);
     
             $arrIdRoom =array();
          foreach ($result_room as $key2 => $roomAndType) { //roomAndType Array ( [id] => 9 [roomType] => 1 );
              if($roomAndType['roomType'] == $countAndType['roomType']){
                array_push($arrIdRoom, $roomAndType['id']);
              }

            }
          
            $data->arrIdRom = $arrIdRoom;	
            $datas[]=$data;
  			}
  		}
      // print("<pre>");
      // print_r($datas);
      // print("</pre>");

  		return $datas;
    }

    public function insertBookingDetail(data_entity $insert_value){
      $query=mysqli_query($this->conn,'select * from bookdetail');
      $fields=array();
      $values_insert=array();
      $data=mysqli_fetch_fields($query);
      foreach($data as $key=>$value)
      {
        foreach($value as $key=>$value)
        {
          if($value=='id'){
            // print("idddđ");
            $fields[]=$value;
            $values_insert[]="'NULL'";
          }else{
            $fields[]=$value;
            $values_insert[]="'{$insert_value->$value}'";
          }
          break;
        }
      }
      $fields=implode(',',$fields);
      $values_insert=implode(',',$values_insert);
      // print('fields: '.$fields);
      // print('values_insert: '.$values_insert);
      $query="insert into bookdetail ($fields) value ($values_insert)";

      // print("signup_model: insert : mysql: ".$query);
      $result=mysqli_query($this->conn,$query);
      // print('result: '.$result);
      if($result){
        // print('id booking detail vưa insert : '.mysqli_insert_id($this->conn));
        return mysqli_insert_id($this->conn);
      }else{
        print("booking_model: insert lỗi");
        return 'booking_model insertBookingDetail: error';
      }
    }

   public function insertHistory(data_entity $insert_value){
    $query=mysqli_query($this->conn,'select * from historybooking');
      $fields=array();
      $values_insert=array();
      $data=mysqli_fetch_fields($query);
      foreach($data as $key=>$value)
      {
        foreach($value as $key=>$value)
        {
          if($value=='id'){
            // print("idddđ");
            $fields[]=$value;
            $values_insert[]="'NULL'";
          }else{
            $fields[]=$value;
            $values_insert[]="'{$insert_value->$value}'";
          }
          break;
        }
      }
      $fields=implode(',',$fields);
      $values_insert=implode(',',$values_insert);
      // print('fields: '.$fields);
      // print('values_insert: '.$values_insert);
      $query="insert into historybooking ($fields) value ($values_insert)";

      // print("signup_model: insert : mysql: ".$query);
      $result=mysqli_query($this->conn,$query);
      // print('result: '.$result);
      if($result){
        // print('id booking detail vưa insert : '.mysqli_insert_id($this->conn));
        return mysqli_insert_id($this->conn);
      }else{
        print("booking_model:insertHistory insert lỗi");
        return 'booking_model insertHistory: error';
      }

   }


}

?>