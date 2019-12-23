<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./application/admin/template/weapp\index.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
                <h3>插件应用</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access(CONTROLLER_NAME.'@index') == '1'): ?>
                <li><a href="<?php echo url("Weapp/index"); ?>" class="tab <?php if(\think\Request::instance()->action() == 'index'): ?>current<?php endif; ?>"><span>插件列表</span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>插件列表</h3>
                <h5>(共<?php echo $pager->totalRows; ?>条数据)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline" action="<?php echo url('Weapp/index'); ?>" method="get" onsubmit="layer_loading('正在处理');">
                <?php echo (isset($searchform['hidden']) && ($searchform['hidden'] !== '')?$searchform['hidden']:''); ?>
                <div class="sDiv">
                    <div class="sDiv2 fl" style="margin-right: 6px;">
                        <input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据...">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <!-- <div class="sDiv2">
                        <input type="button" class="btn" value="重置" onClick="window.location.href='<?php echo url('Weapp/index'); ?>';">
                    </div> -->
                    <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                        <input type="button" class="btn current" value="插件开发者" onclick="window.location.href='<?php echo url("Weapp/create"); ?>';">
                    </div>
                </div>
            </form>
        </div>
        <div class="hDiv">
            <div class="hDivBox">
                <table cellspacing="0" cellpadding="0" style="width: 100%">
                    <thead>
                    <tr>
                        <th abbr="article_title" axis="col3" class="w150">
                            <div class="tc" style="text-align: left; padding-left: 10px;">名称</div>
                        </th>
                        <th abbr="ac_id" axis="col4">
                            <div class="" style="padding-left: 10px;">描述</div>
                        </th>
                        <th abbr="article_title" axis="col3" class="w150">
                            <div class="tc">标识</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w120">
                            <div class="tc">作者</div>
                        </th>
                        <th abbr="article_show" axis="col5" class="w60">
                            <div class="tc">版本</div>
                        </th>
                        <th abbr="article_time" axis="col6" class="w50">
                            <div class="tc">启用</div>
                        </th>
                        <th axis="col1" class="w130">
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
                            <td class="">
                                <div class="w150 tl" style="padding-left: 10px;">
                                    <?php echo $vo['name']; $weapp_upgrade_info = $weapp_upgrade[$vo['code']]; if($weapp_upgrade_info['code'] == '2'): ?>
                                    <p class="testing_upgrade">
                                        <textarea id="<?php echo $vo['code']; ?>_upgrade" class="none"><?php echo (isset($weapp_upgrade_info['msg']['upgrade']) && ($weapp_upgrade_info['msg']['upgrade'] !== '')?$weapp_upgrade_info['msg']['upgrade']:''); ?></textarea> 
                                        <textarea id="<?php echo $vo['code']; ?>_intro" class="none"><?php echo (isset($weapp_upgrade_info['msg']['intro']) && ($weapp_upgrade_info['msg']['intro'] !== '')?$weapp_upgrade_info['msg']['intro']:''); ?></textarea>
                                        <textarea id="<?php echo $vo['code']; ?>_notice" class="none"><?php echo (isset($weapp_upgrade_info['msg']['notice']) && ($weapp_upgrade_info['msg']['notice'] !== '')?$weapp_upgrade_info['msg']['notice']:''); ?></textarea>
                                        <a href="javascript:void(0);" class="a_upgrade" data-version="<?php echo $vo['version']; ?>" data-code="<?php echo $vo['code']; ?>" data-status="<?php echo (isset($vo['status']) && ($vo['status'] !== '')?$vo['status']:'0'); ?>" data-name="<?php echo $vo['name']; ?>" onclick="weapp_upgrade(this);" style="color:#F00;"><?php echo (isset($weapp_upgrade_info['msg']['tips']) && ($weapp_upgrade_info['msg']['tips'] !== '')?$weapp_upgrade_info['msg']['tips']:'[新版本更新]'); ?></a>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="width: 100%">
                                <div style="">
                                    <?php echo $vo['config']['description']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w150 tc">
                                    <?php echo $vo['code']; ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w120 tc">
                                    <?php echo (isset($vo['config']['author']) && ($vo['config']['author'] !== '')?$vo['config']['author']:'匿名'); ?>
                                </div>
                            </td>
                            <td class="">
                                <div class="w60 tc">
                                    <?php echo $vo['config']['version']; ?>
                                </div>
                            </td>
                            <td>
                                <div class="tc w50">
                                    <?php if($vo['status'] == 1): ?>
                                        <span class="yes" <?php if(is_check_access('Weapp@disable') == '1'): ?>onClick="changeTableVal('weapp','id','<?php echo $vo['id']; ?>','status',this);"<?php endif; ?> data-value="-1"><i class="fa fa-check-circle"></i>是</span>
                                    <?php else: ?>
                                        <span class="no" <?php if(is_check_access('Weapp@disable') == '1'): ?>onClick="changeTableVal('weapp','id','<?php echo $vo['id']; ?>','status',this);"<?php endif; ?> data-value="1"><i class="fa fa-ban"></i>否</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="w130 tc">
                                <?php if(empty($vo['status']) || (($vo['status'] instanceof \think\Collection || $vo['status'] instanceof \think\Paginator ) && $vo['status']->isEmpty())): if(is_check_access('Weapp@install') == '1'): ?>
                                    <a href="javascript:void(0);" onclick="install(this);" data-id="<?php echo $vo['id']; ?>" class="btn blue"><i class="fa fa-check"></i>一键安装</a>
                                    <?php endif; if(is_check_access('Weapp@del') == '1'): ?>
                                    <a class="btn red"  href="javascript:void(0);" data-url="<?php echo url('Weapp/del'); ?>" data-id="<?php echo $vo['id']; ?>" data-name="<?php echo $vo['name']; ?>" onClick="delfun(this);"><i class="fa fa-trash-o"></i>删除</a>
                                    <?php endif; else: if(is_check_access('Weapp@execute') == '1'): if(!isset($vo['config']['management_index']) || empty($vo['config']['management_index'])): ?>
                                        <a href="<?php echo url('Weapp/execute',array('sm'=>$vo['code'],'sc'=>$vo['code'],'sa'=>'index')); ?>" class="btn blue"><i class="fa fa-pencil-square-o"></i>管理</a>
                                        <?php endif; endif; if(is_check_access('Weapp@uninstall') == '1'): ?>
                                    <a href="javascript:void(0);" onclick="uninstall(this);" data-id="<?php echo $vo['id']; ?>" data-name="<?php echo $vo['name']; ?>" class="btn red"><i class="fa fa-trash-o"></i>卸载</a>
                                    <?php endif; endif; ?>
                                </div>
                            </td>
                            <td class="sort">
                                <div class="w60 tc">
                                    <?php if(is_check_access('Weapp@edit') == '1'): ?>
                                    <input type="text" onchange="changeTableVal('weapp','id','<?php echo $vo['id']; ?>','sort_order',this);"  size="4"  value="<?php echo $vo['sort_order']; ?>" />
                                    <?php else: ?>
                                    <?php echo $vo['sort_order']; endif; ?>
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
                <?php if(is_check_access('Weapp@upload') == '1'): ?>
                <div class="fbutton">
                    <?php if($isFounder == '1'): ?>
                    <form class="navbar-form form-inline" action="<?php echo url('Weapp/upload'); ?>" name="change_System" id="change_System" method="post" enctype="multipart/form-data">
                        <a onclick="setInstallpwd();" id="a_weappinstall" href="javascript:void(0);" class="a-upload" <?php if(!(empty($weapp_installpwd) || (($weapp_installpwd instanceof \think\Collection || $weapp_installpwd instanceof \think\Paginator ) && $weapp_installpwd->isEmpty()))): ?>style="display: none;"<?php endif; ?>><i class="fa fa-upload"></i>上传安装插件</a>

                        <a id="a_weappfile" href="javascript:void(0);" class="a-upload" <?php if(empty($weapp_installpwd) || (($weapp_installpwd instanceof \think\Collection || $weapp_installpwd instanceof \think\Paginator ) && $weapp_installpwd->isEmpty())): ?>style="display: none;"<?php endif; ?>><input type="file" name="weappfile" id="weappfile" title="请选择…" accept="application/x-zip-compressed"><i class="fa fa-upload"></i>上传安装插件</a>
                    </form>
                    <input type="hidden" id="is_weapp_installpwd" value="<?php echo (isset($is_weapp_installpwd) && ($is_weapp_installpwd !== '')?$is_weapp_installpwd:'0'); ?>" />
                    <?php else: ?>
                        <a onclick="layer.alert('请登录创始人账号上传安装插件！', {icon:4, title: false});" href="javascript:void(0);" class="a-upload"><i class="fa fa-upload"></i>上传安装插件</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <!--分页位置-->
        <?php echo $page; ?>
    </div>
</div>
<form name="form2" id="form2" method="post" action="">
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="thorough" value="1" />
</form>
<script>
    $(document).ready(function(){

        <?php if(empty($weapp_installpwd) || (($weapp_installpwd instanceof \think\Collection || $weapp_installpwd instanceof \think\Paginator ) && $weapp_installpwd->isEmpty())): ?>
        setInstallpwd();
        <?php endif; ?>

        // 表格行点击选中切换
        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');
        });

        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });

        $('#weappfile').change(function(){
            var weappfile = $("#weappfile")[0].files[0];  //获取文件路径名
            var is_weapp_installpwd = $('#is_weapp_installpwd').val();
            if (0 == is_weapp_installpwd) {
                layer.prompt({
                        title: false,
                        closeBtn: 0,
                        id: 'input_installpwd',
                        success: function(layero, index){
                            $("#input_installpwd").find('input').attr('placeholder', '请录入插件安装密码');
                            $("#input_installpwd").find('input').bind('keydown', function(event){
                                if(event.keyCode ==13){
                                    upload($(this).val(), weappfile);
                                }
                            });
                        }
                    },
                    function(pwd, index){
                        upload(pwd, weappfile);
                    }
                );
            } else {
                upload(false, weappfile);
            }
        });

        function upload(pwd, weappfile)
        {
            // var weappfile = document.getElementById('weappfile').files[0]; //获取文件路径名
            // var weappfile = $("#weappfile")[0].files[0];  //获取文件路径名

            var weappfileName = weappfile.name;
            var ext = weappfileName.substr(weappfileName.lastIndexOf('.')).toLowerCase();
            if ($.trim(weappfileName) == '' || ext != '.zip') {
                $('#weappfile').val('');
                showErrorMsg('请上传zip压缩包！');
                return false;
            }
     
            var formData = new FormData();
            formData.append('_ajax', 1);
            formData.append('weappfile', weappfile);
            if (false !== pwd) {
                formData.append('pwd', pwd);
            }
          
            var loading = layer.msg('正在处理...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请勿刷新页面', 
            {
                icon: 1,
                time: 3600000, //1小时后后自动关闭
                shade: [0.2] //0.1透明度的白色背景
            });
            //loading层
            var loading_1 = layer.load(3, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });

            $.ajax({
                url: "<?php echo url('Weapp/upload'); ?>",  //同目录下的php文件
                type: "POST",
                data: formData,
                dataType: "json", //声明成功使用json数据类型回调
                //如果传递的是FormData数据类型，那么下来的三个参数是必须的，否则会报错
                cache: false,  //默认是true，但是一般不做缓存
                processData: false, //用于对data参数进行序列化处理，这里必须false；如果是true，就会将FormData转换为String类型
                contentType: false,  //一些文件上传http协议的关系，自行百度，如果上传的有文件，那么只能设置为false
                success: function(res){  //请求成功后的回调函数
                    if (1 == res.code) {
                        layer.closeAll();
                        layer.msg(res.msg, {icon:1, time:1000}, function(){
                            window.location.reload();
                        });
                    } else {
                        $('#weappfile').val('');
                        layer.close(loading);
                        layer.close(loading_1);
                        layer.msg(res.msg, {icon:2, time:1500});
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    layer.close(loading);
                    layer.close(loading_1);
                    layer.msg('安装失败', {icon:2, time:1500});
                }
            });
        }
    });
    
    /**
     * 设置插件安装密码
     */
    function setInstallpwd()
    {
        layer.prompt({
                title:'创始人设置插件安装密码',
                id: 'set_installpwd',
                success: function(layero, index){
                    // $("#set_installpwd").find('input').attr('placeholder', '仅限于创始人设置插件安装密码！');
                    $("#set_installpwd").find('input').bind('keydown', function(event){
                        if(event.keyCode ==13){
                            submitInstallpwd($(this).val());
                        }
                    });
                }
            },
            function(pwd, index){
                submitInstallpwd(pwd);
            }
        );
    }

    /**
     * 提交保存插件安装密码
     */
    function submitInstallpwd(pwd)
    {
        $.ajax({
            url: "<?php echo url('Weapp/ajax_submitInstallpwd'); ?>",
            type: "POST",
            dataType: "JSON",
            data: {pwd:pwd,_ajax:1},
            success: function(res){
                if (res.code == 1) {
                    layer.closeAll();
                    layer.msg(res.msg, {icon:1, time:1000}, function(){
                        window.location.reload();
                    });
                } else {
                    $("#set_installpwd").find('input').focus();
                    layer.msg(res.msg, {icon:2, time:1500});
                }
            },
            error: function(e){
                $("#set_installpwd").find('input').focus();
                layer.msg('设置失败！', {icon:2, time:2000});
            }
        });
    }

    function weapp_upgrade(obj)
    {
        var name = $(obj).attr('data-name');
        var status = $(obj).attr('data-status');
        if (0 == status) {
            layer.alert('请先安装该插件！', {
                title:false,//name,
                icon: 0
            });
            return false;
        }

        var code = $(obj).attr('data-code');
        var v = $("#"+code+"_upgrade").val();    
        var intro = $("#"+code+"_intro").val();   
        intro += '<style type="text/css">.layui-layer-content{height:270px!important}</style>';
        var notice = $("#"+code+"_notice").val(); 
        // v = v.replace(/\n/g,"<br/>");
        v = notice + intro + '<br/>' + v;
        //询问框
        layer.confirm(v, {
            title: false,//'检测插件更新',
            area: ['580px','400px'],
            btn: ['升级','取消'] //按钮
            
        }, function(){
            layer.closeAll();
            setTimeout(function(){
                upgrade(code); // 请求后台
            },200);
            
        }, function(){  
            layer.msg('不升级可能有安全隐患', {
                btnAlign: 'c',
                time: 20000, //20s后自动关闭
                btn: ['明白了']
            });
            return false;
        });    
    }



    function upgrade(code){
        layer_loading('升级中');
        $.ajax({
            type : "GET",
            url  : "<?php echo url('Weapp/OneKeyUpgrade'); ?>",
            timeout : 360000, //超时时间设置，单位毫秒 设置了 1小时
            data : {code:code, _ajax:1},
            error: function(request) {
                layer.closeAll();
                layer.alert("升级失败，请第一时间联系技术协助！", {icon: 2, closeBtn: false, title:false}, function(){
                    window.location.reload();
                });
            },
            success: function(res) {
                layer.closeAll();
                if(1 == res.code){
                    layer.alert('已升级最新版本!', {icon: 1, closeBtn: false, title:false}, function(){
                        window.location.reload();
                    });
                }
                else{
                    layer.alert(res.msg, {icon: 2, closeBtn: false, title:false}, function(){
                        window.location.reload();
                    });
                }
            }
        });                 
    }

    function install(obj)
    {
        var id = $(obj).attr('data-id');
        var form2 = $('#form2');
        form2.find('input[name=id]').val(id);
        var url = "<?php echo url('Weapp/install'); ?>";
        form2.attr('action', url);
        layer_loading('正在处理');
        form2.submit();
    }

    function uninstall(obj)
    {
        var id = $(obj).attr('data-id');
        var name = $(obj).attr('data-name');
        var form2 = $('#form2');
        form2.find('input[name=id]').val(id);
        var url = "<?php echo url('Weapp/uninstall', ['_ajax'=>1]); ?>";
        form2.attr('action', url);

        //询问框
        var confirm = layer.confirm('<font color="red">此操作数据不可恢复</font>，是否卸载移除？', {
                title: false,//name,
                btn: ['确定', '取消'] //按钮

            }, function(){
                form2.find('input[name=thorough]').val(0);
                layer_loading('正在处理');
                // 确定
                $.ajax({
                    type : 'post',
                    url : url,
                    data : form2.serialize(),
                    dataType : 'json',
                    success : function(res){
                        layer.closeAll();
                        if(res.code == 1){
                            layer.msg(res.msg, {icon: 1, time: 1500}, function(){
                                window.location.reload();
                            });
                        }else{
                            layer.alert(res.msg, {icon: 2, title:false});
                        }
                    },
                    error: function(e) {
                        layer.closeAll();
                        // 处理插件行为app_end影响到的卸载问题
                        if (e.responseText.indexOf("\\behavior\\admin\\") >= 0 && e.responseText.indexOf("not found") >= 0) {
                            layer.msg('卸载成功', {icon: 1, time: 1500}, function(){
                                window.location.reload();
                            });
                        } else {
                            layer.alert(e.responseText, {icon: 2, title:false});
                        }
                    }
                });
                // layer_loading('正在处理');
                // form2.submit();
                
            }, function(){
                layer.close(confirm);

            }
        );
        
        return false;
    }

    function delfun(obj){
        var name = $(obj).attr('data-name');
        layer.confirm('<font color="#ff0000">将移除该插件相关文件</font>，确认移除？', {
            title: false,//name,
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