<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
        include __DIR__."/../common_component/head.php";
    ?>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <?php
                include __DIR__."/../common_component/menu.php";
            ?>
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <?php
                include __DIR__."/../common_component/header.php";
            ?>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <strong>訂單資訊</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">業務姓名</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type = "text" id = "name" class="form-control" value = "">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">業務電話</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type = "text" id = "phone" class="form-control" value = "">
                            </div>
                        </div>
                        <button class="btn btn-success btn-sm" id = "action_button">完成</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <?php
            include __DIR__."/../common_component/footer.php";
        ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <?php
        include __DIR__."/../common_component/buttom_script.php";
    ?>
</body>
<script>
    $("#action_button").click(function (){
        $.ajax({
            url:  $(location).attr('origin') +  "/seller/add",
            type: "post",
            data: JSON.stringify({"name" : $("#name").val(),"phone" : $("#phone").val()}),
            headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
            dataType: "json",
            contentType: "application/json;charset=utf-8",
            success: function(data){
                alert("新增成功");
                window.location.replace($(location).attr("origin")+"/seller/list");
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("編輯失敗，請重新整理網頁後在進行編輯！");
            }
        });
    });
</script>
</html>
