<?php include("header_temp.php");  ?>

<div class="container content">
	<?php 
		foreach ($countHotel as $key => $value) {
			$loop = $value->soluong;
			// print_r($value);	
		?>
		<div class="row item_city">
			<div class="row col-md-12 namecity rounded">
				<h2 class="namecity_1"><?php echo $value->name; ?></h2>
			</div>
			<div class="row col-md-12">
				
			<?php
				$hotels = $this->model->getHotelWithCity($value->idCity);
				// print_r($hotels);
				foreach ($hotels as $key => $value) {
					?>
					
						<div class="col-md-4 item_hotel">
							<img class="img_hotel rounded" src="<?php echo $value->image; ?>" alt="Smiley face" height="120" width="120">
							<div class="thongtinhotel">
								<p class="name_hotel"><?php echo $value->name; ?></p>
								<p class="address_hotel"><?php echo $value->address; ?></p>
							</div>
						</div> <!-- end div item_hotel -->
			<?php

				}

				?>
				</div>
		</div>  <!-- end div item_city -->
		
		<?php
		}

	?> 
	

</div>

<?php include('footer_temp.php'); ?>