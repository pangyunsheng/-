$(function() { 
	if($("#is_support_preorder").val() == "Y"){
		alert("对不起,预定的店铺只支持APP下单");
		window.close();
		return;
	}
	if(!$('.personlink').length>0){
		$("#top_div").load($("#website").val()+"dish/repeatTop");
	}
	if($("#supplierId").val() != ""){
		if($("#supStatus").val() != ""){
			alert($("#supStatus").val());
		}
		getleastprice($("#supplierId").val());
	}
})
/*function isOpenStatus(supId){
	var params = {
			supplierId : $("#supplierId").val()
	}
	$.ajax({   
		type: "POST",   
		url: $("#website").val() + "dish/supStatus",   
		data: params,   
		success: function(result) { 
			if(result == "failed"){
				alert("商家不再营业时间，您将无法下单，请选择其他商家");
				$("#supStatus").val("notOpen");
			}
		}   
	}); 
}*/

function choosedish(dishid){
	$("#dish_"+dishid).bind("click",function(){
	});
	if($("#dish-"+dishid).size()>0){
		adddish(dishid);
		return;
	}
	if($("#attr-"+dishid).attr("isconfig") == "Y"){
		var params = {dishId:dishid,price:$('#dishprice-'+dishid).val()}
		ajaxGet($("#website").val() + "dish/attrPage/", params, function(result) { 
			$("#attrdialog").html(result);
			$("#attrdialog").dialog({
				width : 360,
				height : 600,
				modal : true,
				resizable : false,
				buttons : {
					"确定" : function() {
						submitOk();
					},
					"取消" : function() {
						$(this).dialog("close");
					}
				},
				close : function() {
					$(this).html("");
				}
			});
		}, "html");
	}else{
		var params = {
				dishid : dishid
		}
		$.ajax({
			url : $("#website").val() + "dish/chooseDish",
			data : params,
			type: "POST",
			success : function(result){
				if(result != ""){
					var amount_price = "";
					var price = "";
					$("#manu").css("display","block");
					$("#dish").append(result);
					$("#amount_qty").html($("#amount_qty").html()-(-1));
					amount_price = (Number($("#amount_price").html()) + Number($('#dish_price-'+dishid).html())).toFixed(2);
					$("#amount_price").html(amount_price);
					$("#amount_integral").html(amount_price*$("#currencies").val());
					checkLeastPrice();amount_integral
				}
			}
		});
	}
	
}

function getleastprice(supplierId){
	if($("#sup_phone").val()!=""){
		placeorder1.innerText = $("#sup_phone").val();
		return;
	}
	var params={
			supplierId : supplierId,
			lat : $("#lat").val(),
			lng : $("#lng").val()
	}
	$.ajax({   
		type: "POST",   
		url: $("#website").val() + "dish/getleastprice",   
		data: params,   
		success: function(result) {
			if(result !=""){
				$("#lestPrice").val(result);
			}
		}   
	}); 
}
function cleardish(){
	$("#dish").empty();
	$("#amount_qty").html("0");
	$("#amount_price").html("0");
	$("#manu").css("display","none");
}
function refucedish(dishid,num){
	if(num == ""){
		var qty = $('#quantity-'+dishid).html()-1;
		$('#quantity-'+dishid).html(qty);
		$("#amount_qty").html($("#amount_qty").html()-1);
		amount_price = (Number($("#amount_price").html()) - Number($('#dish_price-'+dishid).html())).toFixed(2);
		$("#amount_price").html(amount_price);
		$("#amount_integral").html(amount_price*$("#currencies").val());
		if(qty < 1){
			$("#dish-"+dishid).remove();
		}
		$("#"+dishid).val(qty);
	}else{
		$("#atr-"+dishid).remove();
		var qty = $('#quantity-'+dishid+"-"+num).html()-1;
		$('#quantity-'+dishid+"-"+num).html(qty);
		$("#amount_qty").html($("#amount_qty").html()-1);
		amount_price = (Number($("#amount_price").html()) - Number($('#dish_price-'+dishid+"-"+num).html())).toFixed(2);
		$("#amount_price").html(amount_price);
		$("#amount_integral").html(amount_price*$("#currencies").val());
		if(qty < 1){
			$("#dish-"+dishid+"-"+num).remove();
		}	
	}
	if(dish.innerHTML == ""){
		$("#manu").css("display","none");
	}
	checkLeastPrice();
}
function checkLeastPrice(){
	leastprice.innerText = (Number($("#lestPrice").val()) - Number($("#amount_price").html())).toFixed(2);
	if(leastprice.innerText == 0 || leastprice.innerText < 0){
		$("#placeorder1").css("display","none");
		$("#placeorder").css("display","inline-block");
	}else{
		$("#placeorder1").css("display","inline-block");
		$("#placeorder").css("display","none");
	}
}
function adddish(dishid){
	var amount_price = "";
	var price = "";
	var qty = $('#quantity-'+dishid).html()-(-1);
	$('#quantity-'+dishid).html(qty);
	$("#amount_qty").html($("#amount_qty").html()-(-1));
	amount_price = (Number($("#amount_price").html()) + Number($('#dish_price-'+dishid).html())).toFixed(2);
	$("#amount_price").html(amount_price);
	$("#amount_integral").html(amount_price*$("#currencies").val());
	$("#"+dishid).val(qty);
	checkLeastPrice();
}
function openAttributeType(dishid){
	var params = {
			dishid : dishid
	}
	$.ajax({
		url : "chooseDishAttrType",
		data : params,
		type: "POST",
		success : function(result){
			if(result != ""){
				$("#manu").css("display","block");
				$("#amount_qty").html(result);
			}
		}
	});
}

function openPalcePage(){ 
	var customers = $("#customers").val();
	if($("#supStatus").val() != ""){
		alert($("#supStatus").val());
		cleardish();
		$("#manu").css("display","none");
		return;
	}
	var dish_id = "";
	var attr_dish = "";
	$("#dish input").each(function(index){
		if($(this).attr("attr") != ""){
			attr_dish = $(this).attr("attr") + "," + attr_dish;
		}else{
			var price = $("#dish_price-"+$(this).attr("id")).html() * $(this).val();
			attr_dish = '{"id":"'+$(this).attr("id")+'","qty":"'+$(this).val()+'"}' + "," + attr_dish;
		}
	});
	attr_dish = attr_dish.substring(0,attr_dish.length-1);

	var params = {dish:attr_dish,allAmount:$("#amount_price").html(),supplierId:$("#supplierId").val()}
	$.ajax({   
		type: "POST",   
		url: $("#website").val() + "dish/openPlaceOrderPage",   
		data: params,   
		success: function(result) { 
			if(result=="success"){
				url = $("#website").val() + "newwebsite/openPlacePage?customers="+customers; 
				window.location.href = url;
			}
		}   
	}); 
	
}

function openBigPicture(dishId){
	var params = {dishId:dishId}
	$.ajax({   
		type: "POST",   
		url: $("#website").val() + "dish/openBigPicture",   
		data: params,   
		success: function(result) { 
			if(result != ""){
				$(".dishinfo").html(result);
				$("#dishMask").show();
				$(".dishinfo").show();
			}
		}   
	}); 
}

function pictureSure(){
	$(".dishinfo").hide();
	$("#dishMask").hide();
	$(".dishinfo").html("");
}

function pictureClose(){
	$(".dishinfo").hide();
	$("#dishMask").hide();
	$(".dishinfo").html("");
}