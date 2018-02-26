<?php
require_once('Model/booking_model.php');


class VIEWBOOKING_CONTROLLER{
  var $model;
  public function __construct(){
    $this->model=new booking_model();
  }
  public function run(){

    $action = isset($_GET['action'])?$_GET['action']:'';

  		// print('booking_con_run:'.	$action);
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION['user'])){
      print("<script>alert('Bạn cần phải đăng nhập!!'); history.back(-1);</script>");
    }

    switch($action){
     case 'step1':
     require_once('View/user/booking1.php');
     break;


     case 'step2':
           require_once('Model/roomtype_model.php');

           $action_POST = isset($_POST['select_hotel'])?$_POST['select_hotel']:'';

           if(empty($action_POST)){
                    // print('action null: '.$action_POST);
            print('Lỗi tại booking controller Step2');

          }else{
                    // print("action # null: ".$action_POST);
            $id_city=$_POST['select_city'];
            $id_hotel=$_POST['select_hotel'];
                    //xu ly ngay thang
            $date=$_POST['daterange'];


            $date = explode(' - ',$date);//cat chuot
            // print('date_step2: '.$date[0]);
            // print('date_step2: '.$date[1]);
            $startDate = $date[0];
            $endDate =$date[1];


            // luu gia tri start datetime vao database
            $startDateTime = strtotime($startDate);

            // $newformat = date('m/d/Y',$startDateTime);

            

            // endDatetime is stored in database
            $endDateTime = strtotime($endDate);

            $timeADay=60*60*24;

            $totalNight= ($endDateTime -$startDateTime)/$timeADay;

            // print("<p>post id_hotel: ".$id_hotel.'</p>'); 
            // print("<p>post city: ".$id_city.'</p>'); 
            // print('<p>startDate: '.$startDateTime.'</p>');
            // print('<p>startDate: '.$newformat.'</p>');
            // print('<p>endDate: '.$endDate.'</p>');
            // print('<p>totalNight: '.$totalNight.'</p>');

            $roomtype_model = new roomtype_model();

            $types=$roomtype_model->getType(2);


            $idTypes =array();
            foreach ($types as $key => $value) {
              # code...
              $idTypes[]=$value->id;
            }
            // print_r($idTypes);


            $countType = $this->model->countTypeWithDate(2,8,9);

            // print('countType');

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
          }
        break; //endstep2
        case 'step3':
        # code...
        $idTypeCount = isset($_POST['idTypeCount'])?$_POST['idTypeCount']:'';

        if(!empty($idTypeCount)){
          $startDateTime= $_POST['startDateTime'];
          $endDateTime= $_POST['endDateTime'];
          $idHotel= $_POST['idHotel'];
          $idCity= $_POST['idCity'];
          // print($idTypeCount);
          $idTypeCount=json_decode($idTypeCount, true);
            // print('<pre>');
            // print_r($idTypeCount);
            // print('</pre>');

          // print_r($idTypeCount);
          //{[idType] => 2
          // [soLuong] => 2
          // [arrIdRoom] => 11,12}
          // print('<p> arrIdRoom:'.getType($idTypeCount[0]['arrIdRoom']).'</p>');

          // get array id room
          // $arrIdRoom = explode(",",$idTypeCount[0]['arrIdRoom']);
          // print_r($arrIdRoom);
          require_once('Model/Hotel/HotelViewModel.php');
          require_once('Model/Room/RoomViewModel.php'); 
          require_once('Model/TypeRoom/TypeRoomViewModel.php'); 

          $hotel = new HOTEL_MODEL();
          $hotelDetail = $hotel->GetDetailHotel($idHotel);
          // print_r($hotelDetail);
          $room = new ROOM_MODEL();
          $type = new TYPEROOM_MODEL();
          $sizeOfType = count($idTypeCount);
          // gia tri chuyen sang view
          $startDate = date('m/d/Y',$startDateTime);
          $endDate = date('m/d/Y',$endDateTime);
          $timeADay=60*60*24;
          $abc = $startDate.' - '.$endDate; 
          print('abc: '.$abc);
          $date = explode(' - ',$abc);
          print('---1: '.$date[0]);
          print('---2:'.$date[1]);

          
          require_once("View/user/booking3.php");
        }
        break;//endstep3

        case 'step4':
            $startDateTime = $_POST['start_date'];
            $endDateTime = $_POST['end_date'];

            $idRoom = $_POST['id_room'];
            session_start();
            $idUser=$_SESSION['user'];

            print('startDateTime; '.$startDateTime);
            print('endDateTime; '.$endDateTime);
            print('idRoom; '.$idRoom);


            require_once("View/user/booking4.php");
        break;
        }
      }
    }

?>