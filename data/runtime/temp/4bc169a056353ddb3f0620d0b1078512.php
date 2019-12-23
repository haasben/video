<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\wwwroot\www.gkbplc.com/application/mobile\view\training\index.htm";i:1574389863;s:60:"D:\wwwroot\www.gkbplc.com\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>培训案例</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>培训案例</h3>
			</header>
			<div class="container">
				<div class="cont">
					<ul style="padding-top: 0.1rem;">
						<?php if(is_array($cases) || $cases instanceof \think\Collection || $cases instanceof \think\Paginator): $i = 0; $__LIST__ = $cases;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="javascript:" class="see" role="button" data-id="<?php echo $v['aid']; ?>">
								<img class="lazy" src="<?php echo $v['litpic']; ?>" height="120" class="img-responsive" alt="<?php echo $v['title']; ?>" />
								<h5><?php echo $v['title']; ?></h5>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
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
