<?php
namespace app\shopadmin\model;
use think\Model;
use think\Db;

class ShopList extends Model
{

	public function select($data)
	{
		return Db::table('dfz_shop_list')
		->where('shop_tel',$data['qwe'])
		->field('shop_name,shop_tel,shop_id')
		->select();
	}

	// 查找店铺资料
	public function seek($data)
	{
		return Db::table('dfz_shop_list')->where('shop_id',$data['name'])->select();
	}

	//修改店铺信息
	public function upd($data)
	{
		return Db::table('dfz_shop_list')->where('shop_id',$data['shop_id'])->update($data);
	}

	//店铺状态，开店，闭店
	public function shop_state($shop_id)
	{
		return Db::name('shop_list')
		->where('shop_id', $shop_id)
		->field('shop_state')
		->select();
	}

	//店主修改店铺状态，开店，闭店
	public function upd_shop_state($shop_id, $shop_state)
	{
		return Db::name('shop_list')
		->where('shop_id', $shop_id)
		->update(['shop_state'=>$shop_state]);
	}
}