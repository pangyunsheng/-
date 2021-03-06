<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\wamp64\www\www.d.com\public/../application/index\view\order\order_confirm.html";i:1509625052;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="“订饭组（dingfanzu.com）”是北京地区知名的在线外卖订餐O2O平台，是写字楼白领专属订餐网站。已覆盖北京数百个写字楼，数十万用户，聚集了数千家餐饮商户。订外卖，找订饭组。" />
        <script src="__JS_PATH__jquery-1.8.3.js"></script>
        <script src="__JS_PATH__jquery.reveal.js"></script>
        <script src="__JS_PATH__jquery.cookie.js"></script> 
        <script src="__JS_PATH__common.js"></script> 
         <link rel="icon" href="/static/img/logo-50-50.jpg" type="image/x-icon" />  
        <!--[if lte IE 10]>
        <script src="__JS_PATH__requestAnimationFrame.js"></script>
        <![endif]-->

        <link rel=stylesheet href="__CSS_PATH__reset.css">
        <link rel=stylesheet href="__CSS_PATH__common.css">
        <link rel=stylesheet href="__CSS_PATH__base.css"> 
        <link rel=stylesheet href="__CSS_PATH__header.css">
        <link rel=stylesheet href="__CSS_PATH__shopcart.css">  
        <link rel=stylesheet href="__CSS_PATH__footer_1.css"> 
        <link rel=stylesheet href="__CSS_PATH__reveal.css">
        <link rel=stylesheet href="__CSS_PATH__login.css">
        <link rel=stylesheet href="__CSS_PATH__order_confirm.css">
        <title>订饭组-网上订餐_外卖_订餐官网</title>
    </head>
    <body>

        <!--header部分-->
        <div class="header shadow">
            <div class="search-result"> 
            </div>
            <div class="header-left fl">
                <div class="icon fl"></div>
                <a class="weixin-dingfan fw" href="#">微信订饭</a>
                <a class="logo" href="/"></a>
                <div class="search">
                <img class="search-icon" src="__IMG_PATH__/icon_search.png" width="22" height="22">
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
                    <a id="header-user"></a>
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
                <!-- <div id="cart" class="cart fr"> 
                    <img class="cart-icon" src="__IMG_PATH__/icon_cart_22_22.png">
                </div> -->
                <div id="user" class="user fr n">
                    <img class="user-icon" src="__IMG_PATH__/icon_my.png"> 
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

        <div class="order-top-info">
        <span>首页&nbsp;&gt;&nbsp;<a class="info-place" onclick="JavaScript:history.go(-1);"></a>&nbsp;&gt;&nbsp;确认订单</span>
        </div>


        <div class="order-confirm-content">
            <div class="checkout-info">
                <div class="checkout-title">
                <h2>订单信息</h2>
                <a onclick="JavaScript:history.go(-1);">&lt; 返回购物车修改
                </a>
                </div>

                <div class="checkout-tablehead">
                <div class="cell itemname">商品</div><div class="cell itemquantity">份数</div><div class="cell itemtotal">小计（元）</div>
                </div>
                
                <!-- 订单信息 -->
                <ul class="checkout-order">

                </ul>

               
                <div class="checkout-bottom">
                <span>实付：<a style="color:#f74342;">￥</a><a class="checkout-bottom-price">...</a>
                </span>
                </div>
            </div> 
            
            <!-- 开始收货地址 -->
            <div class="checkout-content">
                <div class="checkout-select">
                <h2>收货地址</h2>
                <a class="checkout-noaddress " data-reveal-id="addressModal" data-animation="fade">+ 添加地址</a>

                <!-- 添加完地址就会显示 -->
                <div class="n checkout-address">
                    <span class="address-npa"></span>
                    <a class="address-modify"  data-reveal-id="addressModal" data-animation="fade">修改</a> 
                </div>

                </div>
                <div class="checkout-select">
                <h2>付款方式</h2>
                <ul class="checkout-ul">
                <li class="checkout-pay first disabled" >
                <p class="weixin-pay">微信支付</p>
                </li>
                <li class="checkout-pay second disabled" >
                <p  class="alipay-pay"></p>
                </li>
                <li class="checkout-pay disabled" >
                <p  class="no-pay">餐到付款</p>
                </li>
                </ul>
                </div>

                <div class="checkout-select">
                <h2>我的优惠</h2> 
                <p class="checkout-jifen">
                <span class="jifen-label">我的积分：</span> 
                <span class="jifen-value">积分抵现：￥</span>
                </p>
                <div class="checkout-daijinjuan"> 
                    <ul class="daijinjuan-ul">
                        <li class="daijinjuan-item" >
                        <p>￥<span>3</span></p>
                        </li>
                    </ul> 
                    <span class="daijinjuan-value">代金券：￥0</span>
                </div>
                </div>

                <div class="checkout-select">
                <h2>送达时间</h2> 
                <select class="select-arrived-time"> 
                </select>
                </div>

                <div class="checkout-select">
                <h2>留言</h2> 
                <input class="liuyan-txt" placeholder="少放辣椒。少放盐。">
                </div>
                <div class="checkout-select"> 
                <a class="commit-btn"  target="_blank">确认下单</a> 
                </div>
            </div>
            <div class="clear"></div>
        </div>

        <div class="footer-wrap">
            <div class="footer-content">
                  <div class="footer-content-entrance">
                    <a class="footer-content-link" href="/index/About/enter">关于我们</a>
                    <span class="footer-content-separator">|</span>
                    <a class="footer-content-link" >关注微博</a>
                    <span class="footer-content-separator">|</span>
                    <a class="footer-content-link footer-content-weixing">关注微信
                    <img class="weixin-pic" src="images/qr_code.jpg">
                    </a>
                    <span class="footer-content-separator">|</span>
                    <a class="footer-content-link kaidian_address" href="/index/About/enter">商家入驻</a>

                  </div>
                  <div class="footer-content-copyright">©2017 订饭组 <a target="_blank">粤ICP备17106509号-1</a> </div>
            </div>
        </div>


<!-- 添加地址 -->
    <div id="addressModal" class="reveal-modal"> 
        <div id="addressform" class="addressform"> 
                <span class="address-title">送餐地址</span>
                <div class="addressformfield">
                    <label class="address-name">姓名:</label>
                    <input id="address-name" placeholder="请输入姓名,最长8位" maxlength="8">
                    <label id="error-name" class="error"></label>
                </div>
                <div class="addressformfield">
                    <label class="address-pn">手机号:</label>
                    <input id="address-pn" placeholder="请输入11位手机号" maxlength="11">
                    <label id="error-pn" class="error"></label>
                </div>  
                <div class="addressformfield">
                    <label class="address-detail">地址:</label>
                    <div class="detail-2"> 
                        <span id="place"></span> 
                        <input id="address-detail" placeholder="详细地址(如A座12层)">
                    </div> 
                    <label id="error-detail" class="error"></label>
                </div>  
            <div class="addressform-buttons">
                <a class="save-btn" href="#">保存</a>
            </div> 
        </div>
        <a class="close-reveal-modal"><img src="__IMG_PATH__/icon_close.png" height="24" width="24"></a>
    </div>

    <!--提示框-->
    <div id="alertModel" class="alertModel" >
    <a id="alert" data-reveal-id="alertModel" data-animation="fade"></a>
    <span id="alert-msg"></span>
    <a id="btn-ok" class="btn">知道了</a> 
    <a id="btn-close" class="close-reveal-modal"><img src="__IMG_PATH__/icon_close.png" height="24" width="24"></a>
    </div>


    <script src="__JS_PATH__md5.js"></script>
    <script src="__JS_PATH__login.js"></script>
    <script src="__JS_PATH__cart.lib.js"></script>
    <script src="__JS_PATH__myInfo.js"></script> 
    <script src="__JS_PATH__shopInfo.js"></script> 
    <script src="__JS_PATH__order.js"></script>
    <script src="__JS_PATH__login.js"></script>
    <script src="__JS_PATH__header.js"></script>
    <script src="__JS_PATH__footer.js"></script>


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
            // console.log($.cookie());
            $(".footer-content").show();


            //退出
            $('#logout').click(function(event){
                event.preventDefault();
                $.removeCookie('userId',{expires:7,path:'/'});//删除cookie
                location.href = "/index/Shop/shop_list"; 
            });
            
        });
    </script>
    </body>
</html>


<!-- 订单信息 -->
<script>

$(function(){
    var shop_id=$.cookie('shopId');
    var username = $.cookie('userId');

    $.post(
        '/index/Order/init_info',
        {shop_id:shop_id, username:username},
        function(data){
            
            //如果返回空数据
            if(data == '[]')
            {
                location.href = "/index/Shop/shop_list";
                return;
            }else{    
                var count2 = 0;
                var data = $.parseJSON(data); //一条数据
                var item = $.parseJSON(data[0].item); //Array [ Object, Object ]
                var total_price = data[0].total_price;
                var htmlTxt="<li class='checkout-tablerow'>"
                    +"<div class='cell itemname'>$name</div>"
                    +"<div class='cell itemquantity'>$count</div>"
                    +"<div class='cell itemtotal'>￥$price</div></li>";

                for(var i=0; i<item.length; i++)
                {
                    var itemId = item[i].itemId;
                    var name = item[i].name;
                    var count = item[i].count;
                    var price = item[i].price;
                    var price2 = price*count; //单价*个数
                    count2 += count;
                    
                    var newTxt=htmlTxt.replace("$name",name).replace("$count",count).replace("$price",price2);  

                    $('.checkout-order').append(newTxt);

                }
                //合计
                // console.log(count2);
                var newTxt=htmlTxt.replace("$name","合计").replace("$count",count2).replace("$price",total_price);  
                $('.checkout-order').append(newTxt);

              }
                
            } 
        );//$.post
     });    

</script>
