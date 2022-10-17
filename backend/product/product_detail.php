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
                        <strong>產品資訊</strong>
                        <button class="btn btn-success btn-sm" id = "edit_button" onclick = "edit()">編輯</button>
                        <button class="btn btn-success btn-sm" onclick="delete_product(<?php echo $product_data -> size ?>)">刪除</button>
                        <input id = "product_id" value = "<?php echo $product_data -> id; ?>" hidden>
                    </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">產品尺寸</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type = "text" id = "size" class="form-control" value = "<?php echo $product_data -> size ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">產品價格</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input type = "text" id = "price" class="form-control" value = "<?php echo $product_data -> price; ?>" disabled>
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
    function edit(){
        $("input").each(function(){
            if (this.id != "product_id"){
                $(this).prop('disabled', false);
            }
        });
        $("#edit_button").attr("onclick", "finish()");
        $("#edit_button").html("完成編輯");
    }
    function finish(){
        try{
            var order_data = JSON.stringify({
                "size" : $("#size").val(),
                "price" : $("#price").val(),
            });
            $.ajax({
                    url:  $(location).attr('origin') +  "/product/edit/" + $("#product_id").val(),
                    type: "post",
                    data: order_data,
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    success: function(data){
                        window.location.href =  $(location).attr('origin') +  "/product/list";
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("編輯失敗，請重新整理網頁後在進行編輯！");
                    }
                });
        }catch(err){
            alert("編輯失敗！");
            location.refresh();
            return;
        }
        $("input").each(function(){
            $(this).prop('disabled', true);
        });
        $("#edit_button").attr("onclick", "edit()");
        $("#edit_button").html("編輯");
    }
    function delete_product(size){
        if(confirm("已存在訂單可能會受到影響，確定要刪除產品名稱" + size + " ?")){
                $.ajax({
                    url:  $(location).attr('origin') +  "/product/delete/" + id,
                    type: "post",
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    success: function(returnData){
                        alert("刪除成功");
                        location.reload(true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("failed!");
                    }
                });
            }
    }
</script>
</html>
