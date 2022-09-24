<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
        include "head.php";
    ?>
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form>
                        <div class="form-group">
                            <label>admin account</label>
                            <input id = "account" type="account" class="form-control" placeholder="account">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id = "password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <button id = "login" type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var dataJSON = {};
        $("#login").click(function(){
            dataJSON["account"] = $("#account").val();
            dataJSON["password"] = $("#password").val();
            $.ajax({
                url: "https://admin.ian-shen.live/login",
                data: JSON.stringify(dataJSON),
                type: "POST",
                dataType: "json",
                contentType: "application/json;charset=utf-8",
                success: function(returnData){
                    alert("Success");
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert("failed!");
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
