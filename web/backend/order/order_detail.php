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
                        <button class="btn btn-success btn-sm" onclick="edit()" id = "edit_button">編輯</button>
                        <button class="btn btn-danger btn-sm" onclick="delete_order()" >刪除</button>
                        <div class="form-group">
                            <label class=" form-control-label">訂單編號</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input id = "order_id" class="form-control" value = "<?php echo $order_data -> id ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">客戶姓名</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input id = "name" class="form-control" value = "<?php echo $order_data -> name ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class=" form-control-label">客戶電話</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input id = "phone" class="form-control" value = "<?php echo $order_data["phone"]; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">客戶市話</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                                <input id = "address" class="form-control" value = "<?php echo $order_data["telephone"] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">產品數量(箱)</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                <input id = "amount" class="form-control" value = "<?php echo $order_data["amount"] ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">業務員</label>
                                <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <select name="select" id="seller_id" class="form-control" disabled>
                                        <option value="-1">請選擇業務員</option>
                                        <?php   
                                            echo ($order_data["seller_id"] == 0)?"<option value=0 selected>無</option>":"<option value=0>無</option>";
                                            echo "";
                                            foreach($seller_data as $data){
                                                if ($data["id"] == $order_data["seller_id"]){
                                                    echo "<option value=".$data["id"]." selected>".$data["name"]."</option>";
                                                }else{
                                                    echo "<option value=".$data["id"].">".$data["name"]."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
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
    <script>
    function edit(){
        $("input").each(function(){
            if (this.id != "order_id"){
                $(this).prop('disabled', false);
            }
        });
        $("#product_size").prop("disabled", false);
        $("#seller_id").prop("disabled", false);
        $("#edit_button").attr("onclick", "finish()");
        $("#edit_button").html("完成編輯");
        console.log($("#order_id").val());
    }
    function finish(){
        try{
            var order_data = JSON.stringify({
                "client_name" : $("#name").val(),
                "client_phone" : $("#phone").val(),
                "order_address" : $("#address").val(),
                "seller_id" : $("#seller_id").val(),
                "product_amount" : $("#amount").val(),
                "product_size" : $("#product_size").val(),
            });
            $.ajax({
                    url:  window.location.origin +  "/order/edit/" + $("#order_id").val(),
                    type: "post",
                    data: order_data,
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    success: function(data){
                        window.location=document.referrer;
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
        $("#product_size").prop("disabled", true);
        $("#seller_id").prop("disabled", true);
        $("#edit_button").attr("onclick", "edit()");
        $("#edit_button").html("編輯");
    }
    function delete_order(){
        alert("function not complete");
    }
    </script>
</body>
</html>
