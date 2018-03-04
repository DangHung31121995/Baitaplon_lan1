<?php include("View/user/header_temp.php");?>
<div class="container content">
<div class="row">
<?php
	foreach ($data as $key => $value) {
		# code...
		?>
		
			<div class="col-md-6 div_item_news item_hotel" data-idnews="<?php echo $value->id; 	?>">
				<img class="img_hotel rounded" src="<?php echo $value->image; ?>" alt="Smiley face" height="120" width="120">
				<div class="thongtinhotel">
					<a class="tieude" href="?controller=viewnews&id=<?php echo $value->id; 	?>"><?php echo $value->name; ?></a>	
				
					<p class="shortContent"><?php echo $value->shortContent; ?></p>
					<p class="ngaydang">Ngày Đăng: <?php echo $value->date?></p>
				</div>
		
			</div>
		

	

	<?php
	}


?>
</div>

</div>
<script >
	$('.div_item_news').click(function(){
		var id=$(this).data('idnews');

		window.location.href = "?controller=viewnews&id="+id;
	

	});


</script>


<?php include('footer_temp.php')?>