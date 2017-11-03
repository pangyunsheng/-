<?php
namespace app\shopadmin\controller;
use think\Controller;
use think\Model;
use app\shopadmin\model\Dishes;
use app\shopadmin\model\ShopList;
use think\Db;
use think\Request;
use \think\Session;

class Goods extends Controller
{

	protected $goods;

	protected function _initialize()
	{
		$this->goods = new Dishes();
	}

	
	// 展示商品列表页面
	public function listpro()
	{	
		// 通过session获取店铺的shop_id,
		$post = Request::instance()->session();
		
		$res = $this->goods->sel($post);

		$page = $res->render();
		$this->assign('res',$res);
		$this->assign('page',$page);
		return $this->fetch();
	}



	// 查询所有的分类展示在添加商品页
	public function addpro()
	{	
		$shop_id = Session::get('shop_id');

		// 查询所有的分类
		$res = $this->goods->allcate($shop_id);
		$this->assign('res',$res);
		return $this->fetch();
	}

	// 修改商品
	public function editpro()
	{	

		// 获取需要修改的商品mid和店铺shop_id
		
		$post = Request::instance()->param(true);
		$shop_id = Session::get('shop_id');
		// dump($post);die;
		$res = $this->goods->cate($post);

		$res1 = $this->goods->allcate($shop_id);
		$this->assign('res',$res);
		$this->assign('res1',$res1);
	    return $this->fetch();
		
	}

	// 添加商品
	public function add()
	{	

		$res = Request::instance()->param();

		// 获取session中的shop_id
		$res1 = Request::instance()->session();
		// 获取上传文件
		$file = request()->file('meal_pic');

		// dump($res1['name']);

		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

		if($info){

			// 拼接上传文件的路径
			$path = "/uploads/".$info->getSaveName();
		}else{

		// 上传失败获取错误信息
		echo "图片上传失败，请联系管理员";

		}
		$arr=[$res,$path,$res1];

		$result = $this->goods->add($arr);
		if ($result) {

			header('Location:/shopadmin/Goods/listpro');
			exit();
		} else {

			header('Location:/shopadmin/Goods/addpro');
			exit();
		}
		
	}



	// 删除商品
	public function delpro()
	{	
		$post = input();
		// return $post['mid'];
		$res = $this->goods->del($post);
		if ($res) {
			return json_encode(['code'=>'0']);
		} else {
			return json_encode(['code'=>'1']);
		}

	}


	


	// 修改商品
	public function editp()
	{
		$post = input();
		dump($post);
		$file = request()->file('meal_pic');

		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

		if($info){

			// 拼接上传文件的路径
			$path = "/uploads/".$info->getSaveName();
		}else{

		// 上传失败获取错误信息
		echo "图片上传失败，请联系管理员";

		}


		$arr = [$post,$path];
		$res = $this->goods->editp($arr);
		if ($res) {
			header('Location:/shopadmin/Goods/listpro');
			exit();
		} else {
			header('Location:/shopadmin/Goods/editpro');
			exit();
		}



	}

}

