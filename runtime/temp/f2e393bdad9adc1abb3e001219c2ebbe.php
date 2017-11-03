<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\wamp64\www\www.d.com\public/../application/index\view\shop\shop_detail.html";i:1509627574;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="“订饭组（dingfanzu.com）”是北京地区知名的在线外卖订餐O2O平台，是写字楼白领专属订餐网站。已覆盖北京数百个写字楼，数十万用户，聚集了数千家餐饮商户。订外卖，找订饭组。" />
        <script src="__JS_PATH__jquery-1.8.3.js"></script>
        <script src="__JS_PATH__jquery.reveal.js"></script>
        <script src="__JS_PATH__jquery.cookie.js"></script>
        <script src="__JS_PATH__jquery.fly.min.js"></script>  
        <script src="__JS_PATH__common.js"></script>  
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
        <link rel=stylesheet href="__CSS_PATH__leftmenu.css">
        <link rel=stylesheet href="__CSS_PATH__reveal.css">
        <link rel=stylesheet href="__CSS_PATH__login.css">
        <link rel=stylesheet href="__CSS_PATH__menuPage.css">
        <title>订饭组</title>
    </head>

    <body>

        <!--菜品展示-->
       <div class="content-middle n">
            
            <!-- 大菜单 -->
            <?php foreach($c as $val): ?>
            <div id="m<?php echo $val['cid']; ?>" class="menu-wrap">
                <?php foreach($res3 as $v): if($v['cid'] == $val['cid']): ?>
                <!-- 小菜品 -->
                 <div class="menu-item" item-id="<?php echo $v['mid']; ?>"> 
                    <div class="item-wrap">
                        <img src="<?php echo $v['meal_pic']; ?>" height="130" width="130">

                        <div class="item-detail">

                            <span class="name"><?php echo $v['meal_name']; ?></span>

                            <div style="color: #999999;width: 110px;text-align: center;margin: 0 auto">月售<?php echo $v['meal_sell_num']; ?>份</div>

                            <span class="price"  item-price="<?php echo $v['meal_price']; ?>">￥<?php echo $v['meal_price']; ?></span> 
                            <img class="buy" src="__IMG_PATH__icon_buy.png"> 
                            
                            <ul class="stars" data-node="star">                   
                                <li data-value="1" class="active"></li>
                                <li data-value="2" class="active"></li>
                                <li data-value="3" class="active"></li>
                                <li data-value="4" class="active"></li>
                                <li data-value="5" class=""></li>                    
                            </ul>
                        </div> 
                    </div>
                </div> 
                <?php endif; endforeach; ?>
         
            </div>
            <?php endforeach; ?>

       </div>

     <!--   <script>
            $(function(){
                $('#cart-pay').click(function(event){
                    console.log($.cookie());
                    // return false;

                   
            });
          
       </script> -->


       <!-- 评论区 -->
       <div class="pl" style="background: grey">
       	<div class="pl-1" >
       		
       		<section class="main-box">
			    <section class="review-messages">
                <header class="review-header-box clearfix">
                       全部评论（共&ensp;<?php echo $count; ?>&ensp;条评论）
                    <!-- <label class="checkbox view-check fr" title="有内容的评论" model="filterObj">
                        <div class="checker"><span ng-class="{checked:model}">
                            <input type="checkbox" ng-model="model" ng-true-value="true" ng-disabled="disable" class="ng-pristine ng-valid">
                        </span>
                        </div>
                        <span class="ng-binding">有内容的评论</span>
                    </label> -->
                </header>
                
                        <?php foreach($list as $key=>$val): ?>
                        <article class="review-item">
                                    
                                <div class="fr review-search order-detail">
                                    <?php foreach($it as $k=>$v): if($key == $k): foreach($v as $x=>$y): ?>
                                    <!-- 只出两件商品 -->
                                    <?php if($x == 0 || $x == 1): ?>
                                    <a class="review-read-color review-order"><?php echo $y['name']; ?></a> |  
                                    <?php endif; endforeach; endif; endforeach; ?>

                                    等<?php echo $it_count[$key]; ?> 件商品
                                    
                                </div>

                                <span><?php echo $val['username']; ?></span>
                                <span><?php echo $val['pj_time']; ?></span>

                                <span>送餐时长：<?php echo $time[$key]; ?>分钟</span>

						<!-- 小星星随着宽度变小黄色部分变少 -->
                                <span class="small-star">
                                    <span style="width:<?php echo $val['xing_count']*13; ?>.00px;"></span>     
                                </span>

                            <div class="review-content">
                                <?php echo $val['content']; ?>
                            </div>  

                        </article>

                        <?php endforeach; ?>


                    <page total="18" show="5"></page>               
            </section>
			</section>  		
       	</div>              
       </div>

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

                <!-- 购物车 -->
               <!--  <div id="cart" class="cart fr"> 
                    <img class="cart-icon" src="__IMG_PATH__/icon_cart_22_22.png">
                </div> -->

                <!-- 用户头像 -->
                <div id="user" class="user fr n">
                    <img class="user-icon" src="__IMG_PATH__/icon_my.png"> 
                </div> 
            </div>
        </div>


<!---------------------内容部分------------------------>
        <div class="shop-content"> 
			
			<!-- 公告部分 -->
            <div class="gonggao-wrap">
             <div class="gonggao">     
                <b> 平均送达时间：<strong><?php echo $get_time; ?>&ensp;分钟</strong></b> &ensp;|&ensp;
                <b> 起送价：¥<strong><?php echo $res['shop_dispatch_price']; ?></strong></b> &ensp;|&ensp;&ensp;
                <b> 配送费：¥<strong><?php echo $res['shop_add_price']; ?></strong></b> &ensp;|&ensp;

				<!-- 评论区 -->
				<b style="border: 1px dotted red;border-top: none"><a href="" style="color: red;font-size: 18px;text-decoration: underline" id="commit">评论区</a></b>
				
                <b style="float: right;">
                	店铺地址：<strong><?php echo $res['shop_addr']; ?></strong>
                </b>


               </div>
           </div>


            <div class="leftmenu">

                    <dl>
                        <dt>
                        <!-- 店铺图标 -->
                        <img class="shop-icon" src="<?php echo $res['shop_pic']; ?>" >

                        <script>
			            	var leftMenuWidth=$('.leftmenu').width() - 50;
                        	$('.shop-icon').width(leftMenuWidth);
                        </script>
                        
                        <!-- 店铺对应的shop_id -->
                        <span class="shop-name" shopId="<?php echo $res['shop_id']; ?>" >
                        <?php echo $res['shop_name']; ?>
                        </span>

                        <span class="switch-address">
                        <!-- <a class="switch-address" href="place.html">[切换地址]</a> -->

                        <b>营业时间：<?php echo $res['shop_opentime']; ?></b><br>
                    
                        <?php if($res['shop_state'] == 1): ?>
                      <strong style="background-color: #64b93c;color: white;">营业中</strong> 

                        <?php else: ?>
                        <!-- 或者已关门 -->
                         <strong style="background-color: #333;color: white">已闭店</strong> 
            
                         <?php endif; ?>
                        
                        <!-- 如果关店了就隐藏购买图标 -->
                         <script>
                            $(function(){
                                console.log(<?php echo $res['shop_state']; ?>);
                                 if(<?php echo $res['shop_state']; ?> == 0)
                                {
                                    $('.buy').hide();
                                }
                          
                            });
                                                      
                         </script>

                         <!-- 店铺收藏 -->
                        &ensp;&ensp;|&ensp;&ensp; 
            
                        <a id="sc_1">
                        <img src="__IMG_PATH__icon_full_star.png" style="width: 20px;height: 16px;display: inline-block;margin-top: 5px">
                        <label>收藏</label>
                       </a>

                       <a id="sc_2">
                        <img src="__IMG_PATH__icon_star_red.png" style="width: 20px;height: 16px;display: inline-block;margin-top: 5px">
                        <label>已收藏</label>
                      </a>
                        
                        </span>
                        </dt>
                        
                        <!-- 菜类 -->
                        <!-- <dd id="i1" class="active leftmenu-item"><a href="#">热门菜品</a></dd> -->
                        
                        <?php foreach($res2 as $val): ?>
                        <dd id="i<?php echo $val['cid']; ?>" class="leftmenu-item"><a href="#"><?php echo $val['dishes_name']; ?></a></dd>
                        <?php endforeach; ?>

                    </dl> 

            </div>
            
<!------------ 购物车展示 ------------>

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
                    <div class="bottom-price fl">总计：￥<label></label>
                    </div>
                    <div class="bottom-icon"></div>
                    <div class="bottom-pay fr">
                        <a id="cart-pay">结算</a>
                    </div>
                </div>
           </div>

        



<!------------------- 结算结算结算结算结算结算结算结算v结算 ---------------------------->

           <script>
                
                $('#cart-pay').click(function(event) {
                    // return false;
                    var userId=$.cookie('userId');
                    var shop_id = $.cookie('shopId');//店铺id
                    // var item = $.cookie('cart'+shop_id);//订单json数据格式信息
                   
                    if(userId){ //已登录
                        // 把shop_id带过去
                     // console.log($.cookie('cart'+shop_id));
                    var item = $.cookie('cart'+shop_id);//订单json数据格式信息
                    var total_price = $(".bottom-price label")[0].innerText;//总价         
                    var username = $.cookie('userId');//用户名，即手机号
                    // console.log(item);return;
                    
                    var params = {
                        item:item,
                        total_price:total_price,
                        shop_id:shop_id,
                        username:username
                    };
                    $.post(
                            "/index/Order/order_info",
                             params,
                            function(data){
                                 location.href="<?php echo url('/index/Order/order_confirm', ['shop_id'=>$res['shop_id']]); ?>";
                            }
                        );

                    }else{ 
                        $.removeCookie('cart'+shop_id,{expires:7,path:'/'});//删除未登录之前的
                        //未登录跳出登录页面（自动绑定点击事件）
                        $('#header-login').trigger('click');
                    }
                });
           </script>
<!------------------- 结算结算结算结算结算结算结算结算v结算 ---------------------------->
        
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
                    <label class="field-name">手机号:</label>
                    <input id="phone-1" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="login-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield">
                    <label class="field-name">密码:</label>
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
                    <label class="field-name">手机号:</label>
                    <input id="phone-2" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="register-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield field-confirm-code">
                    <label class="field-name">验证码:</label> 
                    <input   id="register-confirm-code" placeholder="请输入验证码">
                    <button id="register-code" class="phone-code-btn">获取验证码</button>
                    <input type="hidden" id="register-hid-code">
                    <div class="loginformfield-code-hint form-error">
                        <span id="register-code-error"></span>
                    </div>
                </div> 
                <div class="loginformfield">
                    <label class="field-name">请输入密码:</label> 
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
                    <label class="field-name">手机号:</label>
                    <input id="phone-3" placeholder="请输入您的手机号">
                    <div class="loginformfield-hint form-error">
                        <span id="chpwd-phone-error"></span>
                    </div>
                </div>
                <div class="loginformfield field-confirm-code">
                    <label class="field-name">验证码:</label> 
                    <input  id="chpwd-confirm-code"  placeholder="请输入验证码">
                    <button id="chpwd-code" class="phone-code-btn">获取验证码</button>
                    <input type="hidden" id="chpwd-hid-code">
                    <div class="loginformfield-code-hint form-error">
                        <span id="chpwd-code-error"></span>
                    </div>
                </div> 
                <div class="loginformfield">
                    <label class="field-name">新密码:</label> 
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

     <!--提示框-->
        <div id="alertModel" class="alertModel" >
        <a id="alert" data-reveal-id="alertModel" data-animation="fade"></a>
        <span id="alert-msg"></span>
        <button id="btn-ok" class="btn">知道了</button>
        <a id="btn-close" class="close-reveal-modal"><img src="__IMG_PATH__/icon_close.png" height="24" width="24"></a>
        </div>


    <script src="__JS_PATH__md5.js"></script>
    <script src="__JS_PATH__myinfo.js"></script>
    <script src="__JS_PATH__shopinfo.js"></script>
    <script src="__JS_PATH__login.js"></script>   
    <script src="__JS_PATH__cart.lib.js"></script>
    <script src="__JS_PATH__cart.js"></script>
    <script src="__JS_PATH__header.js"></script>
    <script src="__JS_PATH__shop.js"></script>

    <script>
 //---===================初始化购物车-====================================//

        $(function(){ 


        cartStart();

        function cartStart(){ 

        var shop_id=$.cookie('shopId');
        var username = $.cookie('userId');

        $.post(
            '/index/Order/init_info',
            {shop_id:shop_id, username:username},
            function(data){
                
                //如果返回空数据
                if(data == '[]')
                {
                    // console.log(typeof(data));return;
                }else{
                    $('.isnull').hide();//隐藏空的话语

                    var data = $.parseJSON(data); //一条数据
                    var item = $.parseJSON(data[0].item); //Array [ Object, Object ]
                    var total_price = data[0].total_price;

                    for(var i=0; i<item.length; i++)
                    {
                        var itemId = item[i].itemId;
                        var name = item[i].name;
                        var count = item[i].count;
                        var price = item[i].price;
                        var price2 = price*count; //单价*个数

                        var htmlTxt="<div class='shop-item-wrap'>"
                        +"<div class='shop-item' item-id='"+itemId+"'>"
                        +"<div class='item-name fl'>"
                        +name
                        +"</div>"
                        +"<div class='item-count fl'>"
                        +"<button class='minus'>-</button>"
                        +"<input type='text' value='"+count+"' "
                        +"readonly='readonly' maxlength='3'>"
                        +"<button class='plus'>+</button>"
                        +"</div>"
                        +"<div class='item-price fl' per-price='"+price+"'>"
                        +"￥<label>"+price2+"</label> "
                        +"</div>"
                        +"</div>"
                        +"</div>";

                        $('.shop-body').append(htmlTxt); 

                    }

                    // processShopItem(); //适配好购物车css
                    // $('.bottom-price').text("总计：￥");
                    // $('.bottom-price').append("<label>"+total_price+"</label>");
                    // // $('.isnull').hide();
                    // $('.bottom-price').css("width","65%");
                    // $('.bottom-pay').show();//显示"结算"
                    
                    // 计算总价
                    setTotalPrice();
                  }
                    
                } 
            );//$.post

            }
         
        });
            

 //---===================初始化购物车-====================================//
    </script>

<!-- 收藏区 -->
     <script>
    $(function(){
        var userId = $.cookie('userId');
        if(!userId){
            $('#sc_1').show();
            $('#sc_2').hide();
        }

    // 初始化收藏
    init_sc();
    function init_sc()
    {
        var $username = $.cookie('userId');

        var $shop_id = $.cookie('shopId');
        $postUrl = '/index/ShopCollect/select_sc';
        $.post(
            $postUrl,
            {username:$username, shop_id:$shop_id},
            function(data){
                
                $res = $.parseJSON(data);
                if($res.code == 0)
                {
                    $('#sc_2').show();
                    $('#sc_1').hide();
                }else{
                     $('#sc_2').hide();
                     $('#sc_1').show();
                }
            }
        );
    }

    // 收藏
    $('#sc_1').click(function(){
        var $shop_id = $.cookie('shopId');
        var $username = $.cookie('userId');
        if(!$username){
             //未登录跳出登录页面（自动绑定点击事件）
             $('#header-login').trigger('click');
             return;
        }

        $postUrl = '/index/ShopCollect/shoucang';
        $.post(
            $postUrl,
            {shop_id:$shop_id, username:$username},
            function(data){
                $res = $.parseJSON(data);
                if($res.code == 0){
                    showAlert("收藏成功");
                    $('#sc_1').hide();
                    $('#sc_2').show();
                }else{
                    showAlert('服务器出错')
                }
            }
        );
    });

    //取消收藏
    $('#sc_2').click(function(){
        var $shop_id = $.cookie('shopId');
        var $username = $.cookie('userId');

         if(!$username){
             //未登录跳出登录页面（自动绑定点击事件）
             $('#header-login').trigger('click');
             return;
        }

        $postUrl = '/index/ShopCollect/cancel_shoucang';
        $.post(
            $postUrl,
            {shop_id:$shop_id, username:$username},
            function(data){
                $res = $.parseJSON(data);
                if($res.code == 0){
                    
                    $('#sc_1').show();
                    $('#sc_2').hide();
                    showAlert("取消收藏成功");
                }else{
                    showAlert('服务器出错')
                }
            }
        );
    });

function showAlert(msg,url){ 
    $("#alert").trigger('click');
    $("#alert-msg").html(msg);
     
     if(url){
        $("#btn-ok,#btn-close").click(function(event) {
            window.location.href=url;
        });
     }                        
}
});
</script>


 
<!-- 评论区 -->
    <script>
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
                    
        $('#commit').click(function(e){

              //阻止url默认跳转
              if ( e && e.preventDefault)
              {
                e.preventDefault(); 
              }else{
                window.event.returnValue = false;  

              } 

            $('.content-middle').hide();
            $('.pl').show();

            var zw=$(window).width(); 
            var shopCartWidth=$('.shop-cart').width();
            var leftMenuWidth=$('.leftmenu').width();

            // console.log(leftMenuWidth);
            var mw=zw-shopCartWidth-leftMenuWidth;  
            $(".pl").width(mw);
            $(".pl").css("margin-left",leftMenuWidth);

            // $(".pl-1").css("padding-left",leftMenuWidth-50);
            $('.pl-1').width(mw);

            // return false;
        });
    </script>

    <style>
        .pl{
            margin:0 auto;
        }
        .pl-1{
            margin-top: 110px;
        }
    </style>


    <script>
	    $(function(){ 

	        //存商家信息到cookie
	        var shopId=$('.shop-name').attr('shopId');
	        var shopName=$('.shop-name').attr('shopName');
	        var shopPhone=$('.shop-name').attr('shopPhone'); 
	        $.cookie('shopId',shopId,{expires:365,path:'/'});//写cookie 



            $('.shop-cart').show(); 
	        //左侧导航
	        var zh=$(window).height();//浏览器当前窗口可视区域高度 
	        // var zh=$(document).height();//浏览器当前窗口文档的高度 

	        var leftHeight=zh-55;
	        $(".leftmenu").height(leftHeight);

	        //公告宽度
	        processGonggao();

	        //菜品div宽度
	        processMenuItems();


	        //购物车宽度
	        var shopCartWidth=$(".shop-cart").width(); 

	        //默认隐藏购物车
	        $(".shop-cart,.shop-bottom").css("right",-shopCartWidth); 
	        var mRight=-shopCartWidth;
	        
	        //点击弹出购物车
	        // $("#cart").click(function(){
	        //     out();
	        // });

	        //添加了商品也会弹出(但是不会缩回去，除非是点击顶部的购物车)
	        // $('.buy').click(function(){ 	
	        //     mRight = '0px';
	        //     $(".shop-cart,.shop-bottom").animate({right:mRight},200);
	       	
	        // });

	        // 购物车弹出
	        // function out()
	        // {
	        	$('.shop-cart').show(); 
	            //适配购物车
	            processShopItem();

	                 
	            if(mRight=='0px'){
	                mRight=-shopCartWidth;
	                $(".shop-cart,.shop-bottom").animate({right:mRight},200);
	            }
	            else{
	                mRight='0px';
	                $(".shop-cart,.shop-bottom").animate({right:mRight},200);
	            }
	        // }


	        //购物车,在cart.js文件
	        // processShopItem();


	        $('.gonggao').show();


	        //进来先隐藏评论，菜单显示
	        $('.pl').hide();
	        $('.content-middle').show();
	       

	       //如果点击评论，隐藏菜品内容，显示评论


	        //监听窗口尺寸
	        $(window).resize(function(){
	            //设置左侧的高
	            var zh=$(window).height(); 
	            var leftHeight=zh-55;
	            $(".leftmenu").height(leftHeight);

	            //公告宽度
	            processGonggao();

	            //菜品div宽度
	            processMenuItems();

	            //购物车
	            processShopItem();
	            
	        });

	        
            //左侧点击
            $('.leftmenu-item a').click(function(){
                $('.content-middle').show();
                // 评价隐藏
                $('.pl').hide();

                //变样式
                $(this).parents('.leftmenu').find('.leftmenu-item').removeClass('active');
                $(this).parent().addClass('active');

                

                //变菜品
                var i=$(this).parents('dd').attr('id');//找到id值
                $('.menu-wrap').hide();
                var m="#"+i.replace('i','m'); 
                $(m).fadeIn(600);
            });

	        
	        //菜品相关
	        function processMenuItems(){
	            var zw=$(window).width(); 
	            var shopCartWidth=$('.shop-cart').width();
	            var leftMenuWidth=$('.leftmenu').width();
	            var mw=zw-shopCartWidth-leftMenuWidth;  
	            $(".content-middle").width(mw);
	            $(".content-middle").css('left', leftMenuWidth);
	            $(".menu-wrap").width(mw);

	            var percent='47%';
	            var marginLeft=0;  

	            if(mw>=700){
	                percent='48%';
	                marginLeft=mw-mw*0.48*2; 
	                if(zw<1240){
	                    $(".stars").css('bottom', 40);
	                    $(".price").css('left', 140);
	                    // $(".buy").css('left', 180);
	                    $(".price").css('right', '');
	                    $(".buy").css('right', 10);
	                }else{
	                    //样式归位
	                    $(".stars").css('bottom', 5);
	                    $(".price").css('left', '');
	                    // $(".buy").css('left', '');
	                    $(".price").css('right', 50);
	                    $(".buy").css('right', 10);
	                }
	            }
	            else if(mw<700){
	                percent='96%';
	                marginLeft=mw-mw*0.86;
	                
	                if(zw<660){
	                    $(".stars").css('bottom', 40);
	                    $(".price").css('left', 140);
	                    // $(".buy").css('left', 180);
	                    $(".price").css('right', '');
	                    $(".buy").css('right', 10);
	                }else{
	                    //样式归位
	                    $(".stars").css('bottom', 5);
	                    $(".price").css('left', '');
	                    // $(".buy").css('left', '');
	                    $(".price").css('right', 50);
	                    $(".buy").css('right', 10);
	                }
	            }

	            // 这里直接改成了46%，不知问题是否可以
	            $(".menu-item").css('width', "46%");
	            $(".item-wrap").css('margin-left', marginLeft);

	             
	        }

	        //公告宽度
	        function processGonggao(){ 
	            var zw=$(window).width();
	            var shopCartWidth=$('.shop-cart').width();
	            var leftMenuWidth=$('.leftmenu').width();
	            var gw=zw-shopCartWidth-leftMenuWidth-40; 
	            var gw_wrap=gw+50;
	            $(".gonggao").width(gw); 
	            $(".gonggao").css('left', leftMenuWidth+10);
	            $(".gonggao-wrap").width(gw_wrap); 
	            $(".gonggao-wrap").css('left',leftMenuWidth );
	        }



 
            });

        
    </script>

</body>
</html>

