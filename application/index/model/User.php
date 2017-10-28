<?php
namespace app\index\model;
use app\index\model\Order;
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

	//更新
	public function upd($data)
	{
		return Db::name('user')->where('username', $data['username'])->update(['password'=>$data['password']]);
	}

	//取积分
	public function get_jifen($post)
	{
		return Db::name('user')->where('username', $post['username'])->field('jifen')->select();
	}

	//取到积分和总价
	public function get_two($post)
	{
		$username = $post['username'];
		$shop_id = $post['shop_id'];

		return Db::table('dfz_user')->alias('a')->join('dfz_order b', 'a.username = b.username')
		->field('a.jifen, b.total_price')
		->where('b.username', $username)
		->where('b.shop_id', $shop_id)
		->where('b.order_status', 0)
		->select();
	}

	//提交订单后更新积分
	public function upd_jifen($username, $jifen)
	{
		return Db::name('user')
		->where('username', $username)
		->update(['jifen'=>$jifen]);
	}
}
