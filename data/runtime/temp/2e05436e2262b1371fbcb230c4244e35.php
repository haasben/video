<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:59:"D:\WWW\video/application/index\view\training_case\index.htm";i:1573701148;s:46:"D:\WWW\video\application\index\view\search.htm";i:1573528354;s:49:"D:\WWW\video\application\index\view\haslogged.htm";i:1573701866;s:51:"D:\WWW\video\application\index\view\course_cate.htm";i:1573105650;s:46:"D:\WWW\video\application\index\view\footer.htm";i:1573700790;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>培训案例-工控自动化视频课程中心</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="shortcut icon" href="<?php echo $web_config['web_icon']; ?>" />

		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>

		<script type="text/javascript" src="/public/static/index/js/jquery-1.10.2.min.js"></script>

		<link rel="stylesheet" type="text/css" href="/public/static/index/css/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="/public/static/index/js/jquery.fancybox.js"></script>

		<script type="text/javascript" src="/public/static/index/js/jquery.superslide.2.1.1.js"></script>
		<script type="text/javascript" src="/public/static/index/js/basic.js"></script>
		<script src="/public/static/index/js/pagesou_ajax.js" type="text/javascript"></script>
		<script src="/public/static/index/js/tools.v1.js" type="text/javascript"></script>

		<script src="/public/static/index/js/jquery.lazyload.js" type="text/javascript"></script>


		<style type="text/css">
			/* -------------------------------------------------
			 * pages 
			 * 
			*/
			.pages li {
				display: inline;
			}

			.pages .active a {
				border-color: #188EEE;
				background-color: #188EEE;
				color: #FFF;
			}
			
			.user-wrap .user-head {
				width: 98px;
				white-space: nowrap;
				text-overflow: ellipsis;
			}
			
			.user-wrap .user-head .caret {
				z-index: 1;
			}
			
			.user-wrap .user-head .user-head-inner {
				width: 100%;
				z-index: 0;
				border: 0;
				text-align: center;
			}
			
			.user-wrap .user-head .user-head-inner img {
				border-radius: 3px;
			}
			
			.h-user {
				float: right;
				width: 230px;
				margin-top: -70px;
				height: 70px;
			}
		</style>



	</head>

	<body>
		<div class="wrap">
			<!--header-->

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
					<div style="clear: both;"></div>
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

			<!-- 用户登录信息 -->
			<!--header-->
			<!--container-->
			<div class="container">
				<!--tabs-->
				<div class="inner">
	<div class="tabs1 mt20">
		<!-- page tab nav -->
		<ul class="tabs-nav" id="page-tabs-nav">

			<?php if(is_array($course_sorts) || $course_sorts instanceof \think\Collection || $course_sorts instanceof \think\Paginator): $i = 0; $__LIST__ = $course_sorts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cs): $mod = ($i % 2 );++$i;?>
			<li class="<?php echo $cs['dirname']; ?>">
				<a class="tabs-link" href="/<?php echo $cs['dirname']; ?>?id=<?php echo $cs['id']; ?>">
					<h3 class="rel"><?php echo $cs['typename']; ?></h3>

					<p><?php echo $cs['seo_title']; ?></p>
				</a>
			</li>

			<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<!-- page tab nav end-->

<script type="text/javascript">

	 $('.<?php echo $categroy; ?>').addClass('active');

</script>
						<!-- page tab nav end-->

						<div class="tabs-cont ">

						</div>
					</div>
				</div>
				<!--tabs-->

				<div class="inner mt20 oh" id="center">

					<!--课程列表-->
					<div class="inner oh">
						<ul class="listview13 clearfix" style="width:1220px;">
							<?php if(is_array($cases) || $cases instanceof \think\Collection || $cases instanceof \think\Paginator): $i = 0; $__LIST__ = $cases;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>
							<li>
								<div class="li-img">
									<a href="<?php echo url('index/trainingCase/details'); ?>&id=<?php echo $c['aid']; ?>" class="title" id="title" data-id="6431" target="_index">
										<img src="<?php echo $c['litpic']; ?>" width="263" height="150" alt="<?php echo $c['title']; ?>" class="lazy" />
									</a>
								</div>
								<p class="h40 mt5 lh20 f16"><a href="<?php echo url('index/trainingCase/details'); ?>&id=<?php echo $c['aid']; ?>"><?php echo $c['title']; ?></a></p>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<!--课程列表-->

					<!--pages分页-->
					<div class=" pages tr">
						<?php echo $cases->render(); ?>
					</div>
					<div class="" style="clear:both"></div>

					<!--pages-->
				</div>

				<!--课程推荐-->
				<div id="recommend-courses">
					
				</div>
				<!--课程推荐-->

			</div>
			<!--container-->

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

