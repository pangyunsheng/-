<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\admin\model\ShopList;
use app\admin\model\DishesCate;



/*=================商品管理===================*/
class Dishes extends Model
{

	use SoftDelete;
	protected $deleteTime = 'delete_time';

	//添加商品
	public function listpro()
	{	
		
		return Db::field('dfz_dishes.mid,dfz_dishes.meal_name,dfz_dishes.meal_price,dfz_dishes.meal_pic,dfz_dishes.create_time,dfz_shop_list.shop_name,dfz_dishes_cate.dishes_name,dfz_shop_list.shop_id')
		->table('dfz_dishes')
		->join('dfz_dishes_cate','dfz_dishes.cid=dfz_dishes_cate.cid')
		->join('dfz_shop_list','dfz_dishes_cate.shop_id=dfz_shop_list.shop_id')
		->where('dfz_dishes.delete_time',null)
		->paginate(10);
	}

	
	// 删除商品
	public function shanchu($data)
	{	
		 return Dishes::destroy($data);
	}


	public  function option($data)
	{	
		
		$pageParam = ['query' =>$data];
			return Db::field('dfz_dishes.mid,dfz_dishes.meal_name,dfz_dishes.meal_price,dfz_dishes.meal_pic,dfz_dishes.create_time,dfz_shop_list.shop_name,dfz_dishes_cate.dishes_name,dfz_shop_list.shop_id')
		->table('dfz_dishes')
		->join('dfz_dishes_cate','dfz_dishes.cid=dfz_dishes_cate.cid')
		->join('dfz_shop_list','dfz_dishes_cate.shop_id=dfz_shop_list.shop_id')
		->where('dfz_dishes.delete_time',null)
		->where('dfz_shop_list.shop_id',$data['shop_id'])
		->paginate(10,false,$pageParam);
	}


}