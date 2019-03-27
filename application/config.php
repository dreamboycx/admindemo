<?php 
use think\Request;
$rootUrl = Request::instance()->root();//
$module = !empty(Request::instance()->module())?Request::instance()->module():'Index';//模块，默认Index
$controller = !empty(Request::instance()->controller())?Request::instance()->controller():'Index';//控制器，默认Index
return array(
    'AUTH_CONFIG'=>array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'tbauth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'tbauth_group_access', //用户组明细表
        'AUTH_RULE' => 'tbauth_rule', //权限规则表
        'AUTH_USER' => 'tbadmin_user'//用户信息表
    ),
    'ADMIN_AUTH'=>'admin_auth',
    'app_debug' => true,
    'app_trace' => true,
    'show_error_msg' => true,
    'template' => array(
        'tpl_begin' => '<!--{',
        'tpl_end'  => '}-->',
        'taglib_begin'  =>  '<',
        'taglib_end'    =>  '>',
    ),
    'dispatch_success_tmpl'  => './tpl/dispatch_jump.tpl',
    'dispatch_error_tmpl'    => './tpl/error.tpl',
    'view_replace_str'   => array( 
        // '__STATIC__'   => '/static',
        // '__URL__' => Request::instance()->root().'/admin'
       '__URL__' => $rootUrl.'/'.$module.'/'.$controller
    ),
    'trace' => array(
        'type'=> 'Html'
    )

);



?>