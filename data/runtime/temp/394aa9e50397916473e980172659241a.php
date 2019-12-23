<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"D:\wwwroot\www.gkbplc.com/application/mobile\view\member\index.htm";i:1574388994;s:60:"D:\wwwroot\www.gkbplc.com\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>我的</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap" id="mine">
			<!-- 个人信息 -->
			<div class="container">
				<div class="p_info">
					<div class="avatar">
						<img src="<?php echo $userData['head_pic']; ?>">
					</div>
					<div class="infos">
						<h3 class="nickname"><?php echo $userData['username']; ?></h3>
						<span>注册时间：<?php echo date('Y-m-d',$userData['reg_time']); ?></span>
						<p><span><?php echo substr_replace($userData['mobile'],'****',3,4); ?></span>&nbsp;|&nbsp;<a href="<?php echo url('mobile/member/edit_users'); ?>&t=3">修改</a></p>
						<p><span>我的收藏：</span><a href="/learn?t=2"><?php echo $memberData['collect_count']; ?>个</a></p>
					</div>
				</div>
				<!-- 我的订单 -->
				<div class="my_order">
					<div class="tit">
						<span>我的订单</span>
						<a href="<?php echo url('mobile/member/order_list'); ?>&t=0">全部订单></a>
					</div>
					<ul class="list">
						<li>
							<a href="<?php echo url('mobile/member/order_list'); ?>&t=0">
								<i class="icon">&#xe62e;</i>
								<span>全部订单</span>
								<span class="num"><?php echo $memberData['order_statusall']; ?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo url('mobile/member/order_list'); ?>&t=1">
								<i class="icon">&#xe668;</i>
								<span>待支付</span>
								<span class="num"><?php echo $memberData['order_status0']; ?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo url('mobile/member/order_list'); ?>&t=2">
								<i class="icon">&#xe62b;</i>
								<span>交易成功</span>
								<span class="num"><?php echo $memberData['order_status1']; ?></span>
							</a>
						</li>
						<li>
							<a href="<?php echo url('mobile/member/order_list'); ?>&t=3">
								<i class="icon">&#xe62c;</i>
								<span>交易失败</span>
								<span class="num"><?php echo $memberData['order_status_1']; ?></span>
							</a>
						</li>
					</ul>
				</div>
				
				<div class="items">
					<ul>
						<li>
							<a href="<?php echo url('mobile/member/edit_users'); ?>&t=1">
								<span>账户设置</span>
								<span class="icon">&#xe63c;</span>
							</a>
						</li>
						<li>
							<a href="/learn?t=1">
								<span>学习记录</span>
								<span class="icon">&#xe63c;</span>
							</a>
						</li>
						<li>
							<a href="<?php echo url('mobile/member/bought_course'); ?>">
								<span>购买的课程</span>
								<span class="icon">&#xe63c;</span>
							</a>
						</li>
					</ul>
				</div>
				
				<!-- 最近学习记录 -->
				<div class="recode">
					<h3>最近学习记录</h3>
					<ul>
						<?php if(is_array($memberData['Learn']) || $memberData['Learn'] instanceof \think\Collection || $memberData['Learn'] instanceof \think\Paginator): $i = 0; $__LIST__ = $memberData['Learn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<div class="kc_img">
								<a href="/mcourse_show?id=<?php echo $v['aid']; ?>">
									<img src="<?php echo $v['litpic']; ?>" >
								</a>
							</div>
							<div class="kc_text">
								<a href="/mcourse_show?id=<?php echo $v['aid']; ?>">
									<div class="title"><?php echo $v['title']; ?></div>
									<div class="class_hour">
										<span>课时：<?php echo $v['hours']; ?></span>
										<span>更新至：<?php echo $v['count']; ?>课时</span>
									</div>
								</a>
							</div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<a href="/learn?t=1" class="more">查看更多 >></a>
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
