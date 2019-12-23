<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\phpStudy\PHPTutorial\WWW\video/application/mobile\view\index\index.htm";i:1574405427;s:68:"D:\phpStudy\PHPTutorial\WWW\video\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!-- 
<div class="time-item" ><h1>支付金额：￥<b  class="uuid-code" id="content">165</b>
<a class="btn-copy" id="copyBT">复制金额</a></h1></div>
<script type="text/javascript">

</script> -->


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $web_config['web_name']; ?></title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/js/swiper/css/swiper.min.css"/>
		<style type="text/css">
			.swiper-container-horizontal>.swiper-pagination-bullets, .swiper-pagination-custom, .swiper-pagination-fraction{bottom: 0;}
		</style>

	</head>
	<body>
		<div class="wrap">
			<!-- 头部 -->
			<header>
				<div class="logo">
					<img src="<?php echo $web_config['web_attr_13']; ?>" >
				</div>
				<div class="menus">
					<a href="/msearch">
						<img src="/public/static/mobile/img/search.png" >
					</a>
					<img src="/public/static/mobile/img/menu.png" class="menu_bar">
				</div>
				<div class="nav">
					<ul>
						<li><a href="./">首页</a></li>
						<?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li><a href="<?php if($v['is_part'] == 0): ?>/M<?php echo $v['dirname']; ?>?id=<?php echo $v['id']; else: ?><?php echo $v['typelink']; endif; ?>"><?php echo $v['typename']; ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</header>
			
			<!-- 内容主体 -->
			<div class="container">
				<!-- banner -->
				<div class="banners">
					<div class="swiper-container" id="banner_list" style="z-index: 0;">
						<div class="swiper-wrapper">
							<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;if($b['pid'] == 7): ?>
							<div class="swiper-slide">
								<a href="<?php echo $b['links']; ?>" <?php if($b['target'] ==1): ?>target="_blank"<?php endif; ?>  style='display:block;height: 168px;' alt="">
									<img src="<?php echo $b['litpic']; ?>" style="height: 100%;">
								</a>
							</div>
							<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							
						</div>
						<!-- 如果需要分页器 -->
						<div class="swiper-pagination"></div>
					</div>
				</div>
				
				<!-- 学员心声 -->
				<div class="cont">
					<h3>学员心声</h3>
					<ul>
						<?php if(is_array($voice) || $voice instanceof \think\Collection || $voice instanceof \think\Paginator): $i = 0; $__LIST__ = $voice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="/mvoice?id=<?php echo $v['aid']; ?>" class="see" role="button" data-id="<?php echo $n['aid']; ?>">
								<img class="lazy" src="<?php echo $v['litpic']; ?>" class="img-responsive" alt="<?php echo $v['title']; ?>" height="100" />
								<h5><?php echo $v['title']; ?></h5>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</li>
					</ul>
				</div>
				
				<!-- 热门课程 -->
				<div class="cont">
					<h3>热门课程</h3>
					<ul>
						<?php if(is_array($hotCourse) || $hotCourse instanceof \think\Collection || $hotCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $hotCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="/mcourse_show?id=<?php echo $n['aid']; ?>" class="see" role="button" data-id="6972">
								<img class="lazy" src="<?php echo $n['litpic']; ?>" class="img-responsive" alt="" height="100" />
								<h5><?php echo $n['title']; ?></h5>
								<div class="info">
									<p><span><?php echo $n['click']; ?></span>人在学</p>
									<p>更新至<span><?php echo $n['total']; ?></span>课</p>
								</div>
								
							</a>
						</li>
					
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				
				<!-- 新课上架 -->
				<div class="cont">
					<h3>新课上架</h3>
					<ul>
						<?php if(is_array($newCourse) || $newCourse instanceof \think\Collection || $newCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $newCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="/mcourse_show?id=<?php echo $n['aid']; ?>" class="see" role="button" data-id="6972">
									<img class="lazy" width="223" height="127" src="<?php echo $n['litpic']; ?>" class="img-responsive" alt="" height="100" />
									<h5><?php echo $n['title']; ?></h5>
									<div class="info">
										<p><span><?php echo $n['click']; ?></span>人在学</p>
										<p>更新至<span><?php echo $n['total']; ?></span>课</p>
									</div>
									
								</a>
							</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				
				<div class="more">
					<a href="/MCourseCenter?id=169">查看更多 >></a>
				</div>
				
				
			</div>
			
			
			<!-- 底部 -->
						<footer>
				<ul>
					<li>
						<a href="./">
							<span class="icon">&#xe65a;</span>
							<span class="name">首页</span>
						</a>
					</li>
					<li>
						<a href="/MCourseCenter?id=169">
							<span class="icon">&#xe670;</span>
							<span class="name">课程中心</span>
						</a>
					</li>
					<li>
						<a href="<?php echo url('mobile/member/order_list'); ?>&t=0">
							<span class="icon">&#xe667;</span>
							<span class="name">订单中心</span>
						</a>
					</li>
					<li>
						<a href="/Mmember">
							<span class="icon">&#xe65d;</span>
							<span class="name">我的</span>
						</a>
					</li>
				</ul>
			</footer>
		</div>
		
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/swiper/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// 轮播图
			var mySwiper = new Swiper ('.swiper-container', {
				direction: 'horizontal', // 垂直切换选项
				loop: true, // 循环模式选项
				autoplay: true,
				
				// 如果需要分页器
				pagination: {
				  el: '.swiper-pagination',
				},
			})
				
		</script>
	</body>
</html>
