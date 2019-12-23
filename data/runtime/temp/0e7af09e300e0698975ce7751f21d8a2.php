<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:48:"./application/admin/template/shop\order_send.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;min-width:auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width:auto;">
    <div class="flexigrid">
        <form class="form-horizontal" id="postForm" action="<?php echo url('Shop/order_send_operating', ['_ajax'=>1]); ?>" method="post">
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
                                    <div class="tc">基本信息</div>
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
                        <label>订单编号</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['order_code']; ?>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>订单类型</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo $OrderData['prom_type_name']; ?>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label>下单时间</label>
                    </dt>
                    <dd class="opt">          
                        <?php echo MyDate('Y-m-d H:i:s',$OrderData['add_time']); ?>
                    </dd>
                </dl>
                <?php if($OrderData['prom_type'] == '0'): ?>
                    <dl class="row">
                        <dt class="tit">
                            <label>发货方式</label>
                        </dt>
                        <dd class="opt">          
                            <select name="prom_type" id="prom_type">
                                <option value="0" <?php if($OrderData['prom_type'] == '0'): ?> selected="selected" <?php endif; ?>>
                                    录入物流单号
                                </option>
                                <option value="1" <?php if($OrderData['prom_type'] == '1'): ?> selected="selected" <?php endif; ?>>
                                    无需物流
                                </option>
                            </select>
                            <span class="err"></span>
                            <p class="notic"></p>
                        </dd>
                    </dl>
                <?php else: ?>
                    <input type="hidden" name="prom_type" value="1">
                <?php endif; ?>

                <div class="<?php if($OrderData['prom_type'] == '1'): ?>none<?php endif; ?>" id="ShippingInfo">
                    <dl class="row">
                        <dt class="tit">
                            <label>物流公司</label>
                        </dt>
                        <dd class="opt">          
                            <span id="express_name_new"><?php echo $OrderData['express_name']; ?></span>
                            &nbsp;<a href="javascript:void(0);" onclick="Express();" class="ncap-btn ncap-btn-green">选择快递</a>
                            <input type="hidden" name="express_name" value="<?php echo $OrderData['express_name']; ?>" id="express_name">
                            <input type="hidden" name="express_id" value="<?php echo $OrderData['express_id']; ?>" id="express_id"/>
                            <input type="hidden" name="express_code" value="<?php echo $OrderData['express_code']; ?>" id="express_code">
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label>配送费用</label>
                        </dt>
                        <dd class="opt">          
                            ￥<?php echo $OrderData['shipping_fee']; ?>
                        </dd>
                    </dl>
                    <dl class="row">
                        <dt class="tit">
                            <label><em>*</em>配送单号</label>
                        </dt>
                        <dd class="opt">
                            <input type="text" value="<?php echo $OrderData['express_order']; ?>" name="express_order" id="express_order" class="input-txt">
                        </dd>
                    </dl>
                </div>

                <div class="<?php if($OrderData['prom_type'] == '0'): ?>none<?php endif; ?>" id="VirtualDelivery">
                    <dl class="row">
                        <dt class="tit">
                            <label>给买家回复</label>
                        </dt>
                        <dd class="opt">          
                            <textarea rows="5" cols="60" name="virtual_delivery" style="height:60px;"><?php echo $OrderData['virtual_delivery']; ?></textarea>
                            <span class="err"></span>
                            <p class="notic"></p>
                        </dd>
                    </dl>
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
                <?php if($OrderData['prom_type'] == '0'): ?>
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
                        <?php echo $OrderData['admin_note']; ?>
                        <span class="err"></span>
                        <p class="notic"></p>
                    </dd>
                </dl>
            </div>
            <div class="ncap-form-default">
                <div class="bot" style="padding-bottom:0px;">
                    <a href="JavaScript:void(0);" onclick="checkForm();" class="ncap-btn-big ncap-btn-green" id="submitBtn">
                        <?php if($OrderData['order_status'] == '1'): ?>
                            确认发货
                        <?php endif; if($OrderData['order_status'] == '2'): ?>
                            修改保存
                        <?php endif; ?>
                    </a>
                </div>
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

        $('#prom_type').change(function(){
            var prom_type = $(this).val();
            if (1 == prom_type) {
                $('#ShippingInfo').hide();
                $('#VirtualDelivery').show();
            } else {
                $('#ShippingInfo').show();
                $('#VirtualDelivery').hide();
            }
        });
    });

    // 物流公司选择框
    function Express(){
        var url = "<?php echo url('Shop/order_express'); ?>";
        //iframe窗
        layer.open({
            type: 2,
            title: '选择快递',
            shadeClose: false,
            maxmin: false, //开启最大化最小化按钮
            area: ['60%', '80%'],
            content: url
        });
    }

    // 选中地址，关闭物流公司弹框
    function express(obj, express_id){
        var express_name = $(obj).parent().find('#express_name_'+express_id).val();
        var express_code = $(obj).parent().find('#express_code_'+express_id).val();
        $('#express_id').val(express_id);
        $('#express_name').val(express_name);
        $('#express_name_new').html(express_name);
        $('#express_code').val(express_code);
        layer.closeAll();
    }

    // 表单提交
    function checkForm(){
        if(0 == $('#prom_type').val() && $('input[name=express_order]').val() == ''){
            showErrorMsg('配送单号不能为空！');
            $('input[name=express_order]').focus();
            return false;
        }

        var _parent = parent;

        layer.confirm('此操作不可恢复，确认发货？', {
            title: false,
            btn: ['确定','取消']
        },function(){
            layer_loading('正在处理');
            $.ajax({
                type: "POST",
                url: $('#postForm').attr('action'),
                data: $('#postForm').serialize(),
                dataType: 'json',
                success: function (res) {
                    layer.closeAll();
                    if(res.code == 1){
                        layer.msg(res.msg, {icon: 1, time: 1000}, function(){
                            _parent.window.location.reload();
                        });
                    }else{
                        layer.alert(res.msg, {icon: 2, title:false});
                        return false;
                    }
                },
                error:function(){
                    layer.closeAll();
                    layer.alert(ey_unknown_error, {icon: 2, title:false});
                }
            });
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