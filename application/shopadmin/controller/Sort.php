<?php
namespace app\shopadmin\controller;
use think\Controller;
use think\Model;
use app\shopadmin\model\ShopCate;
use app\shopadmin\model\DishesCate;
use think\Request;
use think\Db;
use  \think\Session;

class Sort extends Controller
{

	
	protected $dishes;

	protected function _initialize()
	{
		
		$this->dishes = new DishesCate();
	}



	// 添加分类
	public function addcate()
	{	

		
		$res = input();
		if(!empty($res))
		{
			$res = input('param.dishes_name');
			$post = Request::instance()->session();

			$arr = [$res,$post];

			$res1 = $this->dishes->adddishes($arr);
			if ($res) {
				 echo "<script> alert('添加成功');location.href='/shopadmin/sort/listcate';</script>";
			}
		}
		return $this->fetch();
	}




	// 分类列表
	public function listcate()
	{	
		
		$post = Request::instance()->session();
		$res = $this->dishes->dishescate($post['name']);
		$this->assign('res',$res);
		return $this->fetch();
	}

	// 修改分类
	public function editcate()
	{	
		// 获取需要修改的分类id
		$res = Request::instance()->param('id');
		
		// 查找id对应的分类
		$res1 = $this->dishes->editcate($res);

		$this->assign('res1',$res1);
		return $this->fetch();
	
				
	}

	// 删除分类
	public function delpro()
	{			
		$res = input();
		$res1 = $this->dishes->delpro($res);
		if ($res1) {
			return json_encode(['code'=>'0']);
		}

	}


	// 修改分类
	public function edit()
	{
		
		$res = Request::instance()->param(true);
		$res = $this->dishes->edit($res);
	
		if($res){
			echo "<script> alert('修改成功！');location.href='/shopadmin/sort/listcate'; </script>"; 
		} else {
			echo "<script> alert('修改失败');location.href='/shopadmin/sort/listcate'; </script>"; 
		}
		
	}

}