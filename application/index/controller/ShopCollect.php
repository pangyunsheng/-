<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Collect;

class ShopCollect extends Controller
{
	protected $collect;
	protected function _initialize()
	{
		$this->collect = new Collect();
	}

	//收藏店铺
	public function shoucang()
	{
		$post = input();
		$res = $this->collect->add($post);
		if($res)
		{
			return json_encode(['code'=>0]);
		}else{
			return json_encode(['code'=>1]);
		}
	}

	//取消收藏
	public function cancel_shoucang()
	{
		$post = input();
		$res = $this->collect->del($post);
		if($res)
		{
			return json_encode(['code'=>0]);
		}else{
			return json_encode(['code'=>1]);
		}
	}

	//查找店铺
	public function select_sc()
	{
		$post = input();
		$res = $this->collect->search($post);
		if($res)
		{
			return json_encode(['code'=>0]);
		}else{
			return json_encode(['code'=>1]);
		}
	}
}