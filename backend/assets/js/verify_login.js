var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
document.getElementsByTagName('head')[0].appendChild(script);
var pathname = $(location).attr('pathname');

if ((pathname != "/login") || (pathname != "/")){
    $.ajax({
        url: $(location).attr('origin') + "/verify",
        headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
        type: "POST",
        dataType: "json",
        contentType: "application/json;charset=utf-8",
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
}
function logout(){
    window.location.replace($(location).attr('origin') + "/login");
    window.localStorage.removeItem("token");
}
function verify_token(url){
    console.log(localStorage.getItem('token'));
    $.ajax({
        url: $(location).attr('origin') + "/verify",
        headers: {"Authorization":"Bearer " + localStorage.getItem('token')},
        type: "POST",
        dataType: "json",
        contentType: "application/json;charset=utf-8",
        success: function(returnData){
            window.location.replace(url);
        },
        error: function(xhr, ajaxOptions, thrownError){
            localStorage.removeItem('token');
            alert("請重新登入!");
            window.location.replace($(location).attr('origin') + "/login");
        }
    });
}