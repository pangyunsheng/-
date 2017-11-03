<?php
namespace app\shopadmin\controller;
use think\Controller;
use think\Model;
use think\Db;
use app\shopadmin\model\Dishes;
use app\shopadmin\model\ShopList as ShopLista;
use \think\Session;
use think\Request;


class Info extends Controller
{


	protected $dis;
	protected $shop;

	protected function _initialize()
	{
		$this->dis = new Dishes();
		$this->shop = new ShopLista();

	}


	public function shopinfo()
	{	
		// 获取shop_id
		$post = Request::instance()->session();

		// 根据shop_id查询所有信息
		$res = $this->dis->chaxun($post);

		
		// 统计月销量
		// $res1 = $this->dis->count($post);

		
		// foreach ($res1 as $key => $value) {
		// 	$array[$key] = ($value['meal_price']*$value['meal_sell_num']);

		// }

		
		$page = $res->render();
		$this->assign('res',$res);
		$this->assign('page',$page);
	
		return $this->fetch();
	}

	// 商家的店铺资料
	public function info()
	{
		$post = Request::instance()->session();
		// dump($post);
		// 根据shop_id查询所有信息
		$res = $this->shop->seek($post);
		$this->assign('res',$res);
		return $this->fetch();
	}

	//修改店铺信息
	public function infor()
	{
		$post = input();

		$res = $this->shop->upd($post);
		if ($res) {
			return json_encode(['code'=>'1','status'=>'success']);
		} else {
			return json_encode(['code'=>'2','status'=>'success']);
		}		
	}

	//营业状态，开店和关店
	public function shopState()
	{
		$shop_id = Session::get('shop_id', 'think');
		$res = $this->shop->shop_state($shop_id);
		$state = $res[0]['shop_state'];
		$this->assign('state', $state);
		return $this->fetch();
	}

	//改变营业状态
	public function upd_shopState()
	{
		$shop_id = Session::get('shop_id', 'think');
		$shop_state = input('param.shop_state');
		$res = $this->shop->upd_shop_state($shop_id, $shop_state);
		if ($res) {
			return json_encode(['code'=>'0','status'=>'success']);
		} else {
			return json_encode(['code'=>'1','status'=>'success']);
		}	
	}
}