<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\wamp64\www\www.d.com\public/../application/index\view\shop\shop_list.html";i:1509624196;}*/ ?>
﻿<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="“订饭组（dingfanzu.com）”是北京地区知名的在线外卖订餐O2O平台，是写字楼白领专属订餐网站。已覆盖北京数百个写字楼，数十万用户，聚集了数千家餐饮商户。订外卖，找订饭组。" />
        <script src="__JS_PATH__jquery-1.8.3.js"></script>
     
        <script src="__JS_PATH__jquery.reveal.js"></script>
        <script src="__JS_PATH__jquery.cookie.js"></script>
        <script src="__JS_PATH__jquery.fly.min.js"></script>  
        <script src="__JS_PATH__common.js"></script>

        <!-- <script src="__JS_PATH__home.js"></script> -->
        <!-- <script src="__JS_PATH__randnum.js"></script> -->
        <!-- <script src="__JS_PATH__jquery-1.8.2.min.js"></script> -->

        <!-- 转圈等待 -->
        <script src="__JS_PATH__masklayer.js" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="__JS_PATH__jquery.lazyload.js"></script> -->
       <link rel="icon" href="/static/img/logo-50-50.jpg" type="image/x-icon" /> 
        <!--[if lte IE 10]>
        <script src="__JS_PATH__requestanimationframe.js"></script>
        <![endif]-->
 
        <link rel=stylesheet href="__CSS_PATH__reset.css">
        <link rel=stylesheet href="__CSS_PATH__common.css">
        <link rel=stylesheet href="__CSS_PATH__base.css">
        <link rel=stylesheet href="__CSS_PATH__shop.css">
        <link rel=stylesheet href="__CSS_PATH__header.css">
        <link rel=stylesheet href="__CSS_PATH__shopcart.css">
        <!-- <link rel=stylesheet href="__CSS_PATH__leftmenu.css"> -->
        <link rel=stylesheet href="__CSS_PATH__reveal.css">
        <link rel=stylesheet href="__CSS_PATH__login.css">
        <!-- <link rel=stylesheet href="__CSS_PATH__menuPage.css"> -->
        <link rel=stylesheet href="__CSS_PATH__home.css">
        <link rel=stylesheet href="__STATIC_PATH__bootstrap/css/bootstrap.css">
        <!-- <link rel=stylesheet href="__CSS_PATH__bootstrap.css"> -->
        <title>订饭组</title>
    </head>


<body id="body" style="min-width:900px;height:auto;">

	<!--------------------   header部分   ---------------->

        <div class="header shadow">
            <div class="header-left fl">
                <div class="icon fl"></div>
                <a class="weixin-dingfan fw" href="#">微信订饭</a>
                <a class="logo" href="/"></a>
                <div class="search">
                <img class="search-icon" src="__IMG_PATH__icon_search.png" width="20" height="20">
                <input id="search-input" class="search-input" type="text" placeholder="请输入楼名" onkeypress="onKeySearch()">
                <span id="search-del" class="search-del">&times;</span> 
                </div>
                <div class="clear"></div>
            </div>
            <div class="header-right fr">
                <div class="login fl">

                    <span class="header-operater">
                    <a href="/index/Shop/shop_list">外卖</a>
                    <a id="order" href="/index/OrderList/order">我的订单</a>
                    <a href="/index/About/enter">商家入驻</a>
                    <a id="houtai" href="/admin/login/login">后台管理</a> 
                    </span> 
                    <a id="header-login" class="navBtn f-radius f-select" data-reveal-id="myModal" data-animation="fade">
                    登录
                    </a>
                    <a id="header-user" style="color: #333"></a>
                </div>

                 <!-- 后台入口显示 -->
                <script>
                    var username = $.cookie('userId');
                    if(!username)
                    {
                        $('#houtai').hide();
                    }else{
                        $.post(
                            '/index/User/hou_tai',
                            {username:username},
                            function(data){
                                $res = $.parseJSON(data);
                                if($res.status == 'success'){
                                  if($res.code == 0){
                                    $('#houtai').show();
                                 }else{
                                    $('#houtai').hide();
                                 }

                                }else{
                                    showAlert("服务器异常");
                                }
                                
                            }
                        );
                    }
                </script>

                <!-- 购物车 -->
                <!-- <div id="cart" class="cart fr"> 
                    <img class="cart-icon" src="__IMG_PATH__/icon_cart_22_22.png">
                </div> -->

                <!-- 用户头像 -->
                <div id="user" class="user fr n">
                    <img class="user-icon" src="__IMG_PATH__/icon_my.png"> 
                </div> 
            </div> 

              <!-- 购物车展示 -->
            <div class="shop-cart shadow n">
                <div class="shop-head">
                    购物车<a class="shop-clear">[清空]</a>
                </div>
                <div class="shop-body">    
                    

                    <div class="isnull">
                        <span></span>
                        <b>购物车空空如也</b>
                    </div>
                </div>
                <div class="shop-bottom">
                    <div class="bottom-price fl">总计：￥<label>32</label>
                    </div>
                    <div class="bottom-icon"></div>
                    <div class="bottom-pay fr">
                        <a id="cart-pay">结算</a>
                    </div>
                </div>
           </div>

            <!-- 登录后在 --头顶部icon_my.png头像--显示 -->
            <ul id="subnav" class="subnav subnav-shadow n">
                <li><a href="" target="" id="a6">最新订单</a></li>
                <li><a href="" target="" id="a7">历史订单</a></li>
                <li><a href="" target="" id="a8">我的积分</a></li>
                <li><a href="" target="" id="a9">我的收藏</a></li>
                <li><a href="" target="" id="a10">账户设置</a></li>
                <li><a id="sub-logout" href="" target="">退出</a></li>
            </ul>
        </div>

        <!-- 赋值href -->
            <script>
                $username = $.cookie('userId');

                $('#a6').attr('href', '/index/OrderList/order/username/'+$username);
                $('#a7').attr('href', '/index/OrderHistory/scan_history/username/'+$username);
                $('#a8').attr('href', '/index/jifen/score/username/'+$username);
                $('#a9').attr('href', '/index/User/collect/username/'+$username);
                $('#a10').attr('href', '/index/Setting/setting/username/'+$username);
            </script>

        <!-- 登录部分 -->
    <div id="myModal" class="reveal-modal"> 
        <div id="loginform" class="loginform n">
            <div>
                <div class="loginformfield">
                    <span class="form-icon"><img src="__IMG_PATH__logo-50-50.jpg"></span>
                </div>
                <div class="loginformfield">
                    <span class="form-title">
                    <h2>使用手机号登录订饭组</h2>
                    </span>
                </div>
                <div class="loginformfield">
                    <!-- <label class="field-name" >手机号:</label> -->
                    <input id="phone-1" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="login-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield">
                    <!-- <label class="field-name">密码:</label> -->
                    <span class="fp"><a href="#" id="forget-password" class="forget-password">忘记密码？</a></span>
                    <input id="login-pwd" type="password" placeholder="密码">
                    <div class="loginformfield-hint form-error">
                        <span id="login-pwd-error"></span>
                    </div>
                </div> 
            </div>
            <div class="loginform-buttons">
                <a id="checkin" class="save-btn" href="#">登录</a>
                <span >还没有账号？<a id="register">创建一个</a></span>
            </div> 
        </div>
        <div id="registerform" class="registerform n">
            <div>
                <div class="loginformfield">
                    <span class="form-icon"><img src="__IMG_PATH__logo-50-50.jpg"></span>
                </div>
                <div class="loginformfield">
                    <span class="form-title">
                    <h2>创建新账号</h2>
                    </span>
                </div>
                <div class="loginformfield">
                    <!-- <label class="field-name">手机号:</label>  -->
                    <input id="phone-2" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="register-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield field-confirm-code">
                    <!-- <label class="field-name">验证码:</label>  -->
                    <input   id="register-confirm-code" placeholder="请输入验证码">
                    <button id="register-code" class="phone-code-btn">获取验证码</button>
                    <input type="hidden" id="register-hid-code">
                    <div class="loginformfield-code-hint form-error">
                        <span id="register-code-error"></span>
                    </div>
                </div> 
                <div class="loginformfield">
                    <!-- <label class="field-name">请输入密码:</label>  -->
                    <input id="register-pwd" type="password" placeholder="请输入6位以上字母或数字密码">
                    <div class="loginformfield-hint form-error">
                        <span id="register-pwd-error"></span>
                    </div>
                </div> 
            </div>
            <div class="loginform-buttons">
                <a id="create" class="save-btn" href="#">创建</a>
                <span >已经有账号？<a id="login">登录</a></span>
            </div> 
        </div>
        <div id="chpwdform" class="chpwdform n">
            <div>
                <div class="loginformfield">
                    <span class="form-icon"><img src="__IMG_PATH__logo-50-50.jpg"></span>
                </div>
                <div class="loginformfield">
                    <span class="form-title">
                    <h2>修改密码</h2>
                    </span>
                </div>
                <div class="loginformfield">
                    <!-- <label class="field-name">手机号:</label> -->
                    <input id="phone-3" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="chpwd-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield field-confirm-code">
                    <!-- <label class="field-name">验证码:</label>  -->
                    <input  id="chpwd-confirm-code"  placeholder="请输入验证码">
                    <button id="chpwd-code" class="phone-code-btn">获取验证码</button>
                    <input type="hidden" id="chpwd-hid-code">
                    <div class="loginformfield-code-hint form-error">
                        <span id="chpwd-code-error"></span>
                    </div>
                </div> 
                <div class="loginformfield">
                    <!-- <label class="field-name">新密码:</label>  -->
                    <input id="chpwd-pwd" type="password" placeholder="请输入6位以上字母或数字密码">
                    <div class="loginformfield-hint form-error">
                        <span id="chpwd-pwd-error"></span>
                    </div>
                </div> 
            </div>
            <div class="loginform-buttons">
                <a id="chpwd" class="save-btn" href="#">确定</a>
                <span >没有忘记密码？<a id="back-login">返回</a></span>
            </div> 
        </div>
        

        <a class="close-reveal-modal"><img src="__IMG_PATH__icon_close.png" height="24" width="24"></a>
    </div>
	<!-- 登录部分结束 -->


 <!--------------------   header部分结束   ---------------->
		


<!--------- 店铺分类 -------->

		<div class="home_suppliertype_div" style="margin-top: 70px">

			<div style="width: 150px;min-height:90px;display:inline-block;float:left;">
				<img class="img" src="__IMG_PATH__suplogo.png" />
				<span class="type">商家分类</span>
			</div>

			<div style="width: 826px;min-height:90px;display:inline-block;"> 
				<div class="typelist">

					<div class="suptype" id="all">
						<a  href="javascript:void(0)" id="a-all" onclick="choosesupplier('all')">全部</a>
					</div>

					 <?php foreach($res as $val): ?>
                    <div class="suptype" id="<?php echo $val['all_cate_id']; ?>">
                        <a id="a-<?php echo $val['all_cate_id']; ?>" href="javascript:void(0)" onclick="choosesupplier(<?php echo $val['all_cate_id']; ?>)"><?php echo $val['cate_name']; ?></a>
                    </div>
                    <?php endforeach; ?>  

					<!-- <div class="suptype" id="31">
						<a id="a-31" href="javascript:void(0)" onclick="choosesupplier(31)">西式快餐</a>
					</div> -->

				</div>
			</div>

		</div>

        <!-- 隐藏域,商家分类id -->
        <input type="hidden" id="supcateid" >

<!-- 店铺按需分类 -->
<div class="home_suppliersort_div">

	<div class="sort_div">
		<a href="javascript:void(0)" onclick="suppliersort('default')" class="sort_a">默认
			<i id="default" class="sort_img" style='background-image:url(__IMG_PATH__supchoose.png);'></i>
		</a>
		<font class="font" >|</font>
	</div>

	<div class="sort_div">
		<a href="javascript:void(0)" onclick="suppliersort('monthlysale')" class="sort_a">销量
			<i id="monthlysale" class="sort_img" style='background-image:url(__IMG_PATH__supchoose.png);'></i>
		</a>
		<font class="font">|</font>
	</div>

	<div class="sort_div">
		<a href="javascript:void(0)" onclick="suppliersort('distance')" class="sort_a">距离
			<i id="distance" class="sort_img" style='background-image:url(__IMG_PATH__supchoose.png);'></i>
		</a>
		<font class="font">|</font>
	</div>

	<div class="sort_div" style="width: 75px;">
		<a href="javascript:void(0)" onclick="suppliersort('deliveryfloat')" class="sort_a" >免配送费
			<i id="deliveryfloat" class="sort_img" style='background-image:url(__IMG_PATH__supchoose.png);'></i>
		</a>
	</div>

</div>

		<!-- 店铺罗列 -->
		<div id="supplierlist" class="home_supplierlist_div">
            
        <?php foreach($res2 as $val): ?>
			<a href="<?php echo url('shop_detail', ['shop_id'=>$val['shop_id']]); ?>" target="_blank">
			<div class="supplier">
			<img class="img" src="<?php echo $val['shop_pic']; ?>"/>
			<font id="suppliername" class="fontname"><?php echo $val['shop_name']; ?></font><br />
			<font class="span">配送费：<font id="supplier_deliverflaot"><?php echo $val['shop_add_price']; ?>(元)</font>
            </font>
			<font class="span">月销量：<font id="supplier_monthsale"><?php echo $val['shop_sell_sum']; ?></font></font><br />
			<font class="span">配送：<font id="supplier_distace">商家</font></font>
            <font class="span">起送价：<font id="supplier_distace"><?php echo $val['shop_dispatch_price']; ?></font></font>
			</div>
			</a>
        <?php endforeach; ?>


 <script>
            
// 选择分类
function choosesupplier(supcateId){
    // $("#homepages").attr("value","1");
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

    // 选择第二个分类，默认就是按月销量来排序
    var sort = "";
    if($("#monthlysale").is(":hidden")){
        sort = "monthlysale";
    }else if($("#distance").is(":hidden")){
        sort = "distance";
    }else if($("#deliveryfloat").is(":hidden")){
        sort = "deliveryfloat";
    }else if($('#default').is(":hidden")){
        sort = 'monthlysale';
    }
    // mask.open(true);

    var params = {
            supcateId:supcateId,
            sort:sort

            // lat:$("#lat").val(),
            // lng:$("#lng").val(),
            // cityId : $("#cityId").val()
    }
    
    // console.log($.cookie());

    $.ajax({
        url : '/index/Shop/shop_choosesupplier',
        data : params,
        type: "POST",
        success : function(result){

           var result = $.parseJSON(result);
            console.log(result);
            // console.log(typeof(result.supcateId));return;
            if(result == ""){
                $("#supplierlist").html('<a id="a" href="">没有您查询的商家，请选择其他</a>');
                $("#a").css({"font-size":"20px","margin-left":"300px","line-height":"500px"});
            }else{
                // $("#supplierlist").append(result);
                $("#supplierlist").empty(); 
                $("#supplierlist").append(result); 
                $("#page").empty();
            }
            // mask.close();
        }
    });
}



function suppliersort(sort){
    var supcateId = $("#supcateid").val();
    if(supcateId == 'all')
    {
        supcateId = 0;
    }

    if(sort == 'default')
    {
        sort = 'monthlysale';
    }
    // $("#homepages").attr("value","1");
    $("#sort").attr("value",sort);
    $(".sort_img").css("display","none");
    $("#"+sort).css("display","block");
    // mask.open(true);
    var params = {
            supcateId:supcateId,
            sort:sort,
            // lat:$("#lat").val(),
            // lng:$("#lng").val(),
            // cityId : $("#cityId").val()
    }
    // console.log(params);

    $.ajax({
        url : '/index/Shop/shop_choosesupplier',
        data : params,
        type: "POST",
        success : function(result){
            var result = $.parseJSON(result);
            if(result == ""){
                $("#supplierlist").html('<a id="a" href="">没有您查询的商家，请选择其他</a>');
                $("#a").css({"font-size":"20px","margin-left":"300px","line-height":"500px"});
            }else{
                $("#supplierlist").empty(); 
                $("#supplierlist").append(result); 
                $("#page").empty();
            }
            // mask.close();
        }
    });
}
</script>


		<!-- 	<a href="/dish/index?supplierid=10173" target="_blank">
			<div class="supplier">
			<img class="img" src="__IMG_PATH__56fc8674e3d0d130@2x@2x.png"/>
			<font id="suppliername" class="fontname">台湾口口冰</font><br />
			<font class="span">配送费：<font id="supplier_deliverflaot">5(元)</font></font>
			<font class="span">月销量：<font id="supplier_monthsale">620(份)</font></font><br />
			<font class="span">距离：<font id="supplier_distace">4041米</font></font>
			</div>
			</a> -->
	</div>

    <!-- 分页 -->
    <div id="page"><?php echo $page; ?></div>

		<!-- 加载图片转圈 -->
		<!-- <div id="loading" style="display:none;">
			<img style="width:40px;" src="__IMG_PATH__fadingline.gif"/>
		</div> -->

		<div class="home_feedback_div" onclick="showfeedbackdig()">
			<a href="javascript:void(0)" style="color:rgb(102,102,102);"> 意 见 反 馈</a><br />
		</div>

		<div id="hidebg" class="hidebg"></div>
		<div id="feedback" class="feedback">
			<div class="feed_title">反馈问题</div>
			<div class="content_div">
				<textarea id="feedback_content" class="content" placeholder="请在此输入您要反馈的问题或建议"></textarea>
			</div>
			 <a href="/index/About/enter">商家入驻</a>
			<div class="tel_div">
				<input id="feedback_tel" class="tel_input" placeholder="请输入您的手机号码"></input>
			</div>
			<div class="btn_div">
				<button class="btn" onclick="savefeedback()">提交</button>
				<button class="btn" onclick="closefeedback()">取消</button>
			</div>
		</div>
	</div>
	<div style="height: 8em;"><link rel="stylesheet" href="__CSS_PATH__newwebsite.css" type="text/css"  />

<div class="bottom_bar">
	<div style="width: 980px;margin:0 auto;height:100px;z-index:3;">
		<div class="bottom_logo">
			<a href="/"><img style="background: red;height: 50px" src="__IMG_PATH__header_logo.png" border="0"/></a>
		</div>
		<div  class="bottom_link">
			<a href="/index/About/enter"><font class="bottom_link_font">联系我们</font></a><span>&nbsp;&nbsp;|&nbsp;</span> 
			<a href="/index/About/enter"><font class="bottom_link_font">关于我们</font></a><span>&nbsp;&nbsp;|&nbsp;</span>
			<a href="/index/About/enter"><font class="bottom_link_font">店铺加入</font></a><span>&nbsp;&nbsp;|&nbsp;</span>
			<a href="/index/About/enter"><font class="bottom_link_font">微博微信</font></a><span>&nbsp;&nbsp;|&nbsp;</span>
			<a href="/index/About/enter"><font class="bottom_link_font">使用帮助</font></a><span>&nbsp;&nbsp;|&nbsp;</span>
			<a href="/index/About/enter"><font class="bottom_link_font">招聘</font></a><span>&nbsp;&nbsp;|&nbsp;</span>
			<a href="/index/About/enter"><font class="bottom_link_font">免责声明</font></a>			<div style="margin-left: 40px;margin-top:15px;">Copyright@2017 订饭组 All Rights Reserved. 粤ICP备17106509号-1</div>
		</div>
	</div>
</div>

<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fbb50099cc52f462559dec85de863358c' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>


<script src="__JS_PATH__/common.js"></script>
<script src="__JS_PATH__/md5.js"></script>
<script src="__JS_PATH__/myinfo.js"></script>
<script src="__JS_PATH__/login.js"></script>
<script src="__JS_PATH__/cart.lib.js"></script>
<script src="__JS_PATH__/cart.js"></script>
<script src="__JS_PATH__/header.js"></script>
<script src="__JS_PATH__/footer.js"></script>


<!-- 如果用户名存在且cookie没有过期 -->
    <script>
        $(function(){

            //如果未登录点击就点击我的订单，跳出登录页面
            $('#order').click(function(event){
                var $username = $.cookie('userId');
                if(!$.cookie('userId'))
                {
                    //未登录跳出登录页面（自动绑定点击事件）
                    $('#header-login').trigger('click');     
                }else{
                    location.href = '/index/OrderList/order/username/'+$username;
                }
                return false;
            });

            // cookie用户信息
            if($.cookie('userId'))
            {
                var userId=$.cookie('userId');
                $('#header-user').html('hi，'+userId);
                $('#header-user').show();
                $('#header-login').hide(); 
                $('#user').show();
            }

             //初始化购物车
            initCart();

            //footer
            processFooter();

            //地址悬浮
            $(".place-cc a,.place-nav").hover(function() { 
                $('.place-nav').show();
            }, function() {
            $('.place-nav').hide();
            });
            
            //购物车相关 
            var shopCartWidth=$(".shop-cart").width(); 

            //默认隐藏购物车
            $(".shop-cart,.shop-bottom").css("right",-shopCartWidth); 
            var mRight=-shopCartWidth;
            
            $("#cart").click(function(){
                $('.shop-cart').show(); 
                //适配购物车
                processShopItem();
                
                shopCartWidth=$(".shop-cart").width();
                if(mRight=='0px'){
                    mRight=-shopCartWidth;
                    $(".shop-cart,.shop-bottom").animate({right:mRight},200);
                }
                else{
                    mRight='0px';
                    $(".shop-cart,.shop-bottom").animate({right:mRight},200);
                }
            });
        });

         function processFooter(){
            var zh=$(document.body).height(); 
            $(".footer-content").css('top', zh-60);
            $(".footer-content").show();
        }	
    </script>


 </body>
</html>