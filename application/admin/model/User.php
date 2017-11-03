<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class User extends Model
{	
	use SoftDelete;
	protected $deleteTime = 'delete_time';
/*====================管理员后台============================*/
	// 查找所有用户
	public  function select()
	{	
		return Db::name('user')->where('status','0')->where('user_type','0')->order('create_time')->select();
	}


	// 删除用户，更新一个字段
	public function upd($data)
	{



		return	User::destroy($data);
		// $user = new User;
		// // save方法第二个参数为更新条件
		// $user->save([
		// 'status' => '1'
		// ],['uid' => $data]);
		
	}

}