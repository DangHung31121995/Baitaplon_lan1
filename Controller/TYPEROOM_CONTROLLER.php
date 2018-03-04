<?php 
  class TYPEROOM_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/TypeRoom/TypeRoomViewModel.php');
			$this->model = new TYPEROOM_MODEL();
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
					$t=array();
					$type_rom = new data_entity($t);
					 require_once("View/TypeRoom/insert.php");
					 break;
				  }
				  $destination='';
				  $fileUpload=$_FILES['image'];
				  if($fileUpload['name']!=null)
				  {
					 $address_current=$fileUpload['tmp_name'];
					 $destination='View/user/images/'.rand().$fileUpload['name'];
					 move_uploaded_file($address_current, $destination);
				  }
				 // echo $destination;

				  $typeName = $_POST['typeName'];
				  $pricePerDay = $_POST['pricePerDay'];
				  $typeDescription = $_POST['typeDescription'];
				  $totalPeople = $_POST['totalPeople'];
				  $id = 'null';

				  //$id,$username,$password,$fullname,$email,$status
				  $t=array();
				  $new_typerom = new data_entity($t);
				  //$new_typerom->id=$id;
				  $new_typerom->pricePerDay=$pricePerDay;
				  $new_typerom->typeName=$typeName;
				  $new_typerom->typeDescription=$typeDescription;
				  $new_typerom->totalPeople=$totalPeople;
				  $new_typerom->image=$destination;
				  //$new_user->Password=$password;
				 // var_dump($new_typerom);
			     $result=  $this->model->insert($new_typerom);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=TYPEROOM&action=listroom");
				   }
				  break;
				  case 'update':
				  $action_POST = isset($_POST['action'])?$_POST['action']:'';
				 if(empty($action_POST) )
				 {
					   $action_id=isset($_GET['id'])? $_GET['id'] : '';
					   if($action_id !=null)
					   {
						  $type_rom= $this->model->GetDetailTypeRoom($action_id);
						  
								require_once('View/TypeRoom/update.php');
					   }
					   else
					   {
								 echo 'ID NULL';
					   }
				 
						 
				 }
				 else
				 {
							
							$destination='';
							$fileUpload=$_FILES['image'];
							if($fileUpload['name']!=null)
							{
							$address_current=$fileUpload['tmp_name'];
							$destination='View/user/images/'.rand().$fileUpload['name'];
							move_uploaded_file($address_current, $destination);
							}
						  $typeName = $_POST['typeName'];
						  $id = $_POST['id'];
						  $pricePerDay = $_POST['pricePerDay'];
                           
						  //typeDescription
						  $typeDescription = $_POST['typeDescription'];
						  $totalPeople = $_POST['totalPeople'];
						  /// die($typeName. '-' . $id . '-'.$pricePerDay. '-' . $typeDescription);
  
						  $t=array();
						  $roomtype = new data_entity($t);
					      $roomtype->id=$id;
						  $roomtype->typeName=$typeName;
						  $roomtype->pricePerDay=$pricePerDay;
						  $roomtype->typeDescription=$typeDescription;
						  $roomtype->totalPeople=$totalPeople;
						  $roomtype->image=$destination;
						  $result= $this->model->update($roomtype);
						  if ($result)  
						  {					
						  header("Location: index.php?controller=TYPEROOM&action=listroom");
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
						$result=$this->model->delete_typeroom($action_id);
						if ($result)
						{					
							header("Location: index.php?controller=TYPEROOM&action=listroom");
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
				 require("View/TypeRoom/Index.php");
				 break;
				case 'listroom':
				 $result=$this->model->GETALLTYPEROOM();
				 $sumpage= count($result);
				 $numbercurrentpage=6;
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
				 require("View/TypeRoom/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>