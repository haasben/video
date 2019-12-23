<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"./application/admin/template/public\dispatch_jump.htm";i:1572852129;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>跳转提示</title>
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ background: #fff; font-family: '微软雅黑'; color: #CCC; font-size: 16px; }
        .system-message{ padding: 24px 30px; margin:auto; border: #e8e8e8 1px solid; top:50%; width:540px; background-color: #fff;box-shadow: 0 0 8px rgba(0,0,0,0.1);border-radius: 4px;overflow: hidden; }
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 5px; }
        .system-message .jump{ padding-top: 10px; color: #999;}
        .system-message .success,.system-message .error{ line-height: 1.8em;  color: #999; font-size: 36px; font-family: '黑体'; }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
        
        .system-message .tit{position: relative;height: 50px;line-height: 50px;width: 100%;border-bottom: 1px solid #eee;}
        .system-message .tit i{position: absolute;top: 12px;font-size: 30px;margin-right: 10px;color: #53bb4c;}
        .system-message .tit b{margin: 0 15px 0 30px;font-weight: normal;font-size: 16px;color: #53bb4c;}
        .system-message .tit span{font-size: 14px;margin: 0 10px;color: #999;}
        .system-message ul{margin: 10px auto; overflow: hidden;}
        .system-message ul li{float: left;list-style: none;margin:5px 18px 5px 0;}
        .system-message .buttom{margin: 10px auto; width: 100%; text-align: center; line-height: 40px; color: red;}
    </style>
    <script type="text/javascript">
        var __root_dir__ = "";
        var __lang__ = "<?php echo $admin_lang; ?>";
    </script> 
    <script type="text/javascript" src="/public/static/common/js/jquery.tools.min.js"></script>
    <script type="text/javascript">
        $(function(){
            var height2=$('.system-message').height();
            var height1=$(window).height();
            $('.system-message').css('margin-top',((height1-height2)/3)-30);
        });
    </script>
    <script src="/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>
    <!-- Bootstrap core CSS -->
    <script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
    <link href="/public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php switch($code): case "1": 
            $post = $_POST;
            isset($post['typeid']) && $post['tid'] = $post['typeid'];
            if (!empty($data) && is_array($data)) {
                $post = array_merge($post, $data);
            }
            $data = $post;
            $row = \think\DB::name('archives')
                ->field("b.*, a.*, a.aid as aid, c.ifsystem")
                ->alias('a')
                ->join('__ARCTYPE__ b', 'a.typeid = b.id', 'LEFT')
                ->join('__CHANNELTYPE__ c', 'c.id = a.channel', 'LEFT')
                ->where('a.aid', 'eq', $data['aid'])
                ->find();
            $arcurl = get_arcurl($row);
            $channel = $row['channel'];
            $seo_pseudo = tpCache('seo.seo_pseudo');
            $lang = input('param.lang/s', 'cn');
            $gourl = cookie('ENV_GOBACK_URL');
            $addurl = request()->baseFile()."?m=admin&c=Archives&a=add&typeid=".$data['tid']."&lang=".$lang;
            $listurl = cookie('ENV_LIST_URL')."&typeid=".$data['tid'];
            if (empty($row['ifsystem'])) {
                $listurl .= "&channel=".$data['channel'];
                $addurl .= "&channel=".$data['channel'];
            }
            $env_is_uphtml = cookie('ENV_IS_UPHTML');
            $action_name = request()->action();
            $ctl_name = request()->controller();
            if ('add' == $action_name) {
                $msg = '发布';
                $msg1 = '继续发布';
            } else {
                $msg = '编辑';
                $msg1 = '发布';
            }
         ?>
        <div class="system-message">
            <div class="tit">
                <i class="glyphicon glyphicon-ok-circle"></i><span><b>成功<?php echo $msg; ?>文档</b>请选择你的后续操作：</span>
            </div>
            <ul>
                <li><span><?php echo $msg1; ?>文档</span><a href="<?php echo $addurl; ?>" style="display: none;"><?php echo $msg1; ?>文档</a></li>
             <!--    <li><span>查看文档</span><a href="<?php echo $arcurl; ?>" target="_blank" style="display: none;">查看文档</a></li> -->
                <li><span>更改文档</span><a href="<?php echo \think\Request::instance()->baseFile(); ?>?m=admin&c=Archives&a=edit&id=<?php echo $data['aid']; ?>&typeid=<?php echo $data['tid']; ?>&lang=<?php echo (\think\Request::instance()->param('lang') ?: 'cn'); ?>" style="display: none;">更改文档</a></li>
                <li><span>已发布文档管理</span><a href="<?php echo $listurl; ?>" style="display: none;">已发布文档管理</a></li>
                <?php if(!(empty($gourl) || (($gourl instanceof \think\Collection || $gourl instanceof \think\Paginator ) && $gourl->isEmpty()))): ?>
                <li><span>[记忆的列表页]</span><a href="<?php echo $gourl; ?>" style="display: none;">[记忆的列表页]</a></li>
                <?php endif; ?>
            </ul>
            <?php if(2 == $seo_pseudo && 1 != $env_is_uphtml): ?>
            <div class="buttom" id="tips">正在生成当前文档……请勿刷新！</div>
            <input type="hidden" id="is_uphtml" value="1">
            <?php else: ?>
            <input type="hidden" id="is_uphtml" value="0">
            <?php endif; ?>
        </div>
        <script type="text/javascript">
        $(function(){
            var is_uphtml = $('#is_uphtml').val();
            if (0 == is_uphtml) {
                $('.system-message ul li').each(function(i,o){
                    $(o).find('span').hide();
                    $(o).find('a').show();
                })
            }
        });
        </script>
        <?php 
            if (2 == $seo_pseudo && 1 != $env_is_uphtml) {
                cookie('ENV_IS_UPHTML', 1);
         ?>
        <script type="text/javascript">
        /* 生成静态页面代码 */
        var aid = "<?php echo $data['aid']; ?>";
        var typeid = "<?php echo $data['tid']; ?>";
		var ctl_name = "<?php echo $ctl_name; ?>";
        if(aid > 0){
            $.ajax({
                url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml&lang="+__lang__,
                type:'POST',
                dataType:'json',
                data:{aid:aid,typeid:typeid,type:'view',ctl_name:ctl_name,_ajax:1},
                success:function(res){
                    layer.closeAll();
                    $('#tips').html('生成文档HTML成功，正在生成栏目……');
                    $.ajax({
                        url:__root_dir__+"/index.php?m=home&c=Buildhtml&a=upHtml&lang="+__lang__,
                        type:'POST',
                        dataType:'json',
                        data:{aid:aid,typeid:typeid,type:'lists',ctl_name:ctl_name,_ajax:1},
                        success:function(res){
                            layer.closeAll();
                            $('#tips').html('');
                        },
                        error: function(e){
                            layer.closeAll();
                            layer.alert('生成当前栏目HTML失败，请手工生成栏目静态！', {icon: 5, title: false});
                        }
                    });
                },
                error: function(e){
                    layer.closeAll();
                    layer.alert('生成HTML失败，请手工生成静态HTML！', {icon: 5, title: false});
                },
                complete:function(){
                    $('.system-message ul li').each(function(i,o){
                        $(o).find('span').hide();
                        $(o).find('a').show();
                    })
                }
            });
        }
        /* end */
        </script>
        <?php 
            }
         break; case "0": ?>
        <div class="system-message">
            <h1 class="glyphicon glyphicon-exclamation-sign" style="color:#F33"></h1>
            <p class="error"><?php echo strip_tags($msg); ?></p>
            <p class="detail"></p>
            <p class="jump">页面自动 <a id="href" href="<?php echo $url; ?>" target="<?php if(empty($target) || (($target instanceof \think\Collection || $target instanceof \think\Paginator ) && $target->isEmpty())): ?>_self<?php else: ?><?php echo $target; endif; ?>">跳转</a> 等待时间：<b id="wait"><?php echo $wait; ?></b>
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
            </p>
        </div>
    <?php break; endswitch; ?>
</body>
</html>