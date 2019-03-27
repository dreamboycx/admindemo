<?php 
namespace app\index\controller;
use think\Db;
// use extClass\Test;
class Admin extends Base
{
    public function index()
    {
    	// print_r($_REQUEST);exit;
    	$list = Db::table('tbadmin_user')->paginate(10);
    	$this->assign('list', $list);
    	return view();
    }
    //用户权限节点列表
    public function rulelist()
    {
        $title = input('post.title');
        
        if (empty($title)) {
            $list = Db::table('tbauth_rule')->select();
            // echo Db::table('tbauth_rule')->getLastSql();exit;
            $list = infinite($list,0,0);
        }else{
            $list = Db::table('tbauth_rule')->where('title like "%'.$title.'%"')->select();
        }
        $this->assign('title', $title);
        $this->assign('list', $list);
        return view();
    }
    public function rulelistBak()
    {
    	$list = Db::table('tbauth_rule')->paginate(10);
        
        $this->assign('page', $list->render());
        $list=$list->toArray();
        if(!empty($list['data'])){
            $aa = infinite($list['data'],0,0);
        }
        $this->assign('list', $aa);
    	return view();
    }
    //添加编辑用户权限
    public function addeditrule()
    {
        //如果是修改返回当前的数据
        $id = intval(input('param.id'));
        $result = array();
        //if ($id) {
            $result = Db::table('tbauth_rule')->where('id='.$id)->find();
        //}
        $this->assign('result',$result);
        $list = Db::table('tbauth_rule')->select();
        $optionStr = infiniteOpt($list,0,0,$result['pid']);
        $this->assign('optionStr', $optionStr);
        return view();
    }
    //处理用户权限
    public function dorule()
    {
        if(request()->isPost()){
            $param = input('post.');
            if ($param['id']) {
                $model_info = Db::table('tbauth_rule');
                $data = array(
                    'name' => $param['name'],
                    'title' => $param['title'],
                    'status' => $param['status'],
                    'pid' => $param['pid'],
                    'addtime' => time(),
                    'menustatus' => $param['menustatus']
                );
                $result = $model_info->where('id='.$param['id'])->update($data);
            }else{
                $model_info = new \app\index\Model\authRule();
                $model_info->data(array(
                    'name' => $param['name'],
                    'title' => $param['title'],
                    'status' => $param['status'],
                    'pid' => $param['pid'],
                    'addtime' => time(),
                    'menustatus' => $param['menustatus']
                ));
                $result = $model_info->save();
            }
            
            if ($result) {
                return array('code'=>200,'message'=>'操作成功');
            }else{
                return array('code'=>300,'message'=>'操作失败');
            }
        }
    }
    //删除用户权限节点
    public function delrule()
    {
        $id = input("get.id");
        $result = Db::table('tbauth_rule')->where('id in ('.$id.')')->delete();
        if ($result===false) {
            return array('code'=>300,'message'=>'操作失败');
        }else{
            return array('code'=>200,'message'=>'操作成功');
        }
    }
    //用户角色列表
    public function rolelist()
    {
    	$list = Db::table('tbauth_group')->paginate(4);
        // print_r($list);exit;
        $this->assign('list', $list);
    	return view();
    }




}




?>