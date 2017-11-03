<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;
use app\admin\model\Dishes;
use think\Db;
use think\Request;
use app\admin\model\ShopList as ShopListModel;

class Goods extends Controller
{

	protected $goods;
	protected $shop;

	protected function _initialize()
	{
		$this->goods = new Dishes();
		$this->shop = new ShopListModel();
	}

	
	// 展示商品列表页面
	public function listpro()
	{	$pageParam    = ['query' =>[]];

		$res = $this->goods->listpro();
		$page = $res->render();

		$res1 = $this->shop->selshop();

		$this->assign('res',$res);
		$this->assign('res1',$res1);
		$this->assign('page',$page);
		return $this->fetch();
	}


	// 删除商品
	public function delpro()
	{	
		// 获取要删除的mid
		$post = input();
		
		$res = $this->goods->shanchu($post['mid']);

		if ($res) {
			return json_encode(['code'=>'0','status'=>'success']);
		} else {
			return json_encode(['code'=>'1','status'=>'success']);
		}

	}

	// 选择option的选项查出对应的数据
	public function change()
	{

		$post = input();
		// return $post['shop_id'];
		// dump($post);
		if ($post['shop_id']!=0) {

			// 只显示对应的商品
			$res = $this->goods->option($post);
			$page = $res->render();
			$res1 = $this->shop->selshop();
			$this->assign('res',$res);
			$this->assign('res1',$res1);
			$this->assign('page',$page);
			return $this->fetch();

		} else if ($post['shop_id']==0){

			// 显示全部
			$res = $this->goods->listpro();
			$page = $res->render();
			$res1 = $this->shop->selshop();
			$this->assign('res',$res);
			$this->assign('res1',$res1);
			$this->assign('page',$page);
			return $this->fetch();
		}
		

	}

}

