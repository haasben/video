<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"./application/admin/template/users_release\conf.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
                <h3>功能配置</h3>
            </div>
        </div>
        <form class="form-horizontal" id="post_form" action="<?php echo url('UsersRelease/conf'); ?>" method="post">
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">
                        <label>投稿自动审核</label>
                    </dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_automatic_review1" class="cb-enable <?php if($UsersC['is_automatic_review'] == 1): ?>selected<?php endif; ?>">开启</label>
                            <label for="is_automatic_review0" class="cb-disable <?php if(!isset($UsersC['is_automatic_review']) || empty($UsersC['is_automatic_review'])): ?>selected<?php endif; ?>">关闭</label>

                            <input id="is_automatic_review1" name="users[is_automatic_review]" value="1" type="radio"  <?php if($UsersC['is_automatic_review'] == 1): ?> checked="checked"<?php endif; ?>>

                            <input id="is_automatic_review0" name="users[is_automatic_review]" value="0" type="radio" <?php if(!isset($UsersC['is_automatic_review']) || empty($UsersC['is_automatic_review'])): ?> checked="checked" <?php endif; ?>>
                        </div>
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <span style="padding-left: 10px; color: #C0C0C0;">开启后会员投稿将直接展示到前台文档列表</span>
                    </dd>
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label>投稿次数限制</label>
                    </dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_open_posts_count1" class="cb-enable <?php if($UsersC['is_open_posts_count'] == 1): ?>selected<?php endif; ?>">开启</label>
                            <label for="is_open_posts_count0" class="cb-disable <?php if(!isset($UsersC['is_open_posts_count']) || empty($UsersC['is_open_posts_count'])): ?>selected<?php endif; ?>">关闭</label>

                            <input id="is_open_posts_count1" name="users[is_open_posts_count]" value="1" type="radio"  <?php if($UsersC['is_open_posts_count'] == 1): ?> checked="checked"<?php endif; ?>>
                            <input id="is_open_posts_count0" name="users[is_open_posts_count]" value="0" type="radio" <?php if(!isset($UsersC['is_open_posts_count']) || empty($UsersC['is_open_posts_count'])): ?> checked="checked" <?php endif; ?>>
                        </div>
                        
                        &nbsp; &nbsp; &nbsp; &nbsp;
                        <a <?php if(!isset($UsersC['is_open_posts_count']) || empty($UsersC['is_open_posts_count'])): ?>style="display: none;"<?php endif; ?> id='UpUsersLevelBout' href="javascript:void(0);" onclick="UpUsersLevelBout();" class="ncap-btn ncap-btn-green">设置次数</a>

                        <span style="padding-left: 10px; color: #C0C0C0;">开启后可设置会员每日的投搞数量</span>
                    </dd>
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label for="title" id="select_title">投稿栏目选择</label>
                    </dt>
                    <dd class="opt">
                        <select name="typeids[]" id="typeid" style="width: 300px;" size="15" multiple="true">
                            <?php echo $select_html; ?>
                        </select>
                        <span class="err"></span>
                        <p class="red">(按 Ctrl 可以进行多选)</p>
                    </dd>
                </dl>
            </div>

            <div class="ncap-form-default">
                <dl class="row">
                    <div class="bot">
                        <a href="JavaScript:void(0);" onclick="UsersReleaseConfig();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
                    </div>
                </dl>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('input[name="users[is_open_posts_count]"]').click(function(){
            var is_open_posts_count = $(this).val();
            if (1 == is_open_posts_count) {
                $('#UpUsersLevelBout').show();
            } else {
                $('#UpUsersLevelBout').hide();
            }
        });
    });

    // 判断输入框是否为空
    function UsersReleaseConfig(){
        layer_loading('正在处理');
        $('#post_form').submit();
    }

    function UpUsersLevelBout()
    {
        var url = "<?php echo url('UsersRelease/ajax_users_level_bout'); ?>";
        //iframe窗
        layer.open({
            type: 2,
            title: '会员投稿次数设置',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['50%', '80%'],
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