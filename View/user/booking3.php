<?php include("View/user/header_temp.php");?>

<div class="fullcontainer content">
	<div class="container background-booking">

		<img src="View/user/images/curtiss-hotel.jpg" class="img-responsive" style="width:100%;height:300px; margin-bottom: 30px;">
	</div> 

	<div class="container">
		<div class=" row divbookroom">
			<div class=".col-md-6 linenumber">
				<a href='?controller=viewbooking&action=step1' class='num last  last' >1</a>
				<a href='?controller=viewbooking&action=step1' class='text last  last' >thông tin đặt phòng</a>
				<a href='javascript:void(0);'  class='backStep2 num last  last'>2</a>
				<a  href='javascript:void(0);' class='backStep2 text last  last'>chọn phòng</a>
				<span class="num  active">3</span>
				<span class="text  active">Xác Nhận</span>
				<span class="num">4</span>
			</div>
		</div>


		<div class="row detailInformation">
			<table class="table col-md-12 " id='table_detail'>
				<thead class="thead-light">
					<tr class="td_step3">
						<th width="10%">Khách Sạn</th>
						<th width="20%">Địa Chỉ</th>
						<th width="10%">Phòng</th>
						<th width="10%">Loại Phòng</th>
						<th width="15%">Ngày Vào</th>
						<th width="15%">Ngày Ra</th>
						<th width="20%">Tổng Tiền</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($idTypeCount as $key => $value) {

						$arrIdRoom = explode(",",$value['arrIdRoom']);
						for($i =0; $i<$value['soLuong']; $i++){
							$roomDetail = $room->GetDetailRoom($arrIdRoom[$i]);
							$roomType = $type->GetDetailTypeRoom($roomDetail->roomType);
							$price =$roomType->pricePerDay*($endDateTime-$startDateTime)/$timeADay;
							// print_r($roomType);
						?>
						
						<tr class="td_step3">
							<td style="display:none;" class="value" data-id-room="<?php echo $roomDetail->id; ?>" data-start-date="<?php echo $startDateTime; ?>"  data-end-date="<?php echo $endDateTime; ?>" data-price="<?php echo $price; ?>">
								
							</td>
							<td>
								<?php echo $hotelDetail->name; ?>
							</td>
							<td >
								<?php echo $hotelDetail->address; ?>
							</td>
							<td>
								<?php
									echo $roomDetail->roomName;
								?>
							</td>
							<td>
								<?php
									echo $roomType->typeName;;
								?>
							</td>
							<td >
								<?php echo $startDate; ?>
							</td>
							<td >
								<?php echo $endDate; ?>
							</td>
							<td >
								<?php echo $price ?>
							</td>
							

						</tr>


						<?php

						}

						# code...
					}

					?>
					<tr>
						<td colspan="100">
						<a class="btn btn-primary" " id="btnXanNhan" href="javascript:void(0);"  style="margin-left: 48%">Xác nhận</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>


	</div>
</div>

<script>
	$('.backStep2').click(function(){

		var form = document.createElement('form');
		    document.body.appendChild(form);
		    form.method = 'post';
		    form.action = '?controller=viewbooking&action=step2';
		   
	        var input1 = document.createElement('input');
	        input1.type = 'hidden';
	        input1.name="select_hotel";
	        input1.value = <?php echo $hotelDetail->id;?>;
	        form.appendChild(input1);

	        var input2 = document.createElement('input');
	        input2.type = 'hidden';
	        input2.name="daterange";
	        input2.value = '<?php $date = $startDate.' - '.$endDate; echo $date; ?>';
	        console.log('abc');
	        console.log(input2.value);
	        form.appendChild(input2);

	        var input3 = document.createElement('input');
	        input3.type = 'hidden';
	        input3.name="select_city";
	        input3.value = <?php echo $hotelDetail->idCity; ?>;
	        form.appendChild(input3);


		form.submit();

	});
	$("#btnXanNhan").click(function(){



		var listIdTypes=$('.value');
		var datas=[];
		var check=false;
		$.each(listIdTypes,function(i,item){
			// console.log('i: ',i);
			// console.log('\nitem: ',item);
			
			datas.push({
				idRoom: $(item).data("id-room"),
				inDate: $(item).data("start-date"),
				outDate: $(item).data("end-date"),
				price: $(item).data("price")
			});
		
		});
	

		var data = JSON.stringify(datas);
		console.log(data);
		var form = document.createElement('form');
		    document.body.appendChild(form);
		    form.method = 'post';
		    form.action = '?controller=viewbooking&action=step4';
		  
	        var input = document.createElement('input');
	        input.type = 'hidden';
	        input.name = 'insert';
	        input.value =data;
	        form.appendChild(input);
		 

		    form.submit();

	});


</script>

<?php include('footer_temp.php'); ?>