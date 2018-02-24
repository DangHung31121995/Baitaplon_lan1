<?php include("View/user/header_temp.php");?>

<div class="fullcontainer content">
	<div class="container background-booking">

		<img src="View/user/images/curtiss-hotel.jpg" class="img-responsive" style="width:100%;height:300px; margin-bottom: 30px;">
	</div> 

	<div class="container">
		<div class=" row divbookroom">
			<div class=".col-md-6 linenumber">
				<a href='?controller=viewbooking&action=step1' class='num last span_step1_num last' >1</a>
				<a href='?controller=viewbooking&action=step1' class='text last span_step1_text last' >thông tin đặt phòng</a>
				<span class="num span_step2_num active">2</span>
				<span class="text span_step2_text active">chọn phòng</span>
				<span class="num">3</span>
				<span class="text">Xác Nhận</span>
				<span class="num">4</span>
			</div>
		</div>
		<div class="row  " style="margin-top: 50px;">
			<table class="table" style=" width:70%; margin-left:10%">
				<tr>
					<td width="30%">Thành phố</td>
					<td id='step2_thanhpho' width="70%">
						<?php
							print($id_city);
						?></td>
					
				</tr>
				<tr>
					<td width="30%">Khách sạn</td>
					<td id='step2_tinh' width="70%">A</td>
				</tr>
				<tr>
					<td >Thời gian</td>
					<td >
					
						<?php
						 	print($startDate.' - '.$endDate);
						?>
					</td>
				</tr>
				<tr>
					<td>Số Đêm</td>
					<td><?php echo $totalNight; ?></td>
				</tr>
				
			</table>
		</div>

		<div class="row roomdetail">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th width="40%">Phòng trống</th>
						<th width="15%">Giá một đêm</th>
						<th width="15%">Chi phí mỗi phòng</th>
						<th width="15%">Số Lượng Người</th>
						<th width="15%">Số Lượng Phòng</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($types as $key=>$val) {?>
						
					<tr>
						<td>
							<div class="image_room" style="float: left;">
								<img src="<?php print($val->image); ?>" style="width:80px;height:80px;" alt="">
							</div>
							<div class="text_room" style="margin-left: 100px;">
								<p style="font-weight: bold;"><?php echo $val->typeName; ?></p>
								<p><?php print($val->typeDescription); ?></p>
							</div>
						</td>
						<td>
							<?php echo $val->pricePerDay; ?>
						</td>
						<td>
							<?php echo ($val->pricePerDay * $totalNight); ?>
						</td>
						<td>
							<?php echo $val->totalPeople; ?>
						</td>
						<td>
							so luong x
						</td>
					</tr>


					<?php } ?>
					
				</tbody>
			</table>

			<a class="btn btn-primary" id="btnStep2" href="?controller=viewbooking&action=step3"  style="margin-left: 48%">step3</a>

		</div>
	</div>
</div>

<?php include('footer_temp.php') ?>