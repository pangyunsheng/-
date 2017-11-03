<?php
namespace app\index\model;

use think\Model;
use think\Db;

class Admin extends Model
{
	//判断是否显示后台管理
	public function pd_user($username)
	{
		return Db::name('admin')
		->where('phone', $username)
		->field('id')
		->select();
	}
}