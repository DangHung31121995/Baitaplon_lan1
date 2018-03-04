<?php 
  class USER_CONTROLLER
  {
  	    private $model;
		public function __construct() {
			require ('Model/User/UserViewModel.php');
			$this->model = new USER_MODEL();
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
					
					 require_once("View/Users/insert.php");
					 break;
                  }
				  
				  $username=$_POST['username']; 
				  $password=$_POST['password']; 
				  $name=$_POST['name']; 
				  $email=$_POST['email']; 
				  $cmtnd=$_POST['cmtnd']; 
				  $phoneNumber=$_POST['phoneNumber']; 
                  $isAdmin=$_POST['isAdmin']; 
				  $address=$_POST['address']; 
				  
				  $sex=$_POST['sex']; 

				//   //$id,$username,$password,$fullname,$email,$status
				  $t=array();
				  $users= new data_entity($t);
				  //$new_typerom->id=$id;
				  $users->username=$username;
				  $users->password=$password;
				  $users->name=$name;
                  $users->email=$email;
                  $users->cmtnd=$cmtnd;
				  $users->phoneNumber=$phoneNumber;
				  $users->isAdmin=$isAdmin;
				  $users->address=$address;
				  $users->sex=$sex;
				  //$new_user->Password=$password;
				  //var_dump($users);
				  $result=$this->model->insert($users);
				  //die($result);
				  if ($result==true) {					
				 	  header("Location: index.php?controller=USER&action=listuser");
				  }

				  break;
				  case 'update':
				  $action_POST = isset($_POST['action'])?$_POST['action']:'';
				 if(empty($action_POST) )
				 {
					   $action_id=isset($_GET['id'])? $_GET['id'] : '';
					   if($action_id !=null)
					   {
						  $users= $this->model->GetDetailUsers($action_id);
                        
								require_once('View/Users/update.php');
					   }
					   else
					   {
								 echo 'ID NULL';
					   }
				 
						 
				 }
				 else
				 {		
						$username=$_POST['username']; 
						$password=$_POST['password']; 
						$name=$_POST['name']; 
						$email=$_POST['email']; 
						$cmtnd=$_POST['cmtnd']; 
						$phoneNumber=$_POST['phoneNumber']; 
						$isAdmin=$_POST['isAdmin']; 
						$address=$_POST['address']; 
						$id=$_POST['id']; 
						$sex=$_POST['sex']; 
	
					//   //$id,$username,$password,$fullname,$email,$status
						$t=array();
						$users= new data_entity($t);
						//$new_typerom->id=$id;
						$users->username=$username;
						$users->password=$password;
						$users->name=$name;
						$users->email=$email;
						$users->cmtnd=$cmtnd;
						$users->phoneNumber=$phoneNumber;
						$users->isAdmin=$isAdmin;
						$users->address=$address;
					    $users->sex=$sex;
						$users->id=$id;
					
                          $result=  $this->model->update($users);
						  if ($result)  
						  {					
						  header("Location: index.php?controller=USER&action=listuser");
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
						$result=$this->model->delete_user($action_id);
						if ($result)
						{					
							header("Location: index.php?controller=USER&action=listuser");
						}
	
					}
				case 'timkiem':
				 $val = isset($_POST['text'])?$_POST['text']:'';
				 $result1=$this->model->SEARCH($val);
				 $check='yes';
				
				 require("View/Users/Index.php");
				 break;
				case 'listuser':
				 $result=$this->model->GETALLUSER();
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
					$result1=$this->model->PagingUser($tong,$numbercurrentpage);
				 
			
					
				 $check='no';
				 require("View/Users/Index.php");
				 //$trang=$_GET['trang'];
				 
				
				 
				 //echo $numberpage;
				
				 
				
					break;
				
				default:					
					break;
			}
		}
  }
 
?>