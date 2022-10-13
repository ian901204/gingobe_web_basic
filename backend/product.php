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
        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">產品列表</strong>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>產品尺寸</th>
                                            <th>產品價格</th>
                                            <th>產品編輯</th>
                                            <th>產品順序</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($product_data as $data){
                                                echo "<tr>";
                                                echo "<td> <span class='name'>".$data["size"]."</td>";
                                                echo "<td> <span class='product'>".$data["prize"]."</td>";
                                                echo "<td>";
                                                echo "<a href = '/order/get/" . $data["id"]. "' class = 'btn btn-success'>編輯</a>";
                                                echo "<a onclick = 'delete_order(".$data["id"].")' value = ".$data["id"]." class = 'btn btn-danger'>刪除</a>";
                                                echo "</td>";
                                                echo "<td>";
                                                echo "<a href = '/order/get/" . $data["id"]. "' class = 'btn btn btn-primary'>往上移</a>";
                                                echo "<a onclick = 'delete_order(".$data["id"].")' value = ".$data["id"]." class = 'btn btn-secondary'>往下移</a>";
                                                echo "</td>";
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
            include "footer.php";
        ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script>
        function delete_order(order_id){
            if(confirm("確認要刪除產品 #" + order_id + " ?")){
                $.ajax({
                    url:  $(location).attr('origin') +  "/order/delete/" + order_id,
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
        include "buttom_script.php";
    ?>
</body>
</html>
