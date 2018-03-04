<?php 
     require  '../connection.php'; 
   session_start();
    
   
    $connection->query('USE roombooking');
   
     $error= array();
      if($_SERVER['REQUEST_METHOD']=="POST")
      {
         $data=
         [
           'username'=> $_POST['user'],

           'password'=> $_POST['pass']
         ];

         if($data['username']=='')
         {
           $error['username']='Username không được để trống';
         }
         if($data['password']=='')
         {
           $error['password']='password không được để trống';
         }
      if(empty($error))
      {
        
        $mySQL = "SELECT * FROM user WHERE username='".$data['username']."' and password='".$data['password']."' ";
               $is_check= mysqli_query($connection,$mySQL);
               if($is_check !=null)
               {
                 $mang=array();
                 $mang=mysqli_fetch_array($is_check);
                 //print_r($mang);
                $_SESSION['admin_name']= $mang['username'];
                  $_SESSION['id']=$mang['id'];
             
                  echo "<script>alert('Thanh cong');
                  window.location.href='/QuanLyKhachSan/Index.php'</script>";
                  //header("location: Index.php ");
               }
      }
         
       
      }


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../Content/bootstrap/css/bootstrap.min.css"> 

    <link rel="stylesheet" href="../Content/jqueryPlugin/notifyjs/dist/styles/metro/notify-metro.css">
    <!-- Font Awesome -->
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../Content/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../Content/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0)"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input name="user"  type="text" id="txtUserName" class="form-control" placeholder="username">
            <?php   if(isset($error['username'])): ?>
               <p class="text-danger"><?php echo $error['username'];  ?></p>
            
            
            <?php 
            endif
            ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="pass" type="password" class="form-control" placeholder="password">
            <?php   if(isset($error['password'])): ?>
               <p class="text-danger"><?php echo $error['password'];  ?></p>
            
            
            <?php 
            endif
            ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" id="btnLogin" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../Content/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../Content/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../Content/plugins/iCheck/icheck.min.js"></script>
    <script src="../Content/jqueryPlugin/notifyjs/dist/notify.js"></script>
    <script src="../Content/jqueryPlugin/notifyjs/dist/styles/metro/notify-metro.js"></script>
    <script src="../Content/app/share/onlineshop.js"></script>
    <script src="../Content/app/controller/Login/Index.js"></script>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
