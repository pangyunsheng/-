<?php

namespace app\index\controller;
use think\Controller;
use app\index\model\About as AboutModel;
use think\Request;
use app\index\model\ShopList as ShopListModel;
use app\index\model\ShopCate;
use think\Db;

class About extends Controller
{	

	protected $about;
	protected $shop;
	protected $cate;
	protected function _initialize()
	{
		$this->about = new AboutModel;
		$this->shop = new ShopListModel;
		$this->cate = new ShopCate();
	}

	// 商家入驻页面
	public function enter()
	{	

		// 查找cate_list表中的所有分类
		$res = $this->cate->select();
		$this->assign('res',$res);
		return $this->fetch();
	}

	public function ruzhu()
	{	
		$post = input();

		// 查找店铺名是否已经存在
		$res =  Db::table('dfz_shop_list')->where('shop_name',$post['shop_name'])->select();
		$res2 = Db::table('dfz_shop_list')->where('shop_tel',$post['shop_tel']);
		if($res){
			// 店铺名称已存在
			return json_encode(['code'=>'0','status'=>'success']);
		} 	else {
			
			// 把入驻资料插入数据库
				$list = ['shop_name'=>$post['shop_name'],
					'shop_addr'=>$post['shop_addr'],
					// 'shop_keeper'=>$post['shop_keeper'],
					'shop_tel'=>$post['shop_tel'],
					'shop_mode_id'=>$post['shop_mode_id'],
					'status'=>'1',
					'shop_dispath'=>$post['shop_dispath']
					];
			$res1 = Db::table('dfz_shop_list')->insert($list);
			if ($res1) {
				// 插入成功
				return json_encode(['code'=>'1','status'=>'success']);
			} else {
				// 服务器问题
				return json_encode(['code'=>'2','status'=>'success']);
			}
		}
		
	}
	// 联系我们页面
	public function contact()
	{
		return $this->fetch();
	}

	// 关于我们页面
	public function aboutme()
	{
		return $this->fetch();
	}
	

	// 投诉意见页面
	public function complain()
	{
		return $this->fetch();
	}
	// 投诉意见
	public function tousu()
	{
		$post = input();


		return json_encode(['status'=>'success','code'=>'0']);
	}

	// 加入我们页面
	public function joinus()
	{
		return $this->fetch();
	}
}