<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
        include __DIR__."/head.php";
    ?>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <?php
                include __DIR__."/menu.php";
            ?>
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <?php
                include __DIR__."/header.php";
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
                    <button class="btn btn-success btn-sm" onclick="edit()" id = "action_button">編輯</button>
                    <button class="btn btn-danger btn-sm" onclick="delete_seller()" id = "action_button">刪除</button>
                        <div class="form-group">
                            <label class=" form-control-label">業務編號</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input id = "seller_id" class="form-control" value = "<?php echo $seller_data -> id ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">業務姓名</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type = "text" id = "name" class="form-control" value = "<?php echo $seller_data -> name ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">業務電話</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type = "text" id = "phone" class="form-control" value = "<?php echo $seller_data -> phone; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <?php
            include "footer.php";
        ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <?php
        include "buttom_script.php";
    ?>
</body>
<script>
    function delete_seller(){
        $.ajax({
            url:  $(location).attr('origin') +  "/seller/delete/" + $("#seller_id").val(),
            type: "post",
            headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
            dataType: "json",
            contentType: "application/json;charset=utf-8",
            success: function(data){
                alert("刪除成功！");
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("編輯失敗，請重新整理網頁後在進行編輯！");
            }
        });
    }
    function edit(){
        $("#name").prop('disabled', false);
        $("#phone").prop('disabled', false);
        $("#action_button").html("完成");
        $("#action_button").attr("onclick","edit_finish()");
    }
    function edit_finish(){
        try{
            $.ajax({
                    url:  $(location).attr('origin') +  "/seller/edit/" + $("#seller_id").val(),
                    type: "post",
                    data: JSON.stringify({ "name": $("#name").val(), "phone": $("#phone").val() }),
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("編輯失敗，請重新整理網頁後在進行編輯！");
                    }
                });
        }catch(err){
            alert("編輯失敗！");
            location.refresh();
            return;
        }
        $("#name").prop('disabled', true);
        $("#phone").prop('disabled', true);
        $("#action_button").html("編輯");
        $("#action_button").attr("onclick","edit()");
    }
</script>
</html>
