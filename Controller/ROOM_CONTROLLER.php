<?php 
  class ROOM_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/Room/roomViewModel.php');	
				
			$this->model = new ROOM_MODEL();
			
		}

		public function run(){
			if (!isset($_SESSION)) {
					    session_start();
			}
			if(empty($_SESSION['isAdmin'])){
				echo "<script>alert('Bạn không đủ quyền truy cập');</script>";
	        	echo "<script>history.back(-1);</script>";
	        	exit;
			}

           
			$action = isset($_GET['action'])?$_GET['action']:'';
			switch($action) 
			{
				case 'insert':
				$actionPost = isset($_POST['action'])?$_POST['action']:'';
			     if (empty($actionPost))
			      {
					 require_once("View/Room/insert.php");
					 break;
				  }
				 // echo $actionPost;
				  $roomName = $_POST['roomName'];
				  $roomType = $_POST['roomType'];
				  $idHotel = $_POST['idHotel'];
				  $id = 'null';
				  //$id,$username,$password,$fullname,$email,$status
				  
				//   $room = new ROOM();
					$t=array();
					$room = new data_entity($t);
				  //$new_typerom->id=$id;
				  $room->roomName=$roomName;
				  $room->roomType=$roomType;
                  $room->idHotel=$idHotel;
				  //$new_user->Password=$password;
				 // var_dump($new_typerom);
			     $result=  $this->model->insert($room);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=room&action=listroom");
				   }
				  break;
				  case 'update':
				  $action_POST = isset($_POST['action'])?$_POST['action']:'';
				 if(empty($action_POST) )
				 {
					   $action_id=isset($_GET['id'])? $_GET['id'] : '';
					   if($action_id !=null)
					   {
						  $room= $this->model->GetDetailRoom($action_id);
						  //echo ( $type_rom->typeDescription);
						  //var_dump($type_rom);
								require_once('View/Room/update.php');
					   }
					   else
					   {
								 echo 'ID NULL';
					   }
				 
						 
				 }
				 else
				 {
                    $roomName = $_POST['roomName'];
					$roomType = $_POST['roomType'];
					$idHotel = $_POST['idHotel'];
					$id = $_POST['id'];
                    //$id,$username,$password,$fullname,$email,$status
					// $room = new ROOM();
					$t=array();
					$room = new data_entity($t);
					//$new_typerom->id=$id;
					$room->roomName=$roomName;
					$room->roomType=$roomType;
					$room->idHotel=$idHotel;
                    $room->id=$id;
						  
						  $result= $this->model->update($room);
						  if ($result)  
						  {					
						  header("Location: index.php?controller=room&action=listroom");
						  }
						  else
						  {
							  die('chet ne');
						  }
				 }
					break;
		       case 'delete':
					$action_id=isset($_GET['id'])? $_GET['id'] : '';
					if($action_id !=null)
					{
						$result=$this->model->delete_room($action_id);
						if ($result)
						{					
							header("Location: index.php?controller=room&action=listroom");
						}
	
					}
				case 'timkiem':
				 $val = isset($_POST['text'])?$_POST['text']:'';
				 $result1=$this->model->SEARCH($val);
				 $check='yes';
				//  $sumpage= count($result);
				//  $numbercurrentpage=2;
				//  $numberpage=ceil($sumpage/$numbercurrentpage);
				//  $trang = isset($_GET['trang'])?$_GET['trang']:'';
				//  if(empty($trang ))
				//  {
				// 	$trang=1; 
				// 	$tong=1;
				// 	$tong=($trang-1)* $numbercurrentpage;
				// 	$result1=$this->model->SearchPagingRoom( $val,$tong,$numbercurrentpage);
				//  }
				//  else
				//  {
                //     $tong=1;
				// 	$tong=($trang-1)* $numbercurrentpage;
				// 	$result1=$this->model->SearchPagingRoom($val,$tong,$numbercurrentpage);
				//  }
				// 
				 //SearchPagingRoom
                 require("View/Room/Index.php");
				 break;
				case 'listroom':
				 $result=$this->model->GETALLROOM();
				 $sumpage= count($result);
				 $numbercurrentpage=2;
				 $numberpage=ceil($sumpage/$numbercurrentpage);
				 $trang = isset($_GET['trang'])?$_GET['trang']:'';
				 if(empty($trang ))
				 {
					$trang=1; 
					
				 }
                    $tong=1;
					$tong=($trang-1)* $numbercurrentpage;
					$result1=$this->model->PagingRoom($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/Room/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>