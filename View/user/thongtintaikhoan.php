<?php include("View/user/header_temp.php"); ?>
<div class="container content">
	<div class="row content_tttk">
		<div class="col-md-4 menu" " >
      <div class="row col-md-12">
			<a href="?controller=viewaccount&action=tttk" class="btn  btn-large btn-block btn-secondary btnaccount">Thông Tin Tài Khoản</a>
      </div>
      <div class="row col-md-12">
			<a href="?controller=viewaccount&action=changepass" class="btn  btn-large btn-block btn-primary btnaccount">Đổi Mật Khẩu</a>
      </div>
      <div class="row col-md-12">
			<a href="?controller=viewaccount&action=history" class="btn  btn-large btn-block btn-primary btnaccount">Lịch Sử Đặt Phòng</a>
      </div>
		</div>
		<div class="col-md-8 noidung ">
			 <h1 class="title_tttk" style="margin-bottom: 60px;">
                 Thông Tin Cá Nhân
         </h1>
         <div class="formzz">
             <form class="form-tttk" action="?controller=viewaccount&action=tttk" method="post" style="margin-left:25px;     display: grid;" onsubmit="return confirm('Bạn muốn cập nhật lại thông tin ?');">
                 <label for="name">Họ Và Tên <input class="form-control i1" type="text" id="name" name="name" value="<?php echo $data->name; ?>"></label>
                 <label for="sex">Giới Tính<br>
                   <div style="margin-left:100px">
                     <?php if($data->sex=='Nam'){?>
                       <input type="radio" name="sex" id="sex" value="Nam" checked>Nam
                       <input type="radio" name="sex" id="sex" value="Nữ" style="margin-left:50px">Nữ
                     <?php }else{ ?>
                       <input type="radio" name="sex" id="sex" value="Nam">Nam
                       <input type="radio" name="sex" id="sex" value="Nữ" style="margin-left:50px" checked>Nữ
                       <?php } ?>
                   </div>
                 </label>
                 <label for="address">Địa Chỉ<input class="form-control i1" type="text" id="address" name="address" value="<?php echo $data->address ?>"></label>
                 <label for="cmtnd">Số Chứng Minh Thư <input disabled class="form-control i1" type="text" id="cmtnd" name="cmtnd" value=<?php echo $data->cmtnd; ?>></label>
                 <label for="email">email <input disabled class="form-control i1" type="email" id="email" name="email" value="<?php echo $data->email; ?>"></label>
                 <label for="phoneNumber">Số Điện Thoại <input disabled class="form-control i1" type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $data->phoneNumber; ?>"></label>
                 <div class="Up" style="margin-left: 40%;margin-top: 25px;">
                   <input class="btn btn-primary" type="submit" name="action" value="Cập nhật">
                 </div>
             </form>
       </div>
		</div>
	</div>
</div>
<?php include('footer_temp.php'); ?>