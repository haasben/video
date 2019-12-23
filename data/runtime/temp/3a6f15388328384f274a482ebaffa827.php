<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"./application/admin/template/filemanager\edit.htm";i:1571037856;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:59:"D:\WWW\video\application\admin\template\filemanager\bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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

<link rel="stylesheet" type="text/css" href="/public/static/admin/js/codemirror/codemirror.css">
<script type="text/javascript" src="/public/static/admin/js/codemirror/codemirror.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/xml/xml.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/javascript/javascript.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/css/css.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/php/php.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/clike/clike.js"></script>
<script type="text/javascript" src="/public/static/admin/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
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
    <form class="form-horizontal" id="post_form" action="<?php echo url('Filemanager/edit'); ?>" method="post">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit"><em>*</em>工作目录</dt>
                <dd class="opt">
                    <input type="text" name="activepath" value="<?php echo (isset($info['activepath']) && ($info['activepath'] !== '')?$info['activepath']:''); ?>" id="activepath" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">空白表示根目录，不允许用 “..” 形式的路径</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="url"><em>*</em>文件名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="filename" value="<?php echo (isset($info['filename']) && ($info['filename'] !== '')?$info['filename']:''); ?>" id="filename" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">不允许用 “..” 形式的路径</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="content">HTML代码</label>
                </dt>
                <dd class="opt">
                    <textarea name='content' id='content' style='width:99%;height:450px;background:#ffffff;'><?php echo (isset($info['content']) && ($info['content'] !== '')?$info['content']:''); ?></textarea>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="checkForm();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">

    var editor = CodeMirror.fromTextArea(document.getElementById('content'), {
        lineNumbers: true,
        lineWrapping: true,
        autofocus:true,  //自动聚焦
        mode: '<?php echo $info['extension']; ?>'
    });

    // 判断输入框是否为空
    function checkForm(){
        if($.trim($('input[name=activepath]').val()) == ''){
            showErrorMsg('工作目录不能为空！');
            $('input[name=activepath]').focus();
            return false;
        }
        if($.trim($('input[name=filename]').val()) == ''){
            showErrorMsg('文件名称不能为空！');
            $('input[name=filename]').focus();
            return false;
        }
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