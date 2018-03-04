<?php
 class TRANGCHU_CONTROLLER{
 	public function run(){
 		require_once('View/user/trangchu.php');
 		// require_once('Model/test.php');


 		$action = isset($_GET['action'])?$_GET['action']:'';
 		// print("action: ".$action);
 		switch ($action) {
 			case 'signin':
 				print("vao den signin");
 				break;
 			
 			case 'signup':

 			default:
 				# code...
 				break;
 		}
 	}
 }
	
?>