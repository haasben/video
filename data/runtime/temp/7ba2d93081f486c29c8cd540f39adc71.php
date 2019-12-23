<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:54:"D:\WWW\video/application/index\view\download\index.htm";i:1573778854;s:46:"D:\WWW\video\application\index\view\search.htm";i:1573528354;s:49:"D:\WWW\video\application\index\view\haslogged.htm";i:1573701866;s:46:"D:\WWW\video\application\index\view\footer.htm";i:1573700790;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>下载中心</title>
		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/lesson/jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>
		<script type="text/javascript" src="/public/static/index/js/jquery-1.10.2.min.js"></script>
	</head>
	<body>

		<div class="wrap" id="download">
			<div class="header">
				<div class="inner clearfix">
					<a class="logo mr20" href="./">
			<img src="<?php echo $web_config['web_logo']; ?>" width="250" height="66" alt="<?php echo $web_config['web_name']; ?>" />
		</a>

		<!--搜索框-->
		<div class="h-search mr20">

			<div class="search-input search-area">
				<input type="text" name="txtSearch" class="txt-search1" id="txtSearch" placeholder="请输入你要搜索的内容" value="<?php echo $keywords; ?>" />
			</div>
			<a href="javascript:;" class="search-btn searchsubmit btn-search1" id="btn-search1" onfocus="this.blur();">
				<i class="iconfont f20"></i>
			</a>
		</div>
		<script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
		<script type="text/javascript">
			$('#btn-search1').click(function(){

				var keywords = $('#txtSearch').val();
				$.post('/search',{keywords:keywords},function(data){

					if(data.code == '2'){
						layer.msg('请输入您要搜索的内容',{icon:5});
					}else{
						window.location.href = "/search?keywords="+keywords;
					}


				})


			})
		</script>
					<!--搜索框-->
<!-- 			<div style="clear: both;"></div> -->
										<div class="h-user">
						<!--已登录-->
						<?php if(empty($userData) || (($userData instanceof \think\Collection || $userData instanceof \think\Paginator ) && $userData->isEmpty())): ?>
								<!--未登录-->
							<div class="login-nav" id="header-n-login">
								<a class="mr10" href="/login?tab=1">用户登录</a> <a class="reg" href="/login?tab=2">用户注册</a>
							</div>
							<!--未登录-->
						<?php else: ?>
						
							<div class="user-center" id="header-logined" style="">
								<!--用户菜单-->
								<div class="user-wrap" data-role="collapsible">
									<div class="user-head">
										<a class="user-head-inner" href="/member">
											<img class="u-avatar" src="<?php echo $userData['head_pic']; ?>" width="32" height="32">
											<b class="u-truename"></b>
										</a>
										<i class="caret"></i>
									</div>
									<div class="user-cont">
										<div class="user-info">
											<span class="u-truename"></span>
										</div>
										<div class="user-menu">
											
											<a href="/member?tab=3" target="_blank">我的订单</a>
											<a href="/member?tab=4" target="_blank">账户设置</a> 
											<a href="/member?tab=2" target="_blank">学习记录</a> 
											<a href="/member?tab=2&c=2" target="_blank">我的收藏</a> 

											<a href="javascript:;" class="fw logout">退出</a>
										</div>
									</div>
								</div>
								<!--用户菜单-->
								<!--购物车-->
								<div class="user-shop" data-role="collapsible" style="margin-right:0">
									<a class="shop-btn u-grade2" href="#" style="padding:0 10px;"><?php echo $userData['level_name']; ?></a>
								</div>
							</div>
							<script type="text/javascript">
								//退出登录
								$('.logout').click(function(){
									$.post('<?php echo url("index/login/logout"); ?>',function(data){
											if(data.code == 1){
												window.location.href = '/';
											}
										})
									})

							</script>
						<?php endif; ?>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
			
			<div class="container">
				<div class="inner download">
					<h3>下载中心</h3>
					<div class="download_list">
						<ul>
							<?php if(is_array($downloadData) || $downloadData instanceof \think\Collection || $downloadData instanceof \think\Paginator): $i = 0; $__LIST__ = $downloadData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="javascript:" class="btnPay" data-id="<?php echo $v['aid']; ?>">
									<span><?php echo $v['title']; ?> &nbsp;&nbsp;<?php echo round($v['file_size']/1024,2); ?>M&nbsp;&nbsp;[<?php if($v['is_free'] == '是'): ?><span style="color:green">免费<?php else: ?><span style="color:red">收费<?php endif; ?>]</span></span>
								</a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>

						<div class="hot_download">
							<h4>推荐下载</h4>
							<ul>
								<?php if(is_array($tuijian) || $tuijian instanceof \think\Collection || $tuijian instanceof \think\Paginator): $i = 0; $__LIST__ = $tuijian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="javascript:" class="btnPay" data-id="<?php echo $v['aid']; ?>">
									<span><?php echo $v['title']; ?></span>
								</a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>


					</div>
					<!--pages分页-->
					<div class=" pages tr">
						<?php echo $downloadData->render(); ?>
					</div>
					<div class="" style="clear:both"></div>
				</div>
			</div>
			
			<script type="text/javascript">
				$('.btnPay').click(function(){
							
					// var data = $('#course_form').serialize();
					var aid = $(this).attr('data-id');
					$.post('<?php echo url("index/download/get_url"); ?>',{paycourse_id:aid,type:3},function(data){
							if(data.code == 2){
								window.location.href = '/login?tab=1';
							}else if(data.code == 1){
								var url = '/paycourse?orderid='+data.orderid+'&token='+data.token+'&callback='+data.url;

								window.location.href = url;
							}else if(data.code == 3){
								alert(data.msg);
							}else if(data.code == 5){
								window.location.href = data.url;
							}
					})

						})


			</script>


			<!-- footer -->
			<div id="baseD">
				<!--这里是最下面的神色条-->
				<div id="baseDn3">
					<div>
						<span><?php echo $web_config['web_copyright']; ?> - <?php echo $web_config['web_recordnum']; ?></span>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
  let height = $(window).height()
  let minHeight = height - 185
  $(".container").css({
   "min-height":minHeight+"px",
   "margin-bottom":"24px"
  })
 </script>
