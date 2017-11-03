<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\admin\model\ShopList;



/*================管理员管理===============*/
class Admin extends Model
{		

	use SoftDelete;
	protected $deleteTime = 'delete_time';

	// // 添加管理员
	public function addadmin($data)
	{	

		$list = ['phone'=>$data['shop_tel'],
				'shop_id'=>$data['shop_id']
		];
		return Db::name('admin')->insert($list);
	}


	// 查找需要修改的管理员
	public function seladmin($data)
	{
		return Db::name('admin')->where('id',$data)->select();
	}

	// 修改管理员

	public function updadmin($data)
	{
		return Db::name('admin')->where('id',$data['id'])->update($data);
	}


	// 软删除管理员
	public function del($data)
	{		
	return	Admin::destroy($data);
	}

	// 管理员列表
	public function list()
	{
		return Db::table('dfz_admin')->where('delete_time',null)->paginate(10);
	}



	/*====================后台登录============================*/
	// 查询该登录的商家账号是否存在
	public function checkuser($data)
	{	
		return Db::table('dfz_admin')
		->where('phone',$data['username'])
		->whereOr('realname',$data['username'])
		->find();
	}


	// 查询登录密码是否正确
	public function checkpwd($data)
	{
		return  Db::table('dfz_admin')
		->where('password',$data['password'])
		->where('phone',$data['username'])
		->whereOr('realname',$data['username'])
		->find();
		
	}

	// 查找平台管理员
	public function admin($data)
	{
		return  Db::table('dfz_admin')
		->where('password',$data['password'])
		->where('phone',$data['username'])
		->where('role_id','1')
		->whereOr('realname',$data['username'])
		->find();
	}

	// 查找正在操作的管理员

	public function selectadmin($data)
	{
		return Db::table('dfz_admin')
		->field('id,phone,realname')
		->where('phone',$data['qwe'])
		->where('role_id','1')
		->select();
	}
}