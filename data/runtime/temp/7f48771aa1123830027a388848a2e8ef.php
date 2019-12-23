<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"./application/admin/template/uploadify\get_images_path.htm";i:1571037856;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <style type="text/css">
    #online{ padding-top: 0 !important; }
    #online li img{    vertical-align: middle;
    max-width: 100%;
    max-height: 106px;
    position: absolute;
    top: 50%;
    transform: translate(-50%,-50%);
    left: 50%;
    z-index: 1;
}
.saveBtn{
    display: inline-block;
    *display: inline;
    *zoom: 1;
    margin-left: 10px;
    padding: 0 18px;
    height: 40px;
    line-height: 40px;
    cursor: pointer;
    text-align: center;
    background: #fff;
    border: 1px solid #CFCFCF;
    border-radius: 3px;
    color: #565656;
    font-size: 14px;
}
.tabs li:hover {
    color: #fff;
    background: #00B7EE;
    border-color: transparent;
}
.nonepic{ text-align: center; color: #888; margin-top: 60px }
.heading{ clear: both; margin: 20px 10px; }
.heading h2 {
    color: #333333;
    font-size: 15px;
    margin: 0px;
    margin-bottom: 10px;
    font-weight: normal;
}
.heading hr {
    border: none;
    position: relative;
    margin: 0px;
    height: 1px;
    width: 100%;
    background: #e5e5e5;
}
.heading hr:before {
    height: 2px;
    background: #666666;
    content: "";
    position: absolute;
    top: -1px;
    width: 60px;
    left: 0px;
}
    </style>
    <link href="/public/plugins/Ueditor/dialogs/image/image.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="ui-layout-west area manage-area" id="manage_area">
        <div id="tree" class="ztree"></div>
    </div>
    <div class="ui-layout-center" id="online">
        <ul id="list" class="tabs">
            <?php if(!(empty($common_pic) || (($common_pic instanceof \think\Collection || $common_pic instanceof \think\Paginator ) && $common_pic->isEmpty()))): ?>
                <div class="heading">
                  <h2>智能推荐</h2>
                  <hr>
                </div>
                <?php if(is_array($common_pic) || $common_pic instanceof \think\Collection || $common_pic instanceof \think\Paginator): $i = 0; $__LIST__ = $common_pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?>
                    <li data-url="<?php echo $pic['pic_path']; ?>" onclick='hover_new(this);'>
                        <img src="<?php echo $pic['pic_path']; ?>" />
                        <span class="icon"></span>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
 
            <div class="heading">
                 <h2>目录图片</h2>
                 <hr>
            </div>
            <?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?>
                <div class='nonepic'>暂无图片可选择~</div>
            <?php else: if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li data-url="<?php echo $vo['path']; ?>" onclick='hover_new(this);'>
                        <img src="<?php echo $vo['path']; ?>"  />
                        <span class="icon"></span>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </ul>
    </div>
    <script type="text/javascript" src="/public/static/common/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js?v=<?php echo (isset($version) && ($version !== '')?$version:'1.2.9'); ?>"></script>

    <script type="text/javascript">
        // 记录选择的图片
        function hover_new(this_) {
            var num = '<?php echo $info['num']; ?>';
            if (1 == num) {
                // 当数量为1时，仅可选择一张图片
                $("#list li").each(function(){
                    $(this).removeClass("selected")
                });
            }
            // 给点击的图片加上Class
            $(this_).toggleClass("selected");
        }
    </script>
</body>
</html>