<?php

class VIEWBOOKING_CONTROLLER{

	public function run(){
    
		$action = isset($_GET['action'])?$_GET['action']:'';
  	
  		// print('booking_con_run:'.	$action);
 
  		switch($action){
  			case 'step1':
  				require_once('View/user/booking1.php');
          
  				break;
        case 'step2':
            require_once('Model/roomtype_model.php');
          
            $action_POST = isset($_POST['action'])?$_POST['action']:'';
            $action_GET=  isset($_POST['action'])?$_POST['action']:'';
            if(empty($action_POST)){
              // print('action null: '.$action_POST);
            
            }else{
              // print("action # null: ".$action_POST);
              $id_city=$_POST['select_city'];
              $id_hotel=$_POST['select_hotel'];
              //xu ly ngay thang
              $date=$_POST['daterange'];
          

              $date = explode(' - ',$date);//cat chuot
              $startDate = $date[0];
              // luu gia tri start datetime vao database
              $startDatetime = strtotime($startDate);

              $newformat = date('m/d/Y',$startDatetime);

              $endDate =$date[1];

              // endDatetime is stored in database
              $endDatetime = strtotime($endDate);

              $timeADay=60*60*24;

              $totalNight= ($endDatetime -$startDatetime)/$timeADay;

              print("<p>post id_hotel: ".$id_hotel.'</p>'); 
              print("<p>post city: ".$id_city.'</p>'); 
              print('<p>startDate: '.$startDatetime.'</p>');
              print('<p>startDate: '.$newformat.'</p>');
              print('<p>endDate: '.$endDate.'</p>');
              print('<p>totalNight: '.$totalNight.'</p>');

              $roomtype_model = new roomtype_model();

              $types=$roomtype_model->select();

              // print('<pre>');
              // print_r($types);
              // print('</pre>');
              // print('<p>bat dau foreach</p>');
              // foreach ($types as $key => $value) {
              //   # code...
              //   print($key);
              //   print(' : ');
              //   print($value->id);
              //    print($value->image);
              //    print(gettype($value->image));
              //   print(' - ');
              // };

              
              require_once("View/user/booking2.php");
          break;
  		    }
	   }
  }
}

?>