<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\ShopCate;
use app\index\model\ShopList;
use app\index\model\DishesCate;
use app\index\model\Dishes;
use app\index\model\Comment;
use app\index\model\Collect;
use app\index\model\Order;

class Shop extends Controller
{
	protected $shop_cate;
	protected $shop_list;
	protected $dishes_cate;
	protected $dishes;
	protected $comment;
	protected $collect;
	protected $order;

	protected function _initialize()
	{
		$this->shop_cate = new ShopCate();
		$this->shop_list = new ShopList();
		$this->dishes_cate = new DishesCate();
		$this->dishes = new Dishes();
		$this->comment = new Comment();
		$this->collect = new Collect();
		$this->order = new Order();
	}

	//店铺展示
	public function shop_list()
	{
		// 店铺经营分类
		$res = $this->shop_cate->select();

		//店铺罗列
		$res2 = $this->shop_list->select();
		// dump($res2[0]['shop_name']);die;

		$this->assign('page', $res2[1]);
		$this->assign('res', $res);
		$this->assign('res2', $res2[0]);
		// dump($res);die;
		return $this->fetch();
	}

	//店铺菜品展示(详情)
	public function shop_detail()
	{
		$shop_id = input('param.shop_id');

		$res = $this->shop_list->detail_info($shop_id);

		//店家的菜类
		$res2 = $this->dishes_cate->dishes($shop_id);

		//菜类下的小菜
		$result = $this->dishes->cai($shop_id);

		//评论区
		$pl = $this->comment->pl_list($shop_id);
		$count = $pl[0]; //评论数
		$list = $pl[1]; //评论
		$all = $pl[2]; //商品

		$time = [];
		$it = [];
		$it_count = []; //多少件商品
		foreach($all as $key=>$val)
		{
			$time[] = ceil((strtotime($val[0]['received_time']) - strtotime($val[0]['order_time']))/ 60); //时长

			$it[$key] = json_decode($val[0]['item'], JSON_UNESCAPED_UNICODE); //商品，三维数组

			$it_count[$key] = count($it[$key]);
		}

		//平均送达时间
		$get_time = $this->order->goTime($shop_id);

		//每道菜月售多少份
		// $sell_num = $this->order->sell($shop_id);

		// dump($sell_num);die;

		$this->assign('get_time', $get_time);
		$this->assign('it_count', $it_count);
		$this->assign('count', $count);
		$this->assign('it', $it);
		$this->assign('time', $time);
		$this->assign('list', $list);
		$this->assign('c', $result[0]);
		$this->assign('res3', $result[1]);
		$this->assign('res2', $res2);

		$this->assign('res', $res[0]);

		return $this->fetch();
	}


	//点店铺经营类刷选符合店铺
	public function shop_choosesupplier()
	{
		$post = input();
		$res = $this->shop_list->choose_shop($post);
		// return $res;
		// return json_encode($res);
		$result = [];
		foreach($res as $val)
		{
			$str = "
				<a target='_blank' href='/index/Shop/shop_detail/shop_id/{$val['shop_id']}'
				 >			
				<div class='supplier'>
				<img class='img' src='".$val['shop_pic']."'/>
				<font id='suppliername' class='fontname'>".$val['shop_name']."</font><br />
				<font class='span'>配送费：<font id='supplier_deliverflaot'>".$val['shop_add_price']."(元)</font>
	            </font>
				<font class='span'>月销量：<font id='supplier_monthsale'>".$val['shop_sell_sum']."</font></font><br />
				<font class='span'>距离：<font id='supplier_distace'>3411米</font></font>
	            <font class='span'>起送价：<font id='supplier_distace'>".$val['shop_dispatch_price']."</font></font>
				</div>
				</a>
			";
			$result[] = $str;
		}
		// dump(json_encode($result));die;
		return json_encode($result);
	}

	// 确认下单
	public function order_confirm()
	{
		return $this->fetch();
	}

}

