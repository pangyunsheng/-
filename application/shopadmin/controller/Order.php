<?php
namespace app\shopadmin\controller;
use think\Controller;
use think\Model;
use app\shopadmin\model\Order as Orders;
use think\Request;
use app\shopadmin\model\ShopList;
use think\Db;
use \think\Session;


/*=======================订单管理=============*/
class Order extends Controller
{
	
	protected $order;

	protected function _initialize()
	{
		$this->orders = new Orders();

	}


	//  历史订单
	public function listorder()
	{	
		
		$post = Request::instance()->session();
		
		$res = $this->orders->sele($post);

		$page = $res->render();

		$this->assign('res',$res);
		$this->assign('page',$page);
		return $this->fetch();
	}


	// 接单管理页面
	public function moniterOrder()
	{	
		$shop_id = Session::get('shop_id','think');
		// dump($shop_id);
		$res = $this->orders->newOrder($shop_id);
		$item = [];
		foreach($res as $val)
		{
			$item[] = json_decode($val['item'], JSON_UNESCAPED_UNICODE); //第二个参数是数组形式
		}
		$page = $res->render();

		$this->assign('page', $page);
		$this->assign('item', $item);
		$this->assign('res', $res);
		return $this->fetch();
	}

	//接单改状态
	public function take_order()
	{
		$order_id = input('param.order_id');
		$jiedan_time = input('param.jiedan_time');
		$res = $this->orders->upd_status($order_id, $jiedan_time);
		if($res){
			return json_encode(['code'=>'0','status'=>'success']);
		}else{
			return json_encode(['code'=>'1','status'=>'success']);
		}
	}

	//拒单
	public function cancel_order()
	{
		$order_id = input('param.order_id');
		$res = $this->orders->upd_status_2($order_id);
		if($res){
			return json_encode(['code'=>'0','status'=>'success']);
		}else{
			return json_encode(['code'=>'1','status'=>'success']);
		}
	}


	// 删除订单
	public function delorder()
	{
		
		$post = input();
		$res = $this->orders->delor($post);
		if ($res) {
			return json_encode(['code'=>'0','status'=>'success']);
		} else {
			return json_encode(['code'=>'1','status'=>'success']);
		}

	}



		// 搜索订单
	public  function search()
	{	
		$post = input();
	
		if ($post) {
			$res = $this->orders->searc($post['value']);
			$page = $res->render();
			$this->assign('res',$res);
			$this->assign('page',$page);
			return $this->fetch();
		} else {

			$post1 = Request::instance()->session();
			$res = $this->orders->sele($post1);
			$page = $res->render();
			$this->assign('res',$res);
			$this->assign('page',$page);
			return $this->fetch();
		}

	}	

}