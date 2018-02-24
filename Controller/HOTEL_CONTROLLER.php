<?php 
  class HOTEL_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/Hotel/HotelViewModel.php');	
				
			$this->model = new HOTEL_MODEL();
			
		}

		public function run(){
           
			$action = isset($_GET['action'])?$_GET['action']:'';
			switch($action) 
			{
				case 'insert':
				$actionPost = isset($_POST['action'])?$_POST['action']:'';
			     if (empty($actionPost))
			      {
					 
					 require_once("View/Hotel/insert.php");
					 break;
				  }
				 // echo $actionPost;
				  $name = $_POST['name'];
				  $idCity = $_POST['idCity'];
				  $address = $_POST['address'];
				  $id = 'null';
				  //$id,$username,$password,$fullname,$email,$status
				  $t=array();
				  $hotel = new data_entity($t);
				  //$new_typerom->id=$id;
				  $hotel->name=$name;
				  $hotel->idCity=$idCity;
                  $hotel->address=$address;
				  //$new_user->Password=$password;
				 // var_dump($new_typerom);
			     $result=  $this->model->insert($hotel);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=HOTEL&action=listhotel");
				   }
				  break;
				  case 'update':
				  $action_POST = isset($_POST['action'])?$_POST['action']:'';
				 if(empty($action_POST) )
				 {
					   $action_id=isset($_GET['id'])? $_GET['id'] : '';
					   if($action_id !=null)
					   {
						  $hotel= $this->model->GetDetailHotel($action_id);
						  //echo ( $type_rom->typeDescription);
						  //var_dump($type_rom);
								require_once('View/Hotel/update.php');
					   }
					   else
					   {
								 echo 'ID NULL';
					   }
				 
						 
				 }
				 else
				 {
                    $name = $_POST['name'];
                    $idCity = $_POST['idCity'];
                    $address = $_POST['address'];
                    $id =  $_POST['id'];
                    //$id,$username,$password,$fullname,$email,$status
                    $t=array();
					$hotel = new data_entity($t);
                    //$new_typerom->id=$id;
                    $hotel->name=$name;
                    $hotel->idCity=$idCity;
                    $hotel->address=$address;
                    $hotel->id=$id;
						   //die($name. '-' . $idCity . '-'.$address. '-' . $id);
  
						//  $roomtype = new LOAIPHONG();
					    //   $roomtype->id=$id;
						//   $roomtype->typeName=$typeName;
						//   $roomtype->pricePerDay=$pricePerDay;
						//   $roomtype->typeDescription=$typeDescription;
						  $result= $this->model->update($hotel);
						  if ($result)  
						  {					
						  header("Location: index.php?controller=HOTEL&action=listhotel");
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
						$result=$this->model->delete_hotel($action_id);
						if ($result)
						{					
							header("Location: index.php?controller=HOTEL&action=listhotel");
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
                 require("View/Hotel/Index.php");
				 break;
				case 'listhotel':
				 $result=$this->model->GETALLHOTEL();
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
					$result1=$this->model->PagingHotel($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/Hotel/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>