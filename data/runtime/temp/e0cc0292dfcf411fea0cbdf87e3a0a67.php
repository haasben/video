<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:44:"./application/admin/template/level\index.htm";i:1571037856;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\member\bar.htm";i:1571037616;s:80:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\level\level_bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<body style="background-color: rgb(255, 255, 255); overflow-y: scroll; cursor: default; -moz-user-select: inherit;min-width:auto;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width:auto;">
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
                <h3>会员产品分类</h3>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <div class="sDiv">
                <?php if(is_check_access('Level@index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['index'])): ?>current<?php endif; ?>" value="会员产品分类" onclick="window.location.href='<?php echo url("Level/index"); ?>';">
    </div>
<?php endif; if(is_check_access('Member@index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['level_index'])): ?>current<?php endif; ?>"" value="会员级别管理" data-href="<?php echo url('Member/level_index', ['newframe'=>1]); ?>" onclick="newframe(this);">
    </div>
<?php endif; if(is_check_access('Level@upgrade_index') == '1'): ?>
    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
        <input type="button" class="btn <?php if(!in_array(\think\Request::instance()->action(), ['upgrade_index'])): ?>current<?php endif; ?>"" value="会员业务记录" onclick="window.location.href='<?php echo url("Level/upgrade_index"); ?>';">
    </div>
<?php endif; ?>

<script type="text/javascript">
    function newframe(obj)
    {
        var url = $(obj).data('href');
        //iframe窗
        layer.open({
            type: 2,
            title: $(obj).val(),
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: false, //开启最大化最小化按钮
            area: ['100%', '100%'],
            content: url,
            end: function(layero, index){
                window.location.reload();
            }
        });
    }
</script> 
            </div>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="sign w20" axis="col0">
                            <div class="tc"></div>
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="">产品名称</div>
                        </th>
                        <th abbr="article_time" axis="col4" class="w120">
                            <div class="tc">会员级别</div>
                        </th>
                        <th abbr="article_time" axis="col4" class="w100">
                            <div class="tc">产品价格(元)</div>
                        </th>
                        <th abbr="article_time" axis="col4" class="w120">
                            <div class="tc">会员期限(天)</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w60">
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
        <div class="bDiv" style="height: auto; min-height: auto;">
            <form id="PostForm">
                <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                    <table style="width: 100%">
                        <tbody>
                        <?php if(empty($users_type) || (($users_type instanceof \think\Collection || $users_type instanceof \think\Paginator ) && $users_type->isEmpty())): ?>
                            <tr>
                                <td class="no-data" align="center" axis="col0" colspan="50">
                                    <i class="fa fa-exclamation-circle"></i>没有符合条件的记录
                                </td>
                            </tr>
                        <?php else: if(is_array($users_type) || $users_type instanceof \think\Collection || $users_type instanceof \think\Paginator): if( count($users_type)==0 ) : echo "" ;else: foreach($users_type as $k=>$vo): ?>
                            <tr class="tr">
                                <td class="sign">
                                    <div class="w20 tc">
                                        <input type="hidden" name="type_id[]" value="<?php echo $vo['type_id']; ?>">
                                    </div>
                                </td>

                                <td style="width: 100%">
                                    <div style="">
                                        <input type="text" name="type_name[]" value="<?php echo $vo['type_name']; ?>" style="width: 93%;">
                                    </div>
                                </td>

                                <td>
                                    <div class="w120 tc">
                                        <select name="level_id[]" class="tc w100">
                                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $level['level_id']; ?>" <?php if($level['level_id'] == $vo['level_id']): ?>selected<?php endif; ?> ><?php echo $level['level_name']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </div>
                                </td>

                                <td>
                                    <div class="w100 tc">
                                        <input type="text" name="price[]" value="<?php echo $vo['price']; ?>" onkeyup="this.value=this.value.replace(/[^0-9\.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9\.]/g,'')" class="tc w80">
                                    </div>
                                </td>

                                <td>
                                    <div class="w120 tc">
                                        <select name="limit_id[]" class="tc w100" >
                                            <?php if(is_array($member_limit_arr) || $member_limit_arr instanceof \think\Collection || $member_limit_arr instanceof \think\Paginator): $i = 0; $__LIST__ = $member_limit_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$limit): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $limit['limit_id']; ?>" <?php if($limit['limit_id'] == $vo['limit_id']): ?>selected<?php endif; ?> ><?php echo $limit['limit_name']; ?></option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="w60 tc">
                                        <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Level/level_type_del'); ?>" data-name="<?php echo $vo['type_name']; ?>" data-id="<?php echo $vo['type_id']; ?>" onclick="LevelTypeDel(this)"><i class="fa fa-trash-o"></i>删除</a>
                                    </div>
                                </td>
                                <td class="sort">
                                    <div class="w60 tc">
                                        <input class="tc" type="text" onchange="changeTableVal('users_type_manage','type_id','<?php echo $vo['type_id']; ?>','sort_order',this);" name="sort_order[]" size="4" value="<?php echo $vo['sort_order']; ?>" />
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </tbody>
                    </table>
                    <div id='Template'></div>
                </div>
            </form>
            <div class="iDiv" style="display: none;"></div>
        </div>
        <div class="tDiv">
            <div class="tDiv2">
                <div class="fbutton">
                    <a href="javascript:void(0);" onclick="AddLevelType();">
                        <div class="add" title="新增会员产品">
                            <span class="red"><i class="fa fa-plus"></i>新增会员产品</span>
                        </div>
                    </a>
                </div>

                <div class="fbutton">
                    <a href="javascript:void(0);" data-url="<?php echo url('Level/add_level_data'); ?>" onclick="AddLevelData(this);">
                        <div class="add" title="保存">
                            <span class="">保存</span>
                        </div>
                    </a>
                </div>
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
    });

    // 删除
    function LevelTypeDel(obj){
        layer.confirm('此操作不可恢复，确认彻底删除<span style="color:red;">'+$(obj).attr('data-name')+'</span>？', {
            title: false,
            btn: ['确定','取消']
        }, function(){
            layer_loading('正在处理');
            // 确定
            $.ajax({
                type : 'post',
                url : $(obj).attr('data-url'),
                data : {type_id:$(obj).attr('data-id')},
                dataType : 'json',
                success : function(data){
                    layer.closeAll();
                    if(data.code == 1){
                        layer.msg(data.msg, {icon: 1, time:1000},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.alert(data.msg, {icon: 2, title:false});
                    }
                }
            })
        }, function(index){
            layer.close(index);
        });
    }

    function AddLevelType(){
        // tr数,取唯一标识
        var SerialNum = $('.tr').length;
        var AddHtml = [];
        AddHtml += 
        [
            '<tr class="tr" id="tr_'+SerialNum+'">'+
                '<td class="sign">'+
                    '<div class="w20 tc"><input type="hidden" name="type_id[]"></div>'+
                '</td>'+

                '<td style="width: 100%">'+
                    '<div style="">'+
                        '<input type="text" name="type_name[]" style="width: 93%;">'+
                    '</div>'+
                '</td>'+

                '<td>'+
                    '<div class="w120 tc">'+
                        '<select name="level_id[]" class="tc w100">'+
                            '<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level): $mod = ($i % 2 );++$i;?>'+
                                '<option value="<?php echo $level['level_id']; ?>" ><?php echo $level['level_name']; ?></option>'+
                            '<?php endforeach; endif; else: echo "" ;endif; ?>'+
                        '</select>'+
                    '</div>'+
                '</td>'+

                '<td>'+
                    '<div class="w100 tc">'+
                        '<input type="text" name="price[]" onkeyup="this.value=this.value.replace(/[^0-9\.]/g,\'\')" onafterpaste="this.value=this.value.replace(/[^0-9\.]/g,\'\')"  class="tc w80">'+
                    '</div>'+
                '</td>'+

                '<td>'+
                    '<div class="w120 tc">'+
                        '<select name="limit_id[]" class="tc w100">'+
                            '<?php if(is_array($member_limit_arr) || $member_limit_arr instanceof \think\Collection || $member_limit_arr instanceof \think\Paginator): $i = 0; $__LIST__ = $member_limit_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$limit): $mod = ($i % 2 );++$i;?>'+
                                '<option value="<?php echo $limit['limit_id']; ?>"><?php echo $limit['limit_name']; ?></option>'+
                            '<?php endforeach; endif; else: echo "" ;endif; ?>'+
                        '</select>'+
                    '</div>'+
                '</td>'+

                '<td class="">'+
                    '<div class="w60 tc">'+
                        '<a class="btn red" href="javascript:void(0);" data-id="tr_'+SerialNum+'" onclick="DelHtml(this)"><i class="fa fa-trash-o"></i>删除</a>'+
                    '</div>'+
                '</td>'+

                '<td class="sort">'+
                    '<div class="w60 tc">'+
                        '<input class="tc" name="sort_order[]" type="text" size="4" value="100" />'+
                    '</div>'+
                '</td>'+
            '</tr>'
        ];
        $('#Template').append(AddHtml);
    }

    // 删除未保存的级别
    function DelHtml(obj){
        $('#'+$(obj).attr('data-id')).remove();
    }

    // 添加新增数据
    function AddLevelData(obj){
        layer_loading('正在处理');
        $.ajax({
            type : 'post',
            url : $(obj).attr('data-url'),
            data : $('#PostForm').serialize(),
            dataType : 'json',
            success : function(data){
                layer.closeAll();
                if(data.code == 1){
                    layer.msg(data.msg, {icon: 1, time:1000},function(){
                        window.location.reload();
                    });
                }else{
                    layer.alert(data.msg, {icon: 2, title:false});
                }
            }
        })
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