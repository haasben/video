<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:67:"D:\wwwroot\www.gkbplc.com/application/index\view\pay\activation.htm";i:1574308068;s:59:"D:\wwwroot\www.gkbplc.com\application\index\view\search.htm";i:1573528354;s:62:"D:\wwwroot\www.gkbplc.com\application\index\view\haslogged.htm";i:1573701866;s:59:"D:\wwwroot\www.gkbplc.com\application\index\view\footer.htm";i:1573700791;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>激活账户</title>
		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>
		<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<div class="wrap" id="pay">
			<!-- 头部 -->
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
				<div class="inner mt20">
					<h3>订单信息</h3>

					<!-- 支付方式 -->
					<div class="pay_method">
						<div class="orderId">
							<span style="color:red">激活会员账号</span><br>
							<span>订单号：</span><span class="order_code"><?php echo $user_money['order_number']; ?></span>
						</div>
						<div class="allCount">
							本次应支付：<span><?php echo $user_money['money']; ?></span>元
						</div>
						<div class="method">
							<p>请选择支付方式</p>
							<div class="">

								<?php if($user_money['pay_alipay_config']['is_open_alipay'] === '0'): ?>
								<a href="<?php echo url('index/Pay/new_alipay_pay_url'); ?>&order_code=<?php echo $user_money['order_number']; ?>&token=<?php echo $token; ?>&transaction_type=1"  id="alipay">
									<img src="/public/static/index/picture/zhi.jpg" >
								</a>
								<?php endif; if($user_money['pay_wechat_config']['is_open_wechat'] === '0'): ?>
								<a href="javascript:" class="wechat" id="wechat">
									<img src="/public/static/index/picture/wechat.png" >
								</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<input type="hidden" class="token" value="<?php echo $token; ?>">
			<input type="hidden" name="" class="transaction_type" value="1">
			</div>
			
			<!-- footer -->
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

			
			<!-- 微信支付二维码 -->
			
			<div class="wx_qr">
				<div class="wrap">
					<img src="/public/static/index/picture/error.png" class="cha" >
					<div class="content">
						<span>微信扫一扫付款</span>
						<span>￥<?php echo $user_money['money']; ?></span>
						<img id="wechat_code" src="/public/static/index/images/load.gif" >
						<p>请在20分钟内完成支付</p>
					</div>
				</div>
			</div>

		</div>
		
		<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/index/js/mine.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
