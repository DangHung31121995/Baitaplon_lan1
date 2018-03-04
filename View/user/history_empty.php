<?php include("View/user/header_temp.php"); ?>
<div class="container content">
	<div class="row content_tttk">
		<div class="col-md-4 menu" " >
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=tttk" class="btn  btn-large btn-block btn-primary btnaccount">Thông Tin Tài Khoản</a>
		      </div>
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=changepass" class="btn  btn-large btn-block btn-primary    btnaccount">Đổi Mật Khẩu</a>
		      </div>
		      <div class="row col-md-12">
					<a href="?controller=viewaccount&action=history" class="btn  btn-large btn-block btn-primary  btn-secondary btnaccount" >Lịch Sử Đặt Phòng</a>
		      </div>
		</div>
		<div class="col-md-8 noidung">
			<h1 class="title_tttk" style="margin-bottom: 60px;">
                 Lịch Sử Đặt Phòng
        	 </h1>
			
			<p>Bạn Chưa Đặt Phòng Lần Nào</p>
		</div>
	</div>
</div>


<?php include('footer_temp.php'); ?>