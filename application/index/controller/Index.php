<?php
namespace app\index\controller;
// use extClass\Test;
class Index extends Base
{
    public function index()
    {
       return view();
    }
    public function welcome()
    {
    	if('/'==DIRECTORY_SEPARATOR){
    		$ipAddr = $_SERVER['SERVER_ADDR'];
    	}else{
    		$ipAddr = @gethostbyname($_SERVER['SERVER_NAME']);
    	}
    	$os = explode(" ", php_uname());
    	if('/'==DIRECTORY_SEPARATOR ){
    		$computerName = $os[1];
    		$kernel = $os[2];
    	}else{
    		$computerName = $os[2];
    		$kernel = $os[1];
    	}
    	$osInfo = $os[0].'内核版本：'.$kernel;
    	$documentRoot = $_SERVER['DOCUMENT_ROOT']?str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']):str_replace('\\','/',dirname(__FILE__));
    	$serverLang = getenv("HTTP_ACCEPT_LANGUAGE");
    	$uptime = $load = '';
    	// 根据不同系统取得CPU相关信息
		switch(PHP_OS)
		{
			case "Linux":
				$sysInfo = sys_linux();
				$uptime = $sysInfo['uptime'];//服务器运行时间
				$load = $sysInfo['loadAvg'];	//系统负载
			break;
			/*case "WINNT":
				$sysInfo = sys_windows();
			break;*/
			
			default:
			break;
		}
		
		$df = round(@disk_free_space(".")/(1024*1024*1024),3);//可用空间
		$dt = round(@disk_total_space(".")/(1024*1024*1024),3);//总空间

    	$serverInfo = array(
    		'serverName' => $_SERVER['SERVER_NAME'].'('.$ipAddr.')',
    		'computerName' => $computerName,
    		'serverPort' => $_SERVER['SERVER_PORT'],
    		'serverSoftWare' => $_SERVER['SERVER_SOFTWARE'],
    		'dirPath' => __DIR__,
    		'os' => $osInfo,
    		'documentRoot'=>$documentRoot,
    		'maxTime' => ini_get('max_execution_time'),
    		'currentTime' => date('Y-m-d H:i:s'),
    		'serverLang' => $serverLang,
    		'serverUptime' => $uptime,
    		'serverDf' => $df,
    		'serverDt' => $dt
    	);
    	$this->assign('serverInfo',$serverInfo);
    	return view();
    }
}
