<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Order;

class OrderList extends Controller
{
	protected $order;
	protected function _initialize()
	{
		$this->order = new Order();
	}

	//账号设置
	public function order()
	{
		$username = input('param.username');
		$res = $this->order->new_order($username);
		$item = $res[0]['item'];
		$item = json_decode($item, JSON_UNESCAPED_UNICODE); //第二个参数是数组形式
		$jifen = $res[0]['total_price'] - $res[0]['sf_price'];
		// dump($jifen);die;

		$this->assign('jifen', $jifen); //积分抵现
		$this->assign('item', $item); //二维数组
		$this->assign('username', $username);
		$this->assign('res', $res);
		return $this->fetch();
	}
}