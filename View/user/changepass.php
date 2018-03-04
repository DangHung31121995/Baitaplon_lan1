<?php include("View/user/header_temp.php"); ?>
<div class="container content">
	<div class="row content_tttk">
		<div class="col-md-4 menu" " >
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=tttk" class="btn  btn-large btn-block btn-primary btnaccount">Thông Tin Tài Khoản</a>
		      </div>
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=changepass" class="btn  btn-large btn-block btn-primary  btn-secondary  btnaccount">Đổi Mật Khẩu</a>
		      </div>
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=history" class="btn  btn-large btn-block btn-primary btnaccount">Lịch Sử Đặt Phòng</a>
		      </div>
		</div>
		<div class="col-md-8 noidung">
			<h1 class="title_tttk" style="margin-bottom: 60px;">
                 Đổi Mật Khẩu
        	 </h1>
             <form class="form-row" action="?controller=viewaccount&action=changepass" method="post" style="margin-left: 20%;">
				<div class="form-group col-md-6">
					<label for="username">Password Mới<input class="form-control i1" type="password" id="password" name="password_new" value=""></label>
				</div>
				<div class="form-group col-md-6">
					<label for="email">Xác Nhận Password <input class="form-control i1" type="password" id="password" name="password_new_2" value=""></label>
				</div>
				<input hidden class="form-control i1" type="password" id="username" name="username" value=""></label>
				<div  style="margin-left:25%">
					<input class="btn btn-primary" type="submit" name="action_pass" value="Xác Nhận">
					<a href="?controller=viewaccount&action=tttk" class="btn btn-primary a2">Hủy</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include('footer_temp.php'); ?>