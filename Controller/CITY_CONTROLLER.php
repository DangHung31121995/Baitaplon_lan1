<?php

  class CITY_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/City/CityViewModel.php');	
				
			$this->model = new CITY_MODEL();
			
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
				// case 'viewloaimathang':
				// 	$loaimathangid = isset($_GET['id'])?$_GET['id']:'';
				// 	echo($loaimathangid);
				// 	if (empty($loaimathangid)) {
				// 		die('ID does not exist');
				// 	}
				// 	$loaimathang = $this->model->viewloaimathang($loaimathangid);
				// 	require 'View/ViewLoaiMatHang.php';
				// 	break;
				// case 'insert':
				//      $actionPost = isset($_Post['action'])?$_Post['action']:'';
                    
				//      if (empty($actionPost))
				//      {
				//      	// $loaimathang_object = new LOAIMATHANG();
				// 		 require("View/RomeType/insert.php");
				     	//  $Name=$_POST['Name'];
				        //  $CreatedOn=$_POST['CreatedOn'];
				        //  $UpdatedOn=$_POST['UpdatedOn'];
				        //  $loaimathang_object = new LOAIMATHANG();
				        // $loaimathang_object->Name =  $Name;
						// $loaimathang_object->CreatedOn =  $CreatedOn;
						// $loaimathang_object->UpdatedOn = $UpdatedOn;
                        // print_r($loaimathang_object);
						// $check=$this->model->insertloaimathang($loaimathang_object);
				        // if ($check) {					
						// 	header("Location: index.php?controller=LoaiMatHang&action=listbook");
						// }
                        
					 
					 
				  
				      	
				     	
				//  case 'delete':
				//       $id_delete = isset($_GET['id'])?$_GET['id']:'';
				//       echo($id_delete);
				// 	    if (empty($id_delete)) {
				// 				die('ID does not exist');
				// 	     }
	               
	            //         $result = $this->model->delete($id_delete);
                //         echo  $result ;
	            //         if ($result) {
	            //             header("Location: index.php?controller=LoaiMatHang&action=listbook");
		        //             } else {
		        //                 echo "ko delete dc";
		        //             }
	                
                //     break;
             case 'update':
                $action_POST = isset($_POST['action'])?$_POST['action']:'';
               if(empty($action_POST) )
               {
                     $action_id=isset($_GET['id'])? $_GET['id'] : '';
                     if($action_id !=null)
                     {
                        $city= $this->model->GetDetailCity($action_id);
                              require_once('View/City/update.php');
                     }
                     else
                     {
                               echo 'ID NULL';
                     }
               
                       
               }
               else
               {
                       $name = $_POST['name'];
                       $id = $_POST['id'];
                       //die($name. '-' . $id);
                       
					   $t=array();
					   $city = new data_entity($t);
                       $city->id=$id;
                       $city->name=$name;
                       $result = $this->model->update($city);
                       if ($result)
                        {					
                        header("Location: index.php?controller=CITY&action=listcity");
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
                    $result=$this->model->delete_city($action_id);
                    if ($result)
                  {					
                    header("Location: index.php?controller=CITY&action=listcity");
                  }

                }
              break;
				case 'insert':
				$actionPost = isset($_POST['action'])?$_POST['action']:'';
			     if (empty($actionPost))
			      {
					  $t=array();
					 $city = new data_entity($t);
					 require_once("View/City/insert.php");
					 break;
				  }
				 // echo $actionPost;
				  $name = $_POST['name'];
				
				  //$id = 'null';
				  //$id,$username,$password,$fullname,$email,$status
				  $city = new data_entity($t);
				  //$new_typerom->id=$id;
				  $city->name=$name;
				
				// var_dump($new_typerom);
			     $result=  $this->model->insert($city);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=CITY&action=listcity");
				   }
				  break;
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
				 require("View/City/Index.php");
				 break;
				case 'listcity':
				 $result=$this->model->GETALLCITY();
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
					$result1=$this->model->PagingCity($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/City/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>