<?php include("View/user/header_temp.php");?>
<div class="container content " style=" margin-top: 40px; margin-bottom: 20px ">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="d-block img-fluid" src="View/user/images/slide1.jpg" style="widows: 10px;width:100%; height:400px">
					<!-- <h2 style="color: red;">Curtiss Hotel - Thăng hoa của nghỉ ngơi</h2> -->
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="View/user/images/slide2.jpg" style="width:100%;height:400px">
					<!-- <h2 style="color: red;">Curtiss Hotel - Thăng hoa của nghỉ ngơi</h2> -->
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="View/user/images/slide3.jpg" style="width:100%;height:400px">
					<!-- <h2 style="color: red;">Curtiss Hotel - Thăng hoa của nghỉ ngơi</h2> -->
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>

	<div class="container  booking">
		<div style="    margin-left: 130px;">
			<form class="" action="?controller=viewbooking&action=step2" method="post">
				<div class="form-row ">
					<div class=" col-md-3">
						<label for="select_city">Thành Phố</label>
						<select class="form-control city" id ="select_city" name="select_city">
							<?php
							require_once("connect.php");

							$sql = "select * from city";
							$query = mysqli_query($conn,$sql);

							$num = mysqli_num_rows($query);


							while($row = mysqli_fetch_array($query)){

								?>
								<option  value="<?php echo $row['id'] ?>" > <?php echo $row['name']?> </option>
								<?php
							}


							?>
						</select>  
					</div>
					<div class=" col-md-3">
						<label for="select_hotel">Khách Sạn</label>
						<select class="form-control khachsan " name="select_hotel" id ="id_select_hotel">
							<option   value="-1">-------------</option>
						</select>
					</div>

					<div class="col-md-3">
						<label for="select_date">Ngày</label>
						<input type="text" class="form-control" name="daterange" id="select_date" />
					</div>

					<div class="col-md-3" style="margin-top: 30px;padding-left: 60px;">

						<input type="submit" name ="action" value="Đặt Phòng" class="btn btn-primary">
						
					</div>
				</div>
			</form>
		</div>

	</div>


	</div>
<?php include('footer_temp.php')?>