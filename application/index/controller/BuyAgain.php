<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Order;

class BuyAgain extends Controller
{
	protected $order;
	protected function _initialize()
	{
		$this->order = new Order();
	}

	//再买一次
	public function mai()
	{
		$post = input();
		$res = $this->order->add_mai($post);
		if($res == 0){
			return json_encode(['code'=>0]);
		}elseif($res == 1){
			return json_encode(['code'=>1]);
		}elseif($res ==2){
			return json_encode(['code'=>2]); //防止重复购买未确认订单的
		}
	}
}