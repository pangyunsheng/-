(function($){
    $("#tousu-commit").click(function(event) {
        commitAdvice();
    });

    $("#hotel-commit").click(function(event) {
        commitHotel();
    });
})(jQuery);


//投诉或建议

$('#tousu-commit').click(function(){
    commitAdvice();
})
function commitAdvice(){
    var tousuTxt=$("#tousu-txt").val();
    var username=$.cookie('userId');
    if(tousuTxt==""||tousuTxt.length<=0){
        showAlert("不能为空");
        return;
    } 
    if(!username){
        showAlert("请先登录");
        return;
    }
    var postUrl="tousu";  
    $.post(postUrl,  
        {advice:tousuTxt,
         username:username
     },
        function(data) { 
        $res = $.parseJSON(data);   
           if($res.status=="success"){  
                if($res.code=="0"){   
                    showAlert("提交成功");
                   var timer = setInterval(function(){
                        window.location.href='complain';
                    },1000);
                } 
           }else{
                showAlert("服务器异常");
           }
       }); 
}


// 商家入驻

$("#commit").click(function(){
    commitHotel();
})
function commitHotel(){ 
    var shop_name=$("#shop_name").val();
    var shop_addr=$("#shop_addr").val();

    var $shop_mode_id = $('#select').val();
    
    var shop_keeper=$("#shop_keeper").val();
    var shop_tel=$("#shop_tel").val();
    // var shop_dispath=$("#shop_dispath").val();

    var shop_dispath= $('#radio input[name="shop_dispath"]:checked ').val();

   
    
    var image=$("#image").val();
    var reg = /^1[34578]\d{9}$/;
    var username=$.cookie('userId');

    if(!username){
        showAlert("请先登录");
        return;
    }
    if(shop_name==""||shop_name.length<=0){
        showAlert("店铺名称不能为空");
        return;
    } 
    if(shop_addr==""||shop_addr.length<=0){
        showAlert("地址不能为空");
        return;
    } 

    if(shop_keeper=="") {
      showAlert('负责人不能为空');
        return;
    }
    if(shop_tel==""){
        showAlert('联系电话不能为空');
        return;
    }
    if(!reg.test(shop_tel)){
      showAlert('手机格式不正确');
        return;
    }
    if(shop_dispath==""){
        showAlert('配送方式方式不能为空');
        return;
    }
    if(image==""){
        showAlert('必须上传图片');
        return;
    }
 
    var postUrl="/index/about/ruzhu";  

    $.post(postUrl,  
        {shop_name:shop_name,
         shop_addr:shop_addr,
         shop_keeper:shop_keeper,
         shop_mode_id:$shop_mode_id,
         shop_tel:shop_tel,
         shop_dispath:shop_dispath,
         image:image},
        function(data) {  
  
           var res = $.parseJSON(data);  
 
           if(res.status=="success"){   
               
                if(res.code=="0"){   
                    showAlert("店铺名称已存在");
                    return;
                } 
                 if(res.code=='3'){
                    showAlert("该手机号已经被注册");
                    return;
                 } else{
                        showAlert("恭喜您，提交成功,请耐心等待审核");
                         var timer = setInterval(function(){
                            window.location.href='enter';
                        },1000);
                 }

           }else{
                showAlert("服务器异常");
           }
       });


}