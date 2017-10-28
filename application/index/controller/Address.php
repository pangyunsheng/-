<?php
namespace app\index\controller;
use think\Controller;

class Address extends Controller
{
	//账号设置
	public function address()
	{
		return $this->fetch();
	}
}