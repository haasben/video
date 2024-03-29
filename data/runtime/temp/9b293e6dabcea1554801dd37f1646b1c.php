<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"D:\phpStudy\PHPTutorial\WWW\video\core\tpl\dispatch_jump.tpl";i:1571037616;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ background: #fff; font-family: '微软雅黑'; color: #CCC; font-size: 16px; }
        .system-message{ padding: 24px 48px; margin:auto; border: #CCC 3px solid; top:50%; width:500px; border-radius:10px;
            -moz-border-radius:10px; /* Old Firefox */}
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 5px; }
        .system-message .jump{ padding-top: 10px; color: #999;}
        .system-message .success,.system-message .error{ line-height: 1.8em;  color: #999; font-size: 36px; font-family: '黑体'; }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
    </style>
    <script type="text/javascript" src="/public/static/common/js/jquery.tools.min.js"></script>
    <script type="text/javascript">
        $(function(){
            var height2=$('.system-message').height();
            var height1=$(window).height();
            $('.system-message').css('margin-top',((height1-height2)/3)-30);
        });
    </script>
    <!-- Bootstrap core CSS -->
    <link href="/public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="system-message">
        <?php switch($code): case "1": ?>
            <h1 class="glyphicon glyphicon-ok-circle" style="color:#09F"></h1>
            <p class="success"><?php echo strip_tags($msg); ?></p>
            <?php break; case "0": ?>
            <h1 class="glyphicon glyphicon-exclamation-sign" style="color:#F33"></h1>
            <p class="error"><?php echo strip_tags($msg); ?></p>
            <?php break; endswitch; ?>
        <p class="detail"></p>
        <p class="jump">页面自动 <a id="href" href="<?php echo $url; ?>" target="<?php if(empty($target) || (($target instanceof \think\Collection || $target instanceof \think\Paginator ) && $target->isEmpty())): ?>_self<?php else: ?><?php echo $target; endif; ?>">跳转</a> 等待时间：<b id="wait"><?php echo $wait; ?></b>
        </p>
    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),
                href = document.getElementById('href').href,
                target = document.getElementById('href').target;
            var interval = setInterval(function(){
                var time = --wait.innerHTML;
                if(time <= 0) {
                    if ('_parent' == target) {
                        parent.location.href = href;
                    } else {
                        location.href = href;
                    }
                    clearInterval(interval);
                };
            }, 1000);
        })();
    </script>
</body>
</html>