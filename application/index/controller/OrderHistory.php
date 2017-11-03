<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Order;

class OrderHistory extends Controller
{
	protected $order;
	protected function _initialize()
	{
		$this->order = new Order();
	}

	//历史订单
	public function scan_history()
	{
		$post = input();
		$username = input('param.username');
		$row = $this->order->all_order($post);
		$res = $row[0];
		$page = $row[1];
		// dump($row);die;

		$item = [];//订单信息
		$jifen = [];//积分抵现
		foreach($res as $key=>$val)
		{
			$item[$key] = json_decode($val['item'], JSON_UNESCAPED_UNICODE); //第二个参数是数组形式
			$jifen[$key] = $res[$key]['total_price'] - $res[$key]['sf_price'];
		}
		// dump($item);die;

	
		// dump($jifen); 
		
		$this->assign('page', $page);//分页
		$this->assign('jifen', $jifen); 
		$this->assign('item', $item); //二维数组
		$this->assign('username', $username);
		$this->assign('res', $res);
		return $this->fetch();
	}


}