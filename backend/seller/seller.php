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
                                <button class="btn btn-success btn-sm" onclick="add_seller()">新增業務員</button>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>姓名</th>
                                            <th>電話</th>
                                            <th>完成訂單數</th>
                                            <!--<th>獎金</th>-->
                                            <th>動作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($seller_data as $data){
                                                echo "<tr>";
                                                echo "<td>#".$data["id"]."</td>";
                                                echo "<td> <span class='name'>".$data["name"]."</td>";
                                                echo "<td> <span class='product'>".$data["phone"]."</td>";
                                                echo "<td>" . $data["order_data"] -> count() . "</td>";
                                                echo "<td>";
                                                echo "<a href = '/seller/get/" . $data["id"]. "' class = 'btn btn-success'>顯示</a>";
                                                echo "<a onclick = 'delete_seller(".$data["id"].")' value = ".$data["id"]." class = 'btn btn-danger'>刪除</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- /.table-stats -->
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
        function add_seller(){
            window.location.href = $(location).attr("origin") + "/seller/add";
        }
        function delete_seller(seller_id){
            if(confirm("確認要刪除業務編號 #" + seller_id + " ?")){
                $.ajax({
                    url:  $(location).attr('origin') +  "/seller/delete/" + seller_id,
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
