<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Order as OrderModel;

class Setting extends Controller
{
	protected $order;
	protected function _initialize()
	{
		$this->order = new OrderModel();
	}

	//账号设置
	public function setting()
	{
		$username = input('param.username');
		$res = $this->order->order_count($username);
		$res1 = $res[0]; //总单数
		$res2 = $res[1]; //成功数

		$this->assign('res1', $res1);
		$this->assign('res2', $res2);
		return $this->fetch();
	}
}