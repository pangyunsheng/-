<?php
namespace app\shopadmin\controller;
use think\Controller;
use think\Request;
use app\shopadmin\model\ShopList as ShopListModel;
use  \think\Session;
use app\shopadmin\model\Admin;


class Index extends Controller
{	


	protected $shop;
	protected $admin;

	protected function _initialize()
	{
		$this->shop = new ShopListModel();
		$this->admin = new Admin();
	}


	// 商家后台首页展示
	public function index()
	{	
		$post =  Request::instance()->param();
		$username = input('param.qwe');
		$shop_id = $this->admin->shopId($username);

		// dump( Session::get('shop_id','think'));

		$res = $this->shop->select($post);
		if (empty($post)) {
			abort(404,'页面不存在');
		}
		
		//shop_id
		Session::set('name',$res[0]['shop_id'],'think');

		//存店铺id进session
		// $res1 = Session::set('shop_id', $shop_id[0]['shop_id'],'think');

		if ($res) {
			$this->assign('res',$res);
		}

		return $this->fetch();
	}

}