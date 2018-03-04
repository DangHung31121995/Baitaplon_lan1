<div class ="container footer">
		<div class="row" style="    margin-top: 50px;">
			<div class="col-md-5">
				<a href="?controller=viewhotel"><img src="View/user/images/mt-map.png" class="img-responsive" alt=""></a>
			</div>
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-4">
						<a class="typehotel" href="?controller=viewhotel&action=hanoi"  >CURTISS HÀ NỘI </a>
					</div>
					<div class="col-md-4">
						<a class="typehotel" href="?controller=viewhotel&action=danang"  >CURTISS ĐÀ NẴNG </a>
					</div>
					<div class="col-md-4">
						<a class="typehotel" href="?controller=viewhotel&action=saigon">CURTISS SÀI GÒN </a>
					</div>
				</div>

				<div class="row thongtinlienhe">
					<p style="font-weight: bold;"> Thông Tin Liên Hệ </p>
					<table class ="">
						<tr>
							<td>Địa Chỉ: </td>
							<td>&emsp;Đường Nghiêm Xuân Yêm - Đại Kim - Hoàng Mai - Hà Nội</td>
						</tr>
						<tr>
							<td>Số Điện Thoại: </td>
							<td>&emsp;(84-24) 38 58 73 46</td>
						</tr>
						<tr>
							<td>Fax:</td>
							<td>&emsp;(84-24) 35 63 67 75 </td>
						</tr>
						<tr>
							<td>Email: </td>
							<td>&emsp;support@curtisshotel.com</td>
						</tr>
					</table>

				</div>
			</div>

		</div>
	</div>


</body>

<script>

	$(document).ready(function(){
	

		if($('select[name=select_city]').val() =='1'){


			$.post("View/user/data.php",{id:1},function(data){
			// console.log(data);
			$('.khachsan').html(data);
		})
		};
		// alert($('select[name=select_city]').val())
		$(".select_city").change(function(){

			var id= $("#select_city").val();
			// console.log(jQuery.type(id));
			$.post("View/user/data.php",{id:id},function(data){
			// console.log(data);
			$('.khachsan').html(data);
			})
		});


	//dang nhap


	$('#signin').click(function(){
      	
		var username = $("#user").val(); //lấy giá trị input tài khoản
        var password = $("#password").val(); //lấy giá trị input mật khẩu
        // console.log('uer: ',username);

        if(username == ''){
            alert('Vui lòng nhập tài khoản');
            return false;
        }
        if(password == ''){
            alert('Vui lòng nhập mật khẩu');
            return false;
        }
          //lay tat ca du lieu trong form login

  
        $.ajax({
	        type : 'POST', 
	        // url  : 'View/user/login.php', //gửi dữ liệu sang trang dieu huong này
	        url: '?controller=viewaccount&action=signin',
	        dataType : 'json',
	        data : {
	        	user:username,
	        	password:password
	        },

	        error: function (xhr, status) {
            	alert(status);
          	},
	        success :  function(myData)
	        {          
  				console.log(myData);
  				// console.log(myData.check);
                if(myData.check == false)
                {
                    alert(myData.mess);
                }else {
					

                	

                	var html =
                	
					'<div class="accountuser" id="tttk" style="float: right;margin-top: 30px;">'+
						'<p style="text-align: center;">Hi <strong>';
					html= html+ String(myData.user);
					html = html +'</strong></p>'+
						'<a href="?controller=viewaccount&action=tttk">My Account</a>'+
						' | '
						+'<a href="?controller=viewaccount&action=signout">Sign Out</a>';
					if(myData.isAdmin==1){
						html = html +'<p style="margin-top:15px;"><a href="?controller=admin&action=index.php">Truy Cập Quản Trị</a></p>';
					}
				
					html = html +'</div>';
                 
                   $('#div_form_signin').html(html);

                }
            }
	        });
	        return false;
	});




});
	

	// xu ly dateragnpicker
	$(function() {
		var startDate1 = moment().startOf('days');	
	    // console.log(startDate1);
	    var endDate1 = moment().add(2,'days');
	    // console.log(typeof endDate1);
	    // console.log(endDate1);
	    var days = moment().subtract(endDate1, startDate1);
	    var oneday =60*60*24*1000;

	    days=(Date.parse(endDate1)-Date.parse(startDate1))/oneday;
	    days=Math.floor(days);
	    $('#totalDay').val(days);
	   // console.log(days/oneday);
	   $('input[name="daterange"]').daterangepicker({
	   	startDate: startDate1 , endDate: endDate1
	   });
	   $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
	   		// console.log(Date.parse(picker.startDate));
			// console.log(Date.parse(picker.endDate));
			days=(Date.parse(picker.endDate)-Date.parse(picker.startDate))/oneday;
			days=Math.floor(days);
			console.log(days);
			$('#totalDay').val(days);
		});
	});
</script>

</html>