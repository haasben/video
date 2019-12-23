<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:51:"./application/admin/template/member\users_index.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:81:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\users_bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<body style="background-color: rgb(255, 255, 255); overflow-y: scroll; cursor: default; -moz-user-select: inherit;">
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
                <h3>会员列表</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Member/users_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2 fl" style="margin-right: 6px;">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="搜索用户名...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2 fl" style="margin-right: 6px;">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Member/users_index'); ?>';">
                    </div> -->
                    
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
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="sign w40" axis="col0">
                            <div class="tc">选择</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="w40">
                            <div class="tc">ID</div>
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="">用户名</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w100">
                            <div class="tc">会员级别</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w60">
                            <div class="tc">是否激活</div>
                        </th>
                        <th axis="col1" class="w120">
                            <div class="tc">操作</div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table style="width: 100%">
                    <tbody>
                    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                        <tr>
                            <td class="sign">
                                <div class="w40 tc">
                                    <input type="checkbox" name="ids[]" value="<?php echo $vo['users_id']; ?>">
                                </div>
                            </td>
                            <td class="sort">
                                <div class="w40 tc"><?php echo $vo['users_id']; ?></div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                    <?php if(is_check_access('Member@users_edit') == '1'): ?>
                                        <a href="<?php echo url('Member/users_edit',array('id'=>$vo['users_id'])); ?>"><?php echo $vo['username']; ?></a>
                                    <?php else: ?>
                                        <?php echo $vo['username']; endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w100 tc">
                                    <?php echo $vo['level_name']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w60 tc">
                                    <?php if($vo['is_activation'] == '1'): ?>
                                        <span class="yes" <?php if(is_check_access('Member@users_edit') == '1'): ?>onClick="changeTableVal('users','users_id','<?php echo $vo['users_id']; ?>','is_activation',this);"<?php endif; ?>><i class="fa fa-check-circle"></i>是</span>
                                    <?php else: ?>
                                        <span class="no" <?php if(is_check_access('Member@users_edit') == '1'): ?>onClick="changeTableVal('users','users_id','<?php echo $vo['users_id']; ?>','is_activation',this);"<?php endif; ?>><i class="fa fa-ban"></i>否</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc">
                                    <?php if(is_check_access('Member@users_edit') == '1'): ?>
                                        <a href="<?php echo url('Member/users_edit',array('id'=>$vo['users_id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php endif; if(is_check_access('Member@users_del') == '1'): ?>
                                        <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Member/users_del'); ?>" data-id="<?php echo $vo['users_id']; ?>" data-admin_id="<?php echo $vo['admin_id']; ?>" data-username="<?php echo $vo['username']; ?>" onClick="usersdel(this);"><i class="fa fa-trash-o"></i>删除</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="iDiv" style="display: none;"></div>
        </div>
        <div class="tDiv">
            <div class="tDiv2">
                <?php if(is_check_access('Member@users_del') == '1'): ?>
                <div class="fbutton checkboxall">
                    <input type="checkbox" onclick="javascript:$('input[name*=ids]').prop('checked',this.checked);">
                </div>
                <div class="fbutton">
                    <a onclick="batch_del(this, 'ids');" data-url="<?php echo url('Member/users_del'); ?>">
                        <div class="add" title="批量删除">
                            <span><i class="fa fa-close"></i>批量删除</span>
                        </div>
                    </a>
                </div>
                <?php endif; if(is_check_access('Member@users_batch_add') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo url('Member/users_batch_add'); ?>">
                        <div class="add" title="批量新增">
                            <span class="red"><i class="fa fa-plus"></i>批量新增</span>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $page; ?> </div>
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

        <?php if($is_syn_theme_users == '1'): ?>
            syn_theme_users();
        <?php endif; ?>
        function syn_theme_users()
        {
            layer_loading('初始化中');
            // 确定
            $.ajax({
                type : 'get',
                url : "<?php echo url('Member/ajax_syn_theme_users'); ?>",
                data : {_ajax:1},
                dataType : 'json',
                success : function(res){
                    layer.closeAll();
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time: 1000}, function(){
                            window.location.href = res.url;
                        });
                    }else{
                        layer.alert(res.msg, {icon: 2, title:false}, function(){
                            window.location.reload();
                        });
                    }
                },
                error: function(e){
                    layer.closeAll();
                    layer.alert(ey_unknown_error, {icon: 2, title:false}, function(){
                        window.location.reload();
                    });
                }
            })
        }
    });

    // 删除
    function usersdel(obj){
        var admin_id = $(obj).data('admin_id');
        if (0 < admin_id) {
            var title = "系统管理员前台ID，删除不可恢复？";
        } else {
            var title = "此操作不可恢复，确认彻底删除？";
        }
        layer.confirm(title, {
            title: false,//$(obj).attr('data-username'),
            btn: ['确定','取消'] //按钮
        }, function(){
            layer_loading('正在处理');
            // 确定
            $.ajax({
                type : 'post',
                url : $(obj).attr('data-url'),
                data : {del_id:$(obj).attr('data-id'), _ajax:1},
                dataType : 'json',
                success : function(data){
                    layer.closeAll();
                    if(data.code == 1){
                        layer.msg(data.msg, {icon: 1});
                        window.location.reload();
                    }else{
                        layer.alert(data.msg, {icon: 2, title:false});
                    }
                }
            })
        }, function(index){
            layer.close(index);
        });
        return false;
    }

    /**
     * 批量删除提交
     */
    function batch_del(obj, name) {
        var a = [];
        $('input[name^='+name+']').each(function(i,o){
            if($(o).is(':checked')){
                a.push($(o).val());
            }
        })
        if(a.length == 0){
            layer.alert('请至少选择一项', {icon: 2, title:false});
            return;
        }
        // 删除按钮
        layer.confirm('此操作不可恢复，确认批量彻底删除？', {
            title: false,
            btn: ['确定', '取消'] //按钮
        }, function () {
            layer_loading('正在处理');
            $.ajax({
                type: "POST",
                url: $(obj).attr('data-url'),
                data: {del_id:a, _ajax:1},
                dataType: 'json',
                success: function (data) {
                    layer.closeAll();
                    if(data.code == 1){
                        layer.msg(data.msg, {icon: 1});
                        window.location.reload();
                    }else{
                        layer.alert(data.msg, {icon: 2, title:false});
                    }
                },
                error:function(){
                    layer.closeAll();
                    layer.alert(ey_unknown_error, {icon: 2, title:false});
                }
            });
        }, function (index) {
            layer.closeAll(index);
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