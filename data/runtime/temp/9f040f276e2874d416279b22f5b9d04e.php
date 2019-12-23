<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\wwwroot\www.gkbplc.com/application/index\view\project_cases\details.htm";i:1573699472;s:59:"D:\wwwroot\www.gkbplc.com\application\index\view\search.htm";i:1573528354;s:62:"D:\wwwroot\www.gkbplc.com\application\index\view\haslogged.htm";i:1573701866;s:59:"D:\wwwroot\www.gkbplc.com\application\index\view\footer.htm";i:1573700791;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="renderer" content="webkit">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="PAGE-ENTER" content="RevealTrans(Duration=0,Transition=1)" />
		<title>案例详情</title>
		<meta name="keywords" content="项目,案例," />
		<meta name="description" content="" />
		<link rel="shortcut icon" href="<?php echo $web_config['web_icon']; ?>" />
		
		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/lesson/jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>
		<script src="/public/static/index//js/jquery-1.11.3.js"></script>
			<script type="text/javascript" src="/public/static/index/js/basic.js"></script>

		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
			<script src="/public/static/index/js/respond.js"></script>
		<![endif]-->

	</head>
	<body class="inner-box-body" id="article-box-id">
		<div class="wrap">
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
			
			<!-- 内容展示 begin-->
			<div class="container" id="content_show">
				<div class="inner">
					<div class="inner-box">
						<div class="show_content padding-large-bottom padding-large-top content_detail">
							<div class="show_body detail">
								<h1><?php echo $archives['title']; ?></h1>
								<div class=" padding-bottom qhd-title">
									<span><strong>来源：</strong><?php echo $archives['author']; ?></span>
									<span><strong>日期：</strong><?php echo date('Y-m-d H:i',$archives['add_time']); ?> </span> 
									<span><strong>浏览：</strong><?php echo $archives['click']; ?></span>
								</div>
								<div class="description"> 
									<?php echo htmlspecialchars_decode($archives['content']); ?>
			
									<!--分享begin-->
			
									<!--分享 end-->
									<ul class="pager padding-big-top padding-big-bottom">
										<li>上一篇：<?php if(empty($pre) || (($pre instanceof \think\Collection || $pre instanceof \think\Paginator ) && $pre->isEmpty())): ?>没有更多了<?php else: ?><a href='<?php echo url("index/projectCases/details"); ?>&id=<?php echo $pre['aid']; ?>'><?php echo $pre['title']; ?></a> <?php endif; ?>
										</li>
										<li>下一篇：<?php if(empty($next) || (($next instanceof \think\Collection || $next instanceof \think\Paginator ) && $next->isEmpty())): ?>没有更多了<?php else: ?><a href='<?php echo url("index/projectCases/details"); ?>&id=<?php echo $next['aid']; ?>'><?php echo $next['title']; ?></a><?php endif; ?>
										 </li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 内容展示 end-->
			<!--footer-->
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
