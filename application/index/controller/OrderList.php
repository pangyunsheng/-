<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Order ;

class OrderList extends Controller
{
	protected $order;
	protected function _initialize()
	{
		$this->order = new Order();
	}

	//我的订单，最新一个
	public function order()
	{
		// $username = '15767976871';
		$username = input('param.username');
		$res = $this->order->new_order($username);

		//如果该用户没有下过订单
		if($res){
			$item = $res[0]['item'];//订单信息
			$item = json_decode($item, JSON_UNESCAPED_UNICODE); //第二个参数是数组形式
			$jifen = $res[0]['total_price'] - $res[0]['sf_price']; 
			$order_time = $res[0]['order_time']; //下单时间

			$this->assign('jifen', $jifen); //积分抵现
			$this->assign('item', $item); //二维数组
	    }
		// dump($res);die;

		
		$this->assign('username', $username);
		$this->assign('res', $res);
		return $this->fetch();
	}


	//顾客要取消订单
	public function orderCancel()
	{
		$post = input();
		$res = $this->order->cancel_order($post);
		$username = $res[0]['username'];
		//未开始送或者在送途中都可以取消订单
		if($res[0]['received']==0 || $res[0]['received']==1)
		{
			return json_encode(['status'=>'success', 'code'=>'0', 'username'=>$username]);
		}else{
			return json_encode(['status'=>'success', 'code'=>'1', 'username'=>$username]);
		}

	}

	//顾客催单
	public function urgeOrder()
	{
		$post = input();
		$res = $this->order->order_urge($post);
		$username = $res[0]['username'];
		$count = $res[0]['urge_count'];
		// dump($count);die;
		if($count < 2)
		{
			return json_encode(['status'=>'success', 'code'=>'0', 'username'=>$username]);
		}else if($count >= 2 && $count <=4){
			return json_encode(['status'=>'success', 'code'=>'1', 'username'=>$username]);
		}else{
			return json_encode(['status'=>'success', 'code'=>'2', 'username'=>$username]);
		}

	}
}