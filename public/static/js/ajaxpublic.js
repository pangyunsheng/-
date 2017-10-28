function ajaxGet(url, params, callback, dataType) {
	$.ajax({
		url : url,
		data : params,
		success : callback,
		dataType : dataType,
		error : function(result, textStatus, e) {
			alert(result.responseText);
		}
	});
}

function ajaxPost(url, params, callback, dataType) {
	$.ajax({
		url : url,
		data : params,
		type: "POST",
		success : callback,
		dataType : dataType,
		error : function(result, textStatus, e) {
			alert(result.responseText);
		}
	});
}