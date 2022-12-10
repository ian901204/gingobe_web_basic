<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li id = "menu_li">
            <a id = "order_a" href="/order/list"><i class="menu-icon ti-shopping-cart-full"></i>訂單列表</a>
        </li>
        <li  id = "menu_li">
            <a id = "seller_a" href="/seller/list"><i class="menu-icon ti-id-badge"></i>業務列表</a>
        </li>
        <li  id = "menu_li">
            <a id = "product_a" href="/product/list"><i class="menu-icon ti-layout"></i>產品管理</a>
        </li>
    </ul>
</div><!-- /.navbar-collapse -->
<script>
    var pathname = window.location.pathname;
    $('#menu_li').each(function( index ) {
        console.log($(this).$("a").text());
    });
</script>
    <!--menu here-->