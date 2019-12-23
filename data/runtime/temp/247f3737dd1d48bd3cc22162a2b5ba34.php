<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:50:"./application/admin/template/filemanager\index.htm";i:1571037856;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\filemanager\bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
                <h3>模板管理</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?php echo url('Filemanager/index'); ?>" class="tab current"><span>文件管理</span></a></li>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>文件列表</h3>
                <h5>(共<?php echo count($list); ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th abbr="" axis="col3" class="">
                            <div class="" style="padding-left:15px ">文件名</div>
                        </th>
                        <th abbr="" axis="col3" class="w200">
                            <div class="tc">文件大小</div>
                        </th>
                        <th abbr="" axis="col6" class="w100">
                            <div class="tc">更新时间</div>
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
                            <td style="width: 100%">
                                <div style="text-align: left; padding-left: 15px;">
                                  <?php if(in_array($vo['filetype'], array('dir','dir2'))): ?>
                                  <a href="<?php echo url('Filemanager/index', array('activepath'=>replace_path($vo['filepath']))); ?>"><img src="/public/static/admin/images/<?php echo $vo['icon']; ?>" border="0" width="16" height="16" align="absmiddle">&nbsp;<?php echo $vo['filename']; ?></a>
                                  <?php else: if(!(empty($vo['icon']) || (($vo['icon'] instanceof \think\Collection || $vo['icon'] instanceof \think\Paginator ) && $vo['icon']->isEmpty()))): ?>
                                    <img src="/public/static/admin/images/<?php echo $vo['icon']; ?>" border="0" width="16" height="16" align="absmiddle" <?php if(!empty($vo['filepath']) AND 'image' == $vo['filemine']): ?>onmouseover="layer_tips=layer.tips('<img src=<?php echo $vo['filepath']; ?>?v=<?php echo time(); ?> class=\'layer_tips_img\'>',this,{tips: [1, '#fff']});"<?php endif; ?> onmouseout="layer.close(layer_tips);">
                                    <?php endif; ?>
                                    &nbsp;
                                    <?php if($vo['filemine'] == 'image'): ?>
                                        <a href="<?php echo $vo['filepath']; ?>?v=<?php echo time(); ?>" target="_blank"><?php echo $vo['filename']; ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo url('Filemanager/edit',array('filename'=>$vo['filename'], 'activepath'=>replace_path(dirname($vo['filepath'])))); ?>"><?php echo $vo['filename']; ?></a>
                                    <?php endif; endif; ?>
                                  <?php echo $vo['intro']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w200 tc">
                                  <?php echo (isset($vo['filesize']) && ($vo['filesize'] !== '')?$vo['filesize']:''); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w100 tc">
                                  <?php if(!(empty($vo['filetime']) || (($vo['filetime'] instanceof \think\Collection || $vo['filetime'] instanceof \think\Paginator ) && $vo['filetime']->isEmpty()))): ?>
                                  <?php echo date('Y-m-d',$vo['filetime']); endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc">
                                  <?php if($vo['filemine'] == 'image'): if(in_array($vo['filetype'], $replaceImgOpArr)): if(is_check_access(CONTROLLER_NAME.'@replace_img') == '1'): ?>
                                        <a href="<?php echo url('Filemanager/replace_img',array('filename'=>$vo['filename'], 'activepath'=>replace_path(dirname($vo['filepath'])))); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>替换</a>
                                        <?php endif; endif; else: if(in_array($vo['filetype'], $editOpArr)): if(is_check_access(CONTROLLER_NAME.'@edit') == '1'): ?>
                                        <a href="<?php echo url('Filemanager/edit',array('filename'=>$vo['filename'], 'activepath'=>replace_path(dirname($vo['filepath'])))); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                        <?php endif; endif; endif; ?>
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
                <?php if(is_check_access('Filemanager@newfile') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo url('Filemanager/newfile', array('activepath'=>replace_path($activepath))); ?>">
                        <div class="add" title="新建文件">
                            <span class="red"><i class="fa fa-file"></i>新建文件</span>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
    </div>
</div>
<form class="none" id="post_del" method="POST" action="">
  <input type="hidden" name="filename" value="">
  <input type="hidden" name="activepath" value="">
</form>
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

    function delfilename(obj, formid) {
        layer.confirm('此操作不可恢复，确认删除？', {
                title: false,
                btn: ['确定','取消'] //按钮
            }, function(){
                // 确定
                var form = $('#post_del');
                var filename = $(obj).attr('data-filename');
                var activepath = $(obj).attr('data-activepath');
                var url = $(obj).attr('data-url');
                $(form).find('input[name=filename]').val(filename);
                $(form).find('input[name=activepath]').val(activepath);
                $(form).attr('action', url);
                layer_loading('正在处理');
                $('#post_del').submit();
            }, function(index){
                layer.close(index);
                return false;// 取消
            }
        );
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