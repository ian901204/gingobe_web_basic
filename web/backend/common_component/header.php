
<div class="top-left">
    <div class="navbar-header">
        <a class="navbar-brand" href="./"><img src="" alt="Logo"></a>
        <a class="navbar-brand hidden" href="./"><img src="" alt="Logo"></a>
        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
    </div>
</div>
<div class="top-right">
    <div class="header-menu">
        <div class="user-area">
            <a id = "user-name"></a>
            <button class="btn btn-danger logout-btn" onclick="logout()"><i class="fa fa-power-off"></i>Logout</button>
        </div>
    </div>
</div>
<script>
    var admin_name = "none";
    $.ajax({
        url: $(location).attr('origin') + "/frontend/name",
        headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
        type: "POST",
        dataType: "json",
        contentType: "application/json;charset=utf-8",
        success: function(returnData){
            $("#user-name").text("您好," + returnData["name"]);
        },
        error: function(xhr, ajaxOptions, thrownError){
            localStorage.removeItem('token');
            var status = JSON.parse(xhr.responseText)["Status"];
            if (status == "Token is invalid!"){
                alert("認證已過期，請重新登入！");
            }else{
                alert("認證遺失，請重新登入！");
            }
            window.location.replace($(location).attr('origin') + "/login");
        }
    });
</script>
