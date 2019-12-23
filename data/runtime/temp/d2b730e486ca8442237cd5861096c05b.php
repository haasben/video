<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"D:\WWW\video/application/index\view\pay\mpaycourse.htm";i:1574733500;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>支付</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>支付中心</h3>
			</header>
			
			<div class="container">
				<?php if(!(empty($order['course']) || (($order['course'] instanceof \think\Collection || $order['course'] instanceof \think\Paginator ) && $order['course']->isEmpty()))): ?>
				<div class="order_desc">
					<h4>订单信息</h4>
					<ul class="list">
						<li>
							<div class="box">
								<div class="kc_img">
									<a href="/mcourse_show?id=<?php echo $order['order_info']['product_id']; ?>">
										<img src="<?php echo $order['order_info']['litpic']; ?>" height="100">
									</a>
								</div>
								<div class="kc_text">
									<a href="course_show.html">
										<div class="title"><?php echo $order['order_info']['product_name']; ?></div>
										<?php if($order['order_info']['prom_type'] == 1): ?>
										<span style="color:red">注：此课程为单独课程购买，并不是该系列全部课程!!!</span>
										<?php endif; ?>
										<div class="class_hour">
											<span>讲师：<?php echo $order['course']['lecturer']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<span>总课时：<?php echo $order['course']['hours']; ?>个</span>
										</div>
										<div class="price">
											<span class="jin">￥<?php echo $order['order_info']['order_total_amount']; ?></span>
										</div>
									</a>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<?php else: ?>
					<div class="lists">
						<div class="title"><?php echo $order['order_info']['product_name']; ?></div>
					</div>
				<?php endif; ?>
				
				<div class="pay_method">
					<div class="tip">请选择支付方式：</div>
					<div class="types">
						<?php if(isWeixin()){?>
							<a href="<?php echo url('index/Pay/h5_wechat_pay'); ?>&order_code=<?php echo $order['order_info']['order_code']; ?>&token=<?php echo $token; ?>&transaction_type=2"><img src="/public/static/mobile/img/w.png" ></a>
						<?php }else{?>
						<a href="<?php echo url('index/Pay/new_alipay_pay_url'); ?>&order_code=<?php echo $order['order_info']['order_code']; ?>&token=<?php echo $token; ?>&transaction_type=2"><img src="/public/static/mobile/img/timg.jpg" ></a>
						<a href="<?php echo url('index/Pay/h5_wechat_pay'); ?>&order_code=<?php echo $order['order_info']['order_code']; ?>&token=<?php echo $token; ?>&transaction_type=2"><img src="/public/static/mobile/img/w.png" ></a>
						<?php };?>
					</div>
				</div>
			</div>
			
		</div>
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
