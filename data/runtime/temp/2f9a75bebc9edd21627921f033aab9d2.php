<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:45:"./application/admin/template/arctype\edit.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:80:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\field\addonitem.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<script type="text/javascript" src="/public/plugins/laydate/laydate.js"></script>

<script type="text/javascript" src="/public/plugins/Ueditor/ueditor.config.js?v=v1.3.9"></script>
<script type="text/javascript" src="/public/plugins/Ueditor/ueditor.all.min.js?v=v1.3.9"></script>
<script type="text/javascript" src="/public/plugins/Ueditor/lang/zh-cn/zh-cn.js?v=v1.3.9"></script>

<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>编辑栏目</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="javascript:void(0);" data-index='1' class="tab <?php if($tab == '1'): ?>current<?php endif; ?>"><span>常规选项</span></a></li>
                <li><a href="javascript:void(0);" data-index='2' class="tab <?php if($tab == '2'): ?>current<?php endif; ?>"><span>高级选项</span></a></li>
                <?php if(in_array(($field['current_channel']), explode(',',"2,8"))): ?>
                <li><a href="<?php echo url($channeltype_list[$field['current_channel']]['ctl_name'].'/attribute_index', ['typeid'=>\think\Request::instance()->param('id'), 'tab'=>3]); ?>" data-index='3' class="tab <?php if($tab == '3'): ?>current<?php endif; ?>"><span><?php if($field['current_channel'] == '8'): ?>属性列表<?php else: ?>参数列表<?php endif; ?></span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <form class="form-horizontal" id="post_form" action="<?php echo url('Arctype/edit'); ?>" method="post">
        <!-- 常规选项 -->
        <div class="ncap-form-default tab_div_1" <?php if($tab != '1'): ?>style="display:none;"<?php endif; ?>>
            <dl class="row">
                <dt class="tit">
                    <label for="typename"><em>*</em>栏目名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['typename']) && ($field['typename'] !== '')?$field['typename']:''); ?>" name="typename" id="name" class="input-txt">
                    <p class="notic">保持唯一性，不可重复</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="dirname">目录名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['dirname']) && ($field['dirname'] !== '')?$field['dirname']:''); ?>" name="dirname" id="dirname" class="input-txt" onkeyup="this.value=this.value.replace(/[^a-zA-Z0-9_]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^a-zA-Z0-9_]/g,''));">
                    <p class="notic">用于伪静态和静态页面生成！</p>
                    <p class="">留空系统默认全拼音+随机数，仅支持字母、数字、下划线</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="current_channel">内容模型</label>
                </dt>
                <dd class="opt">
                    <?php if(!empty($field['weapp_code'])): ?>
                        <?php echo $channeltype_list[$field['current_channel']]['title']; ?>
                        <input type="hidden" name="current_channel" id="current_channel" value="<?php echo $field['current_channel']; ?>" />
                    <?php else: ?>
                        <select class="small form-control" id="current_channel" name="current_channel" onchange="ajax_get_template();">
                            <?php if(is_array($channeltype_list) || $channeltype_list instanceof \think\Collection || $channeltype_list instanceof \think\Paginator): $i = 0; $__LIST__ = $channeltype_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" data-nid="<?php echo $vo['nid']; ?>" <?php if($field['current_channel'] == $vo['id']): ?>selected="true"<?php endif; ?>><?php echo $vo['title']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    <?php endif; ?>
                    <span class="err"></span>
                    <p class="" id="notic_current_channel"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="parent_id">所属栏目</label>
                </dt>
                <dd class="opt">
                    <?php if($hasChildren > '0'): ?>
                    <?php echo $select_html; ?>
                    <input type="hidden" name="parent_id" id="parent_id" value="<?php echo (isset($field['parent_id']) && ($field['parent_id'] !== '')?$field['parent_id']:''); ?>" />
                    <?php else: ?>
                    <select class="small form-control" id="parent_id" name="parent_id" onchange="set_grade(this);">
                        <?php echo $select_html; ?>
                    </select>
                    <?php endif; ?>
                    <span class="err"></span>
                    <p class="notic">如果选择上级栏目，那么新增的栏目则为被选择上级栏目的子栏目</p>
                </dd>
            </dl>
            <input type="hidden" name="channeltype" id="channeltype" value="<?php echo (isset($field['channeltype']) && ($field['channeltype'] !== '')?$field['channeltype']:''); ?>" />
            <dl class="row none" id="row_url">
                <dt class="tit">
                    <label for="dirpath">文件保存目录</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['dirpath']) && ($field['dirpath'] !== '')?$field['dirpath']:$predirpath); ?>" name="dirpath" id="dirpath" class="input-txt" onkeyup="this.value=this.value.replace(/[^0-9a-zA-Z\/-]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^0-9a-zA-Z\/-]/g,''));">&nbsp;<a href="javascript:void(0);" onclick="get_dirpinyin(this);" id="getpinyin" class="ncap-btn ncap-btn-green">获取拼音</a>
                    <p class="notic">生成的文章HTML页面会存放在该目录下</p>
                </dd>
            </dl>
<!--             <dl class="row">
                <dt class="tit">
                    <label for="sort_order">排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['sort_order']) && ($field['sort_order'] !== '')?$field['sort_order']:'100'); ?>" name="sort_order" id="sort_order" class="input-txt">
                    <p class="notic">越小越靠前</p>
                </dd>
            </dl> -->
            <dl class="row">
                <dt class="tit">
                    <label>隐藏栏目</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="is_hidden1" class="cb-enable <?php if($field['is_hidden'] == 1): ?>selected<?php endif; ?>">是</label>
                        <label for="is_hidden0" class="cb-disable <?php if($field['is_hidden'] == 0): ?>selected<?php endif; ?>">否</label>
                        <input id="is_hidden1" name="is_hidden" value="1" type="radio" <?php if($field['is_hidden'] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="is_hidden0" name="is_hidden" value="0" type="radio" <?php if($field['is_hidden'] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic">隐藏之后，不显示在前台页面</p>
                </dd>
            </dl>

            <?php if(!empty($field['weapp_code'])): ?>
            <div class="none">
            <?php endif; if(is_array($addonFieldExtList) || $addonFieldExtList instanceof \think\Collection || $addonFieldExtList instanceof \think\Paginator): $i = 0; $__LIST__ = $addonFieldExtList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(!isset($vo['ifeditable']) || $vo['ifeditable']): switch($vo['dtype']): case "hidden": ?>
                <!-- 隐藏域 start -->
                <dl class="row" style="display: none;">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <input type="hidden" class="input-txt" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="<?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?>">
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 隐藏域 start -->
            <?php break; case "text": ?>
                <!-- 单行文本框 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <input type="text" class="input-txt" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="<?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?>">&nbsp;<?php echo (isset($vo['dfvalue_unit']) && ($vo['dfvalue_unit'] !== '')?$vo['dfvalue_unit']:''); ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 单行文本框 end -->
            <?php break; case "multitext": ?>
                <!-- 多行文本框 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">          
                        <textarea rows="5" cols="60" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" style="height:60px;"><?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?></textarea>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 多行文本框 end -->
            <?php break; case "checkbox": ?>
                <!-- 复选框 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                        <label><input type="checkbox" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>][]" value="<?php echo $v2; ?>" <?php if(isset($vo['trueValue']) AND in_array($v2, $vo['trueValue'])): ?>checked="checked"<?php endif; ?>><?php echo $v2; ?></label>&nbsp;
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 复选框 end -->
            <?php break; case "radio": ?>
                <!-- 单选项 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                        <label><input type="radio" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="<?php echo $v2; ?>" <?php if(isset($vo['trueValue']) AND in_array($v2, $vo['trueValue'])): ?>checked="checked"<?php endif; ?>><?php echo $v2; ?></label>&nbsp;
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 单选项 end -->
            <?php break; case "switch": ?>
                <!-- 开关 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>1" class="cb-enable <?php if(0 != $vo['dfvalue']): ?>selected<?php endif; ?>">是</label>
                            <label for="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>0" class="cb-disable <?php if(0 == $vo['dfvalue']): ?>selected<?php endif; ?>">否</label>
                            <input id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>1" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="1" type="radio" <?php if(0 != $vo['dfvalue']): ?>checked="checked"<?php endif; ?>>
                            <input id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>0" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="0" type="radio" <?php if(0 == $vo['dfvalue']): ?>checked="checked"<?php endif; ?>>
                        </div>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 开关 end -->
            <?php break; case "select": ?>
                <!-- 下拉框 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt"> 
                        <select name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>">
                            <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $v2; ?>" <?php if(isset($vo['trueValue']) AND in_array($v2, $vo['trueValue'])): ?>selected<?php endif; ?>><?php echo $v2; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 下拉框 end -->
            <?php break; case "img": ?>
                <!-- 单张图 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <div class="input-file-show div_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_local" <?php if($vo[$vo['name'].'_eyou_is_remote'] != '0'): ?>style="display: none;"<?php endif; ?>>
                            <span class="show">
                                <a id="img_a_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" target="_blank" class="nyroModal" rel="gal" href="<?php echo (isset($vo[$vo['name'].'_eyou_local']) && ($vo[$vo['name'].'_eyou_local'] !== '')?$vo[$vo['name'].'_eyou_local']:'javascript:void(0);'); ?>">
                                    <i id="img_i_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" class="fa fa-picture-o" <?php if(!(empty($vo[$vo['name'].'_eyou_local']) || (($vo[$vo['name'].'_eyou_local'] instanceof \think\Collection || $vo[$vo['name'].'_eyou_local'] instanceof \think\Paginator ) && $vo[$vo['name'].'_eyou_local']->isEmpty()))): ?>onmouseover="layer_tips=layer.tips('<img src=<?php echo $vo[$vo['name'].'_eyou_local']; ?> class=\'layer_tips_img\'>',this,{tips: [1, '#fff']});"<?php endif; ?> onmouseout="layer.close(layer_tips);"></i>
                                </a>
                            </span>
                            <span class="type-file-box">
                                <input type="text" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_local" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_local]" value="<?php echo (isset($vo[$vo['name'].'_eyou_local']) && ($vo[$vo['name'].'_eyou_local'] !== '')?$vo[$vo['name'].'_eyou_local']:''); ?>" class="type-file-text">
                                <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                                <input class="type-file-file" onClick="GetUploadify(1,'','allimg','<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_call_back')" size="30" hidefocus="true" nc_type="change_site_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>"
                                     title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                            </span>
                        </div>
                        <input type="text" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_remote" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_remote]" value="<?php echo (isset($vo[$vo['name'].'_eyou_remote']) && ($vo[$vo['name'].'_eyou_remote'] !== '')?$vo[$vo['name'].'_eyou_remote']:''); ?>" placeholder="http://" class="input-txt" <?php if($vo[$vo['name'].'_eyou_is_remote'] != '1'): ?>style="display: none;"<?php endif; ?>>
                        &nbsp;
                        <label><input type="checkbox" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_is_remote]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_is_remote" value="1" <?php if($vo[$vo['name'].'_eyou_is_remote'] == '1'): ?>checked="checked"<?php endif; ?> onClick="clickRemote(this, '<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou');">远程图片</label>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <script type="text/javascript">
                    function <?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_call_back(fileurl_tmp)
                    {
                      $("#<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_local").val(fileurl_tmp);
                      $("#img_a_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").attr('href', fileurl_tmp);
                      $("#img_i_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").attr('onmouseover', "layer_tips=layer.tips('<img src="+fileurl_tmp+" class=\\'layer_tips_img\\'>',this,{tips: [1, '#fff']});");
                    }
                </script>
                <!-- 单张图 end -->
            <?php break; case "imgs": ?>
                <!-- 多张图 start -->
                <dl class="row" id="dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <div class="tab-pane pics" id="tab_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>">
                            <a href="javascript:void(0);" onClick="GetUploadify(100,'','allimg','<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_call_back');" class="imgupload">
                                <i class="fa fa-photo"></i>上传图片
                            </a>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="sort-list-<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>">
                                        <?php if(is_array($vo[$vo['name'].'_eyou_imgupload_list']) || $vo[$vo['name'].'_eyou_imgupload_list'] instanceof \think\Collection || $vo[$vo['name'].'_eyou_imgupload_list'] instanceof \think\Paginator): $k2 = 0; $__LIST__ = $vo[$vo['name'].'_eyou_imgupload_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($k2 % 2 );++$k2;?>
                                        <div class="images_upload" style="display:inline-block;">
                                            <div style="position: relative; height: 130px;">
                                                <input type="hidden" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>][]" value="<?php echo $v2['image_url']; ?>">
                                                <a href="<?php echo $v2['image_url']; ?>" onclick="" class="upimg" target="_blank" title="拖动修改排序">
                                                    <img src="<?php echo $v2['image_url']; ?>" width="100" height="100">
                                                </a>
                                                <a href="javascript:void(0)" onclick="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_ClearPicArr2(this,'<?php echo $v2['image_url']; ?>')" class="delect">删除</a>
                                            </div>
                                            <textarea rows="5" cols="60" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_intro][]" style="height:28px; width: 136px;" placeholder="图片注释"><?php echo $v2['intro']; ?></textarea>
                                        </div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                        <div class="images_upload">
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- 上传图片显示的样板 start -->
                        <div class="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_upload_tpl none">
                            <div class="images_upload" style="display:inline-block;">
                                <div style="position: relative; height: 130px;">
                                    <input type="hidden" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>][]" value="" />
                                    <a href="javascript:void(0);" onClick="" class="upimg" title="拖动修改排序">
                                        <img src="/public/static/admin/images/add-button.jpg" width="100" height="100" />
                                    </a>
                                    <a href="javascript:void(0)" class="delect">&nbsp;&nbsp;</a>
                                </div>
                                <textarea rows="5" cols="60" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_eyou_intro][]" style="height:28px; width: 136px;" placeholder="图片注释"></textarea>
                            </div>
                        </div>
                        <!-- 上传图片显示的样板 end -->
                    </dd>
                </dl>
                <script type="text/javascript">
                    // 上传多图回调函数
                    function <?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_call_back(paths){
                        
                        var  last_div = $(".<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_upload_tpl").html();
                        for (var i=0;i<paths.length ;i++ )
                        {
                            $("#dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").find(".images_upload:eq(0)").before(last_div);  // 插入一个 新图片
                            $("#dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").find(".images_upload:eq(0)").find('a:eq(0)').attr('href',paths[i]).attr('onclick','').attr('target', "_blank");// 修改他的链接地址
                            $("#dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").find(".images_upload:eq(0)").find('img').attr('src',paths[i]);// 修改他的图片路径
                            $("#dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").find(".images_upload:eq(0)").find('a:eq(1)').attr('onclick',"<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_ClearPicArr2(this,'"+paths[i]+"')").text('删除');
                            $("#dl_<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").find(".images_upload:eq(0)").find('input').val(paths[i]); // 设置隐藏域 要提交的值
                        }             
                    }
                    /*
                     * 上传之后删除组图input     
                     * @access   public
                     * @val      string  删除的图片input
                     */
                    function <?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>_ClearPicArr2(obj,path)
                    {
                        // 删除数据库记录
                        $.ajax({
                            type:'GET',
                            url:"<?php echo url('Field/del_arctypeimgs'); ?>",
                            data:{filename:path,fieldname:"<?php echo $vo['name']; ?>",typeid:"<?php echo (isset($aid) && ($aid !== '')?$aid:'0'); ?>"},
                            success:function(){
                                $(obj).parent().parent().remove(); // 删除完服务器的, 再删除 html上的图片
                                $.ajax({
                                    type:'GET',
                                    url:"<?php echo url('Uploadify/delupload'); ?>",
                                    data:{action:"del", filename:path},
                                    success:function(){}
                                });
                            }
                        });    
                    }

                    /** 以下 产品相册的拖动排序相关 js*/

                    $( ".sort-list-<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" ).sortable({
                        start: function( event, ui) {
                        
                        }
                        ,stop: function( event, ui ) {

                        }
                    });
                    //因为他们要拖动，所以尽量设置他们的文字不能选择。 
                    $( ".sort-list-<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" ).disableSelection();
                </script>
                <!-- 多张图 end -->
            <?php break; case "int": ?>
                <!-- 整数类型 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt"> 
                        <input type="text" value="<?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" placeholder="只允许纯数字" class="input-txt" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^0-9]/g,''));">&nbsp;<?php echo (isset($vo['dfvalue_unit']) && ($vo['dfvalue_unit'] !== '')?$vo['dfvalue_unit']:''); ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 整数类型 end -->
            <?php break; case "float": ?>
                <!-- 小数类型 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt"> 
                        <input type="text" value="<?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" placeholder="允许带有小数点的数值" class="input-txt" onkeyup="this.value=this.value.replace(/[^0-9\.]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^0-9\.]/g,''));">&nbsp;<?php echo (isset($vo['dfvalue_unit']) && ($vo['dfvalue_unit'] !== '')?$vo['dfvalue_unit']:''); ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 小数类型 end -->
            <?php break; case "decimal": ?>
                <!-- 金额类型 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt"> 
                        <input type="text" value="<?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" placeholder="允许带有小数点的金额" class="input-txt" onkeyup="this.value=this.value.replace(/[^0-9\.]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^0-9\.]/g,''));">&nbsp;<?php echo (isset($vo['dfvalue_unit']) && ($vo['dfvalue_unit'] !== '')?$vo['dfvalue_unit']:''); ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 金额类型 end -->
            <?php break; case "datetime": ?>
                <!-- 日期和时间 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt"> 
                        <input type="text" class="input-txt" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" value="<?php echo $vo['dfvalue']; ?>">        
                        <span class="add-on input-group-addon">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        </span> 
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <script type="text/javascript">
                    $(function () {
                        $('#<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>').layDate();   
                    });
                </script>
                <!-- 日期和时间 end -->
            <?php break; case "htmltext": ?>
                <!-- HTML文本 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">          
                        <textarea class="span12 ckeditor" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" data-func="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" title=""><?php echo (isset($vo['dfvalue']) && ($vo['dfvalue'] !== '')?$vo['dfvalue']:''); ?></textarea>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <script type="text/javascript">
                    UE.getEditor('<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>',{
                        serverUrl :"<?php echo url('Ueditor/index',array('savepath'=>'ueditor')); ?>",
                        zIndex: 999,
                        initialFrameWidth: "100%", //初化宽度
                        initialFrameHeight: 450, //初化高度            
                        focus: false, //初始化时，是否让编辑器获得焦点true或false
                        maximumWords: 99999,
                        removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign',//允许的最大字符数 'fullscreen',
                        pasteplain:false, //是否默认为纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
                        autoHeightEnabled: false,
                        toolbars: ueditor_toolbars
                    });

                    //必须在提交前渲染编辑器；
                    function <?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>() {
                        //判断编辑模式状态:0表示【源代码】HTML视图；1是【设计】视图,即可见即所得；-1表示不可用
                        if(UE.getEditor("<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").queryCommandState('source') != 0) {
                            UE.getEditor("<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>").execCommand('source'); //切换到【设计】视图
                        }
                    }
                </script>
                <!-- HTML文本 end -->
            <?php break; case "files": ?>
                <!-- 多文件 start -->
<!--                 <dl class="row">
    <dt class="tit">
        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
    </dt>
    <dd class="opt">
        <div id="uploader" class="wu-example">
            用来存放文件信息
            <div id="thelist" class="uploader-list"></div>
            <div class="btns left">
                <div id="picker">选择文件</div>
                <input type="button" id="ctlBtn" class="btn btn-default" value="开始上传" />
            </div>
        </div>
        <span class="err"></span>
        <p class="notic">只允许上传文件的类型：<?php echo (isset($global['file_type']) && ($global['file_type'] !== '')?$global['file_type']:''); ?></p>
    </dd>
</dl>
<link rel="stylesheet" type="text/css" href="/public/plugins/webuploader/webuploader.css">
<script type="text/javascript" src="/public/plugins/webuploader/webuploader.min.js"></script>
<script type="text/javascript">
    var uploader_swf = '/public/plugins/webuploader/Uploader.swf';
    var server_url="<?php echo url('Ueditor/downFileUp',array('savepath'=>'soft')); ?>";
</script>
<script src="/public/static/admin/js/getting-started.js"></script> -->
                <!-- 多文件 end -->
            <?php break; endswitch; endif; endforeach; endif; else: echo "" ;endif; if(!empty($field['weapp_code'])): ?>
            </div>
            <?php endif; ?>
            
        </div>
        <!-- 常规选项 -->
        <!-- 高级选项 -->        
        <div class="ncap-form-default tab_div_2" <?php if($tab != '2'): ?>style="display:none;"<?php endif; ?>>
            <dl class="row <?php if(!empty($field['weapp_code'])): ?>none<?php endif; ?>">
                <dt class="tit">
                    <label>栏目属性</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="is_part1" class="cb-enable <?php if($field['is_part'] == 1): ?>selected<?php endif; ?>">外部链接</label>
                        <label for="is_part0" class="cb-disable <?php if($field['is_part'] == 0): ?>selected<?php endif; ?>">内容栏目</label>
                        <input id="is_part1" name="is_part" value="1" type="radio" <?php if($field['is_part'] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="is_part0" name="is_part" value="0" type="radio" <?php if($field['is_part'] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic">外部连接（在"下方文本框"处填写网址）</p>
                </dd>
            </dl>
            <dl class="row is_part1 <?php if($field['is_part'] == 0): ?>none<?php endif; ?>" id="row_url">
                <dt class="tit">
                    <label for="typelink"><em>*</em>外部链接</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['typelink']) && ($field['typelink'] !== '')?$field['typelink']:''); ?>" name="typelink" id="typelink" class="input-txt" placeholder="http://">
                    <p class="notic">请填写完整外部链接</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="englist_name">英文别名</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['englist_name']) && ($field['englist_name'] !== '')?$field['englist_name']:''); ?>" name="englist_name" id="englist_name" class="input-txt">
                    <p class="notic">显示英文名栏目的网站</p>
                </dd>
            </dl>
            <?php if(!empty($field['weapp_code'])): ?>
            <!-- 插件栏目 -->
            <dl class="row">
                <dt class="tit">
                    <label for="templist">模板管理</label>
                </dt>
                <dd class="opt">
                    <a href="<?php echo url('Filemanager/index', ['activepath'=>'/template/plugins/ask/pc', 'goback'=>1]); ?>" class="ncap-btn ncap-btn-green">点击在线编辑</a>
                </dd>
            </dl>
            <!-- end -->
            <?php endif; if(!empty($field['weapp_code'])): ?>
            <div class="none">
            <?php endif; ?>
            <dl class="row">
                <dt class="tit">
                  <label>栏目图片</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show div_litpic_local" <?php if($field['is_remote'] != '0'): ?>style="display: none;"<?php endif; ?>>
                        <span class="show">
                            <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="<?php echo (isset($field['litpic_local']) && ($field['litpic_local'] !== '')?$field['litpic_local']:'javascript:void(0);'); ?>" target="_blank">
                                <i id="img_i" class="fa fa-picture-o" <?php if(!(empty($field['litpic_local']) || (($field['litpic_local'] instanceof \think\Collection || $field['litpic_local'] instanceof \think\Paginator ) && $field['litpic_local']->isEmpty()))): ?>onmouseover="layer_tips=layer.tips('<img src=<?php echo $field['litpic_local']; ?> class=\'layer_tips_img\'>',this,{tips: [1, '#fff']});"<?php endif; ?> onmouseout="layer.close(layer_tips);"></i>
                            </a>
                        </span>
                        <span class="type-file-box">
                            <input type="text" id="litpic_local" name="litpic_local" value="<?php echo (isset($field['litpic_local']) && ($field['litpic_local'] !== '')?$field['litpic_local']:''); ?>" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','allimg','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo"
                                 title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <input type="text" id="litpic_remote" name="litpic_remote" value="<?php echo (isset($field['litpic_remote']) && ($field['litpic_remote'] !== '')?$field['litpic_remote']:''); ?>" placeholder="http://" class="input-txt" <?php if($field['is_remote'] != '1'): ?>style="display: none;"<?php endif; ?>>
                    &nbsp;
                    <label><input type="checkbox" name="is_remote" id="is_remote" value="1" <?php if($field['is_remote'] == '1'): ?>checked="checked"<?php endif; ?> onClick="clickRemote(this, 'litpic');">远程图片</label>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row" id="dl_templist">
                <dt class="tit">
                    <label for="templist"><em>*</em>列表模板</label>
                </dt>
                <dd class="opt">
                    <select name="templist" id="templist">
                    </select>
                    <span class="err"></span>
                    <p class="notic">模板命名规则：<br/>lists_<font class="font_nid">模型标识</font>.html<br/>lists_<font class="font_nid">模型标识</font>_自定义.html</p>
                    &nbsp;<a href="javascript:void(0);" onclick="newtpl('lists');" class="ncap-btn ncap-btn-green">新建模板</a>
                </dd>
            </dl>
            <dl class="row" id="dl_tempview">
                <dt class="tit">
                    <label for="tempview"><em>*</em>文档模板</label>
                </dt>
                <dd class="opt">
                    <select name="tempview" id="tempview">
                    </select>
                    <span class="err"></span>
                    <p class="notic">模板命名规则：<br/>view_<font class="font_nid">模型标识</font>.html<br/>view_<font class="font_nid">模型标识</font>_自定义.html</p>
                    &nbsp;<a href="javascript:void(0);" onclick="newtpl('view');" class="ncap-btn ncap-btn-green">新建模板</a>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="seo_title">SEO标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($field['seo_title']) && ($field['seo_title'] !== '')?$field['seo_title']:''); ?>" name="seo_title" id="seo_title" class="input-txt">
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>SEO关键字</label>
                </dt>
                <dd class="opt">          
                    <textarea rows="5" cols="60" id="seo_keywords" name="seo_keywords" style="height:40px;"><?php echo (isset($field['seo_keywords']) && ($field['seo_keywords'] !== '')?$field['seo_keywords']:''); ?></textarea>
                    <span class="err"></span>
                    <p class="notic">多个关键词请用英文逗号（,）隔开，建议3到5个关键词。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>SEO描述</label>
                </dt>
                <dd class="opt">          
                    <textarea rows="5" cols="60" id="seo_description" name="seo_description" style="height:60px;"><?php echo (isset($field['seo_description']) && ($field['seo_description'] !== '')?$field['seo_description']:''); ?></textarea>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <?php if(!empty($field['weapp_code'])): ?>
            </div>
            <?php endif; ?>
        </div>
        <!-- 高级选项 -->
        <div class="ncap-form-default">
            <div class="bot">
                <input type="hidden" name="tab" value="<?php echo (isset($tab) && ($tab !== '')?$tab:'0'); ?>">
                <input type="hidden" name="id" id="id" value="<?php echo (isset($field['id']) && ($field['id'] !== '')?$field['id']:''); ?>">
                <input type="hidden" name="grade" id="grade" value="<?php echo (isset($field['grade']) && ($field['grade'] !== '')?$field['grade']:0); ?>">
                <input type="hidden" name="oldgrade" id="oldgrade" value="<?php echo (isset($field['grade']) && ($field['grade'] !== '')?$field['grade']:0); ?>">
                <a href="JavaScript:void(0);" onclick="check_submit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div> 
    </form>
</div>
<script type="text/javascript">

    var templateList = <?php echo json_encode($templateList); ?>;

    $(document).ready(function(){    
        //选项卡切换列表
        $('.tab-base').find('.tab').click(function(){
            $('.tab-base').find('.tab').each(function(){
                $(this).removeClass('current');
            });
            $(this).addClass('current');
            var tab_index = $(this).data('index');          
            $(".tab_div_1, .tab_div_2").hide();          
            $(".tab_div_"+tab_index).show();
        });    

        $('input[name=is_part]').click(function(){
            var val = $(this).val();
            if (val == 1) {
                $('.is_part1').show();
            } else {
                $('.is_part1').hide();
            }
        });

        ajax_get_template();
    });

    /*根据模型ID获取模板文件名*/
    function ajax_get_template() {
        var obj = $('#current_channel');
        var channel = parseInt($(obj).val());
        var js_allow_channel_arr = <?php echo $js_allow_channel_arr; ?>;
        $('#notic_current_channel').html('');

        // 重新定义模板变量，专用于新建模板功能
        $.ajax({
            url: "<?php echo url('Arctype/ajax_getTemplateList'); ?>",
            type: 'GET',
            dataType: 'JSON',
            data: {},
            success: function(res){
                if (res.code == 1) {
                    templateList = res.data.templateList;
                }
            }
        });
        // end

        if (templateList[channel] == undefined || templateList[channel] == '') {
            showErrorMsg('模板文件不存在！');
            return false;
        } else if (templateList[channel]['msg'] != '') {
            $('#notic_current_channel').html(templateList[channel]['msg']);
        }

        $('#templist').html(templateList[channel]['lists']);
        if ($.inArray(channel, js_allow_channel_arr) == -1) {
            if (channel == 6) {
                $('#dl_templist').find('label[for=templist]').html('<em>*</em>单页模板');
            } else if (channel == 8) {
                $('#dl_templist').find('label[for=templist]').html('<em>*</em>留言模板');
            }
            $('#dl_tempview').hide();
        } else {
            $('#dl_templist').find('label[for=templist]').html('<em>*</em>列表模板');
            $('#dl_tempview').show();
        }
        $('#tempview').html(templateList[channel]['view']);

        $('.font_nid').html(templateList[channel]['nid']);
        
        return false;
    }
    /*--end*/

    function get_dirpinyin(obj)
    {
        var typename = $('input[name=typename]').val();
        if ($.trim(typename) == '') {
            showErrorMsg('先填写栏目名称！');
            $('input[name=typename]').focus();
            return false;
        }
        $(obj).html('正在处理');
        $.ajax({
            url: "<?php echo url('Arctype/ajax_get_dirpinyin'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {typename: typename},
            success: function(res){
                $(obj).html('获取拼音');
                if (res.status == 1) {
                    dirpath = $('#dirpath').val() + '/' + res.msg;
                    $('#dirpath').val(dirpath);
                    return true;
                } else {
                    showErrorMsg('操作失败');
                    return false;
                }
            },
            error: function(e){
                $(obj).html('获取拼音');
                showErrorMsg(ey_unknown_error);
                return false;
            }
        });
    }

    function get_arctype(obj) {
        $('#parent_id').html('<option value="">加载中……</option>');
        var channeltype = parseInt($(obj).find("option:selected").val());
        $.ajax({
            url: "<?php echo url('Arctype/ajax_get_arctype'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {channeltype:channeltype},
            success: function(res){
                if (res.status == 1) {
                    $('#parent_id').html(res.select_html);
                } else {
                    showErrorMsg('操作失败');
                    return false;
                }
            },
            error: function(e){
                showErrorMsg(ey_unknown_error);
                return false;
            }
        });
    }

    function set_grade(obj) {
        var grade = parseInt($(obj).find("option:selected").attr("data-grade"));
        $('#grade').val(grade + 1);
        var dirpath = $(obj).find("option:selected").attr("data-dirpath");
        $('#dirpath').val(dirpath);
    }

    function check_submit(){
        if($('input[name="typename"]').val() == ''){
            showErrorMsg('栏目名称不能为空！');
            $('input[name=typename]').focus();
            return false;
        }
        if ($('input[name=is_part]:checked').val() == 1) {
            if($('input[name=typelink]').val() == ''){
                showErrorMsg('外部链接不能为空！');
                $('input[name=typelink]').focus();
                return false;
            }
        }
        var dirname = $('input[name="dirname"]').val();
        var patrn = /^\d+$/;
        if (patrn.test(dirname) == true) {
            showErrorMsg('栏目英文名不能为纯数字！');
            $('input[name=dirname]').focus();
            return false;
        }
        if($('#templist').val() == ''){
            $('.tab-base').find('.tab').each(function(){
                $(this).removeClass('current');
            });
            $($('.tab-base').find('.tab').get(1)).addClass('current');
            $('.tab_div_1').hide();
            $('.tab_div_2').show();
            showErrorMsg('请选择列表模板');
            $('#templist').focus();
            return false;
        }

        var channel = parseInt($('#current_channel').val());
        var js_allow_channel_arr = <?php echo $js_allow_channel_arr; ?>;
        if($('#tempview').val() == '' && $.inArray(channel, js_allow_channel_arr) != -1){
            $('.tab-base').find('.tab').each(function(){
                $(this).removeClass('current');
            });
            $($('.tab-base').find('.tab').get(1)).addClass('current');
            $('.tab_div_1').hide();
            $('.tab_div_2').show();
            showErrorMsg('请选择文档模板');
            $('#tempview').focus();
            return false;
        }
        
        layer_loading('正在处理');
        if(!ajax_check_dirpath())
        {
            layer.closeAll();
            showErrorMsg('文件保存目录已存在！');
            $('input[name=dirpath]').focus();
            return false;
        }
        $('#post_form').submit();
    }

    function ajax_check_dirpath()
    {
        return true;
/*
        var flag = false;
        var dirpath = $.trim($('input[name=dirpath]').val());
        $.ajax({
            url: "<?php echo url('Arctype/ajax_check_dirpath'); ?>",
            type: 'POST',
            async: false,
            dataType: 'JSON',
            data: {dirpath: dirpath, id: $('#id').val()},
            success: function(res){
                if(res.status == 1){
                    flag = true;
                }
            },
            error: function(e){}
        });

        return flag;
        */
    }

    function img_call_back(fileurl_tmp)
    {
      $("#litpic_local").val(fileurl_tmp);
      $("#img_a").attr('href', fileurl_tmp);
      $("#img_i").attr('onmouseover', "layer_tips=layer.tips('<img src="+fileurl_tmp+" class=\\'layer_tips_img\\'>',this,{tips: [1, '#fff']});");
    }

    function newtpl(type)
    {
        var nid = $('#current_channel').find('option:selected').attr('data-nid');
        var url = "<?php echo url('Arctype/ajax_newtpl'); ?>";
        if (url.indexOf('?') > -1) {
            url += '&';
        } else {
            url += '?';
        }
        url += 'type='+type+'&nid='+nid;

        if ('lists' == type) {
            var title = '新建列表模板';
        } else {
            var title = '新建文档模板';
        }
        //iframe窗
        layer.open({
            type: 2,
            title: title,
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['90%', '90%'],
            content: url
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