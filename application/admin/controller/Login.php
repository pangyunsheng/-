<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Validate;
use app\admin\model\User as Users;
use app\admin\model\Admin as Adminss;

class Login extends Controller
{


	protected $admin;

	protected function _initialize()
	{
		$this->admin = new Adminss();
	}
	// 商家后台登录

	public function login()
	{	
		return $this->fetch();
	}


	// 登录成功后跳转到后台
	public function admin()
	{	
		// 获取后台登录所填的信息
		$post =  Request::instance()->param();

		// 验证用户是否存在
		$res1 = $this->admin->checkuser($post);
		if (!$res1) {
			return json_encode(['code'=>'0','status'=>'success']);
		}

		// 验证密码是否正确
		$res2 = $this->admin->checkpwd($post);
		if (!$res2) {
			return json_encode(['code'=>'1','status'=>'success']);
		}

	
		// 验证验证码是否正确
		$validate = new Validate([
		'captcha|验证码'=>'require|captcha'
		]);
		$data = [
			'captcha' => input('post.code')
		];

		if(!$validate->check($data)){
			// 验证码不正确
			return json_encode(['code'=>'2','status'=>'success']);

		} else{
			$res3 = $this->admin->admin($post);
			if ($res3) {
				// 如果登录的是平台的管理员
				return json_encode(['code'=>'4','status'=>'success']);
			} else {
				// 商家
				return json_encode(['code'=>'3','status'=>'success']);
			}

			
		}


		
		


	}
}