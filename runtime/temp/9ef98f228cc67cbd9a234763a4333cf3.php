<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\www\admindemo\public/../application/index\view\admin\addrule.html";i:1545297231;s:56:"E:\www\admindemo\application\index\view\index\_meta.html";i:1544513891;}*/ ?>
<!DOCTYPE HTML>
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
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加权限</title>
</head>
<article class="page-container">
    <form class="form form-horizontal" id="form-rule-add" method="post" action="<?php url('rule/ruleAdd')?>">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $result['one']['title']?>" placeholder="" id="title" name="title">
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">规则标识：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $result['one']['name']?>" placeholder="" id="name" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">权限图标：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo $result['one']['icon']?>" placeholder="请使用矢量图标代码" id="icon" name="icon">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">上级分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		<select class="select" name="p_id" size="1">
			<option value="0">顶级分类</option>
            <?php foreach($result['parent_rule'] as $v){?>
                <option value="<?php echo $v['id']?>" <?php echo $result['one']['p_id'] == $v['id']?'selected':''?>><?php echo $v['title']?></option>
            <?php } ?>
		</select>
		</span> </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否启用：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="status" type="radio" id="sex-1" checked value="1" <?php echo $result['one']['status']==1 ? 'checked':''?>>
                    <label for="sex-1">启用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="status" value="0" <?php echo $result['one']['status']==0 ? 'checked':''?>>
                    <label for="sex-2">禁用</label>
                </div>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否在菜单栏显示：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="is_show" type="radio" id="sex-1" checked value="0" <?php echo $result['one']['status']==0 ? 'checked':''?>>
                    <label for="sex-1">显示</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="is_show" value="1" <?php echo $result['one']['status']==1 ? 'checked':''?>>
                    <label for="sex-2">不显示</label>
                </div>
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input type="hidden" name="id" value="<?php echo $result['one']['id']?>">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
            </div>
        </div>
    </form>
</article>
{/block}
{block name="js"}
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-yellow',
            increaseArea: '20%'
        });
        $("#form-rule-add").validate({
            rules:{
                title:{
                    required:true,
                },
                status:{
                    required:true,
                },

            },
            submitHandler:function(form){
                /**
                 * 成功之后的回调函数
                 * @type {{success: options.success}}
                 */
                var options = {
                    success: function (data) {
                        if(data.code==10000){
                            layer.msg(data.msg,{icon:1,time:1000});
                            setInterval("closeWindow()",1000);
                        }else{
                            layer.msg(data.msg,{icon:5,time:1000});
                        }
                    }
                };
                $(form).ajaxSubmit(options);
            }
        });
    });
    function closeWindow(){
        var index = parent.layer.getFrameIndex(window.name);
        window.parent.location.reload();
    }
</script>
{/block}
