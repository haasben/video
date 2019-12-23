<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"./application/admin/template/admin\admin_edit.htm";i:1575364572;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\admin\admin_bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<body class="rolecss">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
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
    <form class="form-horizontal" id="postForm" action="<?php echo url('Admin/admin_edit'); ?>" method="post">
        <input type="hidden" name="admin_id" value="<?php echo $info['admin_id']; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="head_pic">用户头像</label>
                </dt>
                <dd class="opt">
                    <div class="txpic" onClick="GetUploadify(1,'','allimg','head_pic_call_back');">
                        <input type="hidden" name="head_pic" id="head_pic" value="<?php echo $info['head_pic']; ?>" />
                        <img id="img_head_pic" src="<?php echo get_head_pic($info['head_pic']); ?>" />
                        <em>更换头像</em>
                    </div>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名</label>
                </dt>
                <dd class="opt">
                    <?php echo $info['user_name']; ?>
                    <input type="hidden" name="user_name" value="<?php echo $info['user_name']; ?>">
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="password">登录密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="password" value="" id="password" autocomplete="off" class="input-txt">
                    <p class="notic">推荐密码至少是以大写字母、小写字母、数字等组合！</p>
                    <p id="password_tips"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="password">确认密码</label>
                </dt>
                <dd class="opt">
                    <input type="password" name="password2" value="" id="password2" autocomplete="off" class="input-txt">
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="pen_name">笔名</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="pen_name" value="<?php echo $info['pen_name']; ?>" id="pen_name" class="input-txt">
                    <p class="notic">发布文档后显示责任编辑的名字</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="true_name">真实姓名</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="true_name" value="<?php echo (isset($info['true_name']) && ($info['true_name'] !== '')?$info['true_name']:''); ?>" id="true_name" class="input-txt">
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="mobile">手机号码</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="mobile" value="<?php echo $info['mobile']; ?>" id="mobile" class="input-txt">
                    <p class="notic"></p>
                </dd>
            </dl>
            <?php if($info['admin_id'] != \think\Session::get('admin_info.admin_id') AND 0 >= \think\Session::get('admin_info.role_id')): ?>
            <dl class="row"><dt class="tit"><label><b>管理员权限设置</b></label></dt></dl>
            <dl class="row">
                <dt class="tit">
                    <label for="name">管理员权限组</label>
                </dt>
                <dd class="opt">
                    <p><label><input type="radio" name="role_id" value="-1" onclick="changeRole(-1);" <?php if(-1 == $info['role_id']): ?>checked="checked"<?php endif; ?> />超级管理员</label></p>
                    <?php if(is_array($admin_role_list) || $admin_role_list instanceof \think\Collection || $admin_role_list instanceof \think\Paginator): if( count($admin_role_list)==0 ) : echo "" ;else: foreach($admin_role_list as $key=>$role): ?>
                    <p>
                        <label><input type="radio" name="role_id" value="<?php echo $role['id']; ?>" onclick="changeRole(<?php echo $role['id']; ?>);" <?php if($role_info['id'] == $role['id']): ?> checked="checked"<?php endif; ?> /><?php echo $role['name']; ?></label>
                        <!-- &nbsp;<a href="javascript:void;" data-url="<?php echo url('AuthRole/edit', array('id'=>$role['id'],'iframe'=>1)); ?>" onclick="addRole(this);">[编辑]</a>&nbsp;&nbsp;<a href="javascript:void;" data-url="<?php echo url('AuthRole/del'); ?>" data-id="<?php echo $role['id']; ?>" onclick="delfun(this);">[删除]</a> -->
                    </p>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <p id="custom_role" style="padding-left: 13px; text-decoration:underline;"><label><a href="javascript:void(0);" data-url="<?php echo url('AuthRole/add', array('iframe'=>1)); ?>" onclick="addRole(this);">自定义</a></label></p>
                </dd>
            </dl>
            <dl class="row"><dt class="tit"><label><b>当前权限组预览</b></label></dt></dl>
<!--             <dl class="row">
                <dt class="tit">
                    <label for="name">语言权限</label>
                </dt>
                <dd class="opt">
                    <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['language']) && in_array('cn', $role_info['language'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="language[]" value="cn" <?php if(! empty($role_info['language']) && in_array('cn', $role_info['language'])): ?> checked="checked"<?php endif; ?> class="none" />简体中文</label>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl> -->
            <dl class="row">
                <dt class="tit">
                    <label for="name">在线升级</label>
                </dt>
                <dd class="opt">
                    <label><img class="cboximg" src="/public/static/admin/images/<?php if($role_info['online_update'] == '1'): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="online_update" value="1" <?php if($role_info['online_update'] == '1'): ?> checked="checked"<?php endif; ?> class="none" />允许操作</label>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="name">文档权限</label>
                </dt>
                <dd class="opt">
                    <label><img class="cboximg" src="/public/static/admin/images/<?php if($role_info['only_oneself'] == '1'): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="only_oneself" value="1" <?php if($role_info['only_oneself'] == '1'): ?> checked="checked"<?php endif; ?> class="none" />只允许查看自己发布的文档</label>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="name">操作权限</label>
                </dt>
                <dd class="opt">
                    <p><label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['cud']) && count($role_info['cud'])>=3): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" id="select_cud" <?php if(! empty($role_info['cud']) && count($role_info['cud'])>=3): ?> checked="checked"<?php endif; ?> class="none" />完全控制</label></p>
                    <p><label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['cud']) && in_array('add', $role_info['cud'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="cud[]" value="add" <?php if(! empty($role_info['cud']) && in_array('add', $role_info['cud'])): ?> checked="checked"<?php endif; ?> class="none" />添加信息</label></p>
                    <p><label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['cud']) && in_array('edit', $role_info['cud'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="cud[]" value="edit" <?php if(! empty($role_info['cud']) && in_array('edit', $role_info['cud'])): ?> checked="checked"<?php endif; ?> class="none" />修改信息</label></p>
                    <p><label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['cud']) && in_array('del', $role_info['cud'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="cud[]" value="del" <?php if(! empty($role_info['cud']) && in_array('del', $role_info['cud'])): ?> checked="checked"<?php endif; ?> class="none" />删除信息</label></p>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="name">功能权限</label>
                </dt>
                <dd class="opt">
                    <p>
                        <label><img class="cboximg" src="/public/static/admin/images/ok.png" /><input type="checkbox" id="select_all_permission" class="none" />全部选择</label>
                    </p>

                    <?php if(is_array($modules) || $modules instanceof \think\Collection || $modules instanceof \think\Paginator): if( count($modules)==0 ) : echo "" ;else: foreach($modules as $key=>$vo): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$vo2): if(1 == $vo2['is_modules'] AND ! empty($auth_rule_list[$vo2['id']])): if(1002 == $vo2['id']): ?>
                            <div class="admin_poplistdiv">
                                <h2><?php echo $vo2['name']; ?></h2>
                            <?php if(! empty($arctypes)): ?>
                                <p>
                                    <?php $first_arctype_id = ''; if(is_array($arctypes) || $arctypes instanceof \think\Collection || $arctypes instanceof \think\Paginator): if( count($arctypes)==0 ) : echo "" ;else: foreach($arctypes as $k=>$arctype): if(isset($arctype_array[$arctype['id']])): if($k>0): ?>
                                            <em class="arctype_bg expandable"></em>
                                            <?php else: ?>
                                            <em class="arctype_bg collapsable"></em>
                                            <?php $first_arctype_id = $arctype['id']; endif; endif; ?>
                                        <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['arctype']) && in_array($arctype['id'], $role_info['permission']['arctype'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" class="arctype_cbox arctype_id_<?php echo $arctype['id']; ?> none" name="permission[arctype][]" value="<?php echo $arctype['id']; ?>" <?php if(! empty($role_info['permission']['arctype']) && in_array($arctype['id'], $role_info['permission']['arctype'])): ?> checked="checked"<?php endif; ?> /><?php echo $arctype['typename']; ?></label>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </p>
                                
                                <?php if(is_array($arctypes) || $arctypes instanceof \think\Collection || $arctypes instanceof \think\Paginator): if( count($arctypes)==0 ) : echo "" ;else: foreach($arctypes as $k=>$arctype): if(isset($arctype_array[$arctype['id']])): ?>
                                    <div class="arctype_child" id="arctype_child_<?php echo $arctype['id']; ?>"<?php if($first_arctype_id==$arctype['id']): ?> style="display: block;"<?php endif; ?>>
                                    <?php foreach($arctype_array[$arctype['id']] as $item): ?>
                                        <div class="arctype_child1">
                                            <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['arctype']) && in_array($item['id'], $role_info['permission']['arctype'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" class="arctype_cbox arctype_id_<?php echo $item['id']; ?> none" name="permission[arctype][]" value="<?php echo $item['id']; ?>" data-pid="<?php echo $item['parent_id']; ?>" <?php if(! empty($role_info['permission']['arctype']) && in_array($item['id'], $role_info['permission']['arctype'])): ?> checked="checked"<?php endif; ?> /><?php echo $item['typename']; ?></label>
                                        </div>
                                        <?php if(isset($arctype_array[$item['id']])): ?>
                                        <div class="arctype_child2" id="arctype_child_<?php echo $item['id']; ?>">
                                            <span class="button level1 switch center_docu"></span>
                                            <?php foreach($arctype_array[$item['id']] as $vo): ?>
                                            <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['arctype']) && in_array($vo['id'], $role_info['permission']['arctype'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" class="arctype_cbox none" name="permission[arctype][]" value="<?php echo $vo['id']; ?>" data-pid="<?php echo $vo['parent_id']; ?>" data-tpid="<?php echo $item['parent_id']; ?>" <?php if(! empty($role_info['permission']['arctype']) && in_array($vo['id'], $role_info['permission']['arctype'])): ?> checked="checked"<?php endif; ?> /><?php echo $vo['typename']; ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; endforeach; ?>
                                    </div>
                                <?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                            </div>
                          <?php else: ?>
                            <div class="admin_poplistdiv">
                                <h2><?php echo $vo2['name']; ?></h2>
                                <p>
                                    <?php if(is_array($auth_rule_list[$vo2['id']]) || $auth_rule_list[$vo2['id']] instanceof \think\Collection || $auth_rule_list[$vo2['id']] instanceof \think\Paginator): if( count($auth_rule_list[$vo2['id']])==0 ) : echo "" ;else: foreach($auth_rule_list[$vo2['id']] as $key=>$rule): ?>
                                    <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['rules']) && in_array($rule['id'], $role_info['permission']['rules'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" class="none" name="permission[rules][]" value="<?php echo $rule['id']; ?>" <?php if(! empty($role_info['permission']['rules']) && in_array($rule['id'], $role_info['permission']['rules'])): ?> checked="checked"<?php endif; ?> /><?php echo $rule['name']; ?></label>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </p>
                            </div>
                          <?php endif; endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; if(! empty($plugins)): ?>
                    <div class="admin_poplistdiv">
                        <h2>插件应用</h2>
                        <ul>
                            <?php if(is_array($plugins) || $plugins instanceof \think\Collection || $plugins instanceof \think\Paginator): if( count($plugins)==0 ) : echo "" ;else: foreach($plugins as $key=>$plugin): ?>
                            <li>
                                <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['plugins'][$plugin['code']]) && isset($role_info['permission']['plugins'][$plugin['code']]['child'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" name="permission[plugins][<?php echo $plugin['code']; ?>][code]" value="<?php echo $plugin['code']; ?>" class="none" <?php if(! empty($role_info['permission']['plugins'][$plugin['code']]) && isset($role_info['permission']['plugins'][$plugin['code']]['child'])): ?> checked="checked"<?php endif; ?> /><?php echo $plugin['name']; ?></label>
                                <?php $config = json_decode($plugin['config'], true); if(! empty($config['permission'])): ?>
                                <p style="padding-left:10px;">
                                    <span class="button level1 switch center_docu"></span>
                                    <?php foreach($config['permission'] as $index => $text): ?>
                                    <label><img class="cboximg" src="/public/static/admin/images/<?php if(! empty($role_info['permission']['plugins'][$plugin['code']]['child']) && in_array($index, $role_info['permission']['plugins'][$plugin['code']]['child'])): ?>ok<?php else: ?>del<?php endif; ?>.png" /><input type="checkbox" class="none" name="permission[plugins][<?php echo $plugin['code']; ?>][child][]" <?php if(! empty($role_info['permission']['plugins'][$plugin['code']]['child']) && in_array($index, $role_info['permission']['plugins'][$plugin['code']]['child'])): ?> checked="checked"<?php endif; ?> value="<?php echo $index; ?>" /><?php echo $text; ?></label>
                                    <?php endforeach; ?>
                                </p>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </dd>
            </dl>
            <?php endif; ?>
            <div class="bot"><a href="JavaScript:void(0);" onclick="adsubmit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<textarea name="admin_role_list" id="admin_role_list" class="none"><?php echo json_encode($admin_role_list); ?></textarea>
<script type="text/javascript">
    $(function(){
        // 默认全部禁用复选框
        $('#postForm input[type="checkbox"]').attr("disabled","disabled");

        /*超级管理员默认全选复选框*/
        if (0 >= <?php echo $info['role_id']; ?>) {
            $('#postForm input[type="checkbox"]').attr('checked', 'checked');
            $('#postForm img.cboximg').attr('src', '/public/static/admin/images/ok.png');
        }
        /*--end*/

        $('.arctype_bg').bind('click', function(){
            var acid = $(this).next().find('input').val(), input = 'arctype_child_' + acid;
            $('.arctype_child').hide();
            if( $(this).attr('class').indexOf('expandable') == -1 ){
                $(this).removeClass('collapsable').addClass('expandable');
            }else{
                $('.arctype_bg').removeClass('collapsable').addClass('expandable');
                $(this).removeClass('expandable').addClass('collapsable');
                $('#'+input).show();
            }
        });
        $('.arctype_cbox').bind('click', function(){
            var acid = $(this).val(), input = 'arctype_child_' + acid;
            var pid = $(this).data('pid');
            var tpid = $(this).data('tpid');
            if($(this).attr('checked')){
                if (0 < $('input[data-pid="'+pid+'"]:checked').length) {
                    $('.arctype_id_'+pid).attr('checked', 'checked');
                    $('.arctype_id_'+pid).parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                }
                if (0 < $('#arctype_child_'+tpid).find('input[type="checkbox"]:checked').length) {
                    $('.arctype_id_'+tpid).attr('checked', 'checked');
                    $('.arctype_id_'+tpid).parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                }
                $('#'+input).find('input[type="checkbox"]').attr('checked', 'checked');
                $('#'+input).find('input[type="checkbox"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
            }else{
                if (1 > $('input[data-pid="'+pid+'"]:checked').length) {
                    $('.arctype_id_'+pid).removeAttr('checked');
                    $('.arctype_id_'+pid).parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
                }
                if (1 > $('#arctype_child_'+tpid).find('input[type="checkbox"]:checked').length) {
                    $('.arctype_id_'+tpid).removeAttr('checked');
                    $('.arctype_id_'+tpid).parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
                }
                $('#'+input).find('input[type="checkbox"]').removeAttr('checked');
                $('#'+input).find('input[type="checkbox"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
            }
        });
        $('#select_cud').bind('click', function(){
            if($(this).attr('checked')){
                $('#postForm input[name^="cud"]').attr('checked', 'checked');
                $('#postForm input[name^="cud"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
            }else{
                $('#postForm input[name^="cud"]').removeAttr('checked');
                $('#postForm input[name^="cud"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
            }
        });

        $('#select_all_permission').bind('click', function(){
            if($(this).attr('checked')){
                $('#postForm input[name^="permission"]').attr('checked', 'checked');
                $('#postForm input[name^="permission"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
            }else{
                $('#postForm input[name^="permission"]').removeAttr('checked');
                $('#postForm input[name^="permission"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
            }
        });
        $('#postForm input[name^="permission"],#postForm input[name^="cud"]').bind('click', function(){
            hasSelectAll();
        });

        hasSelectAll();
    });

    function hasSelectAll(){
        var c = true;
        $('#postForm input[name^="permission"]').each(function(idx, ele){
            if(! $(ele).attr('checked')){
                c = false;
                return;
            }
        });
        if(c){
            $('#select_all_permission').attr('checked', 'checked');
            $('#select_all_permission').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
        }else{
            $('#select_all_permission').removeAttr('checked');
            $('#select_all_permission').parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
        }

        var c = true;
        $('#postForm input[name^="cud"]').each(function(idx, ele){
            if(! $(ele).attr('checked')){
                c = false;
                return;
            }
        });
        if(c){
            $('#select_cud').attr('checked', 'checked');
            $('#select_cud').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
        }else{
            $('#select_cud').removeAttr('checked');
            $('#select_cud').parent().find('img.cboximg').attr('src', '/public/static/admin/images/del.png');
        }
    }

    function changeRole(value){
        if (-1 == value) {
            $('#postForm input[type="checkbox"]').attr("checked","checked").attr('disabled', 'disabled');
            $('#postForm img.cboximg').attr('src', '/public/static/admin/images/ok.png');
            return;
        }
        
        $('#postForm input[name!="role_id"]').removeAttr('checked').removeAttr('disabled');
        $('#postForm img.cboximg').attr('src', '/public/static/admin/images/del.png');

        // if(value == "0"){
        //     $('#postForm input[name!="role_id"]').attr('checked', 'checked');
        //     $('#postForm input[name="online_update"]').removeAttr('checked');
        //     $('#postForm input[name="only_oneself"]').removeAttr('checked');
        //     return ;
        // }
        var admin_role_list = JSON.parse($('#admin_role_list').val());
        for(var i in admin_role_list){
            var item = admin_role_list[i];
            if(item.id == value){
                if(item.language){
                    item.language.map(function(row){
                        $('#postForm input[name^="language"][value="'+row+'"]').attr('checked', 'checked');
                        $('#postForm input[name^="language"][value="'+row+'"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                    });
                }

                if(item.online_update){
                    $('#postForm input[name="online_update"]').attr('checked', 'checked');
                    $('#postForm input[name="online_update"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                };
                // if(item.editor_visual){
                //     $('#postForm input[name="editor_visual"]').attr('checked', 'checked');
                //     $('#postForm input[name="editor_visual"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                // };
                if(item.only_oneself){
                    $('#postForm input[name="only_oneself"]').attr('checked', 'checked');
                    $('#postForm input[name="only_oneself"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                };
                if(item.cud){
                    item.cud.map(function(row){
                        $('#postForm input[name^="cud"][value="'+row+'"]').attr('checked', 'checked');
                        $('#postForm input[name^="cud"][value="'+row+'"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                    });
                }
                if(item.permission){
                    for(var p in item.permission){
                        if(p == 'plugins'){
                            if(item.permission[p]){
                                for(var pluginId in item.permission[p]){
                                    $('#postForm input[name="permission['+p+']['+pluginId+'][id]"][value="'+pluginId+'"]').attr('checked', 'checked');
                                    $('#postForm input[name="permission['+p+']['+pluginId+'][code]"][value="'+pluginId+'"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                                    if(item.permission[p][pluginId].child){
                                        item.permission[p][pluginId].child.map(function(row){
                                            $('#postForm input[name="permission['+p+']['+pluginId+'][child][]"][value="'+row+'"]').attr('checked', 'checked');
                                            $('#postForm input[name="permission['+p+']['+pluginId+'][child][]"][value="'+row+'"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                                        });
                                    }
                                }
                            }
                        }else{
                            item.permission[p].map(function(row){
                                $('#postForm input[name="permission['+p+'][]"][value="'+row+'"]').attr('checked', 'checked');
                                $('#postForm input[name="permission['+p+'][]"][value="'+row+'"]').parent().find('img.cboximg').attr('src', '/public/static/admin/images/ok.png');
                            });
                        }
                    }
                }
                
                hasSelectAll();
                $('#postForm input[type="checkbox"]').attr('disabled', 'disabled');
                break;
            }
        }
    }

    function addRole(obj)
    {
        var url = $(obj).data('url');
        // iframe窗
        layer.open({
            type: 2,
            title: '自定义用户组',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: false, //开启最大化最小化按钮
            area: ['90%', '90%'],
            content: url
        });
    }

    function custom_role(str, new_role_id, auth_role_list)
    {
        $('#custom_role').before(str);
        $('#admin_role_list').val(auth_role_list);
        changeRole(new_role_id);
    }

    function head_pic_call_back(fileurl_tmp)
    {
      $("#head_pic").val(fileurl_tmp);
      $("#img_head_pic").attr('src', fileurl_tmp);
    }

    $('#password').keyup(function(){
        var password = $(this).val();
        $.ajax({
            url: "<?php echo url('Admin/ajax_checkPasswordLevel'); ?>",
            type: "POST",
            dataType: "JSON",
            data: {password:password, _ajax:1},
            success: function(res){
                $('#password_tips').removeAttr('class');
                if (1 == res.code) {
                    $('#password_tips').addClass('rank r'+res.data.pwdLevel);
                }
            }
        });
    });

    // 判断输入框是否为空
    function adsubmit(){
        var password = $('#password').val();
        var password2 = $('#password2').val();
        if (password != '' || password2 != '') {
            if (password != password2) {
                showErrorMsg('两次密码输入不一致！');
                $('input[name=password]').focus();
                return false;
            }
        }

        layer_loading('正在处理');
        $('#postForm').submit();
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