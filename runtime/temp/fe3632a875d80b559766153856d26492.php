<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:17:"./tpl/success.tpl";i:1544617672;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="textml; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; text-align: center;margin-top: 100px;}
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
h1 img{width: 100px;}
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 18px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
.tiao{margin-top: 40px}
.tiao a{font-size: 16px;color: #fff;border-radius: 4px;background-color: #0d65a3;padding: 6px 16px;text-decoration: none;}
</style>
</head>
<body>
<div class="system-message">
	<?php switch ($code) {case 1:?>
            <h1><img src="/admindemo/public/static/images/success.jpg"></h1>
            <p class="success"><?php echo(strip_tags($msg));?></p>
            <?php break;case 0:?>
            <h1><img src="/admindemo/public/static/images/error.jpg"></h1>
            <p class="error"><?php echo(strip_tags($msg));?></p>
            <?php break;} ?>
<p class="detail"></p>
<p class="jump">
页面自动跳转 等待时间： <b id="wait"><?php echo($wait); ?></b>
</p>
<p class="tiao"><a id="href" href="<?php echo($url); ?>">点击跳转</a></p>
</div>
<script type="text/javascript">
(function(){
    var wait = document.getElementById('wait'),
        href = document.getElementById('href').href;
    var interval = setInterval(function(){
        var time = --wait.innerHTML;
        if(time <= 0) {
            location.href = href;
            clearInterval(interval);
        };
    }, 1000);
})();
</script>
</body>
<html>