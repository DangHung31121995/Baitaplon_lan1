<?php include("View/user/header_temp.php");?>
<div class="container content">
	<div class="row detail_news">
		<div class="row col-md-12">
			<h3 class="tieude_detail"><?php echo $data->name; ?></h3>
		</div>
		<div class="row col-md-12">
			<p class="content_detail"><?php echo $data->content; ?></p>
		</div>
		<div class="row col-md-12" >
			<a href="?controller=viewnews" class="btn btn-primary" style="margin-left: 40%;
    margin-right: 40px;"> Trở Lại</a>
			<a href="javascript:void(0);" class="btn btn-primary btnnews" data-idcity="<?php echo $data->idCity; ?>">Đặt phòng</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$('.btnnews').click(function(){
		var idCity = $(this).data('idcity');
		console.log('id',idCity);
		var form = document.createElement('form');
	    document.body.appendChild(form);

	    form.method = 'post';
	    form.action = '?controller=viewbooking&action=step1';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'idCity';
        input.value = idCity;
        form.appendChild(input);

	    

	    form.submit();
	});

</script>

<?php include('footer_temp.php'); ?>