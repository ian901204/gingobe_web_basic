const APIUrl = "https://admin.ian-shen.live"
var dataJSON = {};
var label_data = {
	"name":"姓名",
	"telephone":"市話",
	"phone":"手機",
	"amount":"欲訂購的箱數(1000杯/箱)",
	"seller":"業務員編號：",
	"note":"備註"
};
$( "#send_order" ).click(function(){
	var data_missing = 0;
	dataJSON["name"] = $("#name").val();
	dataJSON["telephone"] = $("#telephone").val();
	dataJSON["phone"] = $("#phone").val();
	dataJSON["seller"] = $("#seller").val();
	dataJSON["amount"] = $("#amount").val();
	dataJSON["note"] = $("#note").val();
	$.each(dataJSON, function(index, value){
		console.log(value.length);
		if ((value == "") || (value == null)){
			$("#" + index + "_label").css("color", 'red');
			data_missing = 1;
		}else if(index == "amount" && !$.isNumeric(value)){
			$("#" + index + "_label").text($("#" + index + "_label").text() + "，請輸入正確數量！");
			$("#" + index + "_label").css("color", 'red');
			data_missing = 1;
		}else if(index == "phone" && !$.isNumeric(value) && (value.length == 8 || value.length == 10)){
			$("#" + index + "_label").text($("#" + index + "_label").text() + "，請輸入正確的電話號碼！");
			$("#" + index + "_label").css("color", 'red');
			data_missing = 1;
		}else{
			$("#" + index + "_label").text(label_data[index]);
			$("#" + index + "_label").css("color", 'white');
		}
	});
	if (data_missing == 0){
		$.ajax({
		url: "https://admin.ian-shen.live/order/add",
		data: JSON.stringify(dataJSON),
		type: "POST",
		dataType: "json",
		contentType: "application/json;charset=utf-8",
		success: function(returnData){
			alert("訂單送出成功");
			window.location.replace(window.location.origin);
		},
		error: function(xhr, ajaxOptions, thrownError){
			alert("送出訂單時發生了問題，請稍後在試!");
		}
		});
	}
});
$.ajax({
	url: APIUrl + "/frontend/product",
	type: "POST",
	contentType: "application/json;charset=utf-8",
	dataType:"json",
	success: function(select_data){
	$.each(select_data, function(index, data){
		$('#size').append($('<option>', {value: data["size"],text: data["size"]}));
	});
	}
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