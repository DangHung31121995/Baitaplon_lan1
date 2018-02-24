<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
   <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="asset/jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="View/user/css/account.css" >

    <title>SIGN UP</title>
  </head>
  <body>
    <div class="container">
     <div class="row">
         <div class="col-md-12 hit-the-floor">Thông tin đăng ký</div>
     </div>
  </body>
  <form class="" action="" method="post">
      <label for="User">Tên Đăng Nhập <input class="form-control i1" type="text" id="username" name="username" value=""></label>
      <label for="Password">Mật Khẩu <input class="form-control i1" type="password" id="password" name="password" value=""></label>
      <label for="HoTen">Họ Và Tên <input class="form-control i1" type="text" id="name" name="name" value=""></label>
      <br>
      <label for="GioiTinh">Giới Tính<br>
        <div style="margin-left:100px">
          <input type="radio" name="sex" id="sex" value="Nam">Nam
          <input type="radio" name="sex" id="sex" value="Nữ" style="margin-left:50px">Nữ
        </div>
      </label>
      <br>
      <label for="DiaChi">Địa Chỉ<input class="form-control i1" type="text" id="address" name="address" value=""></label>
      <label for="SoCMT">Số Chứng Minh Thư <input class="form-control i1" type="text" id="cmtnd" name="cmtnd" value=""></label>
      <label for="Email">Email <input class="form-control i1" type="email" id="email" name="email" value=""></label>
      <label for="SoDT">Số Điện Thoại <input class="form-control i1" type="text" id="phoneNumber" name="phoneNumber" value=""></label>
      <div class="Up" style="margin-left:40%">
        <input class="btn btn-primary" type="submit" name="action" value="Đăng Ký">
        <a href="?controller=trangchu" class="btn btn-primary a2">Hủy</a>
      </div>
  </form>
</html>
