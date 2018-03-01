<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
<link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">	
</head>
<body>
	<div class="full-container" style="margin-top: 60px;">
		<table class="table table-bordered">
				<tr class="" style="text-align: center;">
					<td>Khách sạn</td>
					<td>Địa Chỉ</td>
					<td>Phòng</td>	
					<td>Loại Phòng</td>
					<td>Miêu tả</td>
					<td>Số Người</td>
					<td>Tiền Mỗi Đêm</td>
					<td>Giờ Vào</td>
					<td>Giờ ra</td>
					<td>Tổng Tiền</td>
					<td>Ngày Đặt</td>
				
				</tr>

			
        	 <?php 
        	 	foreach ($info as $key => $value) {
        	 		$inDate =  date('m/d/Y',$value->inDate);
        	 		$outDate=   date('m/d/Y',$value->outDate);
        	 		$dateOfBooking =  date('m/d/Y',$value->dateOfBooking);
    	 		?>
				<tr class='' style="text-align: center;">
					

					<td><?php echo $value->name;?></td>
					<td><?php echo $value->address;?></td>
					<td><?php echo $value->roomName;?></td>
					<td><?php echo $value->typeName;?></td>
					<td><?php echo $value->typeDescription; ?></td>
					<td><?php echo $value->totalPeople; ?></td>
					<td><?php echo $value->price; ?></td>
					


					<td><?php echo $inDate;?></td>
					<td><?php echo $outDate;?></td>
					<td><?php echo $value->price;?></td>

					<td><?php echo $dateOfBooking;?></td>
				
				</tr>

				<?php
				}
			?>
				
       </table>
		<div class="row" >
			<div class="col-md-12">
			<a href="?controller=viewaccount&action=history" class=" btnhuy btn btn-primary" style="margin-left: 50%; margin-top: 20px;" >Trở Lại</a>
			</div>
		</div>
	</div>
</body>
</html>