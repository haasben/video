<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\wwwroot\www.gkbplc.com/application/mobile\view\m_course_center\mcourse_show.htm";i:1574739373;s:60:"D:\wwwroot\www.gkbplc.com\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $course_info['title']; ?></title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<a href="javascript:" class="goback" onclick="history.go(-1);"></a>
			<div class="container detail">
				<div class="video">
					<video width="100%" controls poster="<?php echo $course_info['litpic']; ?>" controlslist="nodownload noremoteplayback" class="vid">

					</video>
					
				</div>
				<div class="title-wrap">
					<h4><?php echo $course_info['title']; ?></h4>
					<div class="zx">
						<p><span><?php echo $course_info['click']; ?></span>人在学</p>
						<p class="price">
							<span>￥<?php echo $course_info['amount']; ?></span>
							<?php if($userData['level'] != 3): if($course_info['is_free'] == '是'): ?>
								<a href="javascript:;" class="btnPay" style="color: #fff;background-color: #FF0000;padding: 0.06rem 0.06rem;">立即购买
								</a>
							<?php else: if(empty($mainCourse) || (($mainCourse instanceof \think\Collection || $mainCourse instanceof \think\Paginator ) && $mainCourse->isEmpty())): ?>
									<a href="javascript:;" class="btnPay" style="color: #fff;background-color: #FF0000;padding: 0.06rem 0.06rem;">立即购买
								</a>
									<?php endif; endif; endif; ?>
						</p>
					</div>
				</div>
				
				<div class="course_nav">
					<div class="tabBox">
						<a href="javascript:" class="on" data-id="1">课程表</a>
						<a href="javascript:" data-id="2">课程简介</a>
					</div>
					<!-- 课程表 -->
					<div class="course_list zw" id="zw1">
						<ul>
						<?php if(is_array($course_info['list']) || $course_info['list'] instanceof \think\Collection || $course_info['list'] instanceof \think\Paginator): $k = 0; $__LIST__ = $course_info['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;if($userData['level'] == 3): ?>
								<li data-id="<?php echo $v['aid']; ?>">
									<a href="javascript:;">
										<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
										<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
										<span class="txt play_video"  data-id="<?php echo $v['aid']; ?>">立即观看</span>
									</a>
								</li>
							<?php else: if($course_info['is_free'] == '是'): ?>
									<li data-id="<?php echo $v['aid']; ?>">
										<a href="javascript:;">
											<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
											<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
											<span class="txt play_video"  data-id="<?php echo $v['aid']; ?>">立即观看</span>
										</a>
									</li>
								<?php else: if(empty($mainCourse) || (($mainCourse instanceof \think\Collection || $mainCourse instanceof \think\Paginator ) && $mainCourse->isEmpty())): if($v['arcrank'] == 1): ?>
											<li data-id="<?php echo $v['aid']; ?>">
												<a href="javascript:;">
													<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
													<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
													<span class="txt play_video"  data-id="<?php echo $v['aid']; ?>">立即观看</span>
												</a>
											</li>
										<?php else: if(in_array($v['aid'],$smallCourse)){ ?>
												<li data-id="<?php echo $v['aid']; ?>">
													<a href="javascript:;">
														<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
														<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
														<span class="txt play_video"  data-id="<?php echo $v['aid']; ?>">立即观看</span>
													</a>
												</li>
											<?php }else{ ?>
												<li data-id="<?php echo $v['aid']; ?>">
													<a href="javascript:;">
														<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
														<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
														<span class="txt pay btnPay_cou" data-id="<?php echo $v['aid']; ?>">立即购买</span>
													</a>
												</li>
											<?php }; endif; else: ?>
										<li data-id="<?php echo $v['aid']; ?>">
									
											<a href="javascript:;">
												<p><!-- 第<?php echo $k; ?>课时.  --><?php echo $v['title']; ?></p>
												<span class="colblue l">￥<?php echo $v['users_price']; ?></span>
												<span class="txt play_video"  data-id="<?php echo $v['aid']; ?>">立即观看</span>
											</a>
										</li>
									<?php endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					
					<!-- 课程简介 -->
					<div class="course_desc zw" id="zw2">
						<?php echo htmlspecialchars_decode($course_info['content']); ?>
					</div>
					<form id="course_form" name="course_form" method="post" autocomplete="off">
					<input id="paycourse_id" name="paycourse_id" type="hidden" value="<?php echo $course_info['aid']; ?>"/>
					</form>
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
		<script type="text/javascript" src="/public/plugins/layer-v3.1.0/layer.js"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		$(function(){
			var data_id = $('#zw1 ul li:eq(0)').attr('data-id');
			var id="<?php echo $course_info['aid']; ?>";
			get_vedio_url(data_id,id);

		})

		$('.play_video').click(function(){
			var data_id = $(this).attr('data-id');
			var id="<?php echo $course_info['aid']; ?>";
			get_vedio_url(data_id,id);
		})

		function get_vedio_url(data_id,id){
			$.post("<?php echo url('mobile/MCourseCenter/get_video_url'); ?>",{aid:data_id,id:id},function(data){
				// layer.msg('sad')
				if(data.code == 1){
					var html = '<source src="'+data.data.file_url+'" type="'+data.data.file_mime+'"></source>';
					$('.vid').html(html);
					$('.vid').get(0).load();
					$('.vid').trigger('play');
					$('.vid').get(0).play();
				}else if(data.code == 2){
					layer.msg(data.msg,{icon:5,time:1500},function(){
						window.location.href='/mlogin';
					});
				}else if(data.code == 3){
					layer.msg(data.msg,{icon:5,time:1500});
				}else{

					layer.msg(data.msg,{icon:5,time:1500});
				}

			})
		}

		$('.btnPay').click(function(){
			// alert();return false;
			var data = $('#course_form').serialize();
			$.post('<?php echo url("mobile/MCourseCenter/get_url"); ?>',data,function(data){
				if(data.code == 2){
					window.location.href = '/login?tab=1';
				}else if(data.code == 1){
					var url = '/paycourse?orderid='+data.orderid+'&token='+data.token+'&callback='+data.url;
					window.location.href = url;
				}else if(data.code == 3){
					alert(data.msg);
				}
			})
			return false;

		})

		$('.btnPay_cou').click(function(){

			var data = $('#course_form').serialize();
			data += '&cou_id='+$(this).attr('data-id');
			$.post('<?php echo url("mobile/MCourseCenter/get_url"); ?>',data,function(data){
					if(data.code == 2){
						window.location.href = '/login?tab=1';
					}else if(data.code == 1){
						var url = '/paycourse?orderid='+data.orderid+'&token='+data.token+'&callback='+data.url;
						window.location.href = url;
					}else if(data.code == 3){
						alert(data.msg);
					}
			})
			return false;

		})


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
