<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;



class ShopCate extends Model
{	
	// 查找
	public function select()
	{	
		return Db::name('shop_cate')->select();
	}

		
	// 添加
	public function add($data)
	{	
		 return Db::name('shop_cate')->insert($data);
	}


	public function upd($data)
	{
		return Db::name('shop_cate')->where('all_cate_id',$data['a'])->update(['cate_name'=>$data['cate_name'],'weight'=>$data['weight']]);
	}

	// 删除
	public function del($data)
	{
		ShopCate::destroy($data);
	}

	// public function dishes()
	// {
	// 	return $this->hasMany('Dishes','mid','all_cate_id');
	// }

}