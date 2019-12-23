<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"./application/admin/template/channeltype\edit.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <a class="back" href="<?php echo url('Channeltype/index'); ?>" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>模型管理</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?php echo url('Channeltype/index'); ?>" class="tab <?php if(\think\Request::instance()->controller() == 'Channeltype'): ?>current<?php endif; ?>"><span>编辑模型</span></a></li>
                <?php if(!in_array(($field['nid']), explode(',',"guestbook"))): ?>
                <li><a href="<?php echo url('Field/channel_index', array('channel_id'=>$field['id'])); ?>" class="tab <?php if(\think\Request::instance()->controller() == 'Field'): ?>current<?php endif; ?>"><span>内容字段</span></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <form class="form-horizontal" id="post_form" action="<?php echo url('Channeltype/edit'); ?>" method="post">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>模型名称</label>
                </dt>
                <dd class="opt">
                    <?php if($field['ifsystem'] == '1'): ?>
                    <?php echo (isset($field['title']) && ($field['title'] !== '')?$field['title']:''); else: ?>
                    <input type="text" name="title" value="<?php echo (isset($field['title']) && ($field['title'] !== '')?$field['title']:''); ?>" id="title" class="input-txt">
                    <?php endif; ?>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="nid">模型标识</label>
                </dt>
                <dd class="opt">
                    <?php echo $field['nid']; ?>
                    <input type="hidden" name="nid" value="<?php echo (isset($field['nid']) && ($field['nid'] !== '')?$field['nid']:''); ?>">
                    <span class="err"></span>
                    <p class="">与文档的模板相关连，建议由小写字母、数字组成，因为部份Unix系统无法识别中文文件。<br/>列表模板是：lists_模型标识.htm<br/>文档模板是：view_模型标识.htm</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label>文档标题重复</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="is_repeat_title1" class="cb-enable <?php if(!isset($field['is_repeat_title']) || $field['is_repeat_title'] == 1): ?>selected<?php endif; ?>">允许</label>
                        <label for="is_repeat_title0" class="cb-disable <?php if(isset($field['is_repeat_title']) && $field['is_repeat_title'] == 0): ?>selected<?php endif; ?>">不允许</label>
                        <input id="is_repeat_title1" name="is_repeat_title" value="1" type="radio" <?php if(!isset($field['is_repeat_title']) || $field['is_repeat_title'] == 1): ?> checked="checked"<?php endif; ?>>
                        <input id="is_repeat_title0" name="is_repeat_title" value="0" type="radio" <?php if(isset($field['is_repeat_title']) && $field['is_repeat_title'] == 0): ?> checked="checked"<?php endif; ?>>
                    </div>
                    <p class="notic">新增/编辑文档时，是否允许标题的重复</p>
                </dd>
            </dl>
            <?php if($field['nid'] == 'article'): if($IsOpenRelease == '1'): ?>
                    <dl class="row">
                        <dt class="tit">
                            <label>开启会员投稿</label>
                        </dt>
                        <dd class="opt">
                            <div class="onoff">
                                <label for="is_release1" class="cb-enable <?php if(!isset($field['is_release']) || $field['is_release'] == 1): ?>selected<?php endif; ?>">是</label>
                                <label for="is_release0" class="cb-disable <?php if(isset($field['is_release']) && $field['is_release'] == 0): ?>selected<?php endif; ?>">否</label>
                                <input id="is_release1" name="is_release" value="1" type="radio" <?php if(!isset($field['is_release']) || $field['is_release'] == 1): ?> checked="checked"<?php endif; ?>>
                                <input id="is_release0" name="is_release" value="0" type="radio" <?php if(isset($field['is_release']) && $field['is_release'] == 0): ?> checked="checked"<?php endif; ?>>
                            </div>
                            <p class="notic">开启则在会员投稿中有发布入口</p>
                        </dd>
                    </dl>

                    <dl class="row">
                        <dt class="tit">
                            <label>开启投稿缩略图</label>
                        </dt>
                        <dd class="opt">
                            <div class="onoff">
                                <label for="is_litpic_users_release1" class="cb-enable <?php if(!isset($field['is_litpic_users_release']) || $field['is_litpic_users_release'] == 1): ?>selected<?php endif; ?>">是</label>
                                <label for="is_litpic_users_release0" class="cb-disable <?php if(isset($field['is_litpic_users_release']) && $field['is_litpic_users_release'] == 0): ?>selected<?php endif; ?>">否</label>
                                <input id="is_litpic_users_release1" name="is_litpic_users_release" value="1" type="radio" <?php if(!isset($field['is_litpic_users_release']) || $field['is_litpic_users_release'] == 1): ?> checked="checked"<?php endif; ?>>
                                <input id="is_litpic_users_release0" name="is_litpic_users_release" value="0" type="radio" <?php if(isset($field['is_litpic_users_release']) && $field['is_litpic_users_release'] == 0): ?> checked="checked"<?php endif; ?>>
                            </div>
                            <p class="notic">会员投稿时，是否允许填写缩略图选项</p>
                        </dd>
                    </dl>
                <?php endif; endif; ?>
            <div class="bot">
                <input type="hidden" name="id" value="<?php echo $field['id']; ?>">
                <a href="JavaScript:void(0);" onclick="checkForm();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    // 判断输入框是否为空
    function checkForm(){
        <?php if($field['ifsystem'] != '1'): ?>
        if($.trim($('input[name=title]').val()) == ''){
            showErrorMsg('模型名称不能为空！');
            $('input[name=title]').focus();
            return false;
        }
        <?php endif; ?>
        layer_loading('正在处理');
        $('#post_form').submit();
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