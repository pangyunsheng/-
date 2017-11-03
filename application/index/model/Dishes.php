<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\DishesCate;
use app\index\model\ShopList;

class Dishes extends Model
{
	public function cai($shop_id)
	{
		// 找到菜类cid
		$dish_cate = new DishesCate();
		$c = Db::name('dishes_cate')->where('shop_id', $shop_id)->field('cid')->select();
		$cid = [];
		foreach($c as $val)
		{
			$cid[] = $val['cid'];
		}
		// return $cid;
		$map['cid'] = array('in',$cid);

		//根据菜类cid得到其下面的各种菜品
		$res = Db::name('dishes')->where($map)->select();

		return [$c, $res];
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

	//模糊查询店名和菜名
	public function keyword($meal_name)
	{
		$res = Db::name('dishes')
		->where('meal_name', 'like', "%$meal_name%")
		->select();

		$mid = [];
		foreach($res as $val)
		{
			$mid[] = Db::table('dfz_dishes')->alias('a')
			->join('dfz_dishes_cate b', 'a.cid = b.cid')
			->field('a.meal_name, b.shop_id')
			->where('a.mid', $val['mid'])
			->select();

			// $cid[] = Db::name('dishes_cate')->where('cid', $val['cid'])->field('shop_id')->select();			
		}
		// dump($mid);
		return $mid;
	}
}