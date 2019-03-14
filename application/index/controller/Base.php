<?php 
namespace app\index\controller;
use think\Controller;
use think\Session;
/**
 * 基础类，作为权限验证类
 */
class Base extends Controller
{
	public function _initialize(){
		$time = time();
		$activeTime = Session::get('activeTime');
		// echo $activeTime;exit;
		//没有登录直接跳转到登录页
        if(empty(Session::get(Config("ADMIN_AUTH")))){
        	if (request()->isAjax()) {
                $exitInfo = array ('statusCode' => 301, 'message' => '会话超时，请重新登录。' );
                exit(json_encode($exitInfo));
                // $this->ajaxReturn ( $timeout, "" );
            } else {
                $this->redirect('login/login');
            }
        }
        //页面5分钟没有活动,则清除session，重新登陆
        if (!empty($activeTime)) {
        	if (($time - $activeTime) > 500*60) {
	        	Session::clear();
	        	$this->redirect('Login/login',3,'请重新登陆');
	        }
        }
        Session::set('activeTime',$time);
		//session存在时，不需要验证的权限
		$not_check=array(
			'index/Index/index',
			'index/Index/welcome',
			'index/Index/editPassword'
		);
		$request = request();
		$moduleName = $request->module();
		$controllerName = $request->controller();
		$actionName = $request->action();
		//当前操作的请求                 模块名/方法名
		if(in_array($moduleName.'/'.$controllerName.'/'.$actionName, $not_check)){
			return true;
		}
		/*$auth=new \Auth();
		if(!$auth->check($moduleName.'/'.$controllerName.'/'.$actionName,Session::get(Config("ADMIN_AUTH"))['id'])){
			$this->error('您没有操作权限');
		}*/





	}
}


?>