<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:44:"./application/admin/template/admin\index.htm";i:1571037856;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\admin\admin_bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
            <a class="back" href="<?php echo url(CONTROLLER_NAME.'/index'); ?>" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>管理员</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access('Admin@index') == '1'): ?>
                <li><a href="<?php echo url("Admin/index"); ?>" class="tab <?php if(in_array(\think\Request::instance()->controller(), array('Admin'))): ?>current<?php endif; ?>"><span>管理员列表</span></a></li>
                <?php endif; if($main_lang == $admin_lang): if(is_check_access('AuthRole@index') == '1'): ?>
                <li><a href="<?php echo url("AuthRole/index"); ?>" class="tab <?php if(in_array(\think\Request::instance()->controller(), array('AuthRole'))): ?>current<?php endif; ?>"><span>权限组列表</span></a></li>
                <?php endif; endif; ?>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>管理员列表</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Admin/index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2">
                        <input type="text" size="30" name="keywords" value="<?php echo \think\Request::instance()->param('keywords'); ?>" class="qsbox" placeholder="搜索相关数据...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Admin/index'); ?>';">
                    </div> -->
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <?php if($main_lang == $admin_lang): ?>
                        <th class="sign w40" axis="col0">
                            <div class="tc">选择</div>
                        </th>
                        <?php endif; ?>
                        <th abbr="article_title" axis="col3" class="w40">
                            <div class="tc">ID</div>
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="">用户名</div>
                        </th>
                        <th abbr="ac_id" axis="col4" class="w150">
                            <div class="tc">真实姓名</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w150">
                            <div class="tc">权限组</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w120">
                            <div class="tc">手机号码</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w160">
                            <div class="tc">最后登录时间</div>
                        </th>
                        <th axis="col1" class="w120">
                            <div class="tc">操作</div>
                        </th>
                        
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto; min-height: auto;">
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
                            <?php if($main_lang == $admin_lang): ?>
                            <td class="sign">
                                <div class="w40 tc">
                                    <?php if(\think\Session::get('admin_id') != $vo['admin_id'] AND !empty($vo['parent_id'])): ?>
                                    <input type="checkbox" name="ids[]" value="<?php echo $vo['admin_id']; ?>">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <?php endif; ?>
                            <td class="sort">
                                <div class="w40 tc"><?php echo $vo['admin_id']; ?></div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                    <?php if(is_check_access('Admin@admin_edit') == '1'): ?>
                                    <a href="<?php echo url('Admin/admin_edit',array('id'=>$vo['admin_id'])); ?>"><?php echo $vo['user_name']; ?></a>
                                    <?php else: ?>
                                    <?php echo $vo['user_name']; endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w150 tc">
                                    <?php echo $vo['true_name']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w150 tc"><?php echo (isset($vo['role_name']) && ($vo['role_name'] !== '')?$vo['role_name']:'<em class="red">数据出错</em>'); ?></div>
                            </td>
                            <td>
                                <div class="w120 tc">
                                    <?php echo $vo['mobile']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="tc w160">
                                <?php if(empty($vo['last_login']) || (($vo['last_login'] instanceof \think\Collection || $vo['last_login'] instanceof \think\Paginator ) && $vo['last_login']->isEmpty())): ?>
                                未登录
                                <?php else: ?>
                                <?php echo date('Y-m-d H:i:s',$vo['last_login']); endif; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc">
                                    <?php if(is_check_access('Admin@admin_edit') == '1'): ?>
                                    <a href="<?php echo url('Admin/admin_edit',array('id'=>$vo['admin_id'])); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>编辑</a>
                                    <?php endif; if($main_lang == $admin_lang): if(is_check_access('Admin@admin_del') == '1'): if(\think\Session::get('admin_id') != $vo['admin_id'] AND !empty($vo['parent_id'])): ?>
                                        <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Admin/admin_del'); ?>" data-id="<?php echo $vo['admin_id']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>删除</a>
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
                <?php if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@admin_del') == '1'): ?>
                <div class="fbutton checkboxall">
                    <input type="checkbox" onclick="javascript:$('input[name*=ids]').prop('checked',this.checked);">
                </div>
                <div class="fbutton">
                    <a onclick="batch_del(this, 'ids');" data-url="<?php echo url('Admin/admin_del'); ?>">
                        <div class="add" title="批量删除">
                            <span><i class="fa fa-close"></i>批量删除</span>
                        </div>
                    </a>
                </div>
                <?php endif; if(is_check_access(CONTROLLER_NAME.'@admin_add') == '1'): ?>
                <div class="fbutton">
                    <a href="<?php echo url('Admin/admin_add'); ?>">
                        <div class="add" title="新增管理员">
                            <span class="red"><i class="fa fa-plus"></i>新增管理员</span>
                        </div>
                    </a>
                </div>
                <?php endif; endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $page; ?> </div>
</div>
<input type="hidden" name="head_pic" id="head_pic" value="<?php echo get_head_pic(\think\Session::get('admin_info.head_pic')); ?>">
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

        // 上传头像及时显示
        $('#admin_head_pic', window.parent.document).attr('src', $('#head_pic').val());
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