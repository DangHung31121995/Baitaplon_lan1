<?php include("header_temp.php");?>

<div class="container content">
	<form class="form-row" action="" method="post" style="margin-left: 20%;">
		<div class="form-group col-md-6">
			<label for="username">Password Mới<input class="form-control i1" type="password" id="password" name="password_new" value=""></label>
		</div>
		<div class="form-group col-md-6">
			<label for="email">Xác Nhận Password <input class="form-control i1" type="password" id="password" name="password_new_2" value=""></label>
		</div>
		<input hidden class="form-control i1" type="password" id="username" name="username" value=""></label>
		<div  style="margin-left:25%">
			<input class="btn btn-primary" type="submit" name="action_passcreated" value="Xác Nhận">
			<a href="?controller=trangchu" class="btn btn-primary a2">Hủy</a>
		</div>
	</form>

</div>

<?php include('footer_temp.php'); ?>