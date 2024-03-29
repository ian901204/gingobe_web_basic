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
                                            <th>客戶市話</th>
                                            <th>客戶電話</th>
                                            <th>訂購數量</th>
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
                                                echo "<td> ".$data["name"]."</td>";
                                                echo "<td> ".$data["telephone"]."</td>";
                                                echo "<td>".$data["phone"]."</td>";
                                                echo "<td> ".$data["amount"]."</td>";
                                                echo "<td> ".$data["seller_id"]."</td>";
                                                echo "<td> ".$data["order_time"]."</td>";
                                                echo "<td>";
                                                echo "<button onclick = 'get_detail(" . $data["id"]. ")' class = 'btn btn-success btn-block'>顯示</button>";
                                                echo "<button onclick = 'delete_order(".$data["id"].")' value = ".$data["id"]." class = 'btn btn-danger btn-block'>刪除</button>";
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
                window.location.href = window.location.origin + "/seller/order/get/" + id;
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
