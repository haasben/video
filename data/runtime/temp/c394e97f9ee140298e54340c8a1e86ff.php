<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:43:"./application/admin/template/custom\add.htm";i:1573784733;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:81:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\field\modelfield.htm";i:1571037616;s:91:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\diy_extend\archives_extend.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<body style="background-color: #FFF; overflow: auto;min-width:auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width:auto;">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>新增</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="javascript:void(0);" data-index='1' class="tab current"><span>常规选项</span></a></li>
                <li><a href="javascript:void(0);" data-index='2' class="tab"><span>SEO选项</span></a></li>
                <li><a href="javascript:void(0);" data-index='3' class="tab"><span>其他选项</span></a></li>
            </ul>
        </div>
    </div>
    <form class="form-horizontal" id="post_form" action="<?php echo url('Custom/add'); ?>" method="post">
        <!-- 常规信息 -->
        <div class="ncap-form-default tab_div_1">
            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="title" value="" id="title" class="input-txt" maxlength="100">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>所属栏目</label>
                </dt>
                <dd class="opt"> 
                    <select name="typeid" id="typeid">
                        <option value="0">请选择栏目…</option>
                        <?php echo $arctype_html; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>文档属性</label>
                </dt>
                <dd class="opt">
                    <label><input type="checkbox" name="is_head" value="1">头条[h]</label>&nbsp;
                    <label><input type="checkbox" name="is_recom" value="1">推荐[c]</label>&nbsp;
                    <label><input type="checkbox" name="is_special" value="1">特荐[a]</label>&nbsp;
                    <label><input type="checkbox" name="is_b" value="1">加粗[b]</label>&nbsp;
                    <label><input type="checkbox" name="is_litpic" value="1">图片[p]</label>&nbsp;
                    <label><input type="checkbox" name="is_jump" value="1">跳转[j]</label>&nbsp;
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row none dl_jump">
                <dt class="tit">
                    <label>跳转网址</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="" name="jumplinks" id="jumplinks" class="input-txt" placeholder="http://">
                    <span class="err"></span>
                    <p class="notic">请输入完整的URL网址（包含http或https），设置后访问该条信息将直接跳转到设置的网址</p>
                </dd>
            </dl>
            <?php if(!empty($channelfield_row['litpic']) AND 1 == $channelfield_row['litpic']['ifeditable']): ?>
            <dl class="row">
                <dt class="tit">
                  <label>缩略图</label>
                </dt>
                <dd class="opt">
                    <div class="input-file-show div_litpic_local">
                        <span class="show">
                            <a id="img_a" target="_blank" class="nyroModal" rel="gal" href="javascript:void(0);">
                                <i id="img_i" class="fa fa-picture-o" onmouseover="" onmouseout="layer.close(layer_tips);"></i>
                            </a>
                        </span>
                        <span class="type-file-box">
                            <input type="text" id="litpic_local" name="litpic_local" value="" class="type-file-text">
                            <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                            <input class="type-file-file" onClick="GetUploadify(1,'','allimg','img_call_back')" size="30" hidefocus="true" nc_type="change_site_logo"
                                 title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                        </span>
                    </div>
                    <input type="text" id="litpic_remote" name="litpic_remote" value="" placeholder="http://" class="input-txt" style="display: none;">
                    &nbsp;
                    <label><input type="checkbox" name="is_remote" id="is_remote" value="1" onClick="clickRemote(this, 'litpic');">远程图片</label>
                    <span class="err"></span>
                    <p class="notic">当没有手动上传图片时候，会自动提取相册的第一张图片作为封面</p>
                    &nbsp;<a href="javascript:void(0);" onclick="system_thumb();" class="ncap-btn ncap-btn-green">缩略图配置</a>
                </dd>
            </dl>

            <dl class="row">
                <dt class="tit">
                  <label>上传文件</label>
                </dt>
                <dd class="opt">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-normal" id="buttonList">选择文件</button>
                        <label><input type="checkbox" value="1" onclick="ClickRemoteFile(this);">远程地址</label>

                        <a href="javascript:void(0);" data-url="<?php echo url('Download/template_set'); ?>" onclick="TemplateSet(this);" style="display: none;" id='TemplateSet'>[参数设置]</a>

                        <div class="layui-upload-list">
                            <table class="layui-table">
                                <thead>
                                    <tr>
                                        <th>文件名</th>
                                        <th>大小</th>
                                        <th>状态</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody id="demoList"></tbody>
                            </table>
                        </div>

                        <div style="display: none;" id='ClickRemoteFile'>
                            <div id='Template'>
                                <div class="template_div">
                                    远程地址1：<input type="text" name="remote_file[]" value="" placeholder="http://" style="width: 50%;">
                                    <?php if(is_array($attr_field) || $attr_field instanceof \think\Collection || $attr_field instanceof \think\Paginator): $i = 0; $__LIST__ = $attr_field;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <span class="ey_<?php echo $vo['field_name']; ?>">
                                            <span class="title_<?php echo $vo['field_name']; ?>"><?php echo $vo['field_title']; ?></span>：<input type="text" name="<?php echo $vo['field_name']; ?>[]" style="width: 7%;">
                                        </span>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="template_div">
                                    远程地址2：<input type="text" name="remote_file[]" value="" placeholder="http://" style="width: 50%;">
                                    <?php if(is_array($attr_field) || $attr_field instanceof \think\Collection || $attr_field instanceof \think\Paginator): $i = 0; $__LIST__ = $attr_field;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <span class="ey_<?php echo $vo['field_name']; ?>">
                                            <span class="title_<?php echo $vo['field_name']; ?>"><?php echo $vo['field_title']; ?></span>：<input type="text" name="<?php echo $vo['field_name']; ?>[]" style="width: 7%;">
                                        </span>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                                <div class="template_div">
                                    远程地址3：<input type="text" name="remote_file[]" value="" placeholder="http://" style="width: 50%;">
                                    <?php if(is_array($attr_field) || $attr_field instanceof \think\Collection || $attr_field instanceof \think\Paginator): $i = 0; $__LIST__ = $attr_field;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <span class="ey_<?php echo $vo['field_name']; ?>">
                                            <span class="title_<?php echo $vo['field_name']; ?>"><?php echo $vo['field_title']; ?></span>：<input type="text" name="<?php echo $vo['field_name']; ?>[]" style="width: 7%;">
                                        </span>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <a onclick="GetTemplateAddr(2);">
                                更多远程地址
                            </a>
                        </div>
                        <button style="display:none;" type="button" class="layui-btn" id="buttonListAction">批量重传</button>
                    </div>
                </dd>
            </dl>
            <?php endif; ?>
            
<!-- 用户自定义扩展模板文件 -->

<!-- 用户自定义扩展模板文件，仅用于文档的新增和编辑页面 -->

<?php 
    // 这里可以实现原生php代码
    $diyExtendLogic = new \app\admin\logic\DiyExtendLogic;
 ?>

<!-- 这里自定义HTML表单代码 -->

<!-- end -->

<?php if(is_array($addonFieldExtList) || $addonFieldExtList instanceof \think\Collection || $addonFieldExtList instanceof \think\Paginator): $i = 0; $__LIST__ = $addonFieldExtList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(isset($vo['ifeditable']) && $vo['ifeditable'] == 1): switch($vo['dtype']): case "hidden": ?>
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
            <?php break; case "region": ?>
                <!-- 区域选项 start -->
                <dl class="row">
                    <dt class="tit">
                        <label><?php if(isset($vo['ifrequire']) AND !empty($vo['ifrequire'])): ?><em>*</em><?php endif; ?><?php echo (isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:''); ?></label>
                    </dt>
                    <dd class="opt">
                        <?php if(is_array($vo['dfvalue']) || $vo['dfvalue'] instanceof \think\Collection || $vo['dfvalue'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['dfvalue'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
                            <label>
                                <input type="radio" id="<?php echo $vo['fieldArr']; ?>_<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" name="<?php echo $vo['fieldArr']; ?>[<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>]" value="<?php echo $v2['id']; ?>" <?php if(isset($vo['trueValue']) AND in_array($v2['id'], $vo['trueValue'])): ?>checked="checked"<?php endif; ?>><?php echo $v2['name']; ?>
                            </label>&nbsp;
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <span class="err"></span>
                        <p class="notic"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></p>
                    </dd>
                </dl>
                <!-- 区域选项 end -->
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
                            url:"<?php echo url('Field/del_channelimgs'); ?>",
                            data:{filename:path,channel:"<?php echo (isset($channeltype) && ($channeltype !== '')?$channeltype:'0'); ?>",fieldname:"<?php echo $vo['name']; ?>",aid:"<?php echo (isset($aid) && ($aid !== '')?$aid:'0'); ?>"},
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
            <?php break; endswitch; endif; endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!-- 常规信息 -->
        <!-- SEO设置 -->
        <div class="ncap-form-default tab_div_2" style="display:none;">
            <dl class="row">
                <dt class="tit">
                    <label>TAG标签</label>
                </dt>
                <dd class="opt">          
                    <input type="text" value="" name="tags" id="tags" class="input-txt">
                    &nbsp;<a href="javascript:void(0);" onclick="tags_list(this);" class="ncap-btn ncap-btn-green">管理</a>
                    <span class="err"></span>
                    <p class="notic">多个标签用英文逗号（,）分开，单个标签小于12字节</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="seo_title">SEO标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="" name="seo_title" id="seo_title" class="input-txt">
                    <p class="notic">一般不超过80个字符，为空时系统自动构成，可以到 <a href="<?php echo url('Seo/index', array('inc_type'=>'seo')); ?>">SEO设置 - SEO基础</a> 中设置构成规则。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>SEO关键词</label>
                </dt>
                <dd class="opt">          
                    <textarea rows="5" cols="60" id="seo_keywords" name="seo_keywords" style="height:40px;"></textarea>
                    <span class="err"></span>
                    <p class="notic">一般不超过100个字符，多个关键词请用英文逗号（,）隔开，建议3到5个关键词。</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>SEO描述</label>
                </dt>
                <dd class="opt">          
                    <textarea rows="5" cols="60" id="seo_description" name="seo_description" style="height:60px;"></textarea>
                    <span class="err"></span>
                    <p class="notic">一般不超过200个字符，不填写时系统自动提取正文的前200个字符</p>
                </dd>
            </dl>
        </div>
        <!-- SEO设置 -->
        <!-- 其他参数 -->
        <div class="ncap-form-default tab_div_3" style="display:none;">
            <?php if(!empty($channelfield_row['author']) AND 1 == $channelfield_row['litpic']['ifeditable']): ?>
            <dl class="row">
                <dt class="tit">
                    <label for="author">作者</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (\think\Session::get('admin_info.pen_name') ?: '小编'); ?>" name="author" id="author" class="input-txt">
                    &nbsp;<a href="javascript:void(0);" onclick="set_author();" class="ncap-btn ncap-btn-green">设置</a>
                    <p class="notic">设置作者默认名称（将同步至管理员笔名）</p>
                </dd>
            </dl>
            <?php endif; ?>
            <dl class="row">
                <dt class="tit">
                    <label>浏览量</label>
                </dt>
                <dd class="opt">    
                    <input type="text" value="<?php echo mt_rand(100, 300); ?>" name="click" id="click" class="input-txt">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>阅读权限</label>
                </dt>
                <dd class="opt">
                    <select name="arcrank" id="arcrank">
                        <?php if(is_array($arcrank_list) || $arcrank_list instanceof \think\Collection || $arcrank_list instanceof \think\Paginator): $i = 0; $__LIST__ = $arcrank_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo['rank']; ?>"><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>    
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="articleForm">发布时间</label>
                </dt>
                <dd class="opt">
                    <input type="text" class="input-txt" id="add_time" name="add_time" value="<?php echo date('Y-m-d H:i:s') ?>">        
                    <span class="add-on input-group-addon">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    </span> 
                    <span class="err"></span>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="tempview">文档模板</label>
                </dt>
                <dd class="opt">
                    <select name="tempview" id="tempview">
                        <?php if(is_array($templateList) || $templateList instanceof \think\Collection || $templateList instanceof \think\Paginator): $i = 0; $__LIST__ = $templateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $vo; ?>" <?php if($vo == $tempview): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <input type="hidden" name="type_tempview" value="<?php echo $tempview; ?>" />
                    <span class="err"></span>
                </dd>
            </dl>
        </div>
        <!-- 其他参数 -->
        <div class="ncap-form-default">
            <div class="bot">
                <input type="hidden" name="gourl" value="<?php echo $gourl; ?>">
                <input type="hidden" name="channel" value="<?php echo \think\Request::instance()->param('channel'); ?>">
                <a href="JavaScript:void(0);" onclick="check_submit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div> 
    </form>
</div>
<script type="text/javascript">

    $(function () {
        $('#add_time').layDate();   
     
        //选项卡切换列表
        $('.tab-base').find('.tab').click(function(){
            $('.tab-base').find('.tab').each(function(){
                $(this).removeClass('current');
            });
            $(this).addClass('current');
            var tab_index = $(this).data('index');          
            $(".tab_div_1, .tab_div_2, .tab_div_3").hide();          
            $(".tab_div_"+tab_index).show();
        });

        $('input[name=is_jump]').click(function(){
            if ($(this).is(':checked')) {
                $('.dl_jump').show();
            } else {
                $('.dl_jump').hide();
            }
        });

        var dftypeid = <?php echo (isset($typeid) && ($typeid !== '')?$typeid:'0'); ?>;
        $('#typeid').change(function(){
            var current_channel = $(this).find('option:selected').data('current_channel');
            if (0 < $(this).val() && <?php echo $channeltype; ?> != current_channel) {
                showErrorMsg('请选择对应模型的栏目！');
                $(this).val(dftypeid);
            } else if (<?php echo $channeltype; ?> == current_channel) {
                layer.closeAll();
            }
        });
    });

    function set_author()
    {
        layer.prompt({
                title:'<font color="red">设置作者默认名称</font>'
            },
            function(val, index){
                var admin_id = '<?php echo \think\Session::get('admin_info.admin_id'); ?>';
                $.ajax({
                    url: "<?php echo url('Admin/ajax_setfield'); ?>",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {id_name:'admin_id',id_value:admin_id,field:'pen_name',value:val},
                    success: function(res){
                        if (res.code == 1) {
                            $('#author').val(val);
                            layer.msg(res.msg, {icon: 1, time:1000});
                        } else {
                            showErrorMsg(res.msg);
                            return false;
                        }
                    },
                    error: function(e){
                        showErrorMsg(ey_unknown_error);
                        return false;
                    }
                });
                layer.close(index);
            }
        );
    }

    function tags_list(obj)
    {
        var url = "<?php echo url('Tags/index'); ?>";
        //iframe窗
        layer.open({
            type: 2,
            title: 'TAG标签管理',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['80%', '80%'],
            content: url
        });
    }

    function system_thumb()
    {
        var url = "<?php echo url('System/thumb', ['tabase'=>-1]); ?>";
        //iframe窗
        var iframes = layer.open({
            type: 2,
            title: '缩略图配置',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            content: url
        });
        layer.full(iframes);
    }

    function DeleteFile(obj){
        $(obj).parent().parent().remove();
    }
    // 判断输入框是否为空
    function check_submit(){
        if($.trim($('input[name=title]').val()) == ''){
            showErrorMsg('标题不能为空！');
            $('input[name=title]').focus();
            return false;
        }
        if ($('#typeid').val() == 0) {
            showErrorMsg('请选择栏目…！');
            $('#typeid').focus();
            return false;
        }
        layer_loading('正在处理');
        $('#post_form').submit();
    }

    function img_call_back(fileurl_tmp)
    {
      $("#litpic_local").val(fileurl_tmp);
      $("#img_a").attr('href', fileurl_tmp);
      $("#img_i").attr('onmouseover', "layer_tips=layer.tips('<img src="+fileurl_tmp+" class=\\'layer_tips_img\\'>',this,{tips: [1, '#fff']});");
    }
    Date.prototype.Format = function (fmt) {
                    var o = {
                        "M+": this.getMonth() + 1, //月份 
                        "d+": this.getDate(), //日 
                        "H+": this.getHours(), //小时 
                        "m+": this.getMinutes(), //分 
                        "s+": this.getSeconds(), //秒 
                        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
                        "S": this.getMilliseconds() //毫秒 
                    };
                    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
                    for (var k in o)
                    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
                    return fmt;
                }
 // 文件上传JS
    layui.use('upload', function(){
        var server_url   = "<?php echo url('Ueditor/NewDownloadUploadFile',array('savepath'=>'soft')); ?>";
        var $ = layui.jquery,upload = layui.upload;

        // 多文件列表示例
        var demoListView = $('#demoList'),uploadListIns = upload.render({
            elem: '#buttonList',
            url: server_url,
            accept: 'file',
            multiple: true,
            auto: false,
            bindAction: '#buttonListAction',
            choose: function(obj){

                var files = obj.pushFile();
                var file = $(".layui-upload-file")[0].files[0];
   
                var uploadObj = new SegmentUpload();
            
                var tr = $(
                [
                    '<tr id="upload-'+ file.lastModified +'">',
                        '<td>'+ file.name +'</td>',
                        '<td>'+ (file.size/1024/1024).toFixed(1) +' MB</td>',
                        '<td class="progress'+ file.lastModified+'">等待上传</td>',
                        '<td>',
                            // '<span class="layui-btn layui-btn-xs demo-reload layui-hide">重传</span>',
                            '<span class="layui-btn layui-btn-xs layui-btn-danger demo-delete">移除</span>',
                        '</td>',
                    '</tr>'
                ].join(''));
            
                    // 移除
                    tr.find('.demo-delete').on('click', function(){
                        // 移除对应的文件
                        //delete files[index];
                        tr.remove();
                        // 清空 input file 值，以免移除后出现同名文件不可选
                        uploadListIns.config.elem.next()[0].value = '';
                        clearTimeout(t);
                    });
                    demoListView.append(tr);

                  // var fileDom = document.getElementById("file");
                  // fileDom.onchange = function(){
                    uploadObj.addFileAndSend(file);
                  // };
                  function SegmentUpload() {
                    const length = 1024*1024*5; // 文件包大小
                    const requestUrl = server_url;
                    const requestType = 'POST'; // 请求方式
                    const new_file_name = new Date().Format("yyyyMMddHHmmss")+Math.ceil(Math.random()*100);
                    var request = new XMLHttpRequest();
                    var start = 0; // 截取下标开始位置
                    var end = length; // 截取下标结束位置
                    var nowPackage=''; // 文件包
                    var nowPackageNum = 1; // 当前包数
                    var totalPackageNum = 0; // 总共包数
                    var file = null;
                    this.addFileAndSend = function(that){
                      file = that;
                      totalPackageNum = Math.ceil(file.size / length);
                      blob = cutFile();
                      sendFile(blob);
                      nowPackageNum += 1;
                    };
                    cutFile = function (){
                      nowPackage = file.slice(start, end);
                      start = end;
                      end = start + length;
                    };
                    sendFile = function (){
                      var formData = new FormData();
                      formData.append('file',nowPackage);
                      formData.append('blob_num',nowPackageNum);
                      formData.append('total_blob_num',totalPackageNum);
                      formData.append('new_file_name',new_file_name);
                      formData.append('file_name',file.name);
                      formData.append('type',file.type);
                        
                      request.open(requestType, requestUrl, false);
                      request.onreadystatechange = function (data) {

                        if(request.readyState == 4 && request.status == 200) {
                            var progress;
                            if(nowPackageNum == totalPackageNum){
                              progress = '上传成功';
                              var returnArr = JSON.parse(request.response );
                            if(returnArr['code'] == 1){
                                     var res = returnArr;
                                     var html = '';
                                        html += '<input type="hidden" name="fileupload[file_url][]" value="'+res.file_url+'">';
                                        html += '<input type="hidden" name="fileupload[file_mime][]" value="'+res.file_mime+'">';
                                        html += '<input type="hidden" name="fileupload[file_name][]" value="'+res.file_name+'">';
                                        html += '<input type="hidden" name="fileupload[file_ext][]" value="'+res.file_ext+'">';
                                        html += '<input type="hidden" name="fileupload[file_size][]" value="'+res.file_size+'">';
                                        html += '<input type="hidden" name="fileupload[uhash][]" value="'+res.uhash+'">';
                                        html += '<input type="hidden" name="fileupload[md5file][]" value="'+res.md5file+'">';

                                        var tr = demoListView.find('tr#upload-'+ file.lastModified),
                                        tds = tr.children();
                                        tds.eq(0).html(res.file_name);
                                        tds.eq(2).html('<span style="color: #5FB878;">'+res.msg+'</span>');
                                        tds.eq(3).html('<span class="layui-btn layui-btn-xs layui-btn-danger" onclick="DeleteFile(this);">移除</span>'+html);
                                        
                              }

                            }else{
                              progress = (Math.min(100,(nowPackageNum/totalPackageNum)* 100 )).toFixed(2) +'%';
                            }

                            $('.progress'+file.lastModified).text(progress);
                            
                        }
                           

                      };

                      t = setTimeout(function(){
                          if(start < file.size){
                            blob = cutFile(file);
                            sendFile(nowPackage,file);
                            nowPackageNum += 1;
                          }else{
                              //setTimeout(t);
                          }
                        },2000);
                      request.send(formData);

                    }
                  }

    
                 

                // 将每次选择的文件追加到文件队列
                // var files = this.files = obj.pushFile();
                // console.log(files);
               
                // // 读取本地文件
                // obj.preview(function(index, file, result){
                //     var tr = $(
                //     [
                //         '<tr id="upload-'+ index +'">',
                //             '<td>'+ file.name +'</td>',
                //             '<td>'+ (file.size/1024).toFixed(1) +' KB</td>',
                //             '<td>等待上传</td>',
                //             '<td>',
                //                 // '<span class="layui-btn layui-btn-xs demo-reload layui-hide">重传</span>',
                //                 '<span class="layui-btn layui-btn-xs layui-btn-danger demo-delete">移除</span>',
                //             '</td>',
                //         '</tr>'
                //     ].join(''));
                
                //     // 单个重传
                //     tr.find('.demo-reload').on('click', function(){
                //         obj.upload(index, file);
                //     });
                    
                //     // 移除
                //     tr.find('.demo-delete').on('click', function(){
                //         // 移除对应的文件
                //         delete files[index];
                //         tr.remove();
                //         // 清空 input file 值，以免移除后出现同名文件不可选
                //         uploadListIns.config.elem.next()[0].value = '';
                //     });
                //     demoListView.append(tr);
                // });
            },
            done: function(res, index, upload){
                if(res.code == 0){
                    // 上传成功
                    // 上传成功
                    var html = '';
                    html += '<input type="hidden" name="fileupload[file_url][]" value="'+res.file_url+'">';
                    html += '<input type="hidden" name="fileupload[file_mime][]" value="'+res.file_mime+'">';
                    html += '<input type="hidden" name="fileupload[file_name][]" value="'+res.file_name+'">';
                    html += '<input type="hidden" name="fileupload[file_ext][]" value="'+res.file_ext+'">';
                    html += '<input type="hidden" name="fileupload[file_size][]" value="'+res.file_size+'">';
                    html += '<input type="hidden" name="fileupload[uhash][]" value="'+res.uhash+'">';
                    html += '<input type="hidden" name="fileupload[md5file][]" value="'+res.md5file+'">';

                    var tr = demoListView.find('tr#upload-'+ index),
                    tds = tr.children();
                    tds.eq(0).html(res.file_name);
                    tds.eq(2).html('<span style="color: #5FB878;">'+res.msg+'</span>');
                    tds.eq(3).html('<span class="layui-btn layui-btn-xs layui-btn-danger" onclick="DeleteFile(this);">移除</span>'+html);

                    //清空操作
                    return delete this.files[index];// 移除文件队列已经上传成功的文件
                }
                this.error(res, index, upload);
            },
            error: function(res, index, upload){
                var tr = demoListView.find('tr#upload-'+ index),
                tds = tr.children();
                tds.eq(2).html('<span style="color: #FF5722;">'+res.msg+'</span>');
            }
        });
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