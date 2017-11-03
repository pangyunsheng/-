<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\User;

class Jifen extends Controller
{
	//账号设置
	public function score()
	{
		$username = input('param.username');
		$jifen = new User();
		$res = $jifen->score($username);
		
		$this->assign('res', $res);
		return $this->fetch();
	}
}