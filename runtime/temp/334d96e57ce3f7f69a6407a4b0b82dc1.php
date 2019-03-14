<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"E:\www\admindemo\public/../application/index\view\admin\rulelist.html";i:1548324302;s:56:"E:\www\admindemo\application\index\view\index\_meta.html";i:1548324299;}*/ ?>
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
<style type="text/css">
	ul.pagination{float: right;}
	ul.pagination li {float: left;border: 1px solid #ccc;padding: 0 10px;margin:4px;}
	ul.pagination li.activePage{background-color: #5a98de;color:#fff;} 
</style>
<title>权限管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form class="Huiform" method="post" action="<?php echo url('Admin/rulelist'); ?>" target="_self">
			<input type="text" class="input-text" style="width:250px" placeholder="权限名称" name="title" value="<?php echo $title; ?>">
			<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜权限节点</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限规则','<?php echo url('Admin/addeditrule'); ?>','800','500')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span></div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="7">权限节点</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th>权限名称</th>
				<th width="300">规则标识</th>
				<th width="100">菜单是否显示</th>
				<th width="100">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<tr class="text-l">
						<td><input type="checkbox" value="<?php echo $vo['id']; ?>" name="" id="check_<?php echo $vo['id']; ?>"></td>
						<td><?php echo $vo['id']; ?></td>
						<td><?php echo $vo['title']; ?></td>
						<td><?php echo $vo['name']; ?></td>
						<td><?php if($vo['menustatus'] == 1): ?>显示<?php else: ?><font color="red">不显示</font><?php endif; ?></td>
						<td><?php if($vo['status'] == 1): ?><span class="label label-success radius">已启用</span><?php else: ?><span class="label label-error radius">已停用</span><?php endif; ?></td>
						<td><a title="编辑" href="javascript:;" onclick="admin_permission_edit('添加权限规则','<?php echo url('Admin/addeditrule',['id'=>$vo['id']]); ?>','800','500')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_permission_del(this,<?php echo $vo['id']; ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				<?php endforeach; endif; else: echo "" ;endif; else: ?>
				<tr>
					<td colspan="7" style="text-align: center;">
						暂无数据
					</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-权限-添加*/
function admin_permission_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_permission_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}

/*管理员-权限-删除*/
function admin_permission_del(obj,id){
	console.log(obj,id);
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '<?php echo url('Admin/delrule'); ?>',
			dataType: 'json',
			data:'id='+id,
			success: function(data){
				if (data.code==200) {
					$(obj).parents("tr").remove();
					layer.msg('已删除!',{icon:1,time:1000});
				}else{
					layer.msg('删除失败!',{icon:5,time:1000});
				}
				
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}
/**
 * 批量删除数据
 * @return json
 */
function datadel() {
	var ids = '';
	$("table.table tbody tr td input:checked").each(function(k, v) {
		ids += this.value+",";
	});
	console.log(ids);
	ids = ids.substring(0,ids.length-1);
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '<?php echo url('Admin/delrule'); ?>',
			dataType: 'json',
			data:'id='+ids,
			success: function(data){
				if (data.code==200) {
					layer.msg('已删除!',{icon:1,time:1000});
					window.location.reload();
				}else{
					layer.msg('删除失败!',{icon:5,time:1000});
				}
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
</script>
</body>
</html>