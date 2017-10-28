<?php
namespace app\index\controller;
use think\Controller;

class Jifen extends Controller
{
	//账号设置
	public function score()
	{
		return $this->fetch();
	}
}