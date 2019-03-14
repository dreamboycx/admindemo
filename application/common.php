<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * @param int $code
 * @param string $errorMsg
 * @param string $data
 * @return array
 * 操作提示信息
 */
function formatResult($errorMsg,$code, $data = null){
    return json(['code' => $code,'msg' => $errorMsg,'data'=>$data]);
}
/**
 * @param array $list
 * @param int $parent_id
 * @param int $deep
 * @return array
 * 无限极分类
 */
function infinite($list = [],$parent_id = 0,$deep = 0){
    static $arr = [];
    foreach ($list as $v){
        if($v['pid'] == $parent_id){
            $v['deep'] = $deep;
            //在名称前加上|-形成层级结构
            $v['title'] = str_repeat('&nbsp',$deep*8) ."|-".$v['title'];
            $arr[] = $v;
            infinite($list,$v['id'],$deep + 1);
        }
    }
    return $arr;
}
/**
 * @param array $list
 * @param int $parent_id
 * @param int $deep
 * @return string
 * 无限极分类
 */
function infiniteOpt($list = [],$parent_id = 0,$deep = 0,$pid=0){
    static $optStr = '';
    foreach ($list as $v){
        if($v['pid'] == $parent_id){
            $v['deep'] = $deep;
            //在名称前加上|-形成层级结构
            $option = str_repeat('|-',$deep) ."|-".$v['title'];
            if ($pid==$v['id']) {
                $selected = ' selected="selected"';
            }else{
                $selected = '';
            }
            $optStr .= '<option value="'.$v['id'].'" '.$selected.'>'.$option.'</option>';
            infiniteOpt($list,$v['id'],$deep + 1,$pid);
        }
    }
    return $optStr;
}
/**
 * @param bool $uploads_thumb
 * @param int $width
 * @param int $height
 * @return array
 * 图片上传
 */
function upload($uploads_thumb = UPLOAD_THUMB_OFF,$width = 0,$height = 0){
    $file = request()->file("image");
    if(!empty($_FILES) && empty($file)){
        return ['errorMsg'=>'上传文件大小超过配置'];
    }
    $info = $file->validate(['size'=>15567998,'ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
    if(!$info){
        return ['errorMsg'=>$file->getError()];
    }
    $file_path = $info->getSaveName();
    //需要生成缩略图
    if($uploads_thumb === UPLOAD_THUMB_ON){
        $file_name =  $info->getFilename();
        $thumb = \think\Image::open(ROOT_PATH . 'public' . DS . 'uploads'.DS.$file_path);
        $thumb->thumb($width,$height,\think\Image::THUMB_CENTER)->save(ROOT_PATH . 'public' . DS . 'uploads'.DS.date('Ymd').DS.$file_name.'thumb.jpg');
    }
    return [
        'file_path'=>$file_path,
        'thumb_path' => date('Ymd').DS.$file_name.'thumb.jpg'
    ];
}

/**
 * @param $fileName
 * @return array
 * 多图上传
 */
function uploadMore($fileName){
    // Get the form upload file
    $files = request()->file('image');
    foreach($files as $file){
        // Move to the framework application root directory / public / uploads / directory
        $info = $file->validate(['size'=>20971520,'ext'=>'jpg,png,gif'])->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $fileName);
        if(!$info){
            // Upload failed to get error message
            return ['errorMsg'=>$file->getError()];
        } else {
            // Upload upload information after successful upload
            $filePath[]   = $fileName. '/' .$info->getSaveName();
        }
    }
    return $filePath;
}
//判断是否手机
function isMobile()
{ 
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
}
//windows系统探测
function sys_windows()
{
    if (PHP_VERSION >= 5)
    {
        $objLocator = new COM("WbemScripting.SWbemLocator");
        $wmi = $objLocator->ConnectServer();
        $prop = $wmi->get("Win32_PnPEntity");
    }
    else
    {
        return false;
    }

    //CPU
    $cpuinfo = GetWMI($wmi,"Win32_Processor", array("Name","L2CacheSize","NumberOfCores"));
    $res['cpu']['num'] = $cpuinfo[0]['NumberOfCores'];
    if (null == $res['cpu']['num']) 
    {
        $res['cpu']['num'] = 1;
    }/*
    for ($i=0;$i<$res['cpu']['num'];$i++)
    {
        $res['cpu']['model'] .= $cpuinfo[0]['Name']."<br />";
        $res['cpu']['cache'] .= $cpuinfo[0]['L2CacheSize']."<br />";
    }*/
    $cpuinfo[0]['L2CacheSize'] = ' ('.$cpuinfo[0]['L2CacheSize'].')';
    if($res['cpu']['num']==1)
        $x1 = '';
    else
        $x1 = ' ×'.$res['cpu']['num'];
    $res['cpu']['model'] = $cpuinfo[0]['Name'].$cpuinfo[0]['L2CacheSize'].$x1;
    // SYSINFO
    $sysinfo = GetWMI($wmi,"Win32_OperatingSystem", array('LastBootUpTime','TotalVisibleMemorySize','FreePhysicalMemory','Caption','CSDVersion','SerialNumber','InstallDate'));
    $sysinfo[0]['Caption']=iconv('GBK', 'UTF-8',$sysinfo[0]['Caption']);
    $sysinfo[0]['CSDVersion']=iconv('GBK', 'UTF-8',$sysinfo[0]['CSDVersion']);
    $res['win_n'] = $sysinfo[0]['Caption']." ".$sysinfo[0]['CSDVersion']." 序列号:{$sysinfo[0]['SerialNumber']} 于".date('Y年m月d日H:i:s',strtotime(substr($sysinfo[0]['InstallDate'],0,14)))."安装";
    //UPTIME
    $res['uptime'] = $sysinfo[0]['LastBootUpTime'];

    $sys_ticks = 3600*8 + time() - strtotime(substr($res['uptime'],0,14));
    $min = $sys_ticks / 60;
    $hours = $min / 60;
    $days = floor($hours / 24);
    $hours = floor($hours - ($days * 24));
    $min = floor($min - ($days * 60 * 24) - ($hours * 60));
    if ($days !== 0) $res['uptime'] = $days."天";
    if ($hours !== 0) $res['uptime'] .= $hours."小时";
    $res['uptime'] .= $min."分钟";

    //MEMORY
    $res['memTotal'] = round($sysinfo[0]['TotalVisibleMemorySize']/1024,2);
    $res['memFree'] = round($sysinfo[0]['FreePhysicalMemory']/1024,2);
    $res['memUsed'] = $res['memTotal']-$res['memFree']; //上面两行已经除以1024,这行不用再除了
    $res['memPercent'] = round($res['memUsed'] / $res['memTotal']*100,2);

    $swapinfo = GetWMI($wmi,"Win32_PageFileUsage", array('AllocatedBaseSize','CurrentUsage'));

    // LoadPercentage
    $loadinfo = GetWMI($wmi,"Win32_Processor", array("LoadPercentage"));
    $res['loadAvg'] = $loadinfo[0]['LoadPercentage'];

    return $res;
}

//linux系统探测
function sys_linux()
{
    // CPU
    if (false === ($str = @file("/proc/cpuinfo"))) return false;
    $str = implode("", $str);
    @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(\@.-]+)([\r\n]+)/s", $str, $model);
    @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
    @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
    @preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips);
    if (false !== is_array($model[1]))
    {
        $res['cpu']['num'] = sizeof($model[1]);
        /*
        for($i = 0; $i < $res['cpu']['num']; $i++)
        {
            $res['cpu']['model'][] = $model[1][$i].'&nbsp;('.$mhz[1][$i].')';
            $res['cpu']['mhz'][] = $mhz[1][$i];
            $res['cpu']['cache'][] = $cache[1][$i];
            $res['cpu']['bogomips'][] = $bogomips[1][$i];
        }*/
        if($res['cpu']['num']==1)
            $x1 = '';
        else
            $x1 = ' ×'.$res['cpu']['num'];
        $mhz[1][0] = ' | 频率:'.$mhz[1][0];
        $cache[1][0] = ' | 二级缓存:'.$cache[1][0];
        $bogomips[1][0] = ' | Bogomips:'.$bogomips[1][0];
        $res['cpu']['model'][] = $model[1][0].$mhz[1][0].$cache[1][0].$bogomips[1][0].$x1;
        if (false !== is_array($res['cpu']['model'])) $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);
        if (false !== is_array($res['cpu']['mhz'])) $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);
        if (false !== is_array($res['cpu']['cache'])) $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);
        if (false !== is_array($res['cpu']['bogomips'])) $res['cpu']['bogomips'] = implode("<br />", $res['cpu']['bogomips']);
    }

    // NETWORK

    // UPTIME
    if (false === ($str = @file("/proc/uptime"))) return false;
    $str = explode(" ", implode("", $str));
    $str = trim($str[0]);
    $min = $str / 60;
    $hours = $min / 60;
    $days = floor($hours / 24);
    $hours = floor($hours - ($days * 24));
    $min = floor($min - ($days * 60 * 24) - ($hours * 60));
    if ($days !== 0) $res['uptime'] = $days."天";
    if ($hours !== 0) $res['uptime'] .= $hours."小时";
    $res['uptime'] .= $min."分钟";

    // MEMORY
    if (false === ($str = @file("/proc/meminfo"))) return false;
    $str = implode("", $str);
    preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);
    preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers);

    $res['memTotal'] = round($buf[1][0]/1024, 2);
    $res['memFree'] = round($buf[2][0]/1024, 2);
    $res['memBuffers'] = round($buffers[1][0]/1024, 2);
    $res['memCached'] = round($buf[3][0]/1024, 2);
    $res['memUsed'] = $res['memTotal']-$res['memFree'];
    $res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;

    $res['memRealUsed'] = $res['memTotal'] - $res['memFree'] - $res['memCached'] - $res['memBuffers']; //真实内存使用
    $res['memRealFree'] = $res['memTotal'] - $res['memRealUsed']; //真实空闲
    $res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0; //真实内存使用率

    $res['memCachedPercent'] = (floatval($res['memCached'])!=0)?round($res['memCached']/$res['memTotal']*100,2):0; //Cached内存使用率

    $res['swapTotal'] = round($buf[4][0]/1024, 2);
    $res['swapFree'] = round($buf[5][0]/1024, 2);
    $res['swapUsed'] = round($res['swapTotal']-$res['swapFree'], 2);
    $res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;

    // LOAD AVG
    if (false === ($str = @file("/proc/loadavg"))) return false;
    $str = explode(" ", implode("", $str));
    $str = array_chunk($str, 4);
    $res['loadAvg'] = implode(" ", $str[0]);

    return $res;
}