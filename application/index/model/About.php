<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\ShopList as ShopListModel;
use app\index\model\ShopCate;
class About extends Model
{
	// 查找分类
	public function select()
	{
		return Db::table('dfz_shop_cate')->select();
	}
}