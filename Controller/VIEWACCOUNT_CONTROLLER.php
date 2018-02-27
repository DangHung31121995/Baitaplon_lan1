<?php 
require_once('Model/user_model.php');
class VIEWACCOUNT_CONTROLLER{
	var $model;
    public function __construct(){
      $this->model=new user_model();
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
		        // print_r($insert);
		        $result=$this->model->check($insert); // check dieu kien du hay chua
		       	$user->isAdmin=0;
		        $result=$this->model->insert($insert);
		        if($result)
		        {
		        	// print("account_controller: sigup : result : ".$result);
		        	// print('dang ky thanh cong');
		        	if (session_status() == PHP_SESSION_NONE) {
					    session_start();
					}
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
					$u=array();
					$user=new data_entity($u);
					$user->username=trim($_POST['user']);
					$user->password=trim($_POST['password']);
					if(!$user->username||!$user->password)
					{
						echo "<script> alert('Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu');";
						echo "history.back(-1);</script>";
					exit;
					}
					$result=$this->model->checkSignIn($user);
					
	   				 //neu dang nhap dung

					if($result)
					{
						$array = array(
							'check'=>true,
							'user'=>$user->username,
							'mess'=>'ok'
						);
						if (session_status() == PHP_SESSION_NONE) {
			      	  		session_start();
			    		}
						$_SESSION['user']=$user->username;
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
			case 'signout':
				if (session_status() == PHP_SESSION_NONE) {
			        session_start();
			    }
				unset($_SESSION['user']);
				if(isset($_SESSION['isAdmin'])){
					unset($_SESSION['isAdmin']);
				}
          		header('Location: ?controller=trangchu');
				break;
			case 'myaccount':
				require_once("View/user/myaccount.php");
				# code...
				break;
			case 'forgot':

				$action_POST = isset($_POST['action_forgot'])?$_POST['action_forgot']:'';
		        if (empty($action_POST)) {
		          require_once("View/user/forgot.php");
		          break;
		        }
		        $username=$_POST['username'];
		        $email = $_POST['email'];
		        $cmtnd= $_POST['cmtnd'];
		        // print($username."---".$email."---".$cmtnd);

		        
		        $check =  $this->model->checkForgot($username,$email,$cmtnd);

		        if($check){
		        	if (session_status() == PHP_SESSION_NONE) {
					    session_start();
					}
					$_SESSION['forgot']=$username;
		        	header('Location: ?controller=viewaccount&action=passcreated');
		        }

				break;
			case 'passcreated':
				if (session_status() == PHP_SESSION_NONE) {
					    session_start();
					}
				if(!isset($_SESSION['forgot'])){
					echo "<script>alert('Bạn Không được quyền truy cập thay đổi mật khẩu');</script>";
		        	echo "<script>history.back(-1);</script>";
				}
				$action_POST = isset($_POST['action_passcreated'])?$_POST['action_passcreated']:'';
		        if (empty($action_POST)) {
		          require_once("View/user/passcreated.php");
		          break;
		        }
		        $pass=$_POST['password_new'];
		        $pass_2 = $_POST['password_new_2'];
		        if(strcmp($pass,$pass_2)!=0){
		        	echo "<script>alert('Mật Khẩu Không trùng khớp');</script>";
		        	echo "<script>history.back(-1);</script>";
		        }else{
			        $username=$_SESSION['forgot'];
			        $check =  $this->model->updatePass($username,$pass);
			        // print(gettype($check));
			        if($check){

			        	print("check true");
			        	echo "<script>alert('Cật Nhật Thành Công');";
			        	echo"window.location.href = '?controller=trangchu'</script>";
			        }else{
			        	echo "<script>alert('Cật Nhật Lỗi');</script>";
			        	echo "<script>history.back(-1);</script>";
			        	// print("check false;");
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