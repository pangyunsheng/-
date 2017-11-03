<?php
namespace app\index\model;
use app\index\model\Order;
use think\Model;
use think\Db;

class User extends Model
{
	
	public function select($data)
	{
		$username = $data['username'];
		// $pwd = $data->password;
		return Db::name('user')->where('username', $username)->select();
	}

	//添加
	public function add($data)
	{
		return Db::name('user')->insert($data);
	}

	//更新
	public function upd($data)
	{
		return Db::name('user')->where('username', $data['username'])->update(['password'=>$data['password']]);
	}

	//取积分
	public function get_jifen($post)
	{
		return Db::name('user')->where('username', $post['username'])->field('jifen')->select();
	}

	//取到积分和总价
	public function get_two($post)
	{
		$username = $post['username'];
		$shop_id = $post['shop_id'];

		return Db::table('dfz_user')->alias('a')->join('dfz_order b', 'a.username = b.username')
		->field('a.jifen, b.total_price')
		->where('b.username', $username)
		->where('b.shop_id', $shop_id)
		->where('b.order_status', 0)
		->select();
	}

	//提交订单后更新积分
	public function upd_jifen($username, $jifen)
	{
		return Db::name('user')
		->where('username', $username)
		->update(['jifen'=>$jifen]);
	}

	//提取当前积分
	public function score($username)
	{
		return Db::name('user')
		->where('username', $username)
		->field('jifen')
		->select();
	}

	//评论后加5个积分
	public function five_score($username)
	{
		Db::name('user')
		->where('username', $username)
		->setInc('jifen', 5);
	}


	//修改登录密码
	public function upd_pwd($post)
	{
		$username = $post['username'];
		$password = $post['password']; //当前登录密码
		$password2 = $post['password2']; //要设置的新密码

		$res = Db::name('user')->where('username', $username)->field('password')->select();
		if($res[0]['password'] == $password)
		{
			if($res[0]['password'] == $password2){
				return 'same';
			}else{
				return Db::name('user')->where('username', $username)->update(['password'=>$password2]);
			}
			
		}else{
			//如果不是当前的登录密码
			return 0;
		}
	}

	//插入姓名
	public function add_name($post)
	{
		$username = $post['username'];
		$real_name = $post['real_name'];

		return Db::name('user')->where('username', $username)->update(['real_name'=>$real_name]);
	}

	//店铺收藏
	public function df_collect($username)
	{
		$res = Db::table('dfz_shop_list')->alias('a')
		->join('dfz_collect b', 'a.shop_id = b.shop_id')
		->join('dfz_shop_cate c', 'a.shop_mode_id = c.all_cate_id')
		->field('a.shop_id, a.shop_pic, a.shop_name, c.cate_name')
		->where('b.username', $username)
		->select();

		// dump($res);
		return $res;
	}
}