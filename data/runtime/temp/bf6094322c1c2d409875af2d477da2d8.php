<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:51:"./application/admin/template/field\channel_edit.htm";i:1571037856;s:57:"D:\WWW\video\application\admin\template\public\layout.htm";i:1571037616;s:61:"D:\WWW\video\application\admin\template\field\channel_bar.htm";i:1571037616;s:57:"D:\WWW\video\application\admin\template\public\footer.htm";i:1571037616;}*/ ?>
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
            <?php if(in_array((ACTION_NAME), explode(',',"channel_index"))): ?>
            <a class="back" href="<?php echo url('Channeltype/index'); ?>" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <?php else: ?>
            <a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <?php endif; ?>
            <div class="subject">
                <h3>模型管理</h3>
                <h5></h5>
            </div>
            <ul class="tab-base nc-row">
                <li><a href="<?php echo url('Channeltype/edit', array('id'=>$channel_id)); ?>" class="tab"><span>编辑模型</span></a></li>
                <li><a href="<?php echo url('Field/channel_index', array('channel_id'=>$channel_id)); ?>" class="tab current"><span>内容字段</span></a></li>
            </ul>
        </div>
    </div>
    <form class="form-horizontal" id="post_form" action="<?php echo url('Field/channel_edit'); ?>" method="post">
        <!-- 常规选项 -->
        <div class="ncap-form-default tab_div_1">
            <dl class="row">
                <dt class="tit">
                    <label for="title"><em>*</em>字段标题</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($info['title']) && ($info['title'] !== '')?$info['title']:''); ?>" name="title" id="title" class="input-txt">
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="name"><em>*</em>字段名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>" name="name" id="name" placeholder="只允许字母、数字和下划线的任意组合" class="input-txt" onkeyup="this.value=this.value.replace(/[^0-9a-zA-Z_]/g,'');" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^0-9a-zA-Z_]/g,''));">
                    <p class="notic">保持唯一性，不可与主表、附加表重复</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="dtype"><em>*</em>字段类型</label>
                </dt>
                <dd class="opt">
                    <select name="dtype" id="dtype">
                    <?php if(is_array($fieldtype_list) || $fieldtype_list instanceof \think\Collection || $fieldtype_list instanceof \think\Paginator): $i = 0; $__LIST__ = $fieldtype_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['name']; ?>" data-ifoption="<?php echo (isset($vo['ifoption']) && ($vo['ifoption'] !== '')?$vo['ifoption']:0); ?>" <?php if($info['dtype'] == $vo['name']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>

            <div id='region_div' style="display: none;">
                <dl class="row">
                    <dt class="tit">
                        <label for="region"><em>*</em>区域选择</label>
                    </dt>
                    <dd class="opt">
                        <select id="province" onchange="GetRegionData(this,'province');">
                            <option value="-1">请选择</option>
                            <?php if(is_array($Province) || $Province instanceof \think\Collection || $Province instanceof \think\Paginator): $i = 0; $__LIST__ = $Province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$P_V): $mod = ($i % 2 );++$i;?>
                                <option <?php if($P_V['id'] == $region['parent_id']): ?> selected <?php endif; ?> value="<?php echo $P_V['id']; ?>"><?php echo $P_V['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>

                        <span id='CityId'>
                            <select id="city" onchange="GetRegionData(this,'city');">
                                <option value="<?php echo $region['parent_id']; ?>">请选择</option>
                                <?php if(is_array($City) || $City instanceof \think\Collection || $City instanceof \think\Paginator): $i = 0; $__LIST__ = $City;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$C_V): $mod = ($i % 2 );++$i;?>
                                    <option <?php if($C_V['id'] == $region['region_id']): ?> selected <?php endif; ?> value="<?php echo $C_V['id']; ?>"><?php echo $C_V['name']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>    
                        </span>

                        <span class="err"></span>
                        <p class="notic"></p>
                    </dd>
                    <input type="hidden" id="GetRegionDataUrl" value="<?php echo url('Field/get_region_data'); ?>">
                    <input type="hidden" name="region_data[region_id]" id="RegionId" value="<?php echo $region['region_id']; ?>">
                </dl>

                <dl class="row">
                    <dt class="tit">
                        <label><em>*</em>默认值</label>
                    </dt>
                    <dd class="opt">
                        <textarea rows="5" cols="60" name="region_data[region_names]" id="region_names" readonly='readonly' placeholder="这里会自动区域选择之后的下级区域列表" style="height:110px; background-color: #f5f5f5;"><?php echo $region['region_names']; ?></textarea>
                        <span class="err"></span>
                        <p class="notic">这里会自动区域选择之后的下级区域列表</p>
                    </dd>
                    <input type="hidden" name="region_data[region_ids]" id='region_ids' value='<?php echo $region['region_ids']; ?>' style="width: 100%;">
                </dl>
            </div>

            <dl class="row" id="dl_dfvalue">
                <dt class="tit">
                    <label id="label_dfvalue">默认值</label>
                </dt>
                <dd class="opt">
                    <textarea rows="5" cols="60" id="dfvalue" name="dfvalue" placeholder="如果定义字段类型为下拉框、单选项、多选项时，此处填写被选择的项目(用“,”分开，如“男,女,人妖”)。" style="height:60px;"><?php echo (isset($info['dfvalue']) && ($info['dfvalue'] !== '')?$info['dfvalue']:''); ?></textarea>
                    <span class="err"></span>
                    <p class="notic">如果定义字段类型为下拉框、单选项、多选项时，此处填写被选择的项目(用“,”分开，如“男,女,人妖”)。</p>
                </dd>
            </dl>
            <dl class="row" id="dl_dfvalue_unit">
                <dt class="tit">
                    <label for="dfvalue_unit">数值单位</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($info['dfvalue_unit']) && ($info['dfvalue_unit'] !== '')?$info['dfvalue_unit']:''); ?>" name="dfvalue_unit" id="dfvalue_unit" placeholder="比如：元、个、件等等" class="input-txt">
                    <p class="notic">比如：元、个、件等等</p>
                </dd>
            </dl>
            <dl class="row" id='IsRelease' <?php if($userConfig['users_open_release'] == '0'): ?> style="display: none;" <?php endif; ?>>
                <dt class="tit">
                    <label>应用于投稿</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="IsRelease_1" class="cb-enable <?php if($info['is_release'] == 1): ?>selected<?php endif; ?>">是</label>
                        <input id="IsRelease_1" name="is_release" value="1" type="radio" <?php if($info['is_release'] == 1): ?>checked="checked"<?php endif; ?>>

                        <label for="IsRelease_0" class="cb-disable <?php if(!isset($info['is_release']) || empty($info['is_release'])): ?>selected<?php endif; ?>">否</label>
                        <input id="IsRelease_0" name="is_release" value="0" type="radio" <?php if(!isset($info['is_release']) || empty($info['is_release'])): ?>checked="checked"<?php endif; ?>>
                    </div>
                    &nbsp;
                    <span class="err"></span>
                    <p class="notic">是否应用于会员投稿中</p>
                </dd>
            </dl>
            <dl class="row" id='IsScreening' style="display: none;">
                <dt class="tit">
                    <label>应用于筛选</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="IsScreening_1" class="cb-enable <?php if($info['is_screening'] == 1): ?>selected<?php endif; ?>">是</label>
                        <input id="IsScreening_1" name="is_screening" value="1" type="radio" <?php if($info['is_screening'] == 1): ?>checked="checked"<?php endif; ?>>

                        <label for="IsScreening_0" class="cb-disable <?php if(!isset($info['is_screening']) || empty($info['is_screening'])): ?>selected<?php endif; ?>">否</label>
                        <input id="IsScreening_0" name="is_screening" value="0" type="radio" <?php if(!isset($info['is_screening']) || empty($info['is_screening'])): ?>checked="checked"<?php endif; ?>>
                    </div>
                    &nbsp;
                    <span class="err"></span>
                    <p class="notic">是否应用于列表的条件筛选中</p>
                    <a id="call_tags_help" href="https://www.eyoucms.com/plus/view.php?aid=7881" target="_blank" class="<?php if(!isset($info['is_screening']) || empty($info['is_screening'])): ?>none<?php endif; ?>">查看标签调用</a>
                </dd>
            </dl>
            <!-- <dl class="row" id='IsSelect' style="display: none;">
                <dt class="tit">
                    <label>筛选是否多选</label>
                </dt>
                <dd class="opt">
                    <div class="onoff">
                        <label for="IsMultiSelect_1" class="cb-enable <?php if($info['IsMultiSelect'] == 1): ?>selected<?php endif; ?>">是</label>
                        <input id="IsMultiSelect_1" name="is_multi_select" value="1" type="radio" <?php if($info['IsMultiSelect'] == 1): ?>checked="checked"<?php endif; ?>>

                        <label for="IsMultiSelect_0" class="cb-disable <?php if(!isset($info['IsMultiSelect']) || empty($info['IsMultiSelect'])): ?>selected<?php endif; ?>">否</label>
                        <input id="IsMultiSelect_0" name="is_multi_select" value="0" type="radio" <?php if(!isset($info['IsMultiSelect']) || empty($info['IsMultiSelect'])): ?>checked="checked"<?php endif; ?>>
                    </div>
                    <span class="err"></span>
                    <p class="notic">选择是则在筛选中可多选，否则只能单选</p>
                </dd>
            </dl> -->
            <dl class="row">
                <dt class="tit">
                    <label>提示文字</label>
                </dt>
                <dd class="opt">          
                    <textarea rows="5" cols="60" id="remark" name="remark" placeholder="问号提示文字" style="height:60px;"><?php echo (isset($info['remark']) && ($info['remark'] !== '')?$info['remark']:''); ?></textarea>
                    <span class="err"></span>
                    <p class="notic">问号提示文字</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="title" id="select_title">指定栏目</label>
                </dt>
                <dd class="opt">
                    <select name="typeids[]" id="typeid" style="width: 300px;" size="15" multiple="true">
                        <option value="0" <?php if(in_array(0, $typeids) OR empty($typeids)): ?>selected="true"<?php endif; ?>>
                            —指定所有栏目—
                        </option>
                        <?php echo $select_html; ?>
                    </select>
                    <span class="err"></span>
                    <p class="red">(按 Ctrl 可以进行多选)</p>
                </dd>
            </dl>
<!--             <dl class="row">
                <dt class="tit">
                    <label for="sort_order">排序</label>
                </dt>
                <dd class="opt">
                    <input type="text" value="<?php echo (isset($info['sort_order']) && ($info['sort_order'] !== '')?$info['sort_order']:100); ?>" name="sort_order" id="sort_order" class="input-txt">
                    <p class="notic">越小越靠前</p>
                </dd>
            </dl> -->
        </div>
        <!-- 常规选项 -->
        <div class="ncap-form-default">
            <div class="bot">
                <input type="hidden" name="channel_id" id="channel_id" value="<?php echo (isset($info['channel_id']) && ($info['channel_id'] !== '')?$info['channel_id']:''); ?>">
                <input type="hidden" name="id" id="id" value="<?php echo (isset($info['id']) && ($info['id'] !== '')?$info['id']:''); ?>">
                <input type="hidden" name="old_name" id="old_name" value="<?php echo (isset($info['name']) && ($info['name'] !== '')?$info['name']:''); ?>">
                <a href="JavaScript:void(0);" onclick="check_submit();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a>
            </div>
        </div> 
    </form>
</div>
<script type="text/javascript">
    $(function(){
        // 判断是否隐藏第二级地区选择栏
        var parent_array = <?php echo $parent_array; ?>;
        if (parent_array) {
            var region_id = $('#RegionId').val();
            if (0 <= $.inArray(region_id, parent_array)) {
                $('#CityId').hide();
            }    
        }
        
        var screening_value = $('input:radio[name="is_screening"]:checked').val();
        $('#IsScreening_'+screening_value).click();

        dtype_change($('#dtype'));
        $('#dtype').change(function(){
            dtype_change(this);
        });

        function dtype_change(obj) {
            var dtype = $(obj).val();
            var ifoption = $(obj).find('option:selected').data('ifoption');
            if (0 <= $.inArray(dtype, ['datetime','switch','img','imgs','files'])) {
                $('#dl_dfvalue').hide();
                ClearAreaData();
            } else if ('region' == dtype) {
                $('#region_div').show();
                $('#dl_dfvalue').hide();
            } else {
                $('#dl_dfvalue').show();
                ClearAreaData();
            }
            if (1 == ifoption) {
                $('#label_dfvalue').html('<em>*</em>默认值');
            } else {
                $('#label_dfvalue').html('默认值');
            }
            if (0 <= $.inArray(dtype, ['region','checkbox','radio','select'])) {
                $('#IsScreening').show();
            } else {
                $('#IsScreening').hide();
            }
            if (0 <= $.inArray(dtype, ['text','int','float','decimal'])) {
                $('#dl_dfvalue_unit').show();
            } else {
                $('#dl_dfvalue_unit').hide();
            }
        }
    });

    // 当切换其他类型时清空所有关于区域选择的数据
    function ClearAreaData(){
        $('#region_div').hide();
        $('#RegionId').val('');
        $('#region_names').empty();
    }

    // 获取联动地址
    function GetRegionData(t,type){
        var parent_id = $(t).val();
        if(!parent_id){
            return false;
        }
        
        var url = $('#GetRegionDataUrl').val();
        $.ajax({
            url: url,
            data: {parent_id:parent_id},
            type:'post',
            dataType:'json',
            success:function(res){
                // 判断是否隐藏第二级地区选择栏
                if (0 <= $.inArray(parent_id, res.parent_array)) {
                    $('#CityId').hide();
                }else{
                    $('#CityId').show();
                }
                // 加载城市名称数据到textarea
                $('#region_names').empty().html(res.region_names);
                // 加载城市ID数据到input
                $('#region_ids').val(res.region_ids);
                // 加载ID到input
                $('#RegionId').val(parent_id);
                // 输出下一级栏目选项
                if ('province' == type) {
                    res = '<option value='+parent_id+'>请选择</option>'+ res.region_html;
                    $('#city').empty().html(res);
                }
            },
            error : function() {
                layer.closeAll();
                layer.alert(ey_unknown_error, {icon: 5});
            }
        });
    }

    $('#IsScreening_1').click(function(){
        $('#select_title').html('<em>*</em>指定栏目');
        $('#typeid').find('option:first').attr('disabled', true).css('display', 'none');
        $('#call_tags_help').show();
    });

    $('#IsScreening_0').click(function(){
        $('#select_title').html('指定栏目');
        $('#typeid').find('option:first').attr('disabled', false).css('display', '');
        $('#call_tags_help').hide();
    });

    function check_submit(){
        if($('input[name="title"]').val() == ''){
            showErrorMsg('字段标题不能为空！');
            $('input[name=title]').focus();
            return false;
        }
        var name = $('input[name="name"]').val();
        var ret1 = /^[_]+$/;
        var ret2 = /^[\w]+$/;
        var ret3 = /^[0-9]+$/;
        if (ret1.test(name) || !ret2.test(name)) {
            showErrorMsg('字段名称格式不正确！');
            $('input[name=name]').focus();
            return false;
        } else if (ret3.test(name)) {
            showErrorMsg('字段名称不能纯数字！');
            $('input[name=name]').focus();
            return false;
        }
        if($('#dtype').val() == ''){
            showErrorMsg('请选择字段类型！');
            $('input[name=dtype]').focus();
            return false;
        } else if ('region' == $('#dtype').val()){
            if (-1 == $('#RegionId').val()) {
                showErrorMsg('请选择区域范围！');
                $('#province').focus();
                return false;
            }
        } else {
            var ifoption = $('#dtype').find('option:selected').data('ifoption');
            if (1 == ifoption) {
                if ($.trim($('#dfvalue').val()) == '') {
                    showErrorMsg('默认值不能为空！');
                    $('#dfvalue').focus();
                    return false;
                }

                var tag = '|';
                if($('#dfvalue').val().indexOf(tag) != -1){
               　　  showErrorMsg('默认值不能输入 | 符号！');
                    $('#dfvalue').focus();
                    return false;
            　　}
            }
        }
        if (0 >= parseInt($('#typeid').find('option:selected').length)) {
            showErrorMsg('请选择指定栏目！');
            $('#typeid').focus();
            return false;
        }

        // 字段应用于筛选时，指定栏目必须指定一个或多个栏目
        if (1 == parseInt($('input:radio[name="is_screening"]:checked').val())) {
            if (0 == parseInt($('#typeid').find('option:selected').val())) {
                if (1 >= $('#typeid').val().length) {
                    showErrorMsg('字段应用于筛选时，栏目必须指定一个或多个！');
                    $('#typeid').focus();
                    return false;
                }
            }
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