<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\WWW\video/application/mobile\view\mvoice\voice_play.htm";i:1574230858;s:47:"D:\WWW\video\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $voiceData['title']; ?></title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<a href="javascript:" class="goback" onclick="history.go(-1);"></a>
			<div class="container detail">
				<div class="video">
					<video width="100%" controls autoplay="autoplay" controlslist="nodownload noremoteplayback" class="vid">
						<source src="<?php echo $voiceData['file_url']; ?>" type="<?php echo $voiceData['file_mime']; ?>"></source>
					</video>
					
				</div>
				<div class="title-wrap">
					<h4><?php echo $voiceData['title']; ?></h4>

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
		<script type="text/javascript">
			// 关闭视频画中画功能
			let v = $('.vid')
			v[0]['disablePictureInPicture'] = true;
			
			// tab切换
			$(".tabBox").on('click', 'a', function(){
				$(this).addClass('on').siblings().removeClass('on');
				const id = $(this).attr('data-id');
				$('.zw').hide();
				$("#zw"+id).show();
			})
		</script>
	</body>
</html>
