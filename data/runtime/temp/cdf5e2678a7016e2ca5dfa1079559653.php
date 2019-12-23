<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wwwroot\www.gkbplc.com/application/index\view\pay\mactivation.htm";i:1574733576;}*/ ?>
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
				
				<div class="order_desc">
					<h4>订单信息</h4>
					<ul class="list">
						<li>
							<div class="box">

								<div class="kc_text">
								
										<div class="title">订单类型：激活会员账号</div>
										
										<div class="title">
											<span>订单编号：<?php echo $user_money['order_number']; ?></span>
										</div>
										<div class="title">
											<span class="jin">应付金额：￥<?php echo $user_money['money']; ?></span>
										</div>
									
								</div>
							</div>
						</li>
					</ul>
				</div>
				
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
