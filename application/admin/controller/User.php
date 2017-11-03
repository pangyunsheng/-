<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;
use app\admin\model\User as UserModel;
use think\Request;
use think\Db;


class User extends Controller
{	
	protected $user;

	protected function _initialize()
	{
		$this->user = new UserModel();
	}
	// public function order()
	// {
	// 	return $this->belongsTo('Order','uid','uid');
	// }
	
	// 用户管理》查找用户
	public function listuser()
	{
		$res = $this->user->paginate(10);
		$page = $res->render();
		$this->assign('res',$res);
		$this->assign('page',$page);
		return $this->fetch();
	}


	// 修改用户信息
	public function edituser()
	{
		return $this->fetch();
	}


	// 删除用户
	public function deluser()
	{	
		$res = Request::instance()->param('id');

		$res1 = $this->user->upd($res);
		if ($res1) {
				header("Location:/admin/user/listuser");
			exit();
		} else {
				header("location:/admin/uer/listuser");
				exit();
		}
		
		
	
	}

}