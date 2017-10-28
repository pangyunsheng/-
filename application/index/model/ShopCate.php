<?php

namespace app\index\model;
use think\Model;
use think\Db;

class ShopCate extends Model
{
	public function select()
	{
		return Db::name('shop_cate')->select();
	}

	
}