<?php
namespace app\index\model;
use think\Model;
use think\Db;

class User extends Model
{
	
	public function select($data)
	{
		$username = $data['username'];
		// $pwd = $data->password;

		return Db::name('user')->where('username', $username)->select();
	}

	//添加
	public function add($data)
	{
		return Db::name('user')->insert($data);
	}
}