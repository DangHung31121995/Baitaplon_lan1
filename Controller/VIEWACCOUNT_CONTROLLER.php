<?php 
require_once('Model/signup_model.php');
class VIEWACCOUNT_CONTROLLER{
	var $model;
    public function __construct(){
      $this->model=new signup_model();
    }

	public function run(){
		$action = isset($_GET['action'])?$_GET['action']:'';
		switch ($action) {
			case 'signup':
				$action_POST = isset($_POST['action'])?$_POST['action']:'';
		        if (empty($action_POST)) {
		          require_once("View/user/signup.php");
		          break;
		        }
				require_once('connect.php');
				require_once('Model/data_entity.php');
				$t=array();
				$insert=new data_entity($t);
				$mySQL='select * from user';
				$result=mysqli_query($conn,$mySQL);
				$data=mysqli_fetch_fields($result);
				// print "<pre>";
				// print_r($data);
				// print "</pre>";
		        foreach($data as $key=>$value1) // trỏ đến stdClass Object
		        {
		        	foreach($value1 as $key=>$value2)  // $value2 là tên cột trong database
		        	{
		        		// print("<p>");
	        			// print("value2: ");
	        			// print($value2);
	        			// print("\n POST_$value2 : ");
	        			// print($_POST[$value2]);
	        			// print("</p>");

		        		if($value2 !='id' && $value2 != 'isAdmin')
		        		{
		        			
			              	if($_POST[$value2]=='')
			              	{

			                	echo "<script>alert('Bạn chưa nhập đủ thông tin');";
			           //      	print("value2: ");
	        					// print($value2);
			                	echo "history.back(-1);</script>";
			                	exit;
			              	}
		        			$insert->$value2=$_POST[$value2];
		        		}
		        		break;
		        	}
		        }
		        $result=$this->model->check($insert);
		        $insert->id='null';
		        $insert->isAdmin=0;
		        $result=$this->model->insert($insert);
		        if($result)
		        {
		        	// print("account_controller: sigup : result : ".$result);
		        	// print('dang ky thanh cong');
		        	$_SESSION['user']=$insert->username;
		        	echo "<script>alert('Đăng ký thành công');";
		         	echo "window.location.href='?controller=trangchu';</script>";
		        }else{
		        	// print("account_controller: sigup : result : ".$result);
		        	
		        	// print('dang ky khong thanh cong');
		        	echo "<script>alert('Error: Đăng ký không thành công' );</script>";
		        }
				break;
			case 'signin':

			if(!empty($_POST['user']))
			{
				$username = trim($_POST['user']);
				$password = trim($_POST['password']);
   				 //neu dang nhap dung

				if($username == 'a' && $password == 'b')
				{
					$array = array(
						'check'=>true,
						'user'=>$username,
						'mess'=>'ok'
					);
					
					print json_encode($array);

				}else{
					$array = array(
						'check'=>false,
						'mess'=>'sai user hoac password'
					);
					print json_encode($array);
				}
			}
				break;
			default:
				# code...
				break;
		}

 	}
}

?>