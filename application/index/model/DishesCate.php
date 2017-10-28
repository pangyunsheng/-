<?php
namespace app\index\model;
use think\Model;
use think\Db;

class DishesCate extends Model
{
	public function dishes($shop_id)
	{
		return Db::name('dishes_cate')->where('shop_id', $shop_id)->select();
	}
}
