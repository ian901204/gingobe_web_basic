<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <?php
        include __DIR__."/../common_component/head.php";
    ?>
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
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
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">訂單列表</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>客戶姓名</th>
                                            <th>客戶電話</th>
                                            <th>產品尺寸</th>
                                            <th>產品數量</th>
                                            <th>訂單地址</th>
                                            <th>業務員</th>
                                            <th>訂單成立時間</th>
                                            <th>動作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($order_data as $data){
                                                echo "<tr>";
                                                echo "<td>".$data["id"]."</td>";
                                                echo "<td> ".$data["client_name"]."</td>";
                                                echo "<td> ".$data["client_phone"]."</td>";
                                                echo "<td>".$data["product_size"]."</td>";
                                                echo "<td> ".$data["product_amount"]."</td>";
                                                echo "<td> ".$data["order_address"]."</td>";
                                                echo "<td> ".$data["seller_id"]."</td>";
                                                echo "<td> ".$data["order_time"]."</td>";
                                                echo "<td>";
                                                ?>
                                                <div class = "row">
                                                <div class = "col-md-6">
                                                <?php
                                                echo "<button onclick = 'get_detail(" . $data["id"]. ")' class = 'btn btn-success btn-block'>顯示</button>";
                                                ?>
                                                </div>
                                                <div class = "col-md-6">
                                                <?php
                                                echo "<button onclick = 'delete_order(".$data["id"].")' value = ".$data["id"]." class = 'btn btn-danger btn-block'>刪除</button>";
                                                ?>
                                                    </div>
                                                </div>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
    <script>
        function get_detail(id){
            if (window.location.pathname.includes("seller")){
                var path = window.location.pathname.split("/order")[0];
                window.location.href = window.location.origin + path + "/order/get/" + id;
            }else{
                window.location.href = window.location.origin + "/order/get/" + id;
            }
        }
        function delete_order(order_id){
            if(confirm("確認要刪除訂單編號 #" + order_id + " ?")){
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
        include __DIR__."/../common_component/buttom_script.php";
    ?>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
    </script>
</body>
</html>
