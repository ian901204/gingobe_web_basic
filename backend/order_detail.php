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
                        <div class="form-group">
                            <label class=" form-control-label">客戶姓名</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input id = "name" class="form-control" value = "<?php echo $order_data-> client_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">客戶電話</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input id = "phone" class="form-control" value = "<?php echo $order_data["client_phone"]; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">訂單地址</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                                <input id = "address" class="form-control" value = "<?php echo $order_data["order_address"] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">產品尺寸</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-beer"></i></div>
                                <input id = "size" class="form-control" value = "<?php echo $order_data["product_size"] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">產品數量(箱)</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-archive"></i></div>
                                <input id = "amount" class="form-control" value = "<?php echo $order_data["product_amount"] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">業務員</label>
                            <div class="input-group">
                                <div class="card-body">
                                    <select data-placeholder="Choose a Country..." class="standardSelect" tabindex="-1" style="display: none;">
                                    <option value="-1" label="default"></option>
                                        <?php
                                            foreach($seller_data as $data){
                                                echo "<option value = '".$data["id"]."'>".$data["name"]."</option>";
                                            }
                                        ?>
                                    </select>
                                    <div class="chosen-container chosen-container-single" title="" style="width: 100%;">
                                        <a class="chosen-single chosen-default">
                                            <span>請選擇業務員</span>
                                            <div><b></b></div>
                                        </a>
                                        <div class="chosen-drop">
                                            <div class="chosen-search">
                                                <input class="chosen-search-input" type="text" autocomplete="off" tabindex="1">
                                            </div>
                                            <ul class="chosen-results">
                                                <?php
                                                    $data_index = 1;
                                                    foreach($seller_data as $data){
                                                        echo "<li class='active-result' data-option-array-index=".$data_index." style=''>".$data["name"]."</li>";
                                                        $data_index += 1;
                                                    }
                                                ?>
                                                <!--<li class="active-result" data-option-array-index="1" style="">United States</li>
                                                <li class="active-result" data-option-array-index="2" style="">United Kingdom</li>
                                                <li class="active-result" data-option-array-index="3" style="">Afghanistan</li>
                                                <li class="active-result" data-option-array-index="4" style="">Aland Islands</li>
                                                <li class="active-result" data-option-array-index="5" style="">Albania</li>
                                                <li class="active-result" data-option-array-index="6" style="">Algeria</li>
                                                <li class="active-result" data-option-array-index="7" style="">American Samoa</li>
                                                <li class="active-result" data-option-array-index="8" style="">Andorra</li>
                                                <li class="active-result" data-option-array-index="9" style="">Angola</li>
                                                <li class="active-result" data-option-array-index="10" style="">Anguilla</li>
                                                <li class="active-result" data-option-array-index="11" style="">Antarctica</li>-->
                                            </ul>
                                        </div>
                                    </div>
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
            include "footer.php";
        ?>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script>
    </script>
    <?php
        include "buttom_script.php";
    ?>
</body>
</html>
