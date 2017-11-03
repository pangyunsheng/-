<?php
namespace app\shopadmin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;


/*============订单管理================*/


class Order extends Model
{


	use SoftDelete;
	protected $deleteTime = 'delete_time';

	// 删除订单

	public function delor($data)
	{
		// $data是order_id
		return Order::destroy($data);
	}


	//查询历史订单

	public function sele($data)
	{	
		return Db::field('dfz_order.order_liuyan,dfz_order.order_phone,dfz_order.total_price,dfz_order.order_time,dfz_order.order_id,dfz_comment.xing_count')
		->table('dfz_order')
		->join('dfz_comment','dfz_order.order_id=dfz_comment.order_id')
		->where('dfz_order.shop_id',$data['name'])
		
		->where('dfz_order.delete_time',null)
		->order('order_time','desc')
		->paginate(10);




	}



	// 模糊查询

	public function searc($data)
	{
		return Db::field('dfz_order.order_liuyan,dfz_order.order_phone,dfz_order.total_price,dfz_order.order_time,dfz_order.order_id,dfz_comment.xing_count')
		->table('dfz_order')
		->join('dfz_comment','dfz_order.order_id=dfz_comment.order_id')
		->where('dfz_order.order_liuyan|dfz_order.order_phone|dfz_order.total_price|dfz_order.order_time|dfz_order.order_id','like',"%$data%")
		->order('order_time','desc')
		->paginate(10);
	}

	//查询新的订单
	public function newOrder($shop_id)
	{
		return Db::name('order')
		->where('shop_id', $shop_id)
		->where('order_status', 1)
		->where('order_cancel', 0)
		->order('order_time desc')
		->paginate(2);
	}

	//接单改状态
	public function upd_status($order_id, $jiedan_time)
	{
		//插入接单时间
		return Db::name('order')
		->where('order_id', $order_id)
		->update(['jiedan_time'=>$jiedan_time, 'jiedan_status'=>1]);
	}

	//拒单将字段jiedan_status变为2
	public function upd_status_2($order_id)
	{
		return Db::name('order')
		->where('order_id', $order_id)
		->update(['jiedan_status'=>2]);
	}

}