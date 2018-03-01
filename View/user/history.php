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
			
		</div>
		<div class="row table_his">
			<table class="table ">
				<tr class="" style="text-align: center;">
					<!-- <td>id History</td>
					<td>id booking</td> -->
					<td>Khách sạn</td>
					<td>Địa Chỉ</td>
					<td>Phòng</td>	
					<td>Giờ Vào</td>
					<td>Giờ ra</td>
					<td>Tổng Tiền</td>
					<td>Ngày Đặt</td>
					<td>Action</td>
				</tr>

			
        	 <?php 
        	 	foreach ($historybooking as $key => $value) {
        	 		$inDate =  date('m/d/Y',$value->inDate);
        	 		$outDate=   date('m/d/Y',$value->outDate);
        	 		$dateOfBooking =  date('m/d/Y',$value->dateOfBooking);
    	 		?>
				<tr class='' style="text-align: center;">
						<!-- 
						<td><?php echo $value->idhistory; ?></td>
						<td><?php echo $value->idBooking; ?></td> -->

					<td><?php echo $value->name;?></td>
					<td><?php echo $value->address;?></td>
					<td><?php echo $value->roomName;?></td>
					<td><?php echo $inDate;?></td>
					<td><?php echo $outDate;?></td>
					<td><?php echo $value->price;?></td>

					<td><?php echo $dateOfBooking;?></td>
					<td >
						<a href="?controller=viewaccount&action=history&id=<?php echo $value->idhistory; ?>" class="btn btn-primary">Chi Tiết</a>
						<?php 
							$time= time();
							$soNgayCachNgayChonPhong = ($value->inDate - $time )/(24*60*60);
							// print($soNgayCachNgayChonPhong);
							$soNgayKhongDuocHuyPhong = 2;
							if($soNgayCachNgayChonPhong <= $soNgayKhongDuocHuyPhong){
								?>

								<button  class=" btnhuy btn btn-primary" data-id="<?php echo $value->idhistory; ?>" disabled>Hủy</button>
								<?php
							}else{

						?>


						<a href="#" class=" btnhuy btn btn-primary" data-id="<?php echo $value->idhistory; ?>">Hủy</a>

						<?php
							}

						?>
					</td>

					
				</tr>
				<?php
        	 	}

        	 ?>
           </table>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$(".btnhuy").click(function(){
		var this1 = $(this);
		console.log("this1_1: ",$(this1))
		var idHotel = $(this).data('id');//dong 28
		console.log("id: ",idHotel);

		$.ajax({
			url:'?controller=viewbooking&action=delhistory',
			type: 'POST',
			dataType:'json',
			data:{id:idHotel},
		error: function (xhr, status) {
			alert(status);

		},
		success: function(myData){
			console.log(myData);
            
				if(myData.check){
         			 $(this1).parent().parent().remove();
         			 alert("Hủy đặt phòng thành công");

				}else{
					alert("Huy dat phong that bai");
				}
			}
		});
	});

</script>

<?php include('footer_temp.php'); ?>