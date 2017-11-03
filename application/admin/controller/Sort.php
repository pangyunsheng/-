<?php
namespace app\admin\controller;
use think\Controller;
use think\Model;
use app\admin\model\ShopCate;
use think\Request;
// use think\Db;

class Sort extends Controller
{

	protected $cate;

	protected function _initialize()
	{
		$this->cate = new ShopCate();
	}



	// 添加分类
	public function addcate()
	{	

		$res = Request::instance()->param();
		$res1 = $this->cate->add($res);
		if ($res1) {
			header("Location:/admin/sort/listcate");
			exit;
		} 
		return $this->fetch();
	}



	// 分类列表
	public function listcate()
	{	
		$result = $this->cate->order('weight','desc')->select();
		$this->assign('result',$result);
		return $this->fetch();
	}

	// 修改分类
	public function editcate()
	{	
		// 获取需要修改的分类id
		$res = Request::instance()->param('id');
		if ($res) {
			// 查找id对应的分类
			$result = $this->cate->where('all_cate_id',$res)->find()->toArray();
			// dump($result);
			if ($result) {
				// 分配变量
				$this->assign('result',$result);
				return $this->fetch();
			}
		}			
	}

	// 删除分类
	public function delpro()
	{	
		
		$res = Request::instance()->param('id');
		
		$res1 = $this->cate->del($res);

			header("Location:/admin/sort/listcate");
			exit;
	}


	// 修改分类
	public function edit()
	{
		
		$res1 = Request::instance()->param(true);
		
		$res = $this->cate->upd($res1);
		if($res){
			
			header("Location:/admin/sort/listcate");
			exit;
		} else {
			header("Location:/admin/sort/listcate");
			exit;
		}
		
	}

}