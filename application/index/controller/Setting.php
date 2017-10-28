<?php
namespace app\index\controller;
use think\Controller;

class Setting extends Controller
{
	//账号设置
	public function setting()
	{
		return $this->fetch();
	}
}