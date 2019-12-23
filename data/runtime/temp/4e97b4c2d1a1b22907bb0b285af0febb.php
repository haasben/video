<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:79:"D:\phpStudy\PHPTutorial\WWW\video/application/index\view\free_course\search.htm";i:1573699316;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\search.htm";i:1573528354;s:70:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\haslogged.htm";i:1573701866;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\footer.htm";i:1573700791;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>搜索</title>
		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/lesson/jquery.fancybox.css" media="screen" />

		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>

		<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div class="wrap" id="search">
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
			
			<div class="container">
				<div class="inner">
					<div class="searchList">
						<div class="keyword">
							<span>"<?php echo $keywords; ?>"</span>相关搜索内容
						</div>
						<ul class="lists">
						<?php if(is_array($searchData) || $searchData instanceof \think\Collection || $searchData instanceof \think\Paginator): $i = 0; $__LIST__ = $searchData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<div class="kc_img">
									<a href="/course_show?id=<?php echo $v['aid']; ?>">
										<img width="230" height="130" src="<?php echo $v['litpic']; ?>" >
									</a>
								</div>
								<div class="kc_text">
									<div class="title"><?php echo $v['title']; ?></div>
									<p><?php echo mb_substr(strip_tags(htmlspecialchars_decode($v['content'])),0,50); ?></p> <!-- 课程描述 -->
									<div class="class_hour">
										<span><?php echo $v['click']; ?>人在学</span>&nbsp;&nbsp;|&nbsp;&nbsp;
										<span>总课时：<?php echo $v['hours']; ?>课时</span>
									</div>
								</div>
							</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<!-- 分页 -->
						<div class="pages">
							<?php echo $searchData->render(); ?>
						</div>
					</div>
					<div class="hot">
						<h3>热门搜索</h3>
						<div class="hotList">
							<?php if(is_array($searchHotData) || $searchHotData instanceof \think\Collection || $searchHotData instanceof \think\Paginator): $i = 0; $__LIST__ = $searchHotData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?>
							<a href="/search?keywords=<?php echo $s['word']; ?>"><?php echo $s['word']; ?></a>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							
						</div>
					</div>
				</div>
			</div>


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

		
<!-- 		<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				let keyword = window.location.search.split('?')[1];
				let key = keyword.split('=')[1];
				$('.keyword span').text('"'+decodeURIComponent(key)+'"');
			})
		</script> -->
