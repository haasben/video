<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"D:\WWW\video/application/mobile\view\member\bought_course.htm";i:1574389374;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>购买的课程</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap" id="study">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>购买的课程</h3>
			</header>
			<div class="container">
				<div class="recode">
					<ul>
						<?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<div class="kc_img">
								<a href="/mcourse_show?id=<?php echo $v['product_id']; ?>">
									<img src="<?php echo $v['litpic']; ?>" >
								</a>
							</div>
							<div class="kc_text">
								<div class="title"><?php echo $v['title']; ?></div>
								<div class="class_hour">
									<span>课程有效时长：365天</span>
									<span>总课时：<?php echo $v['hours']; ?>个</span>
								</div>
								<div class="box">
									<div class="price">
										<span class="jin">￥<?php echo $v['order_amount']; ?></span>
									</div>
								</div>
							</div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</div>
			
		</div>
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
