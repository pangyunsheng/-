<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;
use app\admin\model\ShopList;
use think\Request;
use app\admin\model\ShopCate;
use app\admin\model\Admin as AdminModel;
use think\Db;
use \think\Session;


class Shop extends Controller
{	

	protected $shop;
	protected $admin;

	protected function _initialize()
	{
		$this->shop = new ShopList();
		$this->admin = new AdminModel();
	}


	// 展示添加商铺
	public function addshop()
	{	

		// 查找所有申请入驻的商家
		$res = $this->shop->selectshop();

		$res1 = $this->shop->slshop();
		if (empty($res1)) {
			return $this->fetch('shop');
		} else {

			// 统计还有多少商家还没有入驻
			$res2 = count($res);
			
			$this->assign('res',$res);

			$this->assign('res1',$res1);
			$this->assign('res2',$res2);

			return $this->fetch();
		} 
		
	}

	// 添加店铺
	public function addshops()
	{
		// 获取需要添加的店铺id
		$res = Request::instance()->param();

		$res1 = $this->shop->addshop($res);
		
		$res2 = $this->admin->addadmin($res);
		if($res1&&$res2){

			header("Location:/admin/shop/listshop");

			exit("<script>alert('添加成功')</script>");
		} else {
			header("Location:/admin/shop/listshop");
			exit;
		}
		
	}


	// 店铺列表
	public function listshop()
	{	
	
		$res = $this->shop->listshop();
		// 获取总页数
		$page = $res->render();

		$this->assign('res', $res);

		$this->assign('page', $page);

		return $this->fetch();

	}


	// 修改店铺信息
	public function editshop()
	{
		$res = Request::instance()->param();

		$res1 = $this->shop->searchedit($res);

		$this->assign('res1',$res1);

		return $this->fetch();
	}


	// 删除店铺
	public function delshop()
	{
		$res = Request::instance()->param();
		$res1 = $this->shop->delshop($res);

		if($res1){
			
			header("Location:/admin/shop/listshop");
			exit;
		} else {
			header("Location:/admin/shop/listshop");
			exit;
		}
	}



	// 店铺详情
	public function detail()
	{
		
		// 获取详情店铺的id
		$res = Request::instance()->param();
		
		// 获取店铺的所有信息
		$res[] = Db::table('dfz_shop_list','dfz_shop_cate')

		->join('dfz_shop_cate','dfz_shop_list.shop_mode_id=dfz_shop_cate.all_cate_id')

		->where('dfz_shop_list.shop_id',$res['id'])
		
		->find();

		$this->assign('res',$res);

		return $this->fetch();
		}
		
}