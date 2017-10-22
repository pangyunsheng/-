<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User as UserModel;
use lib\Verify;
use think\Session;

class Index extends Controller
{
	protected $user;

	protected function _initialize()
	{
		$this->user = new UserModel();
	}
	//首页
	public function index()
	{
		return $this->fetch();
	}

	// 登录
	public function login()
	{
		// return Request::instance()->post();
		
		//来到这里证明有网络，status='success'
		//data,status,code
		$post = input();
		// dump(Session::get());
		// dump($_COOKIE);die;
		// $user = new UserModel();
		$res = $this->user->select($post);
		// dump($res[0]['password']);die;
		//如果用户名不存在
		if(!$res)
		{
			return json_encode(['code'=>'1', 'status'=>'success']);
		}else{
			
			//用户名存在判断密码正确与否
			if($post['password'] != $res[0]['password'])
			{
				return json_encode(['code'=>'2', 'status'=>'success']);
			}else{
				return json_encode(['code'=>'0', 'status'=>'success']);
			}
		}

	}

	//退出登录
	public function logout()
	{
		return json_encode(['code'=>'0','status'=>'success']);
	}

	//获取手机验证码
	public function yzm()
	{
		//获取手机号
		$phone = input();
		// $phone['username'] = '15767976873';
		$res = $this->user->select($phone);
		if($res)
		{
			//手机号已存在
			return json_encode(['code'=>'1', 'status'=>'success']);
		}else{
			//获取到验证码
			$code = new Verify();
			$verify = $code->code($phone['username']);
			return json_encode(['code'=>'0', 'status'=>'success', 'verify'=>"$verify"]);
		}
	}

	//获取手机验证码--忘记密码
	public function yzm_forget()
	{
		//获取手机号
		$phone = input();
		// $phone['username'] = '15767976873';
		$res = $this->user->select($phone);
		if($res)
		{
			//手机号已存在
			//获取到验证码
			$code = new Verify();
			$verify = $code->code($phone['username']);
			return json_encode(['code'=>'1', 'status'=>'success', 'verify'=>"$verify"]);
		}else{			
			return json_encode(['code'=>'0', 'status'=>'success']);
		}
	}

	//忘记密码，更新密码
	public function update_pwd()
	{
		$post = input();
		$res = $this->user->upd($post);
		if($res)
		{
			return json_encode(['code'=>'0', 'status'=>'success']);
		}else{
			return json_encode(['status'=>'fail']);
		}
	}

	//注册
	public function register()
	{
		//注册信息插入数据库
		$post = input();

		$res = $this->user->select($post);

		if($res)
		{
			//用户存在
			return json_encode(['code'=>'1', 'status'=>'success']);
		}else{
			//不存在在插入进去
			$row = $this->user->add($post);
			if($row)
			{
				return json_encode(['code'=>'0', 'status'=>'success']);
			}else{
				//服务器问题
				return json_encode(['code'=>'2', 'status'=>'success']);
			}
		}
	}
}