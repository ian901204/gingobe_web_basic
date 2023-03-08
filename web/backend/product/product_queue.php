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
        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">產品順序調整</strong>
                                <button onclick="go_back()" class = 'btn btn-success'>回上一頁</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>產品尺寸</th>
                                            <th>產品價格</th>
                                            <th>產品編輯</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $flag = 1;
                                            foreach($product_data as $data){
                                                echo "<tr>";
                                                echo "<td>".$data["order_index"]."</td>";
                                                echo "<td> <span class='name'>".$data["size"]."</td>";
                                                echo "<td> <span class='product'>".$data["price"]."</td>";
                                                echo "<td><div class = 'row'><div class = 'col-4'>";
                                                if ($flag != 1){
                                                    echo "<button onclick = \"move_up('".$data["size"]."', ".$data["order_index"].")\" class = 'btn btn-success btn-block'>往上</button>";
                                                }
                                                echo "</div><div class = 'col-4'>";
                                                if ($flag != count($product_data)){
                                                    echo "<button onclick = \"move_down('".$data["size"]."', ".$data["order_index"].")\" class = 'btn btn-danger btn-block'>往下</button>";
                                                }
                                                echo "</div></div></td>";
                                                echo "</tr>";
                                                $flag ++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
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
    <script>
        function go_back(){
            window.location.href = document.location.origin + "/product/list";
        }
        function move_up(size, index){
            $.ajax({
                    url:  $(location).attr('origin') +  "/product/queue/up",
                    type: "post",
                    data: JSON.stringify({
                        "size":size,
                        "index":index
                    }),
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    success: function(returnData){
                        location.reload(true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("更新失敗，請在檢查網路或者伺服器是否錯誤後再重試一次!");
                    }
                });
        }
        function move_down(size, index){
            $.ajax({
                    url:  $(location).attr('origin') +  "/product/queue/down",
                    type: "post",
                    data: JSON.stringify({
                        "size":size,
                        "index":index
                    }),
                    headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
                    dataType: "json",
                    contentType: "application/json;charset=utf-8",
                    success: function(returnData){
                        location.reload(true);
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert("更新失敗，請在檢查網路或者伺服器是否錯誤後再重試一次!");
                    }
                });
        }
    </script>
    <?php
        include __DIR__."/../common_component/buttom_script.php";
    ?>
</body>
</html>
