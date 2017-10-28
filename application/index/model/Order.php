<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Order extends Model
{
	//插入数据
	public function add($post)
	{
		return Db::name('order')->insert($post);
	}

	//查询某个人在某一家店订单未支付的
	public function status($shop_id, $username)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_id')
				->select();
	}

	//修改未支付的订单
	public function upd($shop_id, $username, $post)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->update($post);
	}

	//初始化购物车
	public function cart($shop_id, $username)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('item, total_price')
				->select();
	}

	//存收货地址
	public function address($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		$order_phone = $post['order_phone'];
		$order_name = $post['order_name'];
		$order_address = $post['order_address'];

		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->update(['order_phone'=>$order_phone, 'order_name'=>$order_name, 'order_address'=>$order_address]);
	}

	//取收货地址
	public function get_address($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_name, order_phone, order_address')
				->select();
	}

	//订单提交。写入信息，更新订单状态为1
	public function commit_upd($post)
	{
        $username = $post['username'];
        $shop_id = $post['shop_id'];
        $sf_price = $post['sf_price'];
        $order_arrived_time = $post['order_arrived_time'];
        $order_liuyan = $post['order_liuyan'];
        $order_time = $post['order_time'];

        return Db::name('order')
        	->where('shop_id', $shop_id)
			->where('username', $username)
			->where('order_status', 0)
			->update(['sf_price'=>$sf_price, 'order_arrived_time'=>$order_arrived_time, 'order_liuyan'=>$order_liuyan, 'order_status'=>1, 'order_time'=>$order_time]);
	}

	//清空购物车
	public function kong_cart($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_name, order_phone, order_address')
				->delect();
	}

	//查找最新下订单所有信息
	public function new_order($username)
	{
		return Db::table('dfz_order')->alias('a')->join('dfz_shop_list b', 'a.shop_id = b.shop_id')
		->field('a.*, b.shop_tel')
		->where('a.order_status', 1)
		->where('a.username', $username)
		->order('order_time desc')
		->limit(1)
		->select();

	}

}