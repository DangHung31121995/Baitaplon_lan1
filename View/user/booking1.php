<?php include("View/user/header_temp.php");?>
<div class="fullcontainer content">
	<div class="container background-booking">

		<img src="View/user/images/curtiss-hotel.jpg" class="img-responsive" style="width:100%;height:300px; margin-bottom: 30px;">
	</div> 

	<div class="container">
		<div class=" row divbookroom">
			<div class=".col-md-6 linenumber">
				<span class="num active span_step1_num" >1</span>
				<span class="text active span_step1_text" >thông tin đặt phòng</span>
				<span class="num span_step2_num">2</span>
				<span class="text span_step2_text">chọn phòng</span>
				<span class="num">3</span>
				<span class="text">Xác Nhận</span>
				<span class="num">4</span>
			</div>
		</div>
		<div class="row form-step1">
			<div class="col-md-12">
				<form class="" action="?controller=viewbooking&action=step2" method="post">

					<div class="form-row ">
						<div class=" col-md-6">
							<label for="select_city">Thành Phố</label>
							<select class="form-control city" id ="select_city" name="select_city">

								<?php
								require_once("connect.php");

								$sql = "select * from city";
								$query = mysqli_query($conn,$sql);

								$num = mysqli_num_rows($query);


								while($row = mysqli_fetch_array($query)){

									?>
									<option value="<?php echo $row['id'] ?>" > <?php echo $row['name']?> </option>
									<?php
								}


								?>
							</select>  
						</div>
						<div class=" col-md-6">
							<label for="select_hotel">Khách Sạn</label>
							<select class="form-control khachsan " name="select_hotel" id ="id_select_hotel">
								<option   value="-1">-------------</option>
							</select>
						</div>
					</div>
					<div class="form-row" style="margin-top: 15px">
						<div class="col-md-6">
							<label for="select_date">Ngày</label>
							<input type="text" class="form-control" name="daterange" id="select_date" />
						</div>
						<div class="col-md-6">
							<label for="totalDay"> Số Đêm</label>

							<input type="text" class="form-control" name="totalDay" id ="totalDay" />
						</div>

					</div>
					<div class="form-row">
						<div class="col-md-12">
							<input type="submit" style="margin-left: 47%; margin-top: 23px;" name ="action" value="step2" class="btn btn-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include('View/user/footer_temp.php') ?>