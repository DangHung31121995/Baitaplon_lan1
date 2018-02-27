<?php include("header_temp.php");?>

<div class="container content">
	<form class="form-row" action="?controller=viewaccount&action=forgot" method="post" style="margin-left: 20%;">
		<div class="form-group col-md-3">
			<label for="username">Tên Đăng Nhập <input class="form-control i1" type="text" id="username" name="username" value=""></label>
		</div>
		<div class="form-group col-md-3">
			<label for="email">Email <input class="form-control i1" type="email" id="email" name="email" value=""></label>
		</div>
		<div class="form-group col-md-3">
			<label for="cmtnd">Số Chứng Minh Thư<input class="form-control i1" type="text" id="cmtnd" name="cmtnd" value=""></label>
		</div>
		<div  style="margin-left:25%">
			<input class="btn btn-primary" type="submit" name="action_forgot" value="Lấy Lại Mật Khẩu">
			<a href="?controller=trangchu" class="btn btn-primary a2">Hủy</a>
		</div>
	</form>

</div>

<?php include('footer_temp.php'); ?>