<?php 
  class ADMIN_CONTROLLER
  {
  	    private $model;
		public function __construct() {
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


            require ('View/Index.php');
			// $action = isset($_GET['action'])?$_GET['action']:'';
			// switch($action) {

			// 	// case 'viewloaimathang':
			// 	// 	$loaimathangid = isset($_GET['id'])?$_GET['id']:'';
			// 	// 	echo($loaimathangid);
			// 	// 	if (empty($loaimathangid)) {
			// 	// 		die('ID does not exist');
			// 	// 	}
			// 	// 	$loaimathang = $this->model->viewloaimathang($loaimathangid);
			// 	// 	require 'View/ViewLoaiMatHang.php';
			// 	// 	break;
			// 	// case 'insertloaihanghoa':
			// 	//      $actionPost = isset($_Post['action'])?$_Post['action']:'';
                    
			// 	//      if (empty($actionPost))
			// 	//      {
			// 	//      	// $loaimathang_object = new LOAIMATHANG();
			// 	//      	 require ('View/ViewInsertLMH.php');
			// 	//      	 $Name=$_POST['Name'];
			// 	//          $CreatedOn=$_POST['CreatedOn'];
			// 	//          $UpdatedOn=$_POST['UpdatedOn'];
			// 	//          $loaimathang_object = new LOAIMATHANG();
			// 	//         $loaimathang_object->Name =  $Name;
			// 	// 		$loaimathang_object->CreatedOn =  $CreatedOn;
			// 	// 		$loaimathang_object->UpdatedOn = $UpdatedOn;
            //     //         print_r($loaimathang_object);
			// 	// 		$check=$this->model->insertloaimathang($loaimathang_object);
			// 	//         if ($check) {					
			// 	// 			header("Location: index.php?controller=LoaiMatHang&action=listbook");
			// 	// 		}
            //     //           break;
			// 	//      }
				  
				      	
				     	
			// 	//  case 'delete':
			// 	//       $id_delete = isset($_GET['id'])?$_GET['id']:'';
			// 	//       echo($id_delete);
			// 	// 	    if (empty($id_delete)) {
			// 	// 				die('ID does not exist');
			// 	// 	     }
	               
	        //     //         $result = $this->model->delete($id_delete);
            //     //         echo  $result ;
	        //     //         if ($result) {
	        //     //             header("Location: index.php?controller=LoaiMatHang&action=listbook");
		    //     //             } else {
		    //     //                 echo "ko delete dc";
		    //     //             }
	                
	        //     //     break;   
			// 	case 'timkiem':
				  
			// 	case 'listroom':
			// 	 $result=$this->model->GETALLTYPEROOM();
			// 	 $sumpage= count($result);
			// 	 $numbercurrentpage=2;
			// 	 $numberpage=ceil($sumpage/$numbercurrentpage);
			// 	 $trang = isset($_GET['trang'])?$_GET['trang']:'';
				 
			
			// 		$tong=1;
			// 		$tong=($trang-1)* $numbercurrentpage;
			// 		$result1=$this->model->PagingRoom($tong,$numbercurrentpage);
				
			// 	 require("View/RomeType/Index.php");
			// 	 //$trang=$_GET['trang'];
				 
				
				 
			// 	 //echo $numberpage;
				
				 
				
			// 		break;
				
			// 	default:					
			// 		break;
			// }
		}
  }
 
?>