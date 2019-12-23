<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"D:\phpStudy\PHPTutorial\WWW\video/application/mobile\view\member\order_list.htm";i:1574385042;s:68:"D:\phpStudy\PHPTutorial\WWW\video\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>订单中心</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>订单中心</h3>
			</header>
			
			<div class="container">
				<!-- tab -->
				<ul class="order_tab">
					<li class="on" data-status="0">全部订单</li>
					<li data-status="1">待支付</li>
					<li data-status="2">已完成</li>
					<li data-status="3">交易失败</li>
				</ul>
				<!-- 订单列表 -->
				<div class="order_list" id="order0" data-id="1">
					<ul>
						
					</ul>
				</div>
				<div class="order_list" id="order1" style="display: none;" data-id="1">
					<ul>
						
					</ul>
				</div>
				<div class="order_list" id="order2" style="display: none;" data-id="1">
					<ul>
					</ul>
				</div>
				<div class="order_list" id="order3" style="display: none;" data-id="1">
					<ul>
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
		<script src="/public/static/mobile/js/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				let t = GetQueryString('t');
				let lis = $('.order_tab li');

				lis.each(function(){
					if($(this).attr('data-status') == t){
						$(this).addClass('on').siblings().removeClass("on");
						$('.order_list').hide();
						$("#order"+t).show();
						return false;
					}
				})

				var page = $('#order'+t).attr('data-id');

				order_list(t,page);

			})

			function order_list(num,page){

				$.post('<?php echo url("mobile/member/order_list"); ?>',{num:num,page:page},function(data){
					var html="";
					$.each(data,function(item,v){
						html+='<li><div class="kc_img"><a href="/mcourse_show?id='+v.aid+'"><img src="'+v.litpic+'" ></a>'
						html+='	</div><div class="kc_text"><div class="title">'+v.title+'</div>'
						html+='<div class="class_hour"><span>课程有效时长：365天</span><span>总课时：'+v.hours+'个</span></div>'
						html+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>'
						if(v.order_status == 0){
							var status = '待支付';
						}else if(v.order_status == 1){
							var status = '已支付';
						}else if(v.order_status == -1){
							var status = '交易失败';
						}
						html+='<span class="status">'+status+'</span></div></div></div></li>'
					})
					page = parseInt(page)+1;
					$('#order'+num).attr('data-id',page);
					$('#order'+num+' ul').append(html);
				})
			}

			// 订单中心tab切换
			$(".order_tab").on("click","li",function(){
				$(this).addClass('on').siblings().removeClass("on");
				const num = $(this).attr("data-status");
				var page = $('#order'+num).attr('data-id');
				$(".order_list").hide();
				$("#order"+num).show();
				if(page != 1){
					return false;
				}
				order_list(num,page);

				
			})
		</script>
	</body>
</html>
