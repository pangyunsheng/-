<?php
namespace app\index\model;
use think\Model;
use think\Db;

class ShopList extends Model
{
	public function select()
	{
		$list = Db::name('shop_list')->paginate(8);
		$page = $list->render();
		return [$list, $page];
	}

	// 分类
	public function choose_shop($post)
	{
		//假设快食简餐对应的是1，找出所有餐馆经营有1的，还有按月销量等的sort
		$supcateId = $post['supcateId'];
		$sort = $post['sort'];
		// return $post;

		// $supcateId = '2';
		// $sort = 'monthlysale';

		//如果商家分类是全部，默认是$supcateId是0
		if($supcateId == '0')
		{
			if($sort == 'monthlysale')
			{
				$res = Db::name('shop_list')->order('shop_sell_sum', 'desc')->select();
			}elseif($sort == 'distance')
			{
				// 暂时未实现
				$res = Db::name('shop_list')->select();
			}elseif($sort == 'deliveryfloat')
			{
				$res = Db::name('shop_list')->where('shop_add_price', 0)->select();
			}
		
		}else{

			//月销量排序，距离排序，免配送费排序
			if($sort == 'monthlysale')
			{
				$res = Db::name('shop_list')->where('shop_mode_id', $supcateId)->order('shop_sell_sum', 'desc')->select();
			}elseif($sort == 'distance')
			{
				// 暂时未实现
				$res = Db::name('shop_list')->where('shop_mode_id', $supcateId)->select();
			}elseif($sort == 'deliveryfloat')
			{
				$res = Db::name('shop_list')->where('shop_mode_id', $supcateId)->where('shop_add_price', 0)->select();
			}
		}

		return $res;
	}


	//店铺详情信息
	public function detail_info($shop_id)
	{
		$res = Db::name('shop_list')->where('shop_id', $shop_id)->select();
		return $res;
	}
}