<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\DishesCate;

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
}