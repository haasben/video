<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:52:"./application/admin/template/field\channel_index.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:61:"D:\WWW\video\application\admin\template\field\channel_bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
            <?php if(in_array((ACTION_NAME), explode(',',"channel_index"))): ?>
            <a class="back" href="<?php echo url('Channeltype/index'); ?>" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <?php else: ?>
            <a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <?php endif; ?>
            <div class="subject">
                <h3>模型管理</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?php echo url('Channeltype/edit', array('id'=>$channel_id)); ?>" class="tab"><span>编辑模型</span></a></li>
                <li><a href="<?php echo url('Field/channel_index', array('channel_id'=>$channel_id)); ?>" class="tab current"><span>内容字段</span></a></li>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>
                    <?php echo $channeltype_list[$channel_id]['title']; ?> - 字段列表
                </h3>
                <h5>(共<?php echo $pager->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Field/channel_index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="hidden" name="searchopt" value="1">
                        <input type="hidden" name="channel_id" id="channel_id" value="<?php echo (isset($channel_id) && ($channel_id !== '')?$channel_id:'1'); ?>">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="字段搜索...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Field/channel_index', array("channel_id"=>$channel_id)); ?>';">
                    </div> -->
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th abbr="article_title" axis="col3" class="w50">
                            <div class="tc">ID</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="">
                            <div class="">字段标题</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w160">
                            <div class="tc">字段名称</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w120">
                            <div class="tc">字段类型</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w70">
                            <div class="tc">字段分类</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w100">
                            <div class="tc">更新时间</div>
                        </th>
                        <th axis="col1" class="w250">
                            <div class="tc">操作</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w60">
                            <div class="tc">排序</div>
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
                                <div class="tc w50">
                                    <?php echo $vo['id']; ?>
                                </div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                <?php if(($vo['ifsystem'] == 1) OR (1 == $vo['ifmain'])): ?>
                                    <?php echo $vo['title']; else: if(is_check_access(CONTROLLER_NAME.'@channel_edit') == '1'): ?>
                                    <a href="<?php echo url('Field/channel_edit',array('channel_id'=>$channel_id,'id'=>$vo['id'])); ?>"><?php echo $vo['title']; ?></a>
                                    <?php else: ?>
                                    <?php echo $vo['title']; endif; endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w160 tc">
                                    <?php echo $vo['name']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc">
                                    <?php echo (isset($fieldtypeList[$vo['dtype']]['title']) && ($fieldtypeList[$vo['dtype']]['title'] !== '')?$fieldtypeList[$vo['dtype']]['title']:'数据错误'); ?>
                                </div>
                            </td>
                            <td>
                                <div class="tc w70">
                                    <?php if(($vo['ifsystem'] == 1) OR (1 == $vo['ifmain'])): ?>
                                        系统
                                    <?php else: ?>
                                        自定义
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w100 tc">
                                    <?php echo date('Y-m-d',$vo['update_time']); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w250 tc">
                                <?php if(is_check_access('Field@ajax_channel_show') == '1'): if($vo['ifcontrol'] == 1): ?>
                                ———
                                <?php else: ?>
                                <a class="btn blue"  href="javascript:void(0);" data-url="<?php echo url('Field/ajax_channel_show'); ?>" data-id="<?php echo $vo['id']; ?>" data-ifeditable="<?php if($vo['ifeditable'] == '1'): ?>0<?php else: ?>1<?php endif; ?>" onClick="handleShow(this);"><i class="fa fa-trash-o"></i><?php if($vo['ifeditable'] == 1): ?>隐藏<?php else: ?>显示<?php endif; ?></a>
                                <?php endif; endif; if(($vo['ifsystem'] == 1) OR (1 == $vo['ifmain'])): ?>
                                    ——————
                                <?php else: if(is_check_access(CONTROLLER_NAME.'@channel_edit') == '1'): ?>
                                    <a href="<?php echo url('Field/channel_edit',array('channel_id'=>$channel_id,'id'=>$vo['id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php endif; if(is_check_access(CONTROLLER_NAME.'@channel_del') == '1'): ?>
                                    <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Field/channel_del', array('channel_id'=>$channel_id)); ?>" data-id="<?php echo $vo['id']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>删除</a>
                                    <?php endif; endif; ?>
                                <a class="btn blue" href="javascript:void(0);" data-name="<?php echo $vo['name']; ?>" data-channel_id="<?php echo (isset($channel_id) && ($channel_id !== '')?$channel_id:'0'); ?>" data-dtype="<?php echo $vo['dtype']; ?>" data-ifmain="<?php echo $vo['ifmain']; ?>" data-is_screening="<?php echo $vo['is_screening']; ?>" onclick="copyToClipBoard(this)">标签调用</a>
                                </div>
                            </td>
                            <td class="sort">
                                <div class="w60 tc">
                                <?php if(empty($vo['ifmain'])): if(is_check_access(CONTROLLER_NAME.'@channel_edit') == '1'): ?>
                                    <input style="text-align: left;" type="text" onchange="changeTableVal('channelfield','id','<?php echo $vo['id']; ?>','sort_order',this);"  size="4"  value="<?php echo $vo['sort_order']; ?>" />
                                    <?php else: ?>
                                    <?php echo $vo['sort_order']; endif; else: ?>
                                    ———
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
                <?php if(is_check_access(CONTROLLER_NAME.'@channel_add') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo url('Field/channel_add', array('channel_id'=>$channel_id)); ?>">
                        <div class="add" title="新增字段">
                            <span class="red"><i class="fa fa-plus"></i>新增字段</span>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $page; ?>
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

        /*模型下拉框跳转*/
        $('#select_channel').change(function(){
            var channel_id = $(this).val();
            var url = "<?php echo url('Field/channel_index'); ?>";
            if (url.indexOf('?') > -1) {
                url += '&';
            } else {
                url += '?';
            }
            url += 'channel_id='+channel_id;
            layer_loading('正在处理');
            window.location.href = url;
        });
        /*--end*/
    });

    function delfun(obj){
      var title = $(obj).attr('data-typename');
      layer.confirm('<font color="#ff0000">数据将无法恢复</font>，确认删除？', {
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
                // $('tr[data-id="'+$(obj).attr('data-id')+'"]').remove();
              }else{
                layer.alert(data.msg, {icon: 2, title:false});
              }
            }
          })
        }, function(index){
          layer.close(index);
        }
      );
      return false;
    }  

    /**
     * 标签调用js
     * @param string  fieldname 字段名称
     * @param intval  channel_id 模型ID
     */
    function copyToClipBoard(obj) {
        var fieldname = $(obj).attr('data-name');
        var channel_id = $(obj).attr('data-channel_id');
        var dtype = $(obj).attr('data-dtype');
        var ifmain = $(obj).attr('data-ifmain');
        var is_screening = $(obj).attr('data-is_screening');
        var height = '280px';
        var contentdiv = '<div class="dialog_content" style="margin: 0px; padding: 0px;"><dl style="padding:10px 30px;line-height:30px;">';
        if (6 == channel_id) {
            switch(dtype)
            {
                case 'imgs':
                    {
                        height = '400px';
                        var viewstr = "{eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyou.field."+fieldname+"'}\r\n    <img src='{$"+fieldname+".image_url}' />\r\n    注释：{$"+fieldname+".intro}\r\n{/eyou:diyfield";
                        contentdiv += '<dd>列表/内容页：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:80px;">' + viewstr + '}</textarea></dd>';
                        var liststr = "{eyou:type typeid='栏目ID' id='eyoav' addfields='"+fieldname+"'}\r\n    {eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyoav."+fieldname+"'}\r\n        <img src='{$"+fieldname+".image_url}' />\r\n        注释：{$"+fieldname+".intro}\r\n    {/eyou:diyfield"+"}\r\n{/eyou:type";
                        contentdiv += '<dd>标签 arclist / list 内调用 <font color="red">(更多简洁调法请参考标签 arclist /list)</font>：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:120px;">' + liststr + '}</textarea></dd>';
                    }
                    break;

                case 'checkbox':
                    {
                        height = '400px';
                        var viewstr = "{eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyou.field."+fieldname+"'}\r\n    {$"+fieldname+".value}\r\n{/eyou:diyfield";
                        contentdiv += '<dd>列表/内容页：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:60px;">' + viewstr + '}</textarea></dd>';
                        var liststr = "{eyou:type typeid='栏目ID' id='eyoav' addfields='"+fieldname+"'}\r\n    {eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyoav."+fieldname+"'}\r\n        {$"+fieldname+".value}\r\n    {/eyou:diyfield"+"}\r\n{/eyou:type";
                        contentdiv += '<dd>标签 arclist / list 内调用 <font color="red">(更多简洁调法请参考标签 arclist /list)</font>：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:120px;">' + liststr + '}</textarea></dd>';
                    }
                    break;

                default:
                    {
                        contentdiv += '<dd>列表/内容页：</dd>';
                        contentdiv += '<dd><input type="text" style=" width:470px;margin-bottom:10px;" value="{$'+'eyou.field.'+fieldname+'}"></dd>';
                        var liststr = "{eyou:type typeid='栏目ID' addfields='"+fieldname+"'}\r\n    {$"+"field."+fieldname+"}\r\n{/eyou:type";
                        contentdiv += '<dd>标签 type 属性 addfields 调用：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:60px;">' + liststr + '}</textarea></dd>';
                    }
                    break;
            }

        } else {
            switch(dtype)
            {
                case 'imgs':
                    {
                        height = '400px';
                        var viewstr = "{eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyou.field."+fieldname+"'}\r\n    <img src='{$"+fieldname+".image_url}' />\r\n    注释：{$"+fieldname+".intro}\r\n{/eyou:diyfield";
                        contentdiv += '<dd>内容页：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:80px;">' + viewstr + '}</textarea></dd>';
                        var liststr = "{eyou:arcview aid='$"+"field.aid' id='eyoav' addfields='"+fieldname+"'}\r\n    {eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyoav."+fieldname+"'}\r\n        <img src='{$"+fieldname+".image_url}' />\r\n        注释：{$"+fieldname+".intro}\r\n    {/eyou:diyfield"+"}\r\n{/eyou:arcview";
                        contentdiv += '<dd>标签 arclist / list 内调用 <font color="red">(更多简洁调法请参考标签 arclist /list)</font>：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:120px;">' + liststr + '}</textarea></dd>';
                    }
                    break;

                case 'checkbox':
                    {
                        height = '430px';
                        var viewstr = "{eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyou.field."+fieldname+"'}\r\n    {$"+fieldname+".value}\r\n{/eyou:diyfield";
                        contentdiv += '<dd>内容页：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:60px;">' + viewstr + '}</textarea></dd>';
                        var liststr = "{eyou:arcview aid='$"+"field.aid' id='eyoav' addfields='"+fieldname+"'}\r\n    {eyou:diyfield type='"+dtype+"' id='"+fieldname+"' name='$"+"eyoav."+fieldname+"'}\r\n        {$"+fieldname+".value}\r\n    {/eyou:diyfield"+"}\r\n{/eyou:arcview";
                        contentdiv += '<dd>标签 arclist / list 内调用 <font color="red">(更多简洁调法请参考标签 arclist /list)</font>：</dd>';
                        contentdiv += '<dd><textarea rows="4" cols="60" style="width:470px;height:120px;">' + liststr + '}</textarea></dd>';
                        if (1 == is_screening) {
                            contentdiv += '<dd style="color: red;">自定义字段应用于条件筛选，请参考标签用法：<a id="call_tags_help" href="https://www.eyoucms.com/plus/view.php?aid=7881" target="_blank">查看标签调用</a></dd>';
                        }
                    }
                    break;

                default:
                    {
                        contentdiv += '<dd>内容页：</dd>';
                        contentdiv += '<dd><input type="text" style=" width:470px;margin-bottom:10px;" value="{$'+'eyou.field.'+fieldname+'}"></dd>';
                        if (1 == ifmain) {
                            contentdiv += '<dd>标签 arclist / list 内调用：</dd>';
                            contentdiv += '<dd><input type="text" style=" width:470px;margin-bottom:10px;" value="{$'+'field.'+fieldname+'}"></dd>';
                        } else {
                            var liststr = "eyou:field aid='$"+"field.aid' addfields='"+fieldname+"' /";
                            contentdiv += '<dd>标签 arclist / list 内调用：</dd>';
                            contentdiv += '<dd><input type="text" style=" width:470px;margin-bottom:10px;" value="{'+liststr+'}"></dd>';
                        }
                        if (1 == is_screening) {
                            contentdiv += '<dd style="color: red;">自定义字段应用于条件筛选，请参考标签用法：<a id="call_tags_help" href="https://www.eyoucms.com/plus/view.php?aid=7881" target="_blank">查看标签调用</a></dd>';
                        }
                    }
                    break;
            }
        }
        contentdiv += '<dd style="border-top: dotted 1px #E7E7E7; color: #F60;">请将相应标签复制并粘贴到对应模板文件中！</dd></dl></div>'
        layer.open({
            title: '标签调用',
            type: 1,
            skin: 'layui-layer-demo',
            area: ['550px', height], //宽高
            content: contentdiv
        });
    }

    function handleShow(obj){
        $.ajax({
            type : 'post',
            url : $(obj).attr('data-url'),
            data : {id:$(obj).attr('data-id'),ifeditable:$(obj).attr('data-ifeditable'), _ajax:1},
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