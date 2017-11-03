<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;
use app\admin\model\Order as Orders;
use think\Request;
use think\Db;

/*=======================订单管理=============*/
class Order extends Controller
{
	
	protected $order;

	protected function _initialize()
	{
		$this->order = new Orders();

	}



	//  历史订单
	public function listorder()
	{	
		$res = $this->order->listorder();
		$page = $res->render();
		
		$this->assign('res',$res);
		$this->assign('page',$page);
		return $this->fetch();
	}



	// 搜索订单
	public  function search()
	{	
		
		$post = input();
		if ($post) {

			// 展示搜索到的订单
			$res = $this->order->searchorder($post['value']);

			$page = $res->render();
			$this->assign('res',$res);
			$this->assign('page',$page);
			return $this->fetch();
		} else {

			// 展示全部订单
			$res = $this->order->listorder();
			// dump($res);
			$page = $res->render();
			$this->assign('res',$res);
			$this->assign('page',$page);
			return $this->fetch();
		}	
		
	}	

	// 删除订单
	public function delorder()
	{
		$post = input();

		$res = $this->order->delor($post);
		if ($res) {
			return json_encode(['code'=>'0','status'=>'success']);
		} else {
			return json_encode(['code'=>'1','status'=>'success']);
		}
		
	}

}