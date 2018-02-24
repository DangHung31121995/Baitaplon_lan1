<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Trang Chủ</title>	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script type="text/javascript" src="asset/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="asset/bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="asset/date/moment.min.js"></script>
	<script type="text/javascript" src="asset/date/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="asset/date/daterangepicker.css">


	<script src="ajax.js" type="text/javascript"></script>
	<link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="views/style.css" />



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="container">
			<div class="row heading">
				<div class="col-md-5">
					<img  src="views/images/logohotel1.png" class="img-responsive" alt="Cinque Terre" style="width: 70%;height: 70%;">
				</div>
				<form class="form-row col-md-7 form-login">
					<div class="row">
						<div class="form-group col-md-5">
							<input type="input" class="form-control" id="user" placeholder="User" >
						</div>
						<div class="form-group col-md-5	">
							<input type="password" class="form-control" id="inputPassword2" placeholder="Password">
						</div>
						<div class="form-group col-md-2">
							<button type="submit " class="btn btn-primary ">Sign In</button>
						</div>
					</div>
					<div class="row">
						<div class="form-group signup_forgot">
							<a href="?controller=customer&action=forgot">Forgot your password?</a>
							<span>  or  </span>

							<a href="?controller=customer&action=forgot">Sign Up</a>

						</div>	
					</div>
					
				</form>
			</div>
			
			<nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #e3f2fd;">
				<h2 class="nav navbar-nav text-primary">CURTISSS</h2>

				<div class="collapse navbar-collapse" style="margin-left:350px">
					<ul class="navbar-nav">
						<li class="nav-item ">
							<a class="nav-link" href="#">Trang Chủ </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Đặt Phòng</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Du Lịch</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="#">Khách Sạn</a>
						</li>
						<li class="nav-item">
							<a class="nav-link " href="#">Về Chúng Tôi</a>
						</li>
					</ul>
				</div>
			</nav>


		</div>

		<div class="container">
		
		</div>

		<div class="container">
			<div class =" footer">
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-2">
						<a class="typehotel" href="#"  >CURTISSS LUXURY </a>
					</div>
					<div class="col-md-2">
						<a class="typehotel" href="#"  >CURTISSS GRAND </a>
					</div>
					<div class="col-md-2">
						<a class="typehotel" href="#">CURTISSS HOLIDAY </a>
					</div>

				</div>
			</div>

			<div class="bottom">

			</div>
		</div>
	</div>

</body>
</html>