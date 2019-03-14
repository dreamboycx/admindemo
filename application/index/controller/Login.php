<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;
use think\captcha;
/**
 * 登陆类
 */
class Login extends Controller
{
	
	function login()
	{
		if(!empty(Session::get(Config("ADMIN_AUTH")))){
			$this -> redirect('Index/index');
		}
		return view();
	}
	public function dologin()
	{
		$captcha = input('post.captcha');
		if(!captcha_check($captcha)){
			$this->error('验证码不正确');
		}
		$username = input('post.username');
		$passwd = input('post.passwd');
		$userInfo = Db::table('tbadmin_user')->where(array('username'=>$username))->find();
		if (empty($userInfo['id'])) {
			$this->error('该用户不存在！');
		}
		if($userInfo['status'] != 1){
    		$this->error('账号被禁用!');
    	}
    	if(md5($passwd) != $userInfo['password']){
    		$this -> error('密码错误，请重新输入');
    	}
    	//查询该用户账号是否分配了角色和角色状态
    	$group_access = Db::table('tbauth_group_access')->where('uid = '.$userInfo['id'])->field('group_id')->find();
        if($group_access['group_id']<=0){
			$this -> error('该账号未授权');
        }
		$result_role = Db::table('tbauth_group')->where('id = '.$group_access['group_id'])->field('status')->find();
		if(empty($result_role)){
			$this -> error('该账号角色未授权');
		}
		if($result_role['status'] != 1){
    		$this -> error('该账号的角色被禁用');
		}
		$result = Db::table('tbadmin_user')->where('id='.$userInfo['id'])->update(array('last_login_time'=>time(),'last_login_ip'=>get_client_ip()));
		Session::set(Config("ADMIN_AUTH"),$userInfo);
		$this ->success('登陆成功','Index/index');
		// $this->redirect('Index/index');
		// print_r(input('post.'));
	}
	public function logout()
	{
		Session::clear();
		$this->redirect('Login/login');
	}
	//验证码
    public function verify()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }
}


?>