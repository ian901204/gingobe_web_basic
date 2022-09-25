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
            <div class="col-xs-6 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <strong>訂單資訊</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="form-group">
                            <label class=" form-control-label">Date input</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. 99/99/9999</small>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Phone input</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. (999) 999-9999</small>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Taxpayer Identification Numbers</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. 99-9999999</small>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Social Security Number</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. 999-99-9999</small>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Eye Script</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. ~9.99 ~9.99 999</small>
                        </div>
                        <div class="form-group">
                            <label class=" form-control-label">Credit Card Number</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                <input class="form-control">
                            </div>
                            <small class="form-text text-muted">ex. 9999 9999 9999 9999</small>
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
