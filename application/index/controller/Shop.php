<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\ShopCate;
use app\index\model\ShopList;
use app\index\model\DishesCate;
use app\index\model\Dishes;

class Shop extends Controller
{
	protected $shop_cate;
	protected $shop_list;
	protected $dishes_cate;
	protected $dishes;

	protected function _initialize()
	{
		$this->shop_cate = new ShopCate();
		$this->shop_list = new ShopList();
		$this->dishes_cate = new DishesCate();
		$this->dishes = new Dishes();
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

		// dump($res3);die;
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
		// return json_encode($res);
		$result = [];
		foreach($res as $val)
		{
			$str = "
				<a href='/index/Shop/shop_detail/shop_id/'".$val['shop_id']." target='_blank'>
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

	public function order_confirm()
	{
		return $this->fetch();
	}

}

