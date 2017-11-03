<?php
namespace app\shopadmin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\shopadmin\model\ShopCate;
use app\shopadmin\model\DishesCate;


/*=================商品管理===================*/
class Dishes extends Model
{

	use SoftDelete;
	protected $deleteTime = 'delete_time';

	//添加商品
	public function add($data)
	{	
		$list = ['meal_name'=>$data[0]['meal_name'],
				'cid'=>$data[0]['cid'],
				'meal_price'=>$data[0]['meal_price'],
				'meal_pic'=>$data[1],
				'shop_id'=>$data[2]['name'],
				];
		return Db::table('dfz_dishes')->where('shop_id',$data[2]['name'])->saveAll($list);
		
	}

	
	// 查找对应店铺的所有商品
	public function sel($data)
	{
		// $data是shop_id
		return Db::table('dfz_dishes')
		->join('dfz_dishes_cate','dfz_dishes.cid=dfz_dishes_cate.cid')
		->where('dfz_dishes_cate.shop_id',$data['name'])
		->where('dfz_dishes.delete_time',null)
		->paginate(10);
	}


	// 删除商品  软删除
	public function del($data)
	{	
		$dishe = model('Dishes');
		return $dishe::destroy($data['mid']);
	}

	// 查询要修改的商品
	public function cate($data)
	{	

		return Db::table('dfz_dishes')
		->join('dfz_dishes_cate','dfz_dishes.cid=dfz_dishes_cate.cid')
		->where('dfz_dishes.mid',$data['mid'])
		->select();
	}

	// 查询所有分类
	public function allcate($shop_id)
	{
		return Db::table('dfz_dishes_cate')
		->where('shop_id', $shop_id)
		->select();
	}


	public function editp($data)
	{
		$upd = new Dishes;
		return $upd->save([
		'meal_name' => $data[0]['meal_name'],
		'meal_price' => $data[0]['meal_price'],
		'meal_pic'=>$data[1]
		],['mid' => $data[0]['mid']]);

	}

	// 查找商家的信息  信息统计

	public function chaxun($data)
	{
		return Db::table('dfz_dishes')->alias('a')
		->join('dfz_dishes_cate b', 'a.cid = b.cid')
		->where('b.shop_id',$data['name'])
		->paginate(6);
	}

	public function count($data)
	{

		return Db::table('dfz_dishes')->alias('a')
		->join('dfz_dishes_cate b', 'a.cid = b.cid')
		->where('b.shop_id',$data['name'])
		->sum('a.meal_sell_num');
	}


}