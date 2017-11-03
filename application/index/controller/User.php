<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User as UserModel;
use app\index\model\Admin;

class User extends Controller
{
	protected $user;
	protected $admin;
	protected function _initialize()
	{
		$this->user = new UserModel();
		$this->admin = new Admin();
	}

	//店铺收藏
	public function collect()
	{
		$username = input('param.username');

		$res = $this->user->df_collect($username);

		$this->assign('res', $res);
		return $this->fetch();
	}

	// //我的地址
	// public function address()
	// {
	// 	return $this->fetch();
	// }


	//账户设置的新密码
	public function new_pwd()
	{
		$post = input();
		$res = $this->user->upd_pwd($post);
		if($res == 'same')
		{
			return json_encode(['status'=>'success', 'code'=>2]); //密码未改动
		}else if($res == 0){
			return json_encode(['status'=>'success', 'code'=>1]); //密码有误
		}else{
			return json_encode(['status'=>'success', 'code'=>0]); //成功
		}
	}

	//插入姓名
	public function real_name()
	{
		$post = input();
		$res = $this->user->add_name($post);
		if($res)
		{
			return json_encode(['status'=>'success', 'code'=>0]);
		}else{
			return json_encode(['status'=>'success', 'code'=>1]);
		}
	}

	//判断是否显示后台管理
	public function hou_tai()
	{
		$username = input('param.username');
		$res = $this->admin->pd_user($username);
		if($res){
			return json_encode(['code'=>0, 'status'=>'success']);
		}else{
			return json_encode(['code'=>1, 'status'=>'success']);
		}
	}

}