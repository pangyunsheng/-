<?php
namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use app\index\model\Order as OrderModel;//控制器和model重名的话要起别名

class Order extends Controller
{
	protected $order;
	protected $user;
	protected function _initialize()
	{
		$this->order = new OrderModel();
		$this->user = new User();
	}

	// 确定订单
	public function order_confirm()
	{

		return $this->fetch();
	}

	// 订单信息
	public function order_info()
	{
		$post = input();

		$shop_id = $post['shop_id'];
		$username = $post['username'];

		//查询支付状态
		$res = $this->order->status($shop_id, $username);
		if($res){
			//如果这个未支付，那就执行更新操作
			$this->order->upd($shop_id, $username, $post);
		}else{
			$this->order->add($post);
		}
		
	}

	// ajax请求，初始化购物车
	public function init_info()
	{
		$post = input();
		$shop_id = $post['shop_id'];
		$username = $post['username'];

		$res = $this->order->cart($shop_id, $username);
		// return json_decode($res[0]['item']);

		return json_encode($res, JSON_UNESCAPED_UNICODE); //有第二个参数才能将中文正常传到前台
	}

	//保存地址
	public function saveUserInfo()
	{
		$post = input();
		// return $post;
		$res = $this->order->address($post);//存

		if($res)
		{
			return ['status'=>'success', 'code'=>'0'];
		}else{
			return ['status'=>'success', 'code'=>'1'];
		}
	}

	//取地址
	public function getAddress()
	{
		$post = input();
		// return $post;
		$res2 = $this->order->get_address($post);//取
		return $res2;
	}

	//取积分
	public function jifen()
	{
		$post = input();
		return $this->user->get_jifen($post);
	}

	//减积分得实付价格
	public function pay_price()
	{
		$post = input();
		return $this->user->get_two($post);
	}

	//提交订单
	public function commitOrder()
	{
		
		$post = input();
		$jifen = input('param.jifen');
		$username = input('param.username');
		$res1 = $this->order->commit_upd($post);
		$res2 = $this->user->upd_jifen($username, $jifen);
		// return [$res1,$res2];
		if($res1)
		{
			return ['code'=>0, 'username'=>$username];
		}else{
			return ['code'=>1];
		}
	}

	//清空购物车，未支付的订单
	public function clear_cart()
	{
		$post = input();
		$this->order->kong_cart($post);
	}


}