<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:46:"./application/admin/template/index\welcome.htm";i:1575598627;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="/public/static/admin/css/main.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/font/css/font-awesome.min.css" rel="stylesheet" />
<link href="/public/static/admin/css/index.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<!--[if IE 7]>
  <link rel="stylesheet" href="/public/static/admin/font/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
    var eyou_basefile = "<?php echo \think\Request::instance()->baseFile(); ?>";
    var module_name = "<?php echo MODULE_NAME; ?>";
    var __root_dir__ = "";
    var __lang__ = "<?php echo $admin_lang; ?>";
    var __main_lang__ = "<?php echo $main_lang; ?>";
</script>  
<script type="text/javascript" src="/public/static/admin/js/jquery.js"></script>
<script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
<script src="/public/static/admin/js/upgrade.js?v=<?php echo $version; ?>"></script>


</head>
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" id="explanation_welcome">


    <?php if(empty($system_explanation_welcome_2)): ?>
    <div class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%; margin-top: 10px;">
        <div class="title checkZoom" data-type="2">
            <span title="不再提示" style="display: block;"></span>
        </div>
        <ul>
            <li style="color: red;">后台登录密码强度：<?php echo getPasswordLevelTitle($admin_login_pwdlevel); ?>，容易被暴力破解，请及时<a href="<?php echo url('Admin/admin_edit', ['id'=>\think\Session::get('admin_info.admin_id')]); ?>">【修改密码】</a>提高安全性。</li>
        </ul>
    </div>
    <?php endif; ?>
</div>
<div class="warpper">
    <div class="title">管理中心</div>
    <div class="content start_content">
        <div class="contentWarp">
            <div class="index_box">
                <section class="index_point hidden-xs">
                    <h3>快捷入口</h3>
                    <div class="container-fluid">
                        <ul>
                            <?php if(is_check_access('System@index') == '1'): ?>
                            <li>
                                <a href="<?php echo url('System/index', array('inc_type'=>'web')); ?>">
                                    <i class="fa fa-newspaper-o"></i>
                                    基本信息
                                </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <?php endif; if(is_check_access('Arctype@index') == '1'): ?>
                            <li>
                                <a href="<?php echo url('Arctype/index'); ?>" >
                                    <i class="fa fa-sitemap"></i>
                                    栏目管理
                                </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <?php endif; if(is_check_access('Archives@release') == '1'): ?>
                            <li>
                                <a href="<?php echo url('Archives/release'); ?>">
                                    <i class="fa fa-plus"></i>
                                    发布内容
                                </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <?php endif; ?>
                            <li>
                                <div class="">
                                    <a href="javascript:void(0);" class="bds_more bdsharebuttonbox" data-cmd="more">
                                        <i class="fa fa-share-alt"></i>分享成果
                                    </a>
                                </div>
                                <script>
                                    window._bd_share_config = {
                                        "common":{
                                            "bdSnsKey":{},
                                            "bdText":"<?php echo $share['bdText']; ?>",
                                            "bdMini":"2",
                                            "bdMiniList":false,
                                            "bdPic":"",
                                            "bdStyle":"2",
                                            "bdSize":"32",
                                            "bdUrl":"<?php echo $share['bdUrl']; ?>",
                                            "bdRootPath":""
                                        },
                                        "share":{}
                                    };
                                    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='public/plugins/share/api/js/share.js?v=<?php echo $version; ?>.js?cdnversion='+~(-new Date()/36e5)];
                                </script>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>

            <div class="section system_section" style="float: none;width: inherit;">

                <div class="system_section_con">
                    <div class="sc_title" style="padding: 26px 0 0px;border-bottom: 1px solid #e4eaec;">
                        <i class="sc_icon"></i>
                        <h3>
                            网站浏览量   总浏览量：<?php echo $weeks_order['count']; ?>
                        </h3>
                    </div>
                    <div class="sc_warp" id="main" style="display: block;padding-bottom: 20px;width: 100%;height:300px;">

                    </div>
                </div>
            </div>


            <div class="section system_section" style="float: none;width: inherit;">

                <div class="system_section_con">
                    <div class="sc_title" style="padding: 26px 0 14px;border-bottom: 1px solid #e4eaec;">
                        <i class="sc_icon"></i>
                        <h3>
                            服务器信息
                        </h3>
                    </div>
                    <div class="sc_warp" id="system_warp" style="display: block;padding-bottom: 20px;">
                        <table cellpadding="0" cellspacing="0" class="system_table">
                            <tbody><tr>
                                <td class="gray_bg">服务器操作系统：</td>
                                <td><?php echo $sys_info['os']; ?></td>
                                <td class="gray_bg">服务器域名/IP：</td>
                                <td><?php echo $sys_info['domain']; ?> [ <?php echo $sys_info['ip']; ?> ]</td>
                            </tr>
                            <tr>
                                <td class="gray_bg">服务器环境：</td>
                                <td><?php echo $sys_info['web_server']; ?></td>
                                <td class="gray_bg">PHP 版本：</td>
                                <td><?php echo $sys_info['phpv']; ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">Mysql 版本：</td>
                                <td><?php echo $sys_info['mysql_version']; ?></td>
                                <td class="gray_bg">GD 版本：</td>
                                <td><?php echo $sys_info['gdinfo']; ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">文件上传限制：</td>
                                <td><?php echo $sys_info['fileupload']; ?></td>
                                <td class="gray_bg">最大占用内存：</td>
                                <td><?php echo $sys_info['memory_limit']; ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">POST限制：</td>
                                <td><?php echo (isset($sys_info['postsize']) && ($sys_info['postsize'] !== '')?$sys_info['postsize']:'unknown'); ?></td>
                                <td class="gray_bg">最大执行时间：</td>
                                <td><?php echo $sys_info['max_ex_time']; ?></td>
                            </tr>
                            <tr>
                                <td class="gray_bg">Zip支持：</td>
                                <td><?php echo $sys_info['zip']; ?></td>
                                <td class="gray_bg">Zlib支持：</td>
                                <td><?php echo $sys_info['zlib']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer" style="position: static; bottom: 0px; font-size:14px;">
    <p>
        <b><?php echo htmlspecialchars_decode($global['web_copyright']); ?></b>
    </p>
</div>
<script type="text/javascript" src="/public/plugins/echarts/echarts.min.js"></script>
<script type="text/javascript">
     var myChart = echarts.init(document.getElementById('main'));        
        option = {
        xAxis: {
                type: 'category',
                data: [
                <?php if(is_array($weeks_order['day']) || $weeks_order['day'] instanceof \think\Collection || $weeks_order['day'] instanceof \think\Paginator): $i = 0; $__LIST__ = $weeks_order['day'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                '<?php echo $v['time']; ?>',
                <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: [
                 <?php if(is_array($weeks_order['day']) || $weeks_order['day'] instanceof \think\Collection || $weeks_order['day'] instanceof \think\Paginator): $i = 0; $__LIST__ = $weeks_order['day'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <?php echo $v['sum']; ?>,
                <?php endforeach; endif; else: echo "" ;endif; ?>

                ],
                type: 'line'
            },
            {   
                name:'总量',
                type:'line',
                stack: '总量',
                label: {
                    normal: {
                        show: true,
                        position: 'top'
                    }
                },
                areaStyle: {normal: {}},
                data:[
                    <?php if(is_array($weeks_order['day']) || $weeks_order['day'] instanceof \think\Collection || $weeks_order['day'] instanceof \think\Paginator): $i = 0; $__LIST__ = $weeks_order['day'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <?php echo $v['sum']; ?>,
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                ]
            }


            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);


    $(function () {

       


        // check_upgrade_version();
        $.get("<?php echo url('Ajax/welcome_handle', ['_ajax'=>1]); ?>"); // 进入欢迎页面需要异步处理的业务
        check_language_tips();

        // 检测语言版本
        function check_language_tips()
        {
            if (__main_lang__ != __lang__) {
                var language_title = $('#language_title', window.parent.document).html();
                layer.msg('当前后台已切换至【'+language_title+'】编辑状态！', {time:3000});
            }
        }

        // 版本检测更新弹窗
        function check_upgrade_version(){
            $.ajax({
                type : "GET",
                url  : "<?php echo url('Ajax/check_upgrade_version', ['_ajax'=>1]); ?>",
                data : {},
                dataType : "JSON",
                success: function(res) {
                    if (1 == res.code) {
                        if (2 == res.data.code) {
                            $('#upgrade_filelist').html(res.data.msg.upgrade);
                            $('#upgrade_intro').html(res.data.msg.intro);
                            $('#upgrade_notice').html(res.data.msg.notice);
                            $('#a_upgrade').attr('data-version', res.data.msg.key_num)
                            .attr('data-max_version', res.data.msg.max_version)
                            .attr('title', res.data.msg.tips);
                            $('#a_upgrade').html('检测到新版本'+res.data.msg.key_num+'[点击查看]').css('color', '#F00');

                            <?php if(-1 != $web_show_popup_upgrade AND (0 >= \think\Session::get('admin_info.role_id') OR 1 == \think\Session::get('admin_info.auth_role_info.online_update'))): ?>
                                btn_upgrade($("#a_upgrade"), 1);
                            <?php endif; ?>
                        } else {
                            $('#td_upgrade_msg').html(res.data.msg);
                        }
                    }
                }
            }); 
        }
    });

    $(function() {
        //操作提示缩放动画
        $(".checkZoom").click(function(){
            $(this).parent().animate({
                color: "#FFF",
                backgroundColor: "#4FD6BE",             
                width: "0",
                height: "0",                             
            },300,function(){
                $(this).remove();
            });
            if(1 >= $('#explanation_welcome').find('div.explanation').length) {
                $('#explanation_welcome').remove();
            }
            var url = eyou_basefile+"?m=admin&c=Ajax&a=explanation_welcome&type="+$(this).attr('data-type')+"&lang="+__lang__+"&_ajax=1";
            $.get(url);
        });

        checkInlet(); // 自动检测隐藏index.php
    });

    // 自动检测隐藏index.php
    function checkInlet() {
        layer.open({
            type: 2,
            title: false,
            area: ['0px', '0px'],
            shade: 0.0,
            closeBtn: 0,
            shadeClose: true,
            content: '//<?php echo \think\Request::instance()->host(); ?>/api/Rewrite/setInlet.html',
            success: function(layero, index){
                layer.close(index);
                var body = layer.getChildFrame('body', index);
                var content = body.html();
                if (content.indexOf("Congratulations on passing") == -1)
                {
                    $.ajax({
                        type : "POST",
                        url  : "/index.php?m=api&c=Rewrite&a=setInlet&_ajax=1",
                        data : {seo_inlet:0},
                        dataType : "JSON",
                        success: function(res) {

                        }
                    }); 
                }
            }
        });
    }
</script>
<br/>
<div id="goTop">
    <a href="JavaScript:void(0);" id="btntop">
        <i class="fa fa-angle-up"></i>
    </a>
    <a href="JavaScript:void(0);" id="btnbottom">
        <i class="fa fa-angle-down"></i>
    </a>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#think_page_trace_open').css('z-index', 99999);
    });
</script>
</body>
</html>