<?php

  class REVIEWS_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/Reviews/ReviewsViewModel.php');	
				
			$this->model = new REVIEWS_MODEL();
			
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
                    $result=$this->model->delete_review($action_id);
                    if ($result)
                  {					
                    header("Location: index.php?controller=REVIEWS&action=listreview");
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
                 require("View/Reviews/Index.php");
				 break;
				case 'listreview':
				 $result=$this->model->GETALLREVIEWS();
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
					$result1=$this->model->PagingReviews($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/Reviews/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>