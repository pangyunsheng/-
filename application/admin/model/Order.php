<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\admin\model\ShopList;
use app\admin\model\Comment;


/*============订单管理================*/


class Order extends Model
{


	use SoftDelete;
	protected $deleteTime = 'delete_time';



	// 删除订单

	public function delor($data)
	{
		return Order::destroy($data);
	}


	public function listorder()
	{
		return Db::field('dfz_order.order_id,dfz_order.order_phone,dfz_order.order_liuyan,dfz_order.order_time,dfz_order.sf_price,dfz_shop_list.shop_name,dfz_comment.xing_count')
		->table('dfz_order')
		->join('dfz_shop_list','dfz_order.shop_id=dfz_shop_list.shop_id')
		->join('dfz_comment','dfz_order.order_id=dfz_comment.order_id')
		->where('dfz_order.delete_time',null)
		->paginate(10);
	}


	public function searchorder($data)
	{
		return Db::field('dfz_order.order_id,dfz_order.order_phone,dfz_order.order_liuyan,dfz_order.order_time,dfz_order.sf_price,dfz_shop_list.shop_name,dfz_comment.xing_count')
		->table('dfz_order')
		->join('dfz_shop_list','dfz_order.shop_id=dfz_shop_list.shop_id')
		->join('dfz_comment','dfz_order.order_id=dfz_comment.order_id')
		->where('dfz_shop_list.shop_name|dfz_order.order_phone|dfz_order.order_liuyan|dfz_comment.xing_count','like',"%$data%")
		->paginate(10);
	}

}