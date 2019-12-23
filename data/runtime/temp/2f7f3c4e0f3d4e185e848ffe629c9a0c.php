<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:59:"./application/admin/template/recycle_bin\archives_index.htm";i:1573184900;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\recycle_bin\bar.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\recycle_bin\btn.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>回收站</h3>
                <h5></h5>
            </div>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>文档回收列表</h3>
                <h5>(共<?php echo $pageObj->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form id="search_form" class="navbar-form form-inline" action="<?php echo url('RecycleBin/archives_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    
<div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
    <input type="button" class="btn <?php if(\think\Request::instance()->action() != 'arctype_index'): ?>current<?php endif; ?>" value="栏目管理" onClick="window.location.href='<?php echo url('RecycleBin/arctype_index'); ?>';">
</div>

<div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
    <input type="button" class="btn <?php if(\think\Request::instance()->action() != 'archives_index'): ?>current<?php endif; ?>" value="文档管理" onClick="window.location.href='<?php echo url('RecycleBin/archives_index'); ?>';">
</div>

<div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
    <input type="button" class="btn <?php if(\think\Request::instance()->action() != 'customvar_index'): ?>current<?php endif; ?>" value="自定义变量" onClick="window.location.href='<?php echo url('RecycleBin/customvar_index'); ?>';">
</div>

<div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
    <input type="button" class="btn <?php if(\think\Request::instance()->action() != 'proattr_index'): ?>current<?php endif; ?>" value="产品参数" onClick="window.location.href='<?php echo url('RecycleBin/proattr_index'); ?>';">
</div>

<div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
    <input type="button" class="btn <?php if(\think\Request::instance()->action() != 'gbookattr_index'): ?>current<?php endif; ?>" value="留言属性" onClick="window.location.href='<?php echo url('RecycleBin/gbookattr_index'); ?>';">
</div>
                    <div class="sDiv2">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="标题搜索...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('RecycleBin/archives_index'); ?>';">
                    </div> -->
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
                        <th abbr="article_title" axis="col3" class="">
                            <div style="text-align: left; padding-left: 10px;" class="">标题</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w150">
                            <div class="tc">所属栏目</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w100">
                            <div class="tc">删除时间</div>
                        </th>
                        <th axis="col1" class="w150">
                            <div class="tc">操作</div>
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
                    <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                        <tr>
                            <td class="no-data" align="center" axis="col0" colspan="50">
                                <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                            </td>
                        </tr>
                    <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$vo): ?>
                        <tr>
                            <td class="sign">
                                <div class="tc w40"><input type="checkbox" name="ids[]" value="<?php echo $vo['aid']; ?>"></div>
                            </td>
                           
                            <td class="sort">
                                <div class="tc w40">
                                    <?php echo $vo['aid']; ?>
                                </div>
                            </td>
                            <td class="" style="width: 100%;">
                                <div class="tl" style="padding-left: 10px;">
                                    <?php if(!(empty($vo['litpic']) || (($vo['litpic'] instanceof \think\Collection || $vo['litpic'] instanceof \think\Paginator ) && $vo['litpic']->isEmpty()))): ?>
                                        <img src="/public/static/admin/images/pic.gif" onmouseover="layer_tips=layer.tips('<img src=<?php echo $vo['litpic']; ?> class=\'layer_tips_img\'>',this,{tips: [1, '#fff']});" onmouseout="layer.close(layer_tips);">&nbsp;
                                    <?php endif; ?>
                                    <?php echo $vo['title']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w150 tc"><a href="<?php echo url('RecycleBin/archives_index', array('typeid'=>$vo['typeid'])); ?>"><?php echo (isset($vo['typename']) && ($vo['typename'] !== '')?$vo['typename']:'<i class="red">数据出错！</i>'); ?></a></div>
                            </td>
                            <td>
                                <div class="w100 tc">
                                    <?php echo date('Y-m-d',$vo['update_time']); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w150 tc">
                                    <?php if(is_check_access('RecycleBin@archives_recovery') == '1'): ?>
                                    <a class="btn blue" href="javascript:void(0);" data-url="<?php echo url('RecycleBin/archives_recovery'); ?>" data-id="<?php echo $vo['aid']; ?>" data-title="<?php echo $vo['title']; ?>" onClick="recovery(this);"><i class="fa fa-trash-o"></i>还原</a>
                                    <?php endif; if(is_check_access('RecycleBin@archives_del') == '1'): ?>
                                    <a class="btn red" href="javascript:void(0);" data-url="<?php echo url('RecycleBin/archives_del'); ?>" data-id="<?php echo $vo['aid']; ?>" data-title="<?php echo $vo['title']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>彻底删除</a>
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
                <div class="fbutton checkboxall">
                    <input type="checkbox" onclick="javascript:$('input[name*=ids]').prop('checked',this.checked);">
                </div>
                <?php if(is_check_access('RecycleBin@archives_recovery') == '1'): ?>
                <div class="fbutton">
                    <a onclick="batch_recovery(this, 'ids');" data-url="<?php echo url('RecycleBin/archives_recovery'); ?>">
                        <div class="add" title="批量还原">
                            <span><i class="fa fa-rotate-left"></i>批量还原</span>
                        </div>
                    </a>
                </div>
                <?php endif; if(is_check_access('RecycleBin@archives_del') == '1'): ?>
                <div class="fbutton">
                    <a onclick="batch_del(this, 'ids');" data-url="<?php echo url('RecycleBin/archives_del'); ?>">
                        <div class="add" title="批量彻底删除">
                            <span><i class="fa fa-close"></i>批量彻底删除</span>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $pageStr; ?>
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

    // 还原
    function recovery(obj){
        layer.confirm('<font color="red">该文档与关联栏目一起还原</font>，确认还原？', {
            title: false,//$(obj).data('title'),
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
     * 批量还原提交
     */
    function batch_recovery(obj, name) {
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
        // 还原按钮
        layer.confirm('<font color="red">选定文档与关联栏目一起还原</font>，确认批量还原？', {
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

    // 删除
    function delfun(obj){
        layer.confirm('此操作不可恢复，确认彻底删除？', {
            title: false,//$(obj).data('title'),
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