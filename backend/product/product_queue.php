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
                                <strong class="card-title">產品列表</strong>
                                <button class="btn btn-success btn-sm" onclick="add_product()">新增產品</button>
                                <button class="btn btn-primary btn-sm" onclick="queue_adjustment()">調整順序</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>產品尺寸</th>
                                            <th>產品價格</th>
                                            <th></th>
                                            <th>產品編輯</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $flag = 0;
                                            foreach($product_data as $data){
                                                echo "<tr>";
                                                echo "<td> <span class='name'>".$data["size"]."</td>";
                                                echo "<td> <span class='product'>".$data["price"]."</td>";
                                                echo "<td></td>";
                                                echo "<td><div class = 'row'><div class = 'col-4'>";
                                                if ($flag != 0){
                                                    echo "<button onclick = 'move_up(\"" . $data["size"]. "\")' class = 'btn btn-success btn-block'>往上</button>";
                                                }
                                                echo "</div><div class = 'col-4'>";
                                                if ($flag != count($product_data)){
                                                    echo "<button onclick = 'move_down(\"".$data["size"]."\")' class = 'btn btn-danger btn-block'>往下</button>";
                                                
                                                }
                                                echo "</div></div></td>";
                                                echo "</tr>";
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
        function add_product(){
            window.location.href =  $(location).attr('origin') +  "/product/add"
        }
        function queue_adjustment(){
            window.location.href =  $(location).attr('origin') +  "/product/queue"
        }
        function get_detail(size){
            window.location.href = $(location).attr('origin')+ "/prodcut/get/" + size
        }
        function product_delete(id, size){
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
    <?php
        include __DIR__."/../common_component/buttom_script.php";
    ?>
</body>
</html>
