<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Validate;
use  \think\Session;
use app\admin\model\Admin;
use app\admin\model\ShopLists;
use think\Db;

class Index extends Controller
{	
	protected $admin;

	protected function _initialize()
	{
		$this->admin = new Admin();
	}


	// 管理员后台首页展示
	public function index()
	{	
		$count = Db::table('dfz_shop_list')->where('status','1')->count('shop_id');
		// 获取正在操作后台的管理员
		$post = input();
		if (empty($post)) {
			abort(404,'页面不存在');
		}
		$res = $this->admin->selectadmin($post);
		$res1 = session('admin_id',$res[0]['id'],'thinkphp');
		
		$this->assign('res',$res);
		$this->assign('count',$count);
		return $this->fetch();
	}

}