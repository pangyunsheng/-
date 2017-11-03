<?php
namespace app\shopadmin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
use app\shopadmin\model\ShopCate;

class DishesCate extends Model
{

	use SoftDelete;
	protected $deleteTime = 'delete_time';
	// 分类列表
	public function dishescate($data)
	{
		return Db::table('dfz_dishes_cate')->where('delete_time',null)->where('shop_id',$data)->select();
	}

	// 根据id查找要修改的分类

	public function editcate($data)
	{
		return Db::table('dfz_dishes_cate')->where('cid',$data)->find();
	}

	// 修改分类
	public function edit($data)
	{
		return Db::table('dfz_dishes_cate')->update(['dishes_name'=>$data['dishes_name'],'cid'=>$data['cid']]);
	}


	// 删除分类
	public function delpro($data)
	{
		return DishesCate::destroy($data);
	}

	// 添加分类

	public function adddishes($data)
	{	
		$list = ['shop_id'=>$data[1]['name'],'dishes_name'=>$data[0]];
	return Db::table('dfz_dishes_cate')->insert($list);
	}
	
}