<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\wwwroot\www.gkbplc.com/application/mobile\view\m_course_center\mcategory.htm";i:1574244827;s:60:"D:\wwwroot\www.gkbplc.com\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>PLC</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3><?php echo $cate_name['typename']; ?></h3>
			</header>
			
			<!-- 内容区 -->
			<div class="container">
				<?php if(!(empty($course_list) || (($course_list instanceof \think\Collection || $course_list instanceof \think\Paginator ) && $course_list->isEmpty()))): ?>
				<ul class="tabs">
					<li class="active"><a href="javascript:" data-id='0'>全部</a></li>
					<?php if(is_array($course_list) || $course_list instanceof \think\Collection || $course_list instanceof \think\Paginator): $k = 0; $__LIST__ = $course_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
					<li><a href="javascript:" data-id='<?php echo $v['id']; ?>'><?php echo $v['typename']; ?></a></li>

					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<?php endif; ?>
				<input type="hidden" name="" value="<?php echo $cate_name['id']; ?>" id="pid">
					<div class="content list_attr_0" data-id="2">

						<div class="cont">
							<ul>
								<?php if(is_array($archives) || $archives instanceof \think\Collection || $archives instanceof \think\Paginator): $i = 0; $__LIST__ = $archives;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
								<li>
									<a href="mcourse_show?id=<?php echo $v['aid']; ?>" class="see" role="button" data-id="<?php echo $v['aid']; ?>">
										<img class="lazy" src="<?php echo $v['litpic']; ?>" height="100" class="img-responsive" alt="" />
										<h5><?php echo $v['title']; ?></h5>
										<div class="info">
											<p><span><?php echo $v['videorating']; ?></span></p>
											<p><span><?php echo $v['click']; ?></span>人在学</p>
										</div>
									</a>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; ?>
								
							</ul>
							<div class="div_attr_0" style="text-align: center;font-size: 12px;display: none;">
								
							</div>
						</div>
					</div>
				<?php if(is_array($course_list) || $course_list instanceof \think\Collection || $course_list instanceof \think\Paginator): $k1 = 0; $__LIST__ = $course_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k1 % 2 );++$k1;?>
					<div class="content list_attr_<?php echo $v['id']; ?>" style="display: none" data-id="1">
						<div class="cont">
							<ul>

							</ul>
							<div class="div_attr_<?php echo $v['id']; ?>" style="text-align: center;font-size: 12px;display: none">
								
							</div>
						</div>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>
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
		<script src="/public/static/mobile/js/load.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
