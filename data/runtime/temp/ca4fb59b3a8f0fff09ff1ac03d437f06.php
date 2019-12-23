<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:45:"./application/admin/template/system\water.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:75:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\system\bar.htm";i:1571037616;s:78:"D:\phpStudy\PHPTutorial\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<body style="background-color: #FFF; overflow-y: scroll;min-width:auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<style>
    .span_1 {
        float: left;
        margin-left: 0px;
        height: 130px;
        line-height: 130px;
    }

    .span_1 ul {
        list-style: none;
        padding: 0px;
    }

    .span_1 ul li {
        border: 1px solid #CCC;
        height: 40px;
        padding: 0px 10px;
        margin-left: -1px;
        margin-top: -1px;
        line-height: 40px;
    }
    #mark_txt_color {
        /*margin:0;*/
        /*padding:0;*/
        border:solid 1px #ccc;
        width:70px;
        height:20px;
        border-right:40px solid green;
        /*line-height:20px;*/
    }
</style>
<script type="text/javascript" src="/public/plugins/colpick/js/colpick.js"></script>
<link href="/public/plugins/colpick/css/colpick.css" rel="stylesheet" type="text/css"/>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="min-width:auto;">
    <?php if(\think\Request::instance()->param('tabase') != '-1'): ?>
    <div class="fixed-bar">
        <div class="item-title">
            <div class="subject">
                <h3>基本信息</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <?php if(is_check_access(CONTROLLER_NAME.'@web') == '1'): ?>
                <li><a href="<?php echo url('System/web'); ?>" <?php if('web'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>网站设置</span></a></li>
                <?php endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@web2') == '1'): ?>
                <li><a href="<?php echo url('System/web2'); ?>" <?php if('web2'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>核心设置</span></a></li>
                <?php endif; endif; if(is_check_access(CONTROLLER_NAME.'@basic') == '1'): ?>
                <li><a href="<?php echo url('System/basic'); ?>" <?php if('basic'==ACTION_NAME): ?>class="current"<?php endif; ?>><span>附件设置</span></a></li>
                <?php endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@water') == '1'): ?>
                <li><a href="<?php echo url('System/water'); ?>" <?php if(in_array(ACTION_NAME, ['water','thumb'])): ?>class="current"<?php endif; ?>><span>图片水印</span></a></li>
                <?php endif; endif; if($main_lang == $admin_lang): if(is_check_access(CONTROLLER_NAME.'@smtp') == '1'): ?>
                <li><a href="<?php echo url('System/smtp'); ?>" <?php if(preg_match('/^smtp/i', ACTION_NAME)): ?>class="current"<?php endif; ?>><span>接口配置</span></a></li>
                <?php endif; endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
    <div class="flexigrid">
        <div class="mDiv">
            <div class="ftitle">
                <h3>水印配置</h3>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn current" value="缩略图配置" onclick="window.location.href='<?php echo url("System/thumb", ['tabase'=>\think\Request::instance()->param('tabase')]); ?>';">
                </div>
            </div>
            <div class="sDiv">
                <div class="sDiv2 addartbtn fl" style="margin-right: 6px;">
                    <input type="button" class="btn" value="水印配置" onclick="window.location.href='<?php echo url("System/water", ['tabase'=>\think\Request::instance()->param('tabase')]); ?>';">
                </div>
            </div>
        </div>
        <form method="post" id="handlepost" action="<?php echo url('System/water'); ?>">
            <div class="ncap-form-default">
                <dl class="row">
                    <dt class="tit">水印功能</dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_mark1" class="cb-enable <?php if(isset($config['is_mark']) && $config['is_mark'] == 1): ?>selected<?php endif; ?>" >开启</label>
                            <label for="is_mark0" class="cb-disable <?php if(!isset($config['is_mark']) || $config['is_mark'] == 0): ?>selected<?php endif; ?>" >关闭</label>
                            <input id="is_mark1" name="is_mark" value="1" <?php if(isset($config['is_mark']) && $config['is_mark'] == 1): ?>checked<?php endif; ?> type="radio">
                            <input id="is_mark0" name="is_mark" value="0" <?php if(!isset($config['is_mark']) || $config['is_mark'] == 0): ?>checked<?php endif; ?> type="radio">
                        </div>
                        <p class="notic">全站图片添加水印</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">缩略图水印</dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="is_thumb_mark1" class="cb-enable <?php if(isset($config['is_thumb_mark']) && $config['is_thumb_mark'] == 1): ?>selected<?php endif; ?>" >开启</label>
                            <label for="is_thumb_mark0" class="cb-disable <?php if(!isset($config['is_thumb_mark']) || $config['is_thumb_mark'] == 0): ?>selected<?php endif; ?>" >关闭</label>
                            <input id="is_thumb_mark1" name="is_thumb_mark" value="1" <?php if(isset($config['is_thumb_mark']) && $config['is_thumb_mark'] == 1): ?>checked<?php endif; ?> type="radio">
                            <input id="is_thumb_mark0" name="is_thumb_mark" value="0" <?php if(!isset($config['is_thumb_mark']) || $config['is_thumb_mark'] == 0): ?>checked<?php endif; ?> type="radio">
                        </div>
                        <p class="notic">开启之后，满足水印条件的缩略图会自动打上水印</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">水印类型</dt>
                    <dd class="opt">
                        <div class="onoff">
                            <label for="mark_type1" class="cb-enable <?php if(isset($config['mark_type']) && $config['mark_type'] == 'text'): ?>selected<?php endif; ?>" >文字</label>
                            <label for="mark_type0" class="cb-disable <?php if(isset($config['mark_type']) && $config['mark_type'] == 'img'): ?>selected<?php endif; ?>" >图片</label>
                            <input id="mark_type1" onclick="setwarter('text')" name="mark_type" value="text" <?php if(isset($config['mark_type']) && $config['mark_type'] == 'text'): ?>checked<?php endif; ?> type="radio">
                            <input id="mark_type0" onclick="setwarter('img')" name="mark_type"  value="img" <?php if(isset($config['mark_type']) && $config['mark_type'] == 'img'): ?>checked<?php endif; ?> type="radio">
                        </div>
                        <p class="notic"></p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">水印条件</dt>
                    <dd class="opt">
                        <ul class="nofloat">
                            <li>
                                <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" value="<?php echo (isset($config['mark_width']) && ($config['mark_width'] !== '')?$config['mark_width']:''); ?>" name="mark_width" id="mark_width" checked="checked" type="text">
                                <span class="err">只能输入整数</span>
                                <label for="mark_width">图片宽度 单位像素(px)</label>
                            </li>
                            <li>
                                <input onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" onpaste="this.value=this.value.replace(/[^\d]/g,'')" pattern="^\d{1,}$" value="<?php echo (isset($config['mark_height']) && ($config['mark_height'] !== '')?$config['mark_height']:''); ?>" name="mark_height" id="mark_height" checked="checked" type="text">
                                <label for="mark_height">图片高度 单位像素(px)</label>
                            </li>
                        </ul>
                        <p class="">提示：图片宽度和高度至少要达到以上像素才能添加水印</p>
                    </dd>
                </dl>
                <dl class="row texttr" style="display:none;">
                    <dt class="tit">
                        <label for="mark_txt">水印文字</label>
                    </dt>
                    <dd class="opt">
                        <input name="mark_txt" id="mark_txt" value="<?php echo (isset($config['mark_txt']) && ($config['mark_txt'] !== '')?$config['mark_txt']:''); ?>" class="input-txt" type="text" />
                        <p class="notic"></p>
                    </dd>
                </dl>
                <dl class="row imgtr">
                    <dt class="tit">
                        <label for="mark_img">水印图片</label>
                    </dt>
                    <dd class="opt">
                        <div class="input-file-show div_mark_img_local" <?php if(isset($config['mark_img_is_remote']) AND $config['mark_img_is_remote'] == 1): ?>style="display: none;"<?php endif; ?>>
                            <span class="show">
                                <a id="img_a" class="nyroModal" rel="gal" href="<?php echo (isset($config['mark_img_local']) && ($config['mark_img_local'] !== '')?$config['mark_img_local']:'javascript:void(0);'); ?>" target="_blank">
                                    <i id="img_i" class="fa fa-picture-o" <?php if(!(empty($config['mark_img_local']) || (($config['mark_img_local'] instanceof \think\Collection || $config['mark_img_local'] instanceof \think\Paginator ) && $config['mark_img_local']->isEmpty()))): ?>onmouseover="layer_tips=layer.tips('<img src=<?php echo (isset($config['mark_img_local']) && ($config['mark_img_local'] !== '')?$config['mark_img_local']:''); ?>>',this,{tips: [1, '#fff']});"<?php endif; ?> onmouseout="layer.close(layer_tips);"></i>
                                </a>
                            </span>
                            <span class="type-file-box">
                                <input type="text"  name="mark_img_local" id="mark_img_local" value="<?php echo (isset($config['mark_img_local']) && ($config['mark_img_local'] !== '')?$config['mark_img_local']:''); ?>" class="type-file-text">
                                <input type="button" name="button" id="button1" value="选择上传..." class="type-file-button">
                                <input class="type-file-file" onClick="GetUploadify(1,'','allimg','call_back');" size="30" hidefocus="true" nc_type="change_site_logo" title="点击前方预览图可查看大图，点击按钮选择文件并提交表单后上传生效">
                            </span>
                        </div>
                        <input type="text" id="mark_img_remote" name="mark_img_remote" value="<?php echo (isset($config['mark_img_remote']) && ($config['mark_img_remote'] !== '')?$config['mark_img_remote']:''); ?>" placeholder="http://" class="input-txt" <?php if(!isset($config['mark_img_is_remote']) OR empty($config['mark_img_is_remote'])): ?>style="display: none;"<?php endif; ?>>
                        &nbsp;
                        <label><input type="checkbox" name="mark_img_is_remote" id="mark_img_is_remote" value="1" <?php if(isset($config['mark_img_is_remote']) AND $config['mark_img_is_remote'] == 1): ?>checked="checked"<?php endif; ?> onClick="clickRemote(this, 'mark_img');">远程图片</label>
                        <span class="err"></span>
                        <p class="notic">最佳显示尺寸为240*60像素</p>
                    </dd>
                </dl>
                <dl class="row texttr" style="display:none;">
                    <dt class="tit">
                        <label for="mark_txt_size">字体大小</label>
                    </dt>
                    <dd class="opt">
                        <input name="mark_txt_size" id="mark_txt_size" value="<?php echo (isset($config['mark_txt_size']) && ($config['mark_txt_size'] !== '')?$config['mark_txt_size']:30); ?>" class="input-txt" type="text" />
                        <p class="notic"></p>
                    </dd>
                </dl>
                <dl class="row texttr" style="display:none;">
                    <dt class="tit">
                        <label for="mark_txt_color">文字颜色</label>
                    </dt>
                    <dd class="opt">
                        <input type="text" name="mark_txt_color" value="<?php echo (isset($config['mark_txt_color']) && ($config['mark_txt_color'] !== '')?$config['mark_txt_color']:'#000000'); ?>" id="mark_txt_color" style="border-color: <?php echo (isset($config['mark_txt_color']) && ($config['mark_txt_color'] !== '')?$config['mark_txt_color']:'#000000'); ?>;" />
                        <p class="notic"></p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="mark_degree">水印透明度</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^\d{1,}$" onblur="$('#mark_degree2').empty().html(this.value);" name="mark_degree" id="mark_degree" value="<?php echo (isset($config['mark_degree']) && ($config['mark_degree'] !== '')?$config['mark_degree']:''); ?>" class="input-txt" type="range" min="0" step="2" max="100">
                        <span class="err" id="mark_degree2"><?php echo (isset($config['mark_degree']) && ($config['mark_degree'] !== '')?$config['mark_degree']:''); ?></span>
                        <p class="notic">0代表完全透明，100代表不透明</p>
                    </dd>
                </dl>
                <dl class="row imgtr">
                    <dt class="tit">
                        <label for="mark_degree">JPEG 水印质量</label>
                    </dt>
                    <dd class="opt">
                        <input pattern="^\d{1,}$" onblur="$('#mark_quality2').empty().html(this.value);" name="mark_quality" id="mark_quality" value="<?php echo (isset($config['mark_quality']) && ($config['mark_quality'] !== '')?$config['mark_quality']:''); ?>" class="input-txt" type="range" min="0" step="2" max="100">
                        <span class="err" id="mark_quality2"><?php echo (isset($config['mark_quality']) && ($config['mark_quality'] !== '')?$config['mark_quality']:''); ?></span>
                        <p class="notic">水印质量请设置为0-100之间的数字,决定 jpg 格式图片的质量</p>
                    </dd>
                </dl>
                <dl class="row">
                    <dt class="tit">
                        <label for="mark_degree">水印位置</label>
                    </dt>
                    <dd class="opt">
                        <div style="height:124px; background:#fff">
                                <span class="span_1">
                                    <ul>
                                        <li><input type="radio" name="mark_sel" value="1"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '1'): ?>checked<?php endif; ?>
                                            >&nbsp;顶部居左
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="4"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '4'): ?>checked<?php endif; ?>
                                            >&nbsp;中部居左
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="7"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '7'): ?>checked<?php endif; ?>
                                            >&nbsp;底部居左
                                        </li>
                                    </ul>
                                </span>
                                <span class="span_1">
                                    <ul>
                                        <li><input type="radio" name="mark_sel" value="2"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '2'): ?>checked<?php endif; ?>
                                            >&nbsp;顶部居中
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="5"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '5'): ?>checked<?php endif; ?>
                                            >&nbsp;中部居中
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="8"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '8'): ?>checked<?php endif; ?>
                                            >&nbsp;底部居中
                                        </li>
                                    </ul>
                                </span>
                                <span class="span_1">
                                    <ul>
                                        <li><input type="radio" name="mark_sel" value="3"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '3'): ?>checked<?php endif; ?>
                                            >&nbsp;顶部居右
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="6"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '6'): ?>checked<?php endif; ?>
                                            >&nbsp;中部居右
                                        </li>
                                        <li><input type="radio" name="mark_sel" value="9"
                                            <?php if(isset($config['mark_sel']) && $config['mark_sel'] == '9'): ?>checked<?php endif; ?>
                                            >&nbsp;底部居右
                                        </li>
                                    </ul>
                                </span>
                            <div style="clear:both;"></div>
                        </div>
                    </dd>
                </dl>
                <div class="bot">
                    <input type="hidden" name="tabase" value="<?php echo \think\Request::instance()->param('tabase'); ?>">
                    <a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="adsubmit();">确认提交</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // 点击刷新数据
        $('.fa-refresh').click(function(){
            location.href = location.href;
        });
        
        var marktype = "<?php echo (isset($config['mark_type']) && ($config['mark_type'] !== '')?$config['mark_type']:''); ?>";
        setwarter(marktype);

        // 颜色选择
        $('#mark_txt_color').colpick({
            flat:false,
            layout:'rgbhex',
            submit:0,
            colorScheme:'light',
            color:$('#mark_txt_color').val(),
            onChange:function(hsb,hex,rgb,el,bySetColor) {
                $(el).css('border-color','#'+hex);
                // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                if(!bySetColor) $(el).val('#'+hex);
            }
        }).keyup(function(){
            $(this).colpickSetColor('#'+this.value);
        });
    });

    function adsubmit(){
        layer_loading('正在处理');
        $('#handlepost').submit();
    }

    // 上传水印图片成功回调函数
    function call_back(fileurl_tmp){
        $("#mark_img_local").val(fileurl_tmp);
        $("#img_a").attr('href', fileurl_tmp);
        $("#img_i").attr('onmouseover', "layer_tips=layer.tips('<img src="+fileurl_tmp+">',this,{tips: [1, '#fff']});");
    }

    function setwarter(marktype){
        if(marktype == 'text'){
            $('.texttr').show();
            $('.imgtr').hide();
        }else{
            $('.texttr').hide();
            $('.imgtr').show();
        }
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