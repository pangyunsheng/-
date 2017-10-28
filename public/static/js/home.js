$(function() { 
	if($("#supplierIP").val() != ""){
		$("#homepages").attr("value","1");
		$("#sort").val("distance");
	}
	$("#netbarAct").css("width",$(window).width());
})
function showfeedbackdig(){
	var hidebg = document.getElementById("hidebg");
	hidebg.style.display="block";  //显示隐藏层
	hidebg.style.height=document.body.clientHeight+"px";  //设置隐藏层的高度为当前页面高度
	document.getElementById("feedback").style.display="block";  //显示弹出层
}
function savefeedback(){
	if($("#feedback_content").val() == ""){
		alert("反馈的内容不能为空");
		return;
	}
	if(/^[\w\u4e00-\u9fa5,\x20，()（）+ -]+$/gi.test($("#feedback_content").val()) == false){
		alert("反馈的内容不能输入特殊字符");
		return;
	}
	if(!/^1[35847]\d{9}$/.test($("#feedback_tel").val())){
		 alert("请输入格式以13、14、15、17、18开头的11位手机号码");
		 return;
	}
	var params = {
			content : $("#feedback_content").val(),
			telephone : $("#feedback_tel").val()
	}
	mask.open(true);
	$.ajax({
		url :  $("#website").val() + "newhome/savefeedback",
		data : params,
		type: "POST",
		success : function(result){
			if(result == "success"){
				alert("反馈成功！");
				$("#feedback").css("display","none");
				$("#hidebg").css("display","none");
			}else{
				alert("反馈失败，请重试！");
			}
			mask.close();
		}
	});
}
function closefeedback(){
	$("#feedback").css("display","none");
	$("#hidebg").css("display","none");
}

function choosesupplier(supcateId){
	$("#homepages").attr("value","1");
	$(".suptype").css("background-color","white");
	$(".suptype a").css("color","#323333");
	if(supcateId != "" && supcateId != "0"){
		$("#supcateid").val(supcateId);
		$("#"+supcateId).css("background-color","#f59f00");
		$("#a-"+supcateId).css("color","white");
		$("#supcateid").val(supcateId);
	}
	if(supcateId == "all"){
		supcateId = 0;
		$("#all").css("background-color","#f59f00");
		$("#a-all").css("color","white");
	}
	var sort = "";
	if($("#monthlysale").is(":hidden")){
		sort = "monthlysale";
	}else if($("#distance").is(":hidden")){
		sort = "distance";
	}else if($("#deliveryfloat").is(":hidden")){
		sort = "deliveryfloat";
	}
	mask.open(true);
	var params = {
			supcateId:supcateId,
			sort:sort,
			lat:$("#lat").val(),
			lng:$("#lng").val(),
			cityId : $("#cityId").val()
	}
	$.ajax({
		url :  $("#website").val() + "newhome/supSortOrType",
		data : params,
		type: "POST",
		success : function(result){
			if(result == ""){
				$("#supplierlist").html('<a id="a" href="">没有您查询的商家，请选择其他</a>');
				$("#a").css({"font-size":"20px","margin-left":"300px","line-height":"500px"});
			}else{
				$("#supplierlist").append(result);
				$("#supplierlist").empty(); 
				$("#supplierlist").append(result); 
			}
			mask.close();
		}
	});
}

function suppliersort(sort){
	$("#homepages").attr("value","1");
	$("#sort").attr("value",sort);
	$(".sort_img").css("display","none");
	$("#"+sort).css("display","block");
	mask.open(true);
	var params = {
			supcateId:$("#supcateid").val(),
			sort:sort,
			lat:$("#lat").val(),
			lng:$("#lng").val(),
			cityId : $("#cityId").val()
	}
	$.ajax({
		url : $("#website").val()+"newhome/supSortOrType",
		data : params,
		type: "POST",
		success : function(result){
			if(result == ""){
				$("#supplierlist").html('<a id="a" href="">没有您查询的商家，请选择其他</a>');
				$("#a").css({"font-size":"20px","margin-left":"300px","line-height":"500px"});
			}else{
				$("#supplierlist").empty(); 
				$("#supplierlist").append(result); 
			}
			mask.close();
		}
	});
}
/*function getNetBarSup(){
	var params = {
			supplierIP : $("#supplierIP").val()
	}
	$.ajax({
		url : $("#website").val()+"newhome/getNetBarSup",
		data : params,
		type: "POST",
		success : function(result){
			if(result != ""){
				$("#supplierlist").append(result);
			}
			return true;
		}
	});
}*/
function openDishPage(supplierid){
	var params = {
			supplierid : supplierid
	}
	$.ajax({
		url : "newhome/openDishPage",
		data : params,
		type: "POST",
		success : function(result){
			if(result != ""){
				$("#body").html(result);
			}
		}
	});
}

$(document).ready(function(){  
    var range = 50;             //距下边界长度/单位px  
    var totalheight = 0;   
    var main = $("#supplierlist");                     //主体元素  
	
    $(window).scroll(function(){  
        var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  
          
        //console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());  
        //console.log("页面的文档高度 ："+$(document).height());  
        //console.log('浏览器的高度：'+$(window).height());  
          
        totalheight = parseFloat($(window).height()) + parseFloat(srollPos);  
		
        if(($(document).height()-range) <= totalheight) {  
        	if($("#loading").css("display") == "none" && $("#search_sup").val() == ""){
        		$("#loading").show();
        		var page = parseInt($("#homepages").val()) + 1;
            	$("#homepages").attr("value", page);
            	var params = {
            			page : page,
            			supcateId : $("#supcateid").val(),
            			sort : $("#sort").val(),
            			lat:$("#lat").val(),
    					lng:$("#lng").val(),
    					cityId : $("#cityId").val()
            	}
            	$.ajax({
            		url : $("#website").val()+"newhome/addSupplier",
            		data : params,
            		type: "POST",
            		success : function(result){
            			$("#loading").hide();
            			if(result != ""){
            				main.append(result);  
            			}
            		}
            	});
        	}
        }  
    });  
});  