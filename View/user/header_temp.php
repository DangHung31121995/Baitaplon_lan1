<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title  id="titleName">Trang Chủ</title>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- 
	<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<script src="https://npmcdn.com/bootstrap@4.0.0-alpha.5/dist/js/bootstrap.min.js"></script> -->

	<script type="text/javascript" src="asset/jquery-3.3.1.js"></script>

	<script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="asset/bootstrap/js/bootstrap.js"></script>

	<script type="text/javascript" src="asset/date/moment.min.js"></script>
	<script type="text/javascript" src="asset/date/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="asset/date/daterangepicker.css">


	<link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">	

	<link rel="stylesheet" type="text/css" href="View/user/css/style.css" >
	<link rel="stylesheet" type="text/css" href="View/user/css/booking.css" >
	


<!-- 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>
<body>

<div class="container">
	<div class="row heading">
		<div class="col-md-5">
			<a href="?controller=trangchu"><img  src="View/user/images/logohotel1.png" class="img-responsive" alt="Cinque Terre" style="width: 70%;height: 70%;"></a>
		</div>

		<?php
		session_start();
		
		if(!isset($_SESSION['user'])){?>
		<div class="col-md-7" id="div_form_signin">
			<form class="form-row col-md-12" style="margin-top: 40px;" id="form_signin" method="post" >
				<div class="row">
					<div class="form-group col-md-5">
						<input type="input" class="form-control" name = "user" id="user" placeholder="User" >
					</div>
					<div class="form-group col-md-5	">
						<input type="password" class="form-control" name ="password" id="password" placeholder="Password">
					</div>
					<div class="form-group col-md-2">
						<button type="submit" href="javascript:void(0);" id="signin" name="signin" class="btn btn-primary ">Sign In</button>
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-5"></div>
					<div class=" form-group col-md-7 ">
						<a href="?controller=viewaccount&action=forgot">Forgot your password?</a>
						<span>  or  </span>

						<a href="?controller=viewaccount&action=signup">Sign Up</a>

					</div>	
				</div>
			</form>
		</div>

		<?php
	}else{ ?>
		<div class="col-md-7 " >

			<div class="accountuser" id="myaccount" style="float: right;margin-top: 30px;">
				<p style="text-align: center;">Hi <strong><?php echo $_SESSION['user']?> </strong></p>
				<a href="?controller=viewaccount&action=myaccount">My Account</a>
				|
				<a href="?controller=viewaccount&action=signout">Sign Out</a>

			</div>
			
		</div>
	<?php } ?>
	</div>  <!-- end row heading -->

	
	<div class="row">
		<nav class=" container navbar navbar-expand-lg navbar-light  " style="background-color: #e3f2fd;">
			<a href="?controller=trangchu"><h2 class="nav navbar-nav " style=" text-shadow: 2px 2px #441e1e; color: red;" >Curtiss Hotel</h2></a>

			<div class="collapse navbar-collapse" style="margin-left:350px">
				<ul class="navbar-nav">
					<li class="nav-item ">
						<a class="nav-link" href="?controller=trangchu">Trang Chủ </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?controller=viewbooking&action=step1">Đặt Phòng</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?controller=viewnews">Du Lịch</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="?controller=viewhotel">Khách Sạn</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="?controller=viewaboutus">Về Chúng Tôi</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
</div>

