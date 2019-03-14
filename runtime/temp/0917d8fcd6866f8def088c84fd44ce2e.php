<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\www\admindemo\public/../application/index\view\index\welcome.html";i:1545292572;s:56:"E:\www\admindemo\application\index\view\index\_meta.html";i:1545309410;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admindemo/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admindemo/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admindemo/public/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admindemo/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admindemo/public/static/h-ui.admin/css/style.css" />
<script type="text/javascript" src="/admindemo/public/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admindemo/public/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admindemo/public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admindemo/public/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">/admindemo/public/static</p>
	<p>登录次数：18 </p>
	<p>上次登录IP：<?php echo \think\Session::get('admin_auth.last_login_ip'); ?>  上次登录时间：<?php echo date("Y-m-d H:i:s",\think\Session::get('admin_auth.last_login_time')); ?></p>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>图片库</th>
				<th>产品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td>92</td>
				<td>9</td>
				<td>0</td>
				<td>8</td>
				<td>20</td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">服务器信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th width="30%">服务器计算机名</th>
				<td><span><?php echo $serverInfo['computerName']; ?></span></td>
			</tr>
			<tr>
				<td>服务器域名/IP地址</td>
				<td><?php echo $serverInfo['serverName']; ?></td>
			</tr>
			<tr>
				<td>服务器端口 </td>
				<td><?php echo $serverInfo['serverPort']; ?></td>
			</tr>
			<tr>
				<td>服务器解译引擎 </td>
				<td><?php echo $serverInfo['serverSoftWare']; ?></td>
			</tr>
			<tr>
				<td>本文件所在文件夹 </td>
				<td><?php echo $serverInfo['dirPath']; ?></td>
			</tr>
			<tr>
				<td>服务器操作系统 </td>
				<td><?php echo $serverInfo['os']; ?></td>
			</tr>
			<tr>
				<td>系统所在文件夹 </td>
				<td><?php echo $serverInfo['documentRoot']; ?></td>
			</tr>
			<tr>
				<td>服务器脚本超时时间 </td>
				<td><?php echo $serverInfo['maxTime']; ?>秒</td>
			</tr>
			<tr>
				<td>服务器当前时间 </td>
				<td><?php echo $serverInfo['currentTime']; ?></td>
			</tr>
			<tr>
				<td>服务器语言 </td>
				<td><?php echo $serverInfo['serverLang']; ?></td>
			</tr>
			<tr>
				<td>服务器已运行时间 </td>
				<td><?php echo $serverInfo['serverUptime']; ?></td>
			</tr>
			<tr>
				<td>服务器总空间 </td>
				<td><?php echo $serverInfo['serverDt']; ?>G</td>
			</tr>
			<tr>
				<td>服务器可用空间 </td>
				<td><?php echo $serverInfo['serverDf']; ?>G</td>
			</tr>
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
			Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
<script type="text/javascript" src="/admindemo/public/static/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admindemo/public/static/h-ui/js/H-ui.min.js"></script>
</body>
</html>