<?php 
  class NEWS_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/News/NewsViewModel.php');
			$this->model = new NEWS_MODEL();
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
					$news_rom = new data_entity($t);
					 require_once("View/News/insert.php");
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
				

				  $idCity = $_POST['idCity'];
				  $name = $_POST['name'];
				  $content = $_POST['content'];
                  $shortContent	 = $_POST['shortContent'];
                  $date	 = $_POST['date'];
				  $id = 'null';

				  //$id,$username,$password,$fullname,$email,$status
				  $t=array();
				  $news= new data_entity($t);
				  //$new_typerom->id=$id;
				  $news->idCity=$idCity;
				  $news->name=$name;
				  $news->content=$content;
                  $news->shortContent=$shortContent;
                  $news->date=$date;
				  $news->image=$destination;
				  //$new_user->Password=$password;
				  //var_dump($news);
			      $result= $this->model->insert($news);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=NEWS&action=listnews");
				  }
				  break;
				  case 'update':
				  $action_POST = isset($_POST['action'])?$_POST['action']:'';
				 if(empty($action_POST) )
				 {
					   $action_id=isset($_GET['id'])? $_GET['id'] : '';
					   if($action_id !=null)
					   {
						  $news= $this->model->GetDetailNews($action_id);
                        
								require_once('View/News/update.php');
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
                            
						  $idCity = $_POST['idCity'];
                          $name = $_POST['name'];
                          $content = $_POST['content'];
                          $shortContent	 = $_POST['shortContent'];
                          $date	 = $_POST['date'];
                          $id = $_POST['id'];
        
                          //$id,$username,$password,$fullname,$email,$status
                          $t=array();
                          $news= new data_entity($t);
                          //$new_typerom->id=$id;
                          $news->idCity=$idCity;
                          $news->name=$name;
                          $news->content=$content;
                          $news->shortContent=$shortContent;
                          $news->date=date("m-d-Y",strtotime($date));
                          
                          $news->image=$destination;
                          $news->id=$id;
                        
                          $result=  $this->model->update($news);
						  if ($result)  
						  {					
						  header("Location: index.php?controller=NEWS&action=listnews");
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
						$result=$this->model->delete_news($action_id);
						if ($result)
						{					
							header("Location: index.php?controller=NEWS&action=listnews");
						}
	
					}
				case 'timkiem':
				 $val = isset($_POST['text'])?$_POST['text']:'';
				 $result1=$this->model->SEARCH($val);
				 $check='yes';
				
				 require("View/Users/Index.php");
				 break;
				case 'listnews':
				 $result=$this->model->GETALLNEWS();
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
					$result1=$this->model->PagingNews($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/News/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>