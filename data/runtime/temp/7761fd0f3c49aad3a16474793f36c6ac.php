<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:52:"./application/admin/template/member\users_config.htm";i:1571037856;s:70:"D:\wwwroot\www.gkbplc.com\application\admin\template\public\layout.htm";i:1571037616;s:67:"D:\wwwroot\www.gkbplc.com\application\admin\template\member\bar.htm";i:1571037616;s:73:"D:\wwwroot\www.gkbplc.com\application\admin\template\member\users_bar.htm";i:1571037616;s:70:"D:\wwwroot\www.gkbplc.com\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<script src="/public/static/admin/js/users_upgrade.js?v=<?php echo $version; ?>"></script>
<script type="text/javascript" src="/public/plugins/colpick/js/colpick.js"></script>
<link href="/public/plugins/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
<body style="background-color: rgb(255, 255, 255); overflow-y: scroll; cursor: default; -moz-user-select: inherit;">
<style type="text/css">
#picker {
    /*margin:0;*/
    /*padding:0;*/
    border:solid 1px #ccc;
    width:70px;
    height:20px;
    border-right:40px solid green;
    /*line-height:20px;*/
}
</style>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
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
                <h3>功能配置</h3>
                <h5></h5>
            </div>
            <form class="navbar-form form-inline" action="<?php echo url('Member/level_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    
    <?php if(is_check_access('Member@users_index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['users_index','users_add','users_edit'])): ?>current<?php endif; ?>" value="会员列表" onclick="window.location.href='<?php echo url("Member/users_index"); ?>';">
    </div>
    <?php endif; if(is_check_access('Member@level_index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['level_index','level_add','level_edit'])): ?>current<?php endif; ?>" value="会员级别" onclick="window.location.href='<?php echo url("Member/level_index"); ?>';">
    </div>
    <?php endif; if(is_check_access('Member@attr_index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['attr_index','attr_add','attr_edit'])): ?>current<?php endif; ?>" value="会员属性" onclick="window.location.href='<?php echo url("Member/attr_index"); ?>';">
    </div>
    <?php endif; if(is_check_access('Member@users_config') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['users_config'])): ?>current<?php endif; ?>" value="功能配置" onclick="window.location.href='<?php echo url("Member/users_config"); ?>';">
    </div>
    <?php endif; ?>

                </div>
            </form>
        </div>
        <form class="form-horizontal" id="postForm" action="<?php echo url('Member/users_config'); ?>" method="post">
<!--             <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">登录设置</div>
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
                        <label for="uname">第三方登录</label>
                    </dt>
                    <dd class="opt">
                        <label>
                            <input type="radio" name="oauth[oauth_open]" value="1" <?php if($info['oauth_open'] == 1): ?>checked="checked"<?php endif; ?>/>开启
                        </label>
                        &nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="oauth[oauth_open]" value="0" <?php if(!isset($info['oauth_open']) || empty($info['oauth_open'])): ?>checked="checked"<?php endif; ?>/>关闭
                        </label>
                        <span style="padding-left: 10px; color: #C0C0C0;">关闭则自动隐藏第三方登录入口。</span>
                    </dd>
                </dl>
                <dl class="row <?php if(!isset($info['oauth_open']) || empty($info['oauth_open'])): ?>none<?php endif; ?>" id="oauth_list">
                    <dt class="tit">
                        <label for="uname">第三方平台</label>
                    </dt>
                    <dd class="opt" style="line-height: 30px;">
                        <label>
                            <input type="checkbox" name="oauth[oauth_qq]" value="1" <?php if(!isset($info['oauth_qq']) || $info['oauth_qq'] == 1): ?>checked="checked"<?php endif; ?> />Q&nbsp;Q登录
                        </label>
                        <span style="padding-left: 23px; color: #C0C0C0;"><a href="javascript:void(0);" onclick="set_oauth_config(this);" data-oauth="qq" data-title="QQ登录配置">[配置参数]</a></span>
                        <br/>
                        <label>
                            <input type="checkbox" name="oauth[oauth_weixin]" value="1" <?php if(!isset($info['oauth_weixin']) || $info['oauth_weixin'] == 1): ?>checked="checked"<?php endif; ?> />微信登录
                        </label>
                        <span style="padding-left: 23px; color: #C0C0C0;"><a href="javascript:void(0);" onclick="set_oauth_config(this);" data-oauth="weixin" data-title="微信登录配置">[配置参数]</a></span>
                        <br/>
                        <label>
                            <input type="checkbox" name="oauth[oauth_weibo]" value="1" <?php if(!isset($info['oauth_weibo']) || $info['oauth_weibo'] == 1): ?>checked="checked"<?php endif; ?> />微博登录
                        </label>
                        <span style="padding-left: 23px; color: #C0C0C0;"><a href="javascript:void(0);" onclick="set_oauth_config(this);" data-oauth="weibo" data-title="微博登录配置">[配置参数]</a></span>
                    </dd>
                </dl>
            </div> -->

<!--             <div class="hDiv">
    <div class="hDivBox">
        <table cellspacing="0" cellpadding="0" style="width: 100%">
            <thead>
            <tr>
                <th class="sign w10" axis="col0">
                    <div class="tc"></div>
                </th>
                <th abbr="article_title" axis="col3" class="w10">
                    <div class="tc">会员系统</div>
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
            <label for="uname">前台模板更新</label>
        </dt>
        <dd class="opt">
            <label id="td_upgrade_msg">
                <div id="upgrade_filelist" style="display:none;"></div> 
                <div id="upgrade_intro" style="display:none;"></div> 
                <div id="upgrade_notice" style="display:none;"></div> 
                <a href="javascript:void(0);" id="a_upgrade" data-version="" data-max_version="" data-iframe="workspace" title="" data-upgrade_url="<?php echo url('Member/OneKeyUpgrade'); ?>" data-check_authority="<?php echo url('Member/check_authority'); ?>">正在版本检测中……</a>
            </label>
        </dd>
    </dl>
</div> -->

            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">注册设置</div>
                            </th>
                            <th abbr="ac_id" axis="col4">
                                <div class=""></div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <!-- config/users -->
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label for="uname">会员中心</label>
                    </dt>
                    <dd class="opt">
                        <label>
                            <input type="radio" name="users[users_open_register]" value="0" <?php if(!isset($info['users_open_register']) || empty($info['users_open_register'])): ?>checked="checked"<?php endif; ?>/>开启
                        </label>
                        &nbsp;&nbsp;&nbsp;
                        <label>
                            <input type="radio" name="users[users_open_register]" value="1" <?php if($info['users_open_register'] == 1): ?>checked="checked"<?php endif; ?>/>关闭
                        </label>
                        <span style="padding-left: 10px; color: #C0C0C0;">关闭则自动隐藏账户注册/登录的入口。</span>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username">注册验证</label>
                    </dt>
                    <dd class="opt" style="line-height: 30px;">
                        <label>
                            <input type="radio" name="users[users_verification]" value="0" <?php if(!isset($info['users_verification']) || empty($info['users_verification'])): ?>checked="checked"<?php endif; ?>/>不验证
                            <span style="padding-left: 23px; color: #C0C0C0;">注册会员后，可直接登录，无需验证。</span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="users[users_verification]" value="1" <?php if($info['users_verification'] == 1): ?>checked="checked"<?php endif; ?>/>后台激活
                            <span style="padding-left: 10px; color: #C0C0C0;">注册会员后，需后台审核激活后才能登录。</span>
                        </label>
                        <br/>
                        <label>
                            <input type="radio" name="users[users_verification]" value="2" onclick="email();" <?php if($info['users_verification'] == 2): ?>checked="checked"<?php endif; ?>/>邮件验证
                            <span style="padding-left: 10px; color: #C0C0C0;" >注册会员中，发送邮箱验证码校验才能注册。</span>
                        </label>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="username">禁止注册用户名</label>
                    </dt>
                    <dd class="opt" style="line-height: 30px;">
                        <textarea rows="5" cols="60" name="users[users_reg_notallow]" style="height:60px;"><?php echo (isset($info['users_reg_notallow']) && ($info['users_reg_notallow'] !== '')?$info['users_reg_notallow']:'www,bbs,ftp,mail,user,users,admin,administrator,eyoucms'); ?></textarea>
                        <p class="notic">前台注册时禁止注册的用户名列表，以逗号(,)分隔开</p>
                    </dd>
                </dl>
            </div>
            <!-- config/theme -->
            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">前台风格设置</div>
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
                        <label for="uname">左侧菜单</label>
                    </dt>
                    <dd class="opt">
                        <a href="javascript:void(0);" onclick="menu_index();" class="ncap-btn ncap-btn-green">管理</a>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="uname">主题颜色</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="theme[theme_color]" value="<?php echo (isset($info['theme_color']) && ($info['theme_color'] !== '')?$info['theme_color']:'#ff6565'); ?>" id="picker" style="border-color: <?php echo (isset($info['theme_color']) && ($info['theme_color'] !== '')?$info['theme_color']:'#ff6565'); ?>;" />
                    </dd>
                </dl>
            </div>

            <div class="ncap-form-default">
                <dl class="row">
                    <div class="bot">
                        <a href="JavaScript:void(0);" onclick="usersset();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
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

        $('input[name="oauth[oauth_open]"]').click(function(){
            var oauth_open = $(this).val();
            if (1 == oauth_open) {
                $('#oauth_list').show();
            } else {
                $('#oauth_list').hide();
            }
        });

        // 颜色选择
        $('#picker').colpick({
            flat:false,
            layout:'rgbhex',
            submit:0,
            colorScheme:'light',
            color:$('#picker').val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                $(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) $(el).val('#'+hex);
            }
        }).keyup(function(){
            $(this).colpickSetColor('#'+this.value);
        });

        // 版本检测更新弹窗
        // $.ajax({
        //     type : "GET",
        //     url  : "<?php echo url('Member/ajax_check_upgrade_version'); ?>",
        //     data : {},
        //     dataType : "JSON",
        //     success: function(res) {
        //         if (1 == res.code) {
        //             if (2 == res.data.code) {
        //                 $('#upgrade_filelist').html(res.data.msg.upgrade);
        //                 $('#upgrade_intro').html(res.data.msg.intro);
        //                 $('#upgrade_notice').html(res.data.msg.notice);
        //                 $('#a_upgrade').attr('data-version', res.data.msg.key_num)
        //                 .attr('data-max_version', res.data.msg.max_version)
        //                 .attr('title', res.data.msg.tips);
        //                 $('#a_upgrade').html('检测到新版本'+res.data.msg.key_num+'[点击查看]').css('color', '#F00');

        //                 <?php if((0 >= \think\Session::get('admin_info.role_id') OR 1 == \think\Session::get('admin_info.auth_role_info.online_update'))): ?>
        //                     // btn_upgrade($("#a_upgrade"), 0);
        //                 <?php endif; ?>
        //             } else {
        //                 $('#td_upgrade_msg').html(res.data.msg);
        //             }
        //         }
        //     }
        // });
    });

    function email(){
        $.ajax({
            url: "<?php echo url('Member/ajax_users_config_email'); ?>",
            type: 'GET',
            dataType: 'JSON',
            data: {},
            success: function(res){
                if (res.code == 0) {
                    $("input[name='users[users_verification]'][value=0]").attr("checked","checked" );
                    layer.alert(res.msg, {icon: 2, title:false});
                    return false;
                }
            },
            error: function(e){
                showErrorMsg(ey_unknown_error);
                return false;
            }
        });
    }

    function set_oauth_config(obj)
    {
        var title = $(obj).data('title');
        var oauth = $(obj).data('oauth');
        var url = "<?php echo url('Member/ajax_set_oauth_config'); ?>";
        if (url.indexOf('?') > -1) {
            url += '&';
        } else {
            url += '?';
        }
        url += 'oauth='+oauth;
        //iframe窗
        layer.open({
            type: 2,
            title: title,
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['80%', '80%'],
            content: url
        });
    }

    function menu_index()
    {
        var url = "<?php echo url('Member/ajax_menu_index'); ?>";
        //iframe窗
        layer.open({
            type: 2,
            title: '前台会员中心左侧菜单',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['80%', '80%'],
            content: url
        });
    }

    function usersset(){
        layer_loading('正在处理');
        $('#postForm').submit();
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