<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"./application/admin/template/system\smtp.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\system\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<link href="/public/plugins/layui/css/layui.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/css/main.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/css/page.css?v=<?php echo $version; ?>" rel="stylesheet" type="text/css">
<link href="/public/static/admin/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="/public/static/admin/font/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
    var eyou_basefile = "<?php echo \think\Request::instance()->baseFile(); ?>";
    var module_name = "<?php echo MODULE_NAME; ?>";
    var GetUploadify_url = "<?php echo url('Uploadify/upload'); ?>";
    var __root_dir__ = "";
    var __lang__ = "<?php echo $admin_lang; ?>";
</script>  
<link href="/public/static/admin/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/static/admin/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="/public/static/admin/js/jquery.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/public/static/admin/js/admin.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="/public/static/admin/js/common.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/public/static/admin/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="/public/static/admin/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/public/plugins/layui/layui.js"></script>
<script src="/public/static/admin/js/myFormValidate.js"></script>
<script src="/public/static/admin/js/myAjax2.js?v=<?php echo $version; ?>"></script>
<script src="/public/static/admin/js/global.js?v=<?php echo $version; ?>"></script>
</head>
<body style="background-color: #FFF; overflow-y: scroll;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <?php if(\think\Request::instance()->param('tabase') != '-1'): ?>
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>基本信息</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access(CONTROLLER_NAME.'@web') == '1'): ?>
                <li><a href="<?php echo url('System/web'); ?>" <?php if('web'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>网站设置</span></a></li>
                <?php endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@web2') == '1'): ?>
                <li><a href="<?php echo url('System/web2'); ?>" <?php if('web2'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>核心设置</span></a></li>
                <?php endif; endif; if(is_check_access(CONTROLLER_NAME.'@basic') == '1'): ?>
                <li><a href="<?php echo url('System/basic'); ?>" <?php if('basic'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>附件设置</span></a></li>
                <?php endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@water') == '1'): ?>
                <li><a href="<?php echo url('System/water'); ?>" <?php if(in_array(ACTION_NAME, ['water','thumb'])): ?>class="current"<?php endif; ?>><span>图片水印</span></a></li>
                <?php endif; endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@smtp') == '1'): ?>
                <li><a href="<?php echo url('System/smtp'); ?>" <?php if(preg_match('/^smtp/i', ACTION_NAME)): ?>class="current"<?php endif; ?>><span>接口配置</span></a></li>
                <?php endif; endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>接口配置</h3>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <!-- <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn" value="短信配置" onclick="window.location.href='<?php echo url("System/sms"); ?>';">
                </div>
            </div> -->
            <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn" value="邮件配置" onclick="window.location.href='<?php echo url("System/smtp"); ?>';">
                </div>
            </div>
        </div>
        <form method="post" id="handlepost" action="<?php echo url('System/smtp'); ?>">
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label for="smtp_server">发送邮件内容</label>
                    </dt>
                    <dd class="opt">
                        [<a href="javascript:void(0);" onclick="smtp_tpl_list();">配置模板</a>]
                        <p class=""></p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="smtp_server"><em>*</em>邮件发送服务器(SMTP)</label>
                    </dt>
                    <dd class="opt">
                        <input id="smtp_server" name="smtp_server" value="<?php echo (isset($config['smtp_server']) && ($config['smtp_server'] !== '')?$config['smtp_server']:''); ?>" class="input-txt" type="text"/>
                        <p class="">发送邮箱的smtp地址。如: smtp.qq.com或smtp.gmail.com</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="smtp_port"><em>*</em>服务器(SMTP)端口</label>
                    </dt>
                    <dd class="opt">
                        <input id="smtp_port" name="smtp_port" value="<?php echo (isset($config['smtp_port']) && ($config['smtp_port'] !== '')?$config['smtp_port']:465); ?>" class="input-txt" type="text"/>
                        <p class="notic">
                            smtp的端口，默认为465，具体请参看各STMP服务商的设置说明。
                        </p>
                        <p class=""><span style="color: red;">注意：如果使用阿里云服务器或Gmail，请将端口设为465，其他的可以尝试端口设为25</span>
                        </p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="smtp_user"><em>*</em>邮箱账号</label>
                    </dt>
                    <dd class="opt">
                        <input id="smtp_user" name="smtp_user" value="<?php echo (isset($config['smtp_user']) && ($config['smtp_user'] !== '')?$config['smtp_user']:''); ?>" class="input-txt" type="text"/>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="smtp_pwd"><em>*</em>邮箱授权码</label>
                    </dt>
                    <dd class="opt">
                        <input id="smtp_pwd"  name="smtp_pwd" value="<?php echo (isset($config['smtp_pwd']) && ($config['smtp_pwd'] !== '')?$config['smtp_pwd']:''); ?>" class="input-txt" type="text"/>
                        <p class="">使用发送邮件的邮箱授权码。具体请点击参看【<a href="http://note.youdao.com/noteshare?id=7680aba7a0faac4a4ae7f47c1c01e9fe" target="_blank">使用指南</a>】</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit"><em>*</em>接收的邮箱地址</dt>
                    <dd class="opt">
                        <input value="<?php echo (isset($config['smtp_from_eamil']) && ($config['smtp_from_eamil'] !== '')?$config['smtp_from_eamil']:''); ?>" name="smtp_from_eamil" id="smtp_from_eamil" class="input-txt" type="text">
                        <input value="测试发送" class="input-btn" onclick="sendEmail();" type="button">
                        <p class="notic">多个邮箱可以用逗号隔开</p>
                    </dd>
                </dl>
                <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="check_form();">确认提交</a></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });
    });

    function check_form(){
        if($('input[name="smtp_server"]').val() == ''){
            showErrorMsg('邮件发送服务器不能为空！');
            $('input[name=smtp_server]').focus();
            return false;
        }
        if($('input[name="smtp_user"]').val() == '' || !checkEmail($('input[name="smtp_user"]').val())){
            showErrorMsg('邮箱账号的格式不正确！');
            $('input[name=smtp_user]').focus();
            return false;
        }
        if($('input[name="smtp_pwd"]').val() == ''){
            showErrorMsg('邮箱授权码不能为空！');
            $('input[name=smtp_pwd]').focus();
            return false;
        }
        if($('input[name="smtp_from_eamil"]').val() == ''){
            showErrorMsg('接收的邮件地址不能为空！');
            $('input[name=smtp_from_eamil]').focus();
            return false;
        }
        layer_loading('正在处理');
        $('#handlepost').submit();
    }

    function sendEmail() {
        var email = $('#smtp_from_eamil').val();
        if (email == '') {
            showErrorMsg('接收的邮件地址不能为空！');
            $('input[name=smtp_from_eamil]').focus();
            return false;
        } else {
            var loading = layer_loading('正在发送');
            $.ajax({
                type: "post",
                data: $('#handlepost').serialize(),
                dataType: 'json',
                url: "<?php echo url('System/send_email', ['_ajax'=>1]); ?>",
                success: function (res) {
                    layer.closeAll();
                    if (res.code == 1) {
                        layer.msg(res.msg, {icon: 1, time:1000});
                    } else {
                        layer.msg(res.msg, {icon: 2, time: 2000});
                    }
                },
                error: function(){
                    layer.closeAll();
                    layer.msg('发送超时，稍后重试~', {icon: 2, time: 1500});
                }
            })
        }
    }

    function smtp_tpl_list()
    {
        var url = "<?php echo url('System/smtp_tpl'); ?>";
        //iframe窗
        layer.open({
            type: 2,
            title: '接口配置',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['80%', '80%'],
            content: url
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