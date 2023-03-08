const APIUrl = "https://admin.ian-shen.live"
var dataJSON = {};
var label_data = {
	"name":"姓名：",
	"telephone":"電話（市話）：",
	"phone":"手機：",
	"amount":"訂購數量（1000入/1箱）：",
	"seller":"業務員編號：",
	"note":"備註："
};

function open_message(){
	$("#success_background").css("height", "100%");
	$(".message_box").css("visibility", "visible");
}
function close_message(){
	$("#success_background").css("height", "0%");
	$(".message_box").css("visibility", "hidden");
	$(".loader").css("visibility", "hidden");
	$(".pass_icon").css("visibility", "hidden");
}
$( "#send_order" ).click(function(){
	$("#send_order").prop('disabled', true);
	var data_missing = 0;
	dataJSON["name"] = $("#name").val();
	dataJSON["telephone"] = $("#telephone").val();
	dataJSON["phone"] = $("#phone").val();
	dataJSON["seller"] = $("#seller").val();
	dataJSON["amount"] = $("#amount").val();
	dataJSON["note"] = $("#note").val();
	$.each(dataJSON, function(index, value){
		if (index != "telephone" && index != "note" && ((value == "") || (value == null))){
			$("#" + index + "_label").css("color", 'red');
			data_missing = 1;
		}else{
			$("#" + index + "_label").css("color", '');
		}
	});
	if((!$.isNumeric(dataJSON["phone"])) || (dataJSON["phone"].length != 8 && dataJSON["phone"].length != 10)){
		$("#phone_label").css("color", 'red');
		data_missing = 1;
	}
	if((!$.isNumeric(dataJSON["amount"]))){
		$("#amount_label").css("color", 'red');
		data_missing = 1;
	}
	if (data_missing == 0){
		open_message();
		$("#send_message").text("訂單送出中");
		$(".loader").css("visibility", "visible");
		$.ajax({
		url: "https://admin.ian-shen.live/order/add",
		data: JSON.stringify(dataJSON),
		type: "POST",
		dataType: "json",
		contentType: "application/json;charset=utf-8",
		success: function(returnData){
			$("#send_message").text("訂單送出成功!");
			$(".loader").css("visibility", "hidden");
			$(".pass_icon").css("visibility", "visible");
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert("送出訂單時發生了問題，請稍後在試!");
		}
		});
	}
	$("#send_order").prop('disabled', false);
});
$.ajax({
	url: APIUrl + "/frontend/seller",
	type: "POST",
	contentType: "application/json;charset=utf-8",
	dataType:"json",
	success: function(select_data){
	$.each(select_data, function(index, data){
		$('#seller').append($('<option>', {value: data["id"],text: data["name"]}));
	});
	}
});