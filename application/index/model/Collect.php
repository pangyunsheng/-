<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Collect extends Model
{
	//添加
	public function add($post)
	{
		return Db::name('collect')->insert($post);
	}

	//删除
	public function del($post)
	{
		$username = $post['username'];
		$shop_id = $post['shop_id'];
		return Db::name('collect')->where('username', $username)->where('shop_id', $shop_id)->delete();
	}

	//查找店铺收藏
	public function search($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		return Db::name('collect')->where('shop_id', $shop_id)->where('username', $username)
		->select();
	}

}