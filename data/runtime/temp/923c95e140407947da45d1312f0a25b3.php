<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:50:"./application/admin/template/channeltype\index.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>频道模型列表</h3>
                <h5>(共<?php echo $pageObj->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <div class="sDiv">
                <?php if(is_check_access('Field@arctype_index') == '1'): ?>
                    <div class="fbutton" style="float: none;">
                          <a href="<?php echo url('Field/arctype_index'); ?>">
                              <div class="add">
                                  <span><i class="fa fa-cogs"></i>栏目字段管理</span>
                              </div>
                          </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th abbr="article_title" axis="col3" class="w40">
                            <div class="tc">ID</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="">
                            <div style="text-align: left; padding-left: 10px;" class="">模型名称</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w120">
                            <div class="tc">模型标识</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w50">
                            <div class="tc">启用</div>
                        </th>
                        <th axis="col1" id="th_handle" class="w160">
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
                            <td class="sort">
                                <div class="tc w40">
                                    <?php echo $vo['id']; ?>
                                </div>
                            </td>
                            <td class="" style="width: 100%;">
                                <div class="tl" style="padding-left: 10px;">
                                    <?php if(is_check_access('Channeltype@edit') == '1'): ?>
                                    <a href="<?php echo url('Channeltype/edit',array('id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
                                    <?php else: ?>
                                    <?php echo $vo['title']; endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc"><?php echo $vo['nid']; ?></div>
                            </td>
                            <td>
                                <div class="tc w50">
                                <?php if(is_check_access('Channeltype@edit') == '1'): if($vo['status'] == 1): ?>
                                        <span class="yes" data-id="<?php echo $vo['id']; ?>" data-status="<?php if($vo['status'] == '1'): ?>0<?php else: ?>1<?php endif; ?>" data-title="<?php echo $vo['title']; ?>" onClick="handleShow(this);"><i class="fa fa-check-circle"></i>是</span>
                                    <?php else: ?>
                                        <span class="no" data-id="<?php echo $vo['id']; ?>" data-status="<?php if($vo['status'] == '1'): ?>0<?php else: ?>1<?php endif; ?>" data-title="<?php echo $vo['title']; ?>" onClick="handleShow(this);"><i class="fa fa-ban"></i>否</span>
                                    <?php endif; else: if($vo['status'] == 1): ?>是<?php else: ?>否<?php endif; endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="tl <?php if(empty($vo['ifsystem']) || (($vo['ifsystem'] instanceof \think\Collection || $vo['ifsystem'] instanceof \think\Paginator ) && $vo['ifsystem']->isEmpty())): ?>w230<?php else: ?>w160<?php endif; ?>">
                                    <?php if(is_check_access('Channeltype@edit') == '1'): if($vo['nid'] == 'guestbook'): ?>
                                        &nbsp;&nbsp;&nbsp;———
                                        <?php else: ?>
                                        <a href="<?php echo url('Channeltype/edit',array('id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o blocki"></i>编辑</a>
                                        <?php endif; endif; if(is_check_access('Channeltype@edit') == '1'): if($vo['nid'] == 'guestbook'): ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;—————
                                        <?php else: ?>
                                        <a href="<?php echo url('Field/channel_index',array('channel_id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-code blocki"></i>内容字段</a>
                                        <?php endif; endif; if(empty($vo['ifsystem']) || (($vo['ifsystem'] instanceof \think\Collection || $vo['ifsystem'] instanceof \think\Paginator ) && $vo['ifsystem']->isEmpty())): if(is_check_access('Channeltype@del') == '1'): ?>
                                        <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Channeltype/del'); ?>" data-id="<?php echo $vo['id']; ?>" data-deltype="pseudo" onClick="delfun(this);"><i class="fa fa-trash-o blocki"></i>删除</a>
                                        <?php endif; ?>
                                        <script type="text/javascript">
                                            $(function(){
                                                $('#th_handle').removeClass('w160').addClass('w230');
                                            });
                                        </script>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td align="" class="" style="width: 100%;">
                                <div>&nbsp;</div>
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
                <?php if(is_check_access('Channeltype@add') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo url('Channeltype/add'); ?>">
                        <div class="add" title="新增模型">
                            <span class="red"><i class="fa fa-plus"></i>新增模型</span>
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

    function delfun(obj){
        var title = '<font color="#ff0000">重要提示！</font>';
        layer.confirm('<font color="#ff0000">此操作将会删除与该模型所有相关的数据且不可恢复，请谨慎操作！</font>是否确认删除？', {
            title: false,
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
                        layer.alert(data.msg, {icon: 2, title:false});  //alert(data);
                    }
                }
            })
        }, function(index){
          layer.close(index);
        });
      return false;
    }

    function handleShow(obj){
        var title = $(obj).attr('data-title');
        $.ajax({
            type : 'post',
            url : "<?php echo url('Channeltype/ajax_show'); ?>",
            data : {id:$(obj).attr('data-id'),status:$(obj).attr('data-status'), _ajax:1},
            dataType : 'json',
            success : function(res){
                if (res.code == 1) {
                    if (0 == res.data.confirm) {
                        layer.msg(res.msg, {icon: 1, time:500}, function(){
                            window.location.reload();
                        });
                    } else {
                        var confirm = layer.confirm(res.msg, {
                            title: false,
                            btn: ['启用','取消'] //按钮
                        }, function(index){
                            layer.close(index);
                            layer_loading('正在处理');
                            // 确定
                            $.ajax({
                                type : 'post',
                                url : "<?php echo url('Channeltype/ajax_check_tpl'); ?>",
                                data : {id:$(obj).attr('data-id'),status:$(obj).attr('data-status'),tpltype:res.data.tpltype, _ajax:1},
                                dataType : 'json',
                                success : function(res){
                                    layer.closeAll();
                                    if(res.code == 1){
                                        layer.msg(res.msg, {icon: 1, time: 500}, function(){
                                            window.location.reload();
                                        });
                                    }else{
                                        layer.alert(res.msg, {icon: 2, title:false});
                                    }
                                }
                            })
                        });
                    }
                } else {
                    layer.alert(res.msg, {icon: 2, title:false});
                }
            },
            error:function(){
                layer.alert(ey_unknown_error, {icon: 2, title:false});
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