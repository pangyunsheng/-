<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as Admins;
use app\admin\model\ShopList as ShopLists;
use think\Model;
use think\Request;
use think\Db;
use \think\session;
class Admin extends Controller
{	

	protected $admin;
	protected $shoplist;
	protected function _initialize()
	{
		$this->admin = new Admins();
		$this->shoplist = new ShopLists();
	}

	
	// 添加管理员页面
	public function addadmin()
	{	
	
		$res = $this->shoplist->seleshop();
		
		$this->assign('res',$res);
		return $this->fetch();
	}

	// 添加管理员

	public function add()
	{	

		$res = Request::instance()->param(true);
		$res1 = $this->admin->add($res);
		if ($res1) {
			header("Location:/admin/admin/listadmin");
			exit;
		}

	}

	// 修改管理员信息页面
	public function editadmin()
	{	

		$post = Request::instance()->session();
		$res = Request::instance()->param('eid');
		$res1 = $this->admin->seladmin($res);
		$this->assign('res1',$res1);
		return $this->fetch();
	}

	//修改管理员
	public function updadmin()
	{
		$res = Request::instance()->param(true);
		if ($res) {
			$res1 = $this->admin->updadmin($res);
			if ($res1) {
				
				header("refresh:0.5, url=/admin/admin/listadmin");
				exit("<script>alert('修改成功')</script>");
			}else{
				header("refresh:0.5, url=/admin/admin/listadmin");
				exit("<script>alert('修改成功')</script>");
			} 
		}
		
	
	} 

	// 管理员列表
	public function listadmin()
	{	
		$res = $this->admin->list();
		$page = $res->render();
		$this->assign('res',$res);
		$this->assign('page',$page);
		return $this->fetch();
	}


	// 删除管理员
	public function deladmin()
	{	
		$res = Request::instance()->param('did');

		$res1 = $this->admin->del($res);
		if ($res1) {
			echo "<script> alert('删除成功');location.href='/admin/admin/listadmin'; </script>"; 
			// header("location:/admin/admin/listadmin");
			exit();
		}
			
	}

}