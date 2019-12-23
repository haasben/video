<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"D:\WWW\video/application/mobile\view\m_course_center\index.htm";i:1574303196;s:47:"D:\WWW\video\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>课程中心</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
		
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>课程中心</h3>
			</header>
			<div class="container">
				<div class="category">
					<ul>
						<?php if(is_array($course_cate) || $course_cate instanceof \think\Collection || $course_cate instanceof \think\Paginator): $i = 0; $__LIST__ = $course_cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="/mcategory?id=<?php echo $v['id']; ?>"><?php echo $v['typename']; ?></a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
				
				<!-- 列表 -->
				<div class="contents">
					<!-- 热门课程 -->
					<div class="cont">
						<h4>热门课程</h4>
						<ul>
							<?php if(is_array($hotCourse) || $hotCourse instanceof \think\Collection || $hotCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $hotCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$h): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="/mcourse_show?id=<?php echo $h['aid']; ?>" class="see" role="button" data-id="6972">
									<img class="lazy" src="<?php echo $h['litpic']; ?>" height="100" width="" class="img-responsive" alt="" />
									<h5><?php echo $h['title']; ?></h5>
									<div class="info">
										<p><span><?php echo $h['click']; ?></span>人在学</p>
										<p>更新至<span><?php echo $h['total']; ?></span>课</p>
									</div>
								</a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<!-- 热门课程 -->
					
					<!-- 免费课程 -->
					<div class="cont">
						<h4>免费课程</h4>
						<ul>
							<?php if(is_array($FreeCourse) || $FreeCourse instanceof \think\Collection || $FreeCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $FreeCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="/mcourse_show?id=<?php echo $f['aid']; ?>" class="see" role="button" data-id="6972">
									<img class="lazy" src="<?php echo $f['litpic']; ?>" height="100" class="img-responsive" alt="" />
									<h5><?php echo $f['title']; ?></h5>
									<div class="info">
										<p><span><?php echo $f['click']; ?></span>人在学</p>
										<p>更新至<span><?php echo $h['total']; ?></span>课</p>
									</div>
									
								</a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						
						<div class="more">
							<a href="/MFreeCourse?id=129">查看更多>></a>
						</div>
					</div>
					<!-- 免费课程 -->
					
				</div>
			</div>
			
			
			
			<!-- footer -->
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
	</body>
</html>
