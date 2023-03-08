<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li id = "menu_li">
            <a id = "menu_a" href="/order/list"><i class="menu-icon ti-shopping-cart-full"></i>訂單列表</a>
        </li>
        <li  id = "menu_li">
            <a id = "menu_a" href="/seller/list"><i class="menu-icon ti-id-badge"></i>業務列表</a>
        </li>
        <li  id = "menu_li">
            <a id = "menu_a" href="/product/list"><i class="menu-icon ti-layout"></i>產品管理</a>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->
<script>
    $('#menu_a').each(function( index ) {
        console.log($(this).text());
    });
</script>
    <!--menu here-->