<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Comment ;
use app\index\model\User;

class PingLun extends Controller
{
	protected $comment;
	protected $user;
	protected function _initialize()
	{
		$this->comment = new Comment();
		$this->user = new User();
	}

	//提交商品评价
	public function save_comment()
	{
		$post = input();
		$username = $post['username'];
		$res = $this->comment->add($post);

		//评论加5个积分
		$this->user->five_score($username);

		if($res)
		{
			return json_encode(['status'=>'success', 'code'=>'0', 'username'=>$username]);
		}
	}

	//查找是否已经评论的，隐藏评论按钮
	public function duibi()
	{
		$order_id = $this->comment->select();

		if($order_id){
			// 找到已经评论的order_id隐藏评论按钮
			return json_encode(['code'=>'0', 'order_id'=>$order_id]);
		}else{
			return json_encode(['code'=>'1', 'order_id'=>$order_id]);
		}
	}

}