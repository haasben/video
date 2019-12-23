<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:47:"./application/admin/template/member\pay_set.htm";i:1571037856;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<body style="background-color: rgb(255, 255, 255); overflow-y: scroll; cursor: default; -moz-user-select: inherit;min-width: auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width: auto;">
        <div class="fixed-bar">
        <div class="item-title">
            <?php if(preg_match('/^money_/i', ACTION_NAME)): ?>
                <a class="back" href="<?php echo url(CONTROLLER_NAME.'/money_index'); ?>" title="返回列表">
                    <i class="fa fa-arrow-circle-o-left"></i>
                </a>
            <?php else: if(preg_match('/^shop/i', CONTROLLER_NAME)): ?>
                    <a class="back" href="<?php echo url("Shop/index"); ?>" title="返回列表">
                        <i class="fa fa-arrow-circle-o-left"></i>
                    </a>
                <?php else: if(preg_match('/^UsersRelease/i', CONTROLLER_NAME)): ?>
                        <a class="back" href="<?php echo url("Member/users_index"); ?>" title="返回列表">
                            <i class="fa fa-arrow-circle-o-left"></i>
                        </a>
                    <?php else: ?>
                        <a class="back" href="<?php echo url(CONTROLLER_NAME.'/users_index'); ?>" title="返回列表">
                            <i class="fa fa-arrow-circle-o-left"></i>
                        </a>
                    <?php endif; endif; endif; ?>
            <div class="subject">
                <h3>会员中心</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access('Member@users_index') == '1'): ?>
                    <li>
                        <a href="<?php echo url('Member/users_index'); ?>" <?php if(in_array(ACTION_NAME, ['users_index','level_index','attr_index','users_config'])): ?>class="current"<?php endif; ?>>
                            <span>会员列表</span>
                        </a>
                    </li>
                <?php endif; if(is_check_access('Member@pay_set') == '1'): if(1 == $userConfig['pay_open']): ?>
                        <li>
                            <a href="<?php echo url('Member/pay_set'); ?>" <?php if(in_array(ACTION_NAME, ['pay_set','money_index','money_edit'])): ?>class="current"<?php endif; ?>>
                                <span>支付功能</span>
                            </a>
                        </li>
                    <?php endif; endif; if(is_check_access('Shop@index') == '1'): if(1 == $userConfig['shop_open']): ?>
                        <li>
                            <a href="<?php echo url('Shop/index'); ?>" <?php if(in_array(CONTROLLER_NAME, ['Shop'])): ?>class="current"<?php endif; ?>>
                                <span>商城中心</span>
                            </a>
                        </li>
                    <?php endif; endif; if(is_check_access('Level@index') == '1'): if(1 == $userConfig['level_member_upgrade']): ?>
                        <li>
                            <a href="<?php echo url('Level/index'); ?>" <?php if(in_array(CONTROLLER_NAME, ['Level'])): ?>class="current"<?php endif; ?>>
                                <span>会员升级</span>
                            </a>
                        </li>
                    <?php endif; endif; if(is_check_access('UsersRelease@conf') == '1'): if(1 == $userConfig['users_open_release']): ?>
                        <li>
                            <a href="<?php echo url('UsersRelease/conf'); ?>" <?php if(in_array(CONTROLLER_NAME, ['UsersRelease'])): ?>class="current"<?php endif; ?>>
                                <span>会员投稿</span>
                            </a>
                        </li>
                    <?php endif; endif; ?>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>接口配置</h3>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn" value="接口配置" onclick="window.location.href='<?php echo url("Member/pay_set"); ?>';">
                </div>
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn current" value="账户充值记录" onclick="window.location.href='<?php echo url("Member/money_index"); ?>';">
                </div>
            </div>
        </div>
        <form class="form-horizontal" id="postWechatForm" action="<?php echo url('Member/wechat_set'); ?>" method="post">
            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">微信支付配置</div>
                            </th>
                            <th abbr="ac_id" axis="col4">
                                <div class=""></div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>支付方式</label>
                    </dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_open_wechat0" class="cb-enable <?php if(!isset($wechat['is_open_wechat']) || empty($wechat['is_open_wechat'])): ?>selected<?php endif; ?>">开启</label>
                            <label for="is_open_wechat1" class="cb-disable <?php if($wechat['is_open_wechat'] == 1): ?>selected<?php endif; ?>">关闭</label>
                            <input id="is_open_wechat0" name="wechat[is_open_wechat]" value="0" type="radio" <?php if(!isset($wechat['is_open_wechat']) || empty($wechat['is_open_wechat'])): ?> checked="checked"<?php endif; ?>>
                            <input id="is_open_wechat1" name="wechat[is_open_wechat]" value="1" type="radio" <?php if($wechat['is_open_wechat'] == 1): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username"><em>*</em>微信AppId</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="wechat[appid]" id="appid" value="<?php echo $wechat['appid']; ?>" class="input-txt">
                        <p class="notic">请输入您的微信公众平台中的微信AppId，用于微信支付。</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username"><em>*</em>微信商户号</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="wechat[mchid]" id="mchid" value="<?php echo $wechat['mchid']; ?>" class="input-txt">
                        <p class="notic">请输入您的微信公众平台中的微信商户号，用于微信支付。</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username"><em>*</em>微信KEY值</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="wechat[key]" id="key" value="<?php echo $wechat['key']; ?>" class="input-txt">
                        <p class="notic">请输入您的微信公众平台中的微信KEY值，用于微信支付。</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username"><em>*</em>微信AppSecret</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="wechat[appsecret]" id="appsecret" value="<?php echo $wechat['appsecret']; ?>" class="input-txt">
                        <p class="notic">请输入您的微信公众平台中的微信AppSecret，用于手机端微信支付。</p>
                    </dd>
                </dl>
                <dl class="row">
                    <div class="bot" style="padding-bottom:0px;">
                        <a href="JavaScript:void(0);" onclick="wechatset();" class="ncap-btn-big ncap-btn-green" id="submitWechatBtn">确认提交</a>
                        &nbsp;<a href="https://www.eyoucms.com/ask/?ct=question&askaid=202" target="_blank" style="font-size: 12px;padding-left: 10px;position:absolute;top: 30px">不会配置？</a>
                    </div>
                </dl>
            </div>
        </form>


        <form class="form-horizontal" id="postAlipayForm" action="<?php echo url('Member/alipay_set'); ?>" method="post">
            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">支付宝支付配置</div>
                            </th>
                            <th abbr="ac_id" axis="col4">
                                <div class=""></div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>支付方式</label>
                    </dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_open_alipay0" class="cb-enable <?php if(!isset($alipay['is_open_alipay']) || empty($alipay['is_open_alipay'])): ?>selected<?php endif; ?>">开启</label>
                            <label for="is_open_alipay1" class="cb-disable <?php if($alipay['is_open_alipay'] == 1): ?>selected<?php endif; ?>">关闭</label>
                            <input id="is_open_alipay0" name="alipay[is_open_alipay]" value="0" type="radio" <?php if(!isset($alipay['is_open_alipay']) || empty($alipay['is_open_alipay'])): ?> checked="checked"<?php endif; ?>>
                            <input id="is_open_alipay1" name="alipay[is_open_alipay]" value="1" type="radio" <?php if($alipay['is_open_alipay'] == 1): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="uname"><em></em>使用支付宝版本</label>
                    </dt>
                    <dd class="opt">
                        <label>
                            <input type="radio" name="alipay[version]" onclick="switch_set(this);" value="0" <?php if(empty($php_version) && empty($alipay['version'])): ?>checked="checked"<?php endif; ?> />新版接口
                            <span style="padding-left: 10px; color: #C0C0C0;">支持<font color="red">php5.5.0</font>或更高版本！(阿里云空间必须php7.0或以上)</span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="alipay[version]" onclick="switch_set(this);" value="1" <?php if($alipay['version'] == 1 || $php_version == 1): ?>checked="checked"<?php endif; ?> />旧版接口
                            <span style="padding-left: 10px; color: #C0C0C0;">可支持<font color="red">php5.4</font>或更高版本！</span>
                        </label>
                    </dd>
                </dl>

                <div id="new_version" <?php if($alipay['version'] == 1 || $php_version == 1): ?>class="none"<?php endif; ?>>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>支付宝APPID</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" name="alipay[app_id]" id="app_id" value="<?php echo $alipay['app_id']; ?>" class="input-txt">
                            <p class="notic">请输入您的支付宝APPID，用于支付宝支付。</p>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>商户私钥</label>
                        </dt>
                        <dd class="opt">
                            <textarea rows="5" cols="80" id="merchant_private_key" name="alipay[merchant_private_key]" style="height:120px;"><?php echo $alipay['merchant_private_key']; ?></textarea>
                            <p class="notic">请输入您的商户私钥，用于支付宝支付。</p>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>支付宝公钥</label>
                        </dt>
                        <dd class="opt">
                            <textarea rows="5" cols="80" id="alipay_public_key" name="alipay[alipay_public_key]" style="height:106px;"><?php echo $alipay['alipay_public_key']; ?></textarea>
                            <p class="notic">请输入您的支付宝公钥，用于支付宝支付。</p>
                        </dd>
                    </dl>
                </div>

                <div id="old_version" <?php if(empty($php_version) && empty($alipay['version'])): ?>class="none"<?php endif; ?>>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>支付宝账号</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" name="alipay[account]" id="account" value="<?php echo $alipay['account']; ?>" class="input-txt">
                            <p class="notic">请输入您的支付宝账号，用于支付宝支付。</p>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>交易安全校验码</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" name="alipay[code]" id="code" value="<?php echo $alipay['code']; ?>" class="input-txt">
                            <p class="notic">请输入您的交易安全校验码，用于支付宝支付。</p>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label for="username"><em>*</em>合作者身份ID</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" name="alipay[id]" id="id" value="<?php echo $alipay['id']; ?>" class="input-txt">
                            <p class="notic">请输入您的合作者身份ID，用于支付宝支付。</p>
                        </dd>
                    </dl>
                </div>
                <dl class="row">
                    <div class="bot">
                        <a href="JavaScript:void(0);" onclick="alipayset();" class="ncap-btn-big ncap-btn-green" id="submitAlipayBtn">确认提交</a>
                    </div>
                </dl>
            </div>
        </form>
    </div>
</div>
<script>
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

    /*微信支付配置*/
    function wechatset(){
        if($('#postWechatForm input[id=appid]').val() == ''){
            layer.alert('微信AppId不能为空！', {icon: 2, title:false});
            return false;
        }

        if($('#postWechatForm input[id=mchid]').val() == ''){
            layer.alert('微信商户号不能为空！', {icon: 2, title:false});
            return false;
        }

        if($('#postWechatForm input[id=key]').val() == ''){
            layer.alert('微信KEY值不能为空！', {icon: 2, title:false});
            return false;
        }

        if($('#postWechatForm input[id=appsecret]').val() == ''){
            layer.alert('微信AppSecret不能为空！', {icon: 2, title:false});
            return false;
        }

        layer_loading('正在处理');
        $.ajax({
            url: $('#postWechatForm').attr('action'),
            type: 'POST',
            dataType: 'JSON',
            data: $('#postWechatForm').serialize(),
            success: function(res){
                layer.closeAll();
                if (1 == res.code) {
                    layer.msg(res.msg, {icon: 1, time: 1000});
                    return false;
                } else {
                    layer.alert(res.msg, {icon: 2, title:false});
                    return false;
                }
            },
            error: function(e){
                layer.closeAll();
                showErrorMsg(ey_unknown_error);
                return false;
            }
        });
    }

    function php_version(is){
        var php_version = <?php echo $php_version; ?>;
        // php_version=1，表示php本版低于5.5.0，不可用新版支付方式
        if (php_version == 1) {
            if (is == true) {
                layer.alert('PHP版本低于5.5.0，不可用新版支付方式，请使用旧版！', {icon: 2, title:false});
            }
            $("#postAlipayForm input[name='alipay[version]'][value=1]").attr("checked","checked");
            return false;
        }
        return true;
    }

    function switch_set(obj){
        var switch_set = $(obj).val();
        if (switch_set == 0) {
            if (php_version(true)) {
                $("#postAlipayForm #new_version").show();
                $("#postAlipayForm #old_version").hide();
            }
        }else if (switch_set == 1) {
            $("#postAlipayForm #new_version").hide();
            $("#postAlipayForm #old_version").show();
        }
    }

    function alipayset(){
        var switch_set = $("#postAlipayForm input[name='alipay[version]']:checked").val();
        if (switch_set == 0) {
            // 新版判断
            if($('#postAlipayForm #app_id').val() == ''){
                layer.alert('支付APPID不能为空！', {icon: 2, title:false});
                return false;
            }

            if($('#postAlipayForm #merchant_private_key').val() == ''){
                layer.alert('商户私钥不能为空！', {icon: 2, title:false});
                return false;
            }

            if($('#postAlipayForm #alipay_public_key').val() == ''){
                layer.alert('支付宝公钥不能为空！', {icon: 2, title:false});
                return false;
            }
        }else if (switch_set == 1) {
            // 旧版判断
            if($('#postAlipayForm #account').val() == ''){
                layer.alert('支付宝账号不能为空！', {icon: 2, title:false});
                return false;
            }

            if($('#postAlipayForm #code').val() == ''){
                layer.alert('交易安全校验码不能为空！', {icon: 2, title:false});
                return false;
            }

            if($('#postAlipayForm #id').val() == ''){
                layer.alert('合作者身份ID不能为空！', {icon: 2, title:false});
                return false;
            }
        }

        layer_loading('正在处理');
        $.ajax({
            url: $('#postAlipayForm').attr('action'),
            type: 'POST',
            dataType: 'JSON',
            data: $('#postAlipayForm').serialize(),
            success: function(res){
                layer.closeAll();
                if (1 == res.code) {
                    layer.msg(res.msg, {icon: 1, time: 1000});
                    return false;
                } else {
                    layer.alert(res.msg, {icon: 2, title:false});
                    return false;
                }
            },
            error: function(e){
                layer.closeAll();
                showErrorMsg(ey_unknown_error);
                return false;
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