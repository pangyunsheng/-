$(function(){
    //是否已登录
    checkIfLogin();
    //解决IE的trim问题
    if(!String.prototype.trim) {
      String.prototype.trim = function () {
        return this.replace(/^\s+|\s+$/g,'');
      };
    }
     //点击创建
    $('#register').click(function(){
        $('#loginform').hide();
        $('#registerform').fadeIn(300);
    });
    //点击登录
    $('#login').click(function(){ 
        $('#registerform').hide(); 
        $('#loginform').fadeIn(300);
    });
    //点击忘记密码
    $('#forget-password').click(function(){
        $('#loginform').hide(); 
        $('#chpwdform').fadeIn(300);
    });
    //点击返回
    $('#back-login').click(function(){
        $('#chpwdform').hide();  
        $('#loginform').fadeIn(300);
    });

    //点击顶部登录
    $('.header .login').click(function(){
         $('#registerform').hide();
         $('#chpwdform').hide();
         $('#loginform').show();
    });
  

//++++++++++++++++++++ 登录代码开始 +++++++++++++++++++++++++++//

    //登录账号
    $('#checkin').click(function(event){ 
          if (event && event.preventDefault) {//如果是FF下执行这个 
                event.preventDefault(); 
            }else{  
                window.event.returnValue = false;//如果是IE下执行这个 
            }
        
        var phone=$('#phone-1').val().trim(); 
        var pwd=$('#login-pwd').val().trim(); 
        $('#login-phone-error,#login-pwd-error').text("");
        if(phone==""){ 
            $('#login-phone-error').text('手机号不能为空');
            return;
        }
        if(pwd==""){
            $('#login-pwd-error').text('密码不能为空');
            return;
        }

       checkin(phone,pwd);
    });

 // 提交到后台验证
function checkin(phone,pwd){

    var postUrl='/index/Index/login'; 

       $.post(postUrl, 
        {username:phone,
         password:pwd}, 
        function(data) {
            $res = $.parseJSON(data);

           if($res.status=="success"){  
                if($res.code=="0"){  //登录成功

                    //登录成功自动触发被选定元素的事件类型，即自动帮你点击X来关闭登录窗口
                    $('.close-reveal-modal').trigger('click');

                    // 设置过期时间
                    $.cookie('userId',phone,{expires:30,path:'/'});//写cookie

                    var userId=$.cookie('userId');
                    $('#header-user').html('hi，'+userId);
                    $('#header-user').show();
                    $('#header-login').hide(); 
                    $('#user').show();

                    location.reload(); //登录后刷新重载一下，主要为了加载用户购物车的信息
                    //加载我的信息
                    loadMyInfo();

                }else if($res.code=="1"){
                    $('#login-phone-error').text('该用户不存在');
                }else if($res.code=="2"){ 
                    $('#login-pwd-error').text('密码错误');
                }
           }else{
                alert("服务器异常");
           }
       }
      );
   }

//++++++++++++++++++++ 登录代码结束 +++++++++++++++++++++++++++//



//++++++++++++++++++++ 注册代码开始 +++++++++++++++++++++++++++//

//注册账号（点击创建按钮开始全部验证注册信息）3
$('#create').click(function(){ 
    var phone=$('#phone-2').val().trim();
    var code=$('#register-confirm-code').val().trim();
    var code2=$('#register-hid-code').val().trim();
    var pwd=$('#register-pwd').val().trim();
    console.log(code);
    console.log(code2);
    //每次都先清空错误提示在判断
    $('#register-phone-error,#register-code-error,#register-pwd-error,#register-code-error').text("");

    if(phone==""){ 
        $('#register-phone-error').text('手机号不能为空');
        return;
    }
    if(code==""){ 
        $('#register-code-error').text('验证码不能为空');
        return;
    }
    if(pwd==""){
        $('#register-pwd-error').text('密码不能为空');
        return;
    }
    if(!/\w{6,18}/.test(pwd))
    {
        $('#register-pwd-error').text('请输入6-18位字母或数字密码');
        return;
    }  
    // var md5Code=$.md5(code);
    if(code!=code2){
        $('#register-code-error').text('验证码不正确');
        return;
    }
    create(phone,pwd);
});

//注册成功插入数据库，直接登录 4
function create(phone,pwd){ 
    var postUrl='/index/Index/register';

       $.post(postUrl, 
        {
            username:phone,
            password:pwd,
        }, 
        function(data) { 
           var res= $.parseJSON(data);

           if(res.status=="success"){ //注册成功
                
                if(res.code=="0"){  
                    $('.close-reveal-modal').trigger('click');
                    $.cookie('userId',phone,{expires:30,path:'/'});//写cookie
                    var userId=$.cookie('userId');
                    $('#header-user').html('hi，'+userId);
                    $('#header-user').show();
                    $('#header-login').hide(); 
                    $('#user').show();

                    //加载我的信息
                    loadMyInfo();
                }

                // else if($res.code=="1"){
                //     alert($res.msg);
                // }

                else if(res.code=="1"){
                    $('#register-phone-error').text('该用户已注册');
                }
           }else{
                alert("服务器异常");
           }
       });
}

    //注册点击获取验证码时，对手机格式进行验证 1
    $('#register-code').click(function(){
        //合法性
        var phone=$('#phone-2').val().trim();
        var reg = /^1[34578]\d{9}$/;

        $('#register-phone-error').text("");
        if(phone==""){ //判断手机号是否为空
            $('#register-phone-error').text('手机号不能为空');
            return;
        }else if(!reg.test(phone)){
            $('#register-phone-error').text('请输入正确手机格式');
            return;
        }


        // else if(isNaN(phone)){ //判断是否是数字
        //     $('#register-phone-error').text('手机号格式不正确');
        //     return;
        // }else if(phone.length!=11){ //判断手机号是否够位数
        //    
        // }
         
         //获取验证码
        getCode(phone);
    });


//获取验证码 2
function getCode(phone){
    var postUrl="/index/index/yzm";
    $.post(postUrl, 
        {username:phone}, 
        function(data) {
            // console.log(data);return;
           $res= $.parseJSON(data);
           if($res.status=="success"){  
                 
                if($res.code=="0"){

                    //倒计时60s
                    setCodeTime(); 

                    //验证码放到隐藏域 
                     $('#register-hid-code').val($res.verify);
                     
                }else if($res.code=="1"){
                    alert("该手机已注册，请直接登录");
                    return;
                }
           }else{
                alert("服务器异常");
           }
       });
}

//++++++++++++++++++++ 注册代码结束 +++++++++++++++++++++++++++//




//++++++++++++++++++++ 忘记密码代码开始 +++++++++++++++++++++++++++//

 //忘记密码（设置新密码，点“确定”按钮的时候）
$('#chpwd').click(function(event) {
    var phone=$('#phone-3').val().trim();
    var code=$('#chpwd-confirm-code').val().trim();
    var code2=$('#chpwd-hid-code').val().trim();
    var pwd=$('#chpwd-pwd').val().trim(); 
    $('#chpwd-phone-error,#chpwd-pwd-error,#chpwd-code-error').text("");
    if(phone==""){ 
        $('#chpwd-phone-error').text('手机号不能为空');
        return;
    }
    if(code==""){ 
        $('#chpwd-code-error').text('验证码不能为空');
        return;
    }  
    if(pwd==""){
        $('#chpwd-pwd-error').text('密码不能为空');
        return;
    }
    if(!/\w{6,18}/.test(pwd))
    {
        $('#register-pwd-error').text('请输入6-18位字母或数字密码');
        return;
    }  
    // var md5Code=$.md5(code);
    if(code!=code2){
        $('#chpwd-code-error').text('验证码不正确');
        return;
    }
    chpwd(phone,pwd);
});

//更新用户密码
function chpwd(phone,pwd){
var postUrl='/index/Index/update_pwd'; 
   $.post(postUrl, 
    {username:phone,
     password:pwd}, 
    function(data) {

       $res= $.parseJSON(data); 
       if($res.status=="success"){  

            if($res.code=="0"){ 
                alert('密码已重置'); 
                $('.close-reveal-modal').trigger('click');
            }
            // else if($res.code=="1"){
            //     alert($res.msg);
            // }
       }else{
            alert("服务器异常");
       }

   });
}


//忘记密码的验证码
    $('#chpwd-code').click(function(){
        //合法性
        var phone=$('#phone-3').val().trim();
        var reg = /^1[34578]\d{9}$/;
        $('#register-phone-error').text("");

        if(phone==""){ 
            $('#chpwd-phone-error').text('手机号不能为空');
            return;
        }else if(!reg.test(phone)){
            $('#register-phone-error').text('请输入正确手机格式');
            return;
        }
        //忘记密码
        getCode_forget(phone);
    });
    
//获取验证码 
function getCode_forget(phone){
    var postUrl="/index/index/yzm_forget";
    $.post(postUrl, 
        {username:phone}, 
        function(data) {
            // console.log(data);return;
           $res= $.parseJSON(data);
           if($res.status=="success"){  
                 //手机号存在即已经注册，可以发
                if($res.code=="1"){
                    console.log($res.verify);
                    //倒计时60s
                    setCodeTime(); 

                    //验证码放到隐藏域 
                     $('#chpwd-hid-code').val($res.verify);
                     
                }else if($res.code=="0"){
                    alert("该手机未注册，请先注册");
                    return;
                }
           }else{
                alert("服务器异常");
           }
       });
}

//++++++++++++++++++++ 忘记密码代码结束 +++++++++++++++++++++++++++// 



    //点击退出
    $('#sub-logout').click(function(event) { 
       event.preventDefault();  //阻止默认打开url，功能类似 return false
        logout();
    });


    //加载个人的基本信息
    function loadMyInfo(){
         var username=$.cookie('userId');
        if(username){ 
            var postUrl="/ajax/loadMyInfo.php";   
            //开始加载
            $.post(postUrl,  
            {username:username},
            function(data,status,xhr) {     
               if(status=="success"){  
                    $res= $.parseJSON(data); 
                    if($res.code=="0"){  
                       my_SaveValue("userId",$res.data['username']);
                       my_SaveValue("pn",$res.data['phone']);
                       my_SaveValue("name",$res.data['name']);
                       my_SaveValue("place",$res.data['building']);
                       my_SaveValue("block",$res.data['block']);
                       my_SaveValue("floor",$res.data['floor']);
                       my_SaveValue("jifen",$res.data['jifen']);
                       my_SaveValue("email",$res.data['email']);
                    } 
               }else{
                    alert("服务器异常");
               }
           }); 
        }
    }

    
}); //完整加载结束符号在此

// (jQuery);


var leftSeconds=60;
function setCodeTime(){  
    $('.phone-code-btn').attr('disabled',"true");
    $('.phone-code-btn').text(leftSeconds+"s");
    leftSeconds--;
    if(leftSeconds<0){
        leftSeconds=60;
        $('.phone-code-btn').text("重新获取");
        $('.phone-code-btn').removeAttr("disabled");
    }else{
        setTimeout("setCodeTime()", 1000); 
    }
}


function checkIfLogin(){ 
    var postUrl="/ajax/checkLogin.php";
    $.post(postUrl, 
        '', 
        function(data) { 
           var res= $.parseJSON(data); 
           if(res.status=="success"){   
                 
                if(res.code=="0"){ //已登录 
                    var userId=$.cookie('userId'); 
                    $('#header-login').hide();
                    $('#user').show();
                }else if(res.code=="1"){ //未登录 
                    $('#user').hide();
                    $('#header-login').show();
                }
           }else{
                alert("服务器异常");
           }
       });
}

// 登录退出
function logout(){
    var postUrl="/index/index/logout";  
    $.post(postUrl,  
        {},
        function(data) {  
            $res= $.parseJSON(data);  
           if($res.status=="success"){    
                if($res.code=="0"){ //退出成功 
                      $.removeCookie('userId',{expires:7,path:'/'});//删除cookie 

                      // location.href = '/';
                      location.reload();
                } 
           }else{
                alert("服务器异常");
           }
       }); 

}

