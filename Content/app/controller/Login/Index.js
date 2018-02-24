var logginController = function () {
// khai báo 1 phương thức tĩnh có thể gọi trực tiếp
    this.initialize = function () {
        
        registerEvent();
    }
    
    var registerEvent = function () {

        $('#formRole').validate({
            errorClass: 'red',
            ignore: [],
            lang:'en',
            rules: {
                ten: {
                    required:true
                },
                matkhau: {
                    required: true
                }
            }
        });
        $("#btnLogin").off('click').on('click', function (e) {
            if ($('#formRole').valid()){

                e.preventDefault();
                var username = $('#txtUserName').val();
                var password = $('#txtPassWord').val();
                login(username, password);
            }
         
        })

    }
    var login = function (username, password)
    {
        $.ajax({
            type: "POST",
            data: {
                userName: username,
                Password:password
            },
            dataType: 'json',
            url: "/Admin/Login/Authen",
            success: function (res) {
                if (res.success===true)
                {
                    onlineshop.notify("Access granted", "success");
                    window.location.href = "/Admin/Home/Index";
                }
                else
                {
                    onlineshop.notify("Login Failed",'error');
                }

            }

        })
    }


}
