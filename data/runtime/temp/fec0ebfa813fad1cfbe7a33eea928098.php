<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"./application/admin/template/member\money_index.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
                <h3>账户充值记录</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Member/money_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2 fl" style="margin-right: 6px;">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="搜索订单号...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2 fl" style="margin-right: 6px;">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Member/money_index'); ?>';">
                    </div> -->
                    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                        <input type="button" class="btn current" value="接口配置" onclick="window.location.href='<?php echo url("Member/pay_set"); ?>';">
                    </div>
                    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                        <input type="button" class="btn" value="账户充值记录" onclick="window.location.href='<?php echo url("Member/money_index"); ?>';">
                    </div>
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="sign w10" axis="col0">
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="">订单号</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w100">
                            <div class="tc">充值金额</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="w150">
                            <div class="tc">用户名</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w150">
                            <div class="tc">充值时间</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w100">
                            <div class="tc">支付方式</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w100">
                            <div class="tc">状态</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w100">
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
                                <div class="w10 tc">
                                </div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                    <?php echo $vo['order_number']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w100 tc">
                                    ￥<?php echo $vo['money']; ?>
                                </div>
                            </td>
                            <td class="sort">
                                <div class="w150 tc">
                                    <a href="<?php echo url('Member/users_edit', ['id'=>$vo['users_id'],'from'=>'money_index']); ?>"><?php echo $vo['username']; ?></a>
                                </div>
                            </td>
                            <td>
                                <div class="w150 tc">
                                    <?php echo date('Y-m-d H:i:s',$vo['add_time']); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="tc w100">
                                <?php if(!(empty($pay_method_arr[$vo['pay_method']]) || (($pay_method_arr[$vo['pay_method']] instanceof \think\Collection || $pay_method_arr[$vo['pay_method']] instanceof \think\Paginator ) && $pay_method_arr[$vo['pay_method']]->isEmpty()))): ?>
                                    <?php echo $pay_method_arr[$vo['pay_method']]; else: ?>
                                    ————
                                <?php endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="tc w100">
                                <?php echo $pay_status_arr[$vo['status']]; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="tc w100">
                                    <?php if($vo['status'] == 1): ?>
                                    <a class="btn blue"  href="javascript:void(0);" data-url="<?php echo url('Member/money_mark_order'); ?>" data-moneyid="<?php echo $vo['moneyid']; ?>" data-title="手工充值" data-status="<?php echo $vo['status']; ?>" data-username="<?php echo $vo['username']; ?>" data-money="<?php echo $vo['money']; ?>" onClick="handle(this);"><i class="fa fa-trash-o"></i>充值</a>
                                    <?php elseif($vo['status'] == 3): ?>
                                    <a class="btn blue"  href="javascript:void(0);" data-url="<?php echo url('Member/money_mark_order'); ?>" data-moneyid="<?php echo $vo['moneyid']; ?>" data-title="撤销充值" data-status="<?php echo $vo['status']; ?>" data-username="<?php echo $vo['username']; ?>" data-money="<?php echo $vo['money']; ?>" onClick="handle(this);"><i class="fa fa-trash-o"></i>撤销</a>
                                    <?php else: ?>
                                    ————
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
    });

    // 订单处理
    function handle(obj){
        var msg = '';
        var status = $(obj).attr('data-status');
        var username = $(obj).attr('data-username');
        var money = $(obj).attr('data-money');
        if (1 == status) {
            msg = "将为【<font color='red'>"+username+"</font>】账户充值<font color='red'>￥"+money+"元</font>，确认执行？";
        } else if (3 == status) {
            msg = "将扣除【<font color='red'>"+username+"</font>】账户余额<font color='red'>￥"+money+"元</font>，确认执行？";
        }

        layer.confirm(msg, {
            title: false,//$(obj).data('title'),
            btn: ['确定','取消'] //按钮
        }, function(){
            layer_loading('正在处理');
            // 确定
            $.ajax({
                type : 'post',
                url : $(obj).attr('data-url'),
                data : {moneyid:$(obj).attr('data-moneyid'), _ajax:1},
                dataType : 'json',
                success : function(res){
                    layer.closeAll();
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time:1000}, function(){
                            window.location.reload();
                        });
                    }else{
                        layer.alert(data.msg, {icon: 2, title:false});
                    }
                },
                error:function(){
                    layer.closeAll();
                    layer.alert(ey_unknown_error, {icon: 2, title:false});
                }
            })
        }, function(index){
            layer.closeAll();
        });
        return false;
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