<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\Order;

class Comment extends Model
{

	//添加评论
	public function add($post)
	{
        //更新dfz_order表is_comment字段为1
        $order_id = $post['order_id'];
		Db::name('order')->where('order_id', $order_id)->update(['is_comment'=>1]);

        return Db::name('comment')->insert($post);
        
	}

	//查找
	public function select()
	{
		return Db::name('comment')->field('order_id')->select();
	}

	//展示店铺评论
	public function pl_list($shop_id)
	{
		//评论数
		$count = Db::name('comment')->where('shop_id', $shop_id)->count('order_id');

		$order_id = Db::name('comment')->where('shop_id', $shop_id)->field('order_id')->select();

		$list = Db::name('comment')->where('shop_id', $shop_id)->select();

		$all = [];
		foreach($order_id as $key=>$val){
			$all[] = Db::name('order')->where('order_id', $val['order_id'])->field('item, order_time, received_time')->select();
		}

		
		// dump($list);
		return [$count, $list, $all];

	}
}