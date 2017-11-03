<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\admin\model\ShopCate;

class ShopList extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	

	// 删除店铺，这里执行的是软删除

	public function delshop($data)
	{
		
		return ShopList::destroy($data['shop_id']);
	}


	// 查找所有店铺
	public function selshop()
	{
		return Db::table('dfz_shop_list')->field('shop_name,shop_id')->where('delete_time',null)->select();
	}


	// 查找所有还没有通过申请的商家
	public function selectshop()
	{
		
		return Db::table('dfz_shop_list')
		->join('dfz_shop_cate','dfz_shop_list.shop_mode_id= dfz_shop_cate.all_cate_id')
		->where('dfz_shop_list.status=1')//status = 1表示申请还未通过
		->select();
	}

	// 查找一家未入驻的商家
	public function slshop()
	{
		return Db::table('dfz_shop_list')
		->join('dfz_shop_cate','dfz_shop_list.shop_mode_id= dfz_shop_cate.all_cate_id')
		->where('dfz_shop_list.status=1')
		->order('dfz_shop_list.shop_id','asc')
		->limit(1)
		->select();
	}


	// 添加店铺，其实是把数据表中status改成0
	public function addshop($data)
	{
		$shop = new ShopList;
		// save方法第二个参数为更新条件
		$shop->save([
		'status' => '0'
		],['shop_id' => $data['shop_id']]);
	}


	// 查找一家已经入驻的商家
	public function seleshop()
	{
		return Db::table('dfz_shop_list')
		->field('shop_id,shop_tel,shop_name,shop_keeper')
		->limit(1)
		->select();
	}



	// 查找要修改的店铺
	public function searchedit($data)
	{
		return Db::table('dfz_shop_list')->where('shop_id',$data['shop_id'])->select();
	}


	// 店铺列表

	public function listshop()
	{
		return Db::table('dfz_shop_list')
		->join('dfz_shop_cate','dfz_shop_list.shop_mode_id=dfz_shop_cate.all_cate_id')
		->where('dfz_shop_list.delete_time',null)
		->where('dfz_shop_list.status','0')
		->paginate(5);
	}

}