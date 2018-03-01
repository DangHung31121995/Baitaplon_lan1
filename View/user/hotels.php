<?php include("header_temp.php");  ?>

<div class="container content">
	<?php 
		foreach ($hotels as $key => $value) {
			$cityname = $city->GetDetailCity($value->idCity)->name;
		?>
		<div class="row item_city">
			<div class="row col-md-12 namecity rounded">
				<h2 class="namecity_1"><?php echo $cityname; ?></h2>
			</div>
			?>
			<?php
				$hotels2 = $this->model->getHotelWithCity($value->idCity);
				foreach ($hotels2 as $k => $val) {
					?>
					<div class="row col-md-12">
						<div class="col-md-4 item_hotel">
							<img class="img_hotel rounded" src="<?php $val->image; ?>" alt="Smiley face" height="120" width="120">
							<div class="thongtinhotel">

								<p class="name_hotel"><?php echo $val->name; ?></p>
								<p class="address_hotel"><?php echo $val->address;?></p>
							</div>
						</div><!--  end div item_hotel -->

					</div>

			<?php

				}


			?>
			
		</div><!--  end div item_city -->
		
		<?php
		}

	?>
	

</div>

<?php include('footer_temp.php'); ?>