<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"./application/admin/template/shop\order_details.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<style type="text/css">

.system_table{ border:1px solid #dcdcdc; width:100%;}
.system_table td{ height:40px; line-height:40px; font-size:12px; color:#454545; border-bottom:1px solid #dcdcdc; border-right:1px solid #dcdcdc; width:35%;padding-left:3%;}
.system_table td.gray_bg{ background:#f7f7f7; width:15%;}

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
                <h3>订单详情</h3>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn current" value="返回列表" onclick="window.location.href='<?php echo url("Shop/index"); ?>';">
                </div>
            </div>
        </div>
        <form class="form-horizontal" id="postForm" action="<?php echo url('Shop/order_mark_status'); ?>" method="post">
            <input type="hidden" name="order_id" value="<?php echo $OrderData['order_id']; ?>">
            <input type="hidden" name="order_code" value="<?php echo $OrderData['order_code']; ?>">
            <input type="hidden" name="users_id" value="<?php echo $OrderData['users_id']; ?>">
            <input type="hidden" name="consignee" value="<?php echo $OrderData['consignee']; ?>">
            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="sign w10" axis="col0">
                                    <div class="tc"></div>
                                </th>
                                <th abbr="article_title" axis="col3" class="w10">
                                    <div class="tc">订单信息</div>
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
                <table cellpadding="0" cellspacing="0" class="system_table">
                    <tbody>
                        <tr>
                            <td class="gray_bg">订单ID：</td>
                            <td><?php echo $OrderData['order_id']; ?></td>
                            <td class="gray_bg">订单编号：</td>
                            <td><?php echo $OrderData['order_code']; ?></td>
                        </tr>
                        <tr>
                            <td class="gray_bg">用户名：</td>
                            <td><?php echo $UsersData['username']; ?></td>
                            <td class="gray_bg">邮箱地址：</td>
                            <td><?php echo $UsersData['email']; ?></td>
                        </tr>
                        <tr>
                            <td class="gray_bg">手机号码：</td>
                            <td><?php echo $UsersData['mobile']; ?></td>
                            <td class="gray_bg">应付金额：</td>
                            <td>￥<?php echo $OrderData['order_amount']; ?></td>
                        </tr>
                        <tr>
                            <td class="gray_bg">支付方式：</td>
                            <td>
                                <?php if($OrderData['payment_method'] == '1'): ?>
                                    货到付款
                                <?php else: ?>
                                    在线支付
                                <?php endif; ?>
                            </td>
                            <td class="gray_bg">订单状态：</td>
                            <td>
                                <?php echo (isset($admin_order_status_arr[$OrderData['order_status']]) && ($admin_order_status_arr[$OrderData['order_status']] !== '')?$admin_order_status_arr[$OrderData['order_status']]:''); if($OrderData['order_status'] == '2'): ?>
                                    &nbsp;<a href="javascript:void(0);" data-url="<?php echo url('Shop/order_send',array('order_id'=>$OrderData['order_id'])); ?>" onclick="sendOrderDetails(this);" class="ncap-btn ncap-btn-green" >
                                        发货详情
                                    </a>
                                    <script type="text/javascript">
                                        // 发货、标记未付款
                                        function sendOrderDetails(obj){
                                            var url = $(obj).attr('data-url');
                                            //iframe窗
                                            var iframes = layer.open({
                                                type: 2,
                                                title: '订单发货详情',
                                                fixed: true, //不固定
                                                shadeClose: false,
                                                shade: 0.3,
                                                area: ['100%', '100%'],
                                                content: url
                                            });
                                            layer.full(iframes);
                                        }
                                    </script>
                                    <?php if($OrderData['prom_type'] == '0'): ?>
                                        &nbsp;<a href="javascript:void(0);" data-url="<?php echo $MobileExpressUrl; ?>" onclick="LogisticsInquiry(this);" class="ncap-btn ncap-btn-green" >
                                            物流查询
                                        </a>
                                        <script type="text/javascript">
                                            // 发货、标记未付款
                                            function LogisticsInquiry(obj){
                                                var url = $(obj).attr('data-url');
                                                //iframe窗
                                                var iframes = layer.open({
                                                    type: 2,
                                                    title: '物流查询',
                                                    shadeClose: false,
                                                    maxmin: false, //开启最大化最小化按钮
                                                    area: ['60%', '80%'],
                                                    content: url
                                                });
                                            }
                                        </script>
                                    <?php endif; endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="gray_bg">下单时间：</td>
                            <td><?php echo MyDate('Y-m-d H:i:s',$OrderData['add_time']); ?></td>
                            <td class="gray_bg">付款时间：</td>
                            <td><?php echo MyDate('Y-m-d H:i:s',$OrderData['pay_time']); ?></td>
                        </tr>
                        <tr>
                            <td class="gray_bg">付款方式：</td>
                            <td>
                                <?php if($OrderData['payment_method'] == '1'): ?>
                                    快递代收
                                <?php else: ?>
                                    <?php echo (isset($pay_method_arr[$OrderData['pay_name']]) && ($pay_method_arr[$OrderData['pay_name']] !== '')?$pay_method_arr[$OrderData['pay_name']]:'未付款'); endif; ?>
                            </td>
                            <td class="gray_bg">订单类型：</td>
                            <td><?php echo $OrderData['prom_type_name']; ?></td>
                        </tr>
                        <?php if(empty($OrderData['prom_type']) || (($OrderData['prom_type'] instanceof \think\Collection || $OrderData['prom_type'] instanceof \think\Paginator ) && $OrderData['prom_type']->isEmpty())): ?>
                            <tr>
                                <td class="gray_bg">物流公司：</td>
                                <td><?php echo $OrderData['express_name']; ?></td>
                                <td class="gray_bg">配送单号：</td>
                                <td><?php echo $OrderData['express_order']; ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="sign w10" axis="col0">
                                    <div class="tc"></div>
                                </th>
                                <th abbr="article_title" axis="col3" class="w10">
                                    <div class="tc">收货信息</div>
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
                <?php if(empty($OrderData['prom_type']) || (($OrderData['prom_type'] instanceof \think\Collection || $OrderData['prom_type'] instanceof \think\Paginator ) && $OrderData['prom_type']->isEmpty())): ?>
                <dl class="row">
                    <dt class="tit">
                        <label>收货人</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['consignee']; ?>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>联系方式</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['mobile']; ?>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>收货地址</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['country']; ?> <?php echo $OrderData['province']; ?> <?php echo $OrderData['city']; ?> <?php echo $OrderData['district']; ?> <?php echo $OrderData['address']; ?>
                    </dd>
                </dl>
               
                <?php endif; ?>
                <dl class="row">
                    <dt class="tit">
                        <label>订单留言</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['user_note']; ?>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>管理员备注</label>
                    </dt>
                    <dd class="opt">          
                        <textarea rows="5" cols="60" id="admin_note" name="admin_note" style="height:60px;"><?php echo $OrderData['admin_note']; ?></textarea>
                        <span class="err"></span>
                        <p class="notic"></p>
                    </dd>
                </dl>
                <div class="bot" style="padding-bottom:0px;">
                    <input type="hidden" name="gourl" value="<?php echo $gourl; ?>">
                    <a href="JavaScript:void(0);" onclick="UpNote('<?php echo $OrderData['order_id']; ?>');" class="ncap-btn-big ncap-btn-green" id="submitBtn">保存</a>
                </div>
            </div>

            <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">商品信息</div>
                            </th>
                            <th abbr="ac_id" axis="col4">
                                <div class=""></div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="hDiv" style="margin-top: 5px;">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="sign w60" axis="col0">
                                    <div class="tc">商品ID</div>
                                </th>
                                <th abbr="article_title" axis="col3" class="">
                                    <div style="text-align: left; padding-left: 10px;" class="">商品名称</div>
                                </th>
                                <th abbr="article_time" axis="col6" class="w150">
                                    <div class="tl">规格属性</div>
                                </th>
                                <th abbr="article_time" axis="col6" class="w80">
                                    <div class="tc">数量</div>
                                </th>
                                <th abbr="article_time" axis="col6" class="w100">
                                    <div class="tc">会员价格</div>
                                </th>
                                <th abbr="article_title" axis="col3" class="w100">
                                    <div class="tc">单品小计</div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="bDiv" style="height: auto;">
                <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                    <table style="width: 100%;">
                        <tbody>
                        <?php if(empty($DetailsData) || (($DetailsData instanceof \think\Collection || $DetailsData instanceof \think\Paginator ) && $DetailsData->isEmpty())): ?>
                            <tr>
                                <td class="no-data" align="center" axis="col0" colspan="50">
                                    <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                                </td>
                            </tr>
                        <?php else: if(is_array($DetailsData) || $DetailsData instanceof \think\Collection || $DetailsData instanceof \think\Paginator): if( count($DetailsData)==0 ) : echo "" ;else: foreach($DetailsData as $k=>$vo): ?>
                            <tr>
                                <td class="sort">
                                    <div class="tc w60">
                                        <?php echo $vo['product_id']; ?>
                                    </div>
                                </td>
                                <td class="" style="width: 100%;">
                                    <div class="tl" style="padding-left: 10px;">
                                        <a href="<?php echo $vo['arcurl']; ?>" target="_blank">
                                            <img src="<?php echo $vo['litpic']; ?>" style="width: 60px;height: 60px;"> <?php echo $vo['product_name']; ?>
                                        </a>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tl w150">
                                        <?php echo $vo['data']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w80">
                                        <?php echo $vo['num']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        ￥<?php echo $vo['product_price']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        ￥<?php echo $vo['subtotal']; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="iDiv" style="display: none;"></div>
            </div>

            <!-- <div class="hDiv">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tc"></div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w10">
                                <div class="tc">操作信息</div>
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
                <input type="hidden" name="status_name" id="status_name">
                <dl class="row">
                    <dt class="tit">
                        <label for="uname">可执行操作</label>
                    </dt>
                    <dd class="opt">
                        <?php if($OrderData['order_status'] == '0'): ?>
                            <a href="JavaScript:void(0);" onclick="OrderMark('yfk');" class="ncap-btn-big ncap-btn-green" id="submitBtn">
                                标记已付款
                            </a>
                        <?php endif; if($OrderData['order_status'] == '2'): ?>
                            <a href="JavaScript:void(0);" onclick="OrderMark('ysh');" class="ncap-btn-big ncap-btn-green" id="submitBtn">
                                标记已收货
                            </a>
                        <?php endif; if($OrderData['order_status'] != '-1'): ?>
                            <a href="JavaScript:void(0);" onclick="OrderMark('wx');" class="ncap-btn-big ncap-btn-green" id="submitBtn">
                                标记为无效
                            </a>
                        <?php endif; ?>
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
                                <div class="tc">操作记录</div>
                            </th>
                            <th abbr="ac_id" axis="col4">
                                <div class=""></div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="hDiv" style="margin-top: 5px;">
                <div class="hDivBox">
                    <table cellspacing="0" cellpadding="0" style="width: 100%">
                        <thead>
                        <tr>
                            <th class="sign w10" axis="col0">
                                <div class="tl"></div>
                            </th>
                            <th class="sign w130" axis="col0">
                                <div class="tl">操作者</div>
                            </th>
                            <th abbr="article_title" axis="col3" class="w180">
                                <div class="tc">操作时间</div>
                            </th>
                            <th abbr="article_time" axis="col6" class="w100">
                                <div class="tc">支付状态</div>
                            </th>
                            <th abbr="article_time" axis="col6" class="w100">
                                <div class="tc">发货状态</div>
                            </th>
                            <th abbr="article_time" axis="col6" class="w100">
                                <div class="tc">订单状态</div>
                            </th>
                            <th abbr="article_time" axis="col6" class="w100">
                                <div class="tc">操作描述</div>
                            </th>
                            <th abbr="article_title" axis="col3" class="">
                                <div style="text-align: left; padding-left: 10px;" class="">操作备注</div>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="bDiv" style="height: auto;">
                <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                    <table style="width: 100%;">
                        <tbody>
                        <?php if(empty($Action) || (($Action instanceof \think\Collection || $Action instanceof \think\Paginator ) && $Action->isEmpty())): ?>
                            <tr>
                                <td class="no-data" align="center" axis="col0" colspan="50">
                                    <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                                </td>
                            </tr>
                        <?php else: if(is_array($Action) || $Action instanceof \think\Collection || $Action instanceof \think\Paginator): if( count($Action)==0 ) : echo "" ;else: foreach($Action as $k=>$vo): ?>
                            <tr>
                                <td class="sort">
                                    <div class="tl w10"></div>
                                </td>
                                <td class="sort">
                                    <div class="tl w130">
                                        <?php echo $vo['username']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w180">
                                        <?php echo MyDate('Y-m-d H:i:s',$vo['add_time']); ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        <?php echo (isset($admin_order_status_arr[$vo['order_status']]) && ($admin_order_status_arr[$vo['order_status']] !== '')?$admin_order_status_arr[$vo['order_status']]:''); ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        <?php echo $vo['pay_status']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        <?php echo $vo['express_status']; ?>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="tc w100">
                                        <?php echo $vo['action_desc']; ?>
                                    </div>
                                </td>
                                <td class="" style="width: 100%;">
                                    <div class="tl" style="padding-left: 10px;">
                                        <?php echo $vo['action_note']; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="iDiv" style="display: none;"></div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    // 判断输入框是否为空
    function OrderMark(status_name){
        if('qfh' == status_name){
            var order_id = '<?php echo $OrderData['order_id']; ?>';
            var url = "<?php echo url('Shop/order_send'); ?>";
            if (url.indexOf('?') > -1) {
                url += '&';
            } else {
                url += '?';
            }
            url += 'order_id='+order_id;
            window.location.href = url;
            return false;
        }else if('yfk' == status_name){
            var msg = '确认订单已付款？';
        }else if('ysh' == status_name){
            var msg = '确认订单已收货？';
        }else if('wfk' == status_name){
            var msg = '确认订单未付款？';
        }else if('wx' == status_name){
            var msg = '确认订单无效？';
        }
        
        layer.confirm(msg, {
            title: false,
            btn: ['确定','取消']
        },function(){
            $('#status_name').val(status_name);
            layer_loading('正在处理');
            $('#postForm').submit();
        },function(index){
            layer.closeAll(index);
        });
    }

    // 更新管理员备注
    function UpNote(order_id){
        var admin_note = $('#admin_note').val();
        $.ajax({
            url: "<?php echo url('Shop/update_note'); ?>",
            data: {order_id:order_id,admin_note:admin_note},
            type:'post',
            dataType:'json',
            success:function(res){
                layer.closeAll();
                if ('1' == res.code) {
                    layer.msg(res.msg, {time: 1500});
                }else{
                    layer.msg(res.msg, {time: 1500});
                }
            }
        });
    }

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