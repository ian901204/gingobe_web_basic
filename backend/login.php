<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
        include __DIR__."/common_component/head.php";
    ?>
</head>
<body class="login-bg">
        <div class="alerts"></div>
        <div class="login-logo">
                <a >
                    <img class="align-content" src="images/金勾杯股份有限公司-LOGO.png" alt="" >
                </a>
            </div>
                <div class="login-form">
                        <div class="form-group">
                            <label id = "account_label">管理員帳戶</label>
                            <input id = "account" class="form-control" placeholder="輸入帳號">
                        </div>
                        <div class="form-group">
                            <label id = "password_label">密碼</label>
                            <input id = "password" type="password" class="form-control" placeholder="輸入密碼">
                        </div>
                        <button onclick = "login()" class="btn btn-success btn-flat m-b-30 m-t-30">登入</button>
                </div>
    <script>
        var dataJSON = {};
        function login(){
            dataJSON["account"] = $("#account").val();
            dataJSON["password"] = $("#password").val();
            $.ajax({
                url: $(location).attr('origin') + "/login",
                data: JSON.stringify(dataJSON),
                type: "POST",
                contentType: "application/json;charset=utf-8",
                success: function(returnData){
                    window.localStorage.setItem("token", JSON.parse(JSON.stringify(returnData))["token"]);
                    window.location.href = $(location).attr("origin") + "/order/list";
                },
                error: function(xhr, ajaxOptions, thrownError){
                    var error_message = "";
                    if (xhr.statusCode == "400"){
                        error_message = xhr.responseText;
                    }else{
                        var responseData = $.parseJSON(xhr.responseText);
                        if (responseData["Status"] == "account"){
                            error_message = "查無此帳號!";
                            $("#account").addClass("is-invalid");
                            $("#password").removeClass("is-invalid");
                        }else if(responseData["Status"] == "password"){
                            error_message = "密碼錯誤!";
                            $("#password").addClass("is-invalid");
                            $("#account").removeClass("is-invalid");
                        }
                    }
                    $(".alerts").html("<div id = 'check_error' class='sufee-alert alert with-close alert-secondary alert-dismissible fade show'><span class='badge badge-pill badge-secondary'>錯誤</span>" + error_message +"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        $('link[src="assets/js/main.js"]').attr('href',$(location).attr('origin') + 'assets/js/main.js');
    </script>
</body>
</html>
