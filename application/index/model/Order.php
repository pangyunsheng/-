<?php
namespace app\index\model;
use think\Model;
use think\Db;
use app\index\model\Dishes;
use app\index\model\DishesCate;

class Order extends Model
{
	//插入数据
	public function add($post)
	{
		return Db::name('order')->insert($post);
	}

	//查询某个人在某一家店订单未支付的
	public function status($shop_id, $username)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_id')
				->select();
	}

	//修改未支付的订单
	public function upd($shop_id, $username, $post)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->update($post);
	}

	//初始化购物车
	public function cart($shop_id, $username)
	{
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('item, total_price')
				->select();
	}

	//存收货地址
	public function address($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		$order_phone = $post['order_phone'];
		$order_name = $post['order_name'];
		$order_address = $post['order_address'];

		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->update(['order_phone'=>$order_phone, 'order_name'=>$order_name, 'order_address'=>$order_address]);
	}

	//取收货地址
	public function get_address($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_name, order_phone, order_address')
				->select();
	}

	//订单提交。写入信息，更新订单状态为1
	public function commit_upd($post)
	{
        $username = $post['username'];
        $shop_id = $post['shop_id'];
        $sf_price = $post['sf_price'];
        $order_arrived_time = $post['order_arrived_time'];
        $order_liuyan = $post['order_liuyan'];
        $order_time = $post['order_time'];

        return Db::name('order')
        	->where('shop_id', $shop_id)
			->where('username', $username)
			->where('order_status', 0)
			->update(['sf_price'=>$sf_price, 'order_arrived_time'=>$order_arrived_time, 'order_liuyan'=>$order_liuyan, 'order_status'=>1, 'order_time'=>$order_time]);
	}

	//清空购物车
	public function kong_cart($post)
	{
		$shop_id = $post['shop_id'];
		$username = $post['username'];
		return Db::name('order')
				->where('shop_id', $shop_id)
				->where('username', $username)
				->where('order_status', 0)
				->field('order_name, order_phone, order_address')
				->delect();
	}

	//查找最新下订单所有信息
	public function new_order($username)
	{
		$res = Db::table('dfz_order')->alias('a')->join('dfz_shop_list b', 'a.shop_id = b.shop_id')
		->field('a.*, b.shop_tel, b.shop_name')
		->where('a.order_status', 1)
		->where('a.username', $username)
		->order('order_time desc')
		->limit(1)
		->select();

		// dump($res);
		return $res;

	}

	//顾客取消订单处理
	public function cancel_order($post)
	{
		$order_id = $post['order_id'];
		$username = $post['username'];

		//顾客发起取消订单申请，更新字段order_cancel为1
		Db::name('order')
		->where('order_id', $order_id)
		->where('username', $username)
		->update(['order_cancel'=>1]);

	    $res = Db::name('order')
		->where('order_id', $order_id)
		->where('username', $username)
		->field('received, username')
		->select();

		//如果商家同意取消订单,处理了，更新字段order_cancel为2
		// Db::name('order')
		// ->where('order_id', $order_id)
		// ->where('username', $username)
		// ->update(['order_cancel'=>2]);

		return $res;
	}

	//顾客催单次数
	public function order_urge($post)
	{
		$order_id = $post['order_id'];
		$username = $post['username'];

		$res1 = Db::name('order')
		->where('order_id', $order_id)
		->where('username', $username)
		->field('urge_count, username')
		->select();

		//催单次数加1
		Db::name('order')
		->where('order_id', $order_id)
		->where('username', $username)
		->setInc('urge_count');
		
		return $res1;
	}

	//历史订单
	public function all_order($post)
	{
		$username = $post['username'];

		//过滤掉最新的订单
		$guolv = Db::name('order')->where('order_cancel', 0)->where('received', 0)
		         ->order('order_time desc')->limit(1)->field('order_id')->select();
		$order_id = $guolv[0]['order_id'];

		$list = Db::table('dfz_order')->alias('a')->join('dfz_shop_list b', 'a.shop_id = b.shop_id')
		->field('a.*, b.shop_tel, b.shop_name')
		->where('a.order_status', 1)
		->where('a.username', $username)
		->where('order_id', 'neq', $order_id)
		->order('order_time desc')
		->where('a.received', 2) //订单完成是2
		->paginate(2);

		$page = $list->render();
		return [$list, $page];
	}

	//再买一次
	public function add_mai($post)
	{
		$order_id = $post['order_id'];
		// $order_id = 25;
		$res = Db::name('order')->where('order_id', $order_id)->select();
		$username = $res[0]['username'];
		$item = $res[0]['item'];
		$total_price = $res[0]['total_price'];
		$shop_id = $res[0]['shop_id'];

		$data = [
			'username'=>$username,
			'item'=>$item,
			'total_price'=>$total_price,
			'shop_id'=>$shop_id
		];

		//防止没确定的订单重复下
		$res2 = Db::name('order')
		->where('username', $username)
		->where('shop_id', $shop_id)
		->where('order_status', 0)
		->select();
		if($res2){
			return 2;
		}

		//插入一条新的，为未确认的订单
		$res3 = Db::name('order')->insert($data);
		if($res3)
		{
			return 0;
		}else{
			return 1;
		}
	}

	//查找订单数，成功单数
	public function order_count($username)
	{
		//总数
		$res = Db::name('order')->where('username', $username)->count('order_id');

		//成功数
		$res2 = Db::name('order')->where('username', $username)->where('received', 2)->count('order_id');
		return [$res, $res2];
	}

	//平均送达时间
	public function goTime($shop_id)
	{
		//已成功完成的订单数
		$count = Db::name('order')->where('shop_id', $shop_id)->where('order_status', 1)->where('received', 2)
		->count('order_id');


		$time = Db::name('order')->where('shop_id', $shop_id)->where('order_status', 1)->where('received', 2)->field('received_time, order_time')->select(); //二维数组

		$total_time = []; //总时长
		foreach($time as $val)
		{
			$total_time[] = ceil((strtotime($val['received_time']) - strtotime($val['order_time']))/ 60); //时长
		}
		$total_time = array_sum($total_time);

		if($count == 0)
		{
			return "暂无数据";
		}else{
			// 平均送达时间
			$aver_time = ceil($total_time / $count);
			return $aver_time;
		}
		
	}

	//每道菜月售多少
	public function sell($shop_id)
	{
		$goods = Db::name('order')->where('received', 2)->where('order_status', 1)
		         ->where('shop_id', $shop_id)->field('item')->select();

		$arr = [];
		$item = [];
		$count = [];
		foreach($goods as $val)
		{
			$arr[] = json_decode($val['item'], JSON_UNESCAPED_UNICODE); 			
		}

		//mid
		$m = Db::table('dfz_dishes')->alias('a')->join('dfz_dishes_cate b', 'a.cid = b.cid')
		->where('b.shop_id', $shop_id)->field('a.mid')->select();

		foreach($arr as $v)
		{
			foreach($v as $x=>$y)
			{
				$item[] = $y['itemId'];
				$count[] = $y['count'];
			}
			
		}

		foreach($m as $key=>$value)
		{
			foreach($item as $k=>$v)
			{
				if($value['mid'] == $v)
				{
					echo $k;
				}
			}
		}

		dump($arr);

		dump($item);

		dump($m); 


		dump($count);
	}
}