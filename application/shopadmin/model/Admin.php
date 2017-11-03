<?php
namespace app\shopadmin\model;
use think\Model;
use think\Db;

class Admin extends Model
{
	//找对应的shop_id
	public function shopId($username)
	{
		return Db::name('admin')->where('phone', $username)->field('shop_id')->select();
	}
}