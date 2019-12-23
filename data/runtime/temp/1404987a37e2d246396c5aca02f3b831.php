<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:52:"./application/admin/template/download\course_add.htm";i:1575604442;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
<link rel="stylesheet" type="text/css" href="/public/plugins/webuploader/webuploader.css">
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
                <h3>新增视频</h3>
                <h5></h5>
            </div>

            <ul class="tab-base nc-row">
                <li><a href="javascript:void(0);" data-index='1' class="tab current"><span>常规选项</span></a></li>
<!--                 <li><a href="javascript:void(0);" data-index='2' class="tab"><span>SEO选项</span></a></li>
                <li><a href="javascript:void(0);" data-index='3' class="tab"><span>其他选项</span></a></li> -->
            </ul>
        </div>
    </div>
    <h1 style="color:red;font-size: 14px;padding:15px 0 15px 3%;">注：文件上传过程中切换到其他页面会导致文件上传失败</h1>
    <form class="form-horizontal" id="post_form" action="<?php echo url('Download/course_add'); ?>" method="post">
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
                        <option value="<?php echo $typeid; ?>"><?php echo $typename; ?></option>
                      <!--   <?php echo $arctype_html; ?> -->
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>所属章节</label>
                </dt>
                <dd class="opt">  
                    <select name="cha_id" id="cha_id">
                        <option value="0">请选择章节</option>
                        <?php if(is_array($chapter) || $chapter instanceof \think\Collection || $chapter instanceof \think\Paginator): $i = 0; $__LIST__ = $chapter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['title']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                      <!--   <?php echo $arctype_html; ?> -->
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>

             <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>观看限制</label>
                </dt>
                <dd class="opt">
                    <input type="radio" name="arcrank" value="0" checked="checked">收费
                    <input type="radio" name="arcrank" value="1">免费
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>


            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>收费金额</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="users_price" value="0.00" id="users_price" class="input-txt" maxlength="100">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>

            <input type="hidden" name="cou_id" value="<?php echo $id; ?>">


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





        </div>
        <!-- 常规信息 -->
        <!-- SEO参数 -->
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
        <!-- SEO参数 -->
        <!-- 其他参数 -->
        <div class="ncap-form-default tab_div_3" style="display:none;">
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
<!--             <dl class="row">
                <dt class="tit">
                    <label>排序号</label>
                </dt>
                <dd class="opt">    
                    <input type="text" value="100" name="sort_order" id="sort_order" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">越小越靠前</p>
                </dd>
            </dl> -->
        </div>
        <!-- 其他参数 -->
        <div class="ncap-form-default">
            <div class="bot">
                <input type="hidden" name="gourl" value="<?php echo $gourl; ?>">
                <a href="JavaScript:void(0);" onclick="check_submit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/public/plugins/webuploader/webuploader.min.js"></script>
<script type="text/javascript">
    var uploader_swf = '/public/plugins/webuploader/Uploader.swf';
    var server_url   = "<?php echo url('Ueditor/NewDownloadUploadFile',array('savepath'=>'soft')); ?>";
</script>
<script src="/public/static/admin/js/getting-started.js"></script>

<script type="text/javascript">
    // 远程/本地上传文件切换
    function ClickRemoteFile(obj)
    {   
        if ($(obj).is(':checked')) {
            $('#ClickRemoteFile').show();
            $('#TemplateSet').show();
        } else {
            $('#ClickRemoteFile').hide();
            $('#TemplateSet').hide();
        }
    }

    // 远程地址参数设置
    function TemplateSet(th){
        var url = $(th).attr('data-url');
        //iframe窗
        layer.open({
            type: 2,
            title: '参数设置',
            fixed: true, //不固定
            shadeClose: false,
            shade: 0.3,
            maxmin: true, //开启最大化最小化按钮
            area: ['40%', '60%'],
            content: url
        });
    }

    // 获取模板属性数据
    function GetTemplateAddr(num = 1){
        $.ajax({
            url: "<?php echo url('Download/get_template'); ?>",
            data: {num:num},
            type:'post',
            dataType:'json',
            success: function(res){
                // 拼装模板属性并追加
                AddTemplateAddr(num,res.data);
            },
        });
    }

    // 删除对应的文件及文件信息
    function DeleteFile(obj){
        $(obj).parent().parent().remove();
    }

    // 拼装模板属性并追加
    function AddTemplateAddr(num = 1,data = ''){
        // 获取指定div数量
        var SerialNum = $('#Template div').length;
        // 初始化数组
        var html_div = [];
        // 拼装html
        if (num > 1) {
            for (var i = 0; i < num; i++) {                            
                SerialNum++;
                html_div += 
                [
                    '<div class="template_div">'+
                        '远程地址'+SerialNum+'：<input type="text" name="remote_file[]" value="" placeholder="http://" style="width: 50%;"> '
                ];

                if (data) {
                    for (var j = 0; j < data.length; j++) {
                        html_div += 
                        [
                            '<span class="ey_'+data[j]['field_name']+'"> '+
                                '<span class="title_'+data[j]['field_name']+'"> '+data[j]['field_title']+'</span>：<input type="text" name="'+data[j]['field_name']+'[]" style="width: 7%;">'+
                            '</span>'
                        ];
                    }
                }
                
                html_div += 
                [
                    '</div>'
                ];
            }
        }else{
            SerialNum++;
            html_div += 
            [
                '<div class="template_div">'+
                    '远程地址'+SerialNum+'：<input type="text" name="remote_file[]" value="" placeholder="http://" style="width: 50%;">'
            ];
            
            if (data) {
                for (var j = 0; j < data.length; j++) {
                    html_div += 
                    [
                        '<span class="ey_'+data[j]['field_name']+'">'+
                            '<span class="title_'+data[j]['field_name']+'"> '+data[j]['field_title']+'</span>：<input type="text" name="'+data[j]['field_name']+'[]" style="width: 7%;">'+
                        '</span>'
                    ];
                }
            }

            html_div += 
            [
                '</div>'
            ];
        }

        // 追加html
        $('#Template').append(html_div);
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
                      formData.append('file_name',file.name);
                      formData.append('new_file_name',new_file_name);
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