<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\WWW\video/application/index\view\course_center\video_play.htm";i:1575427921;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $course['title']; ?></title>
		<meta name="description" content="<?php echo $course['seo_description']; ?>" />
		<meta name="keywords" content="<?php echo $course['seo_keywords']; ?>" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/player.css">
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css">
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/jquery.fancybox.css" />
		<link rel="stylesheet" href="/public/static/index/css/automail.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>
		<script src="/public/static/index/js/jquery-1.11.3.js"></script>
		<script src="/public/static/index/js/jquery.cookie.js"></script>
		<script type="text/javascript" src="/public/static/index/js/jquery.fancybox.js"></script>

		<style type="text/css">
			html,body{height: 100%;}
		</style>
	</head>
	<body style="height: 100% !important;overflow: hidden;">
		<div class="video_wrap">
			<div class="container videos">
				<video width="800" height="" controls="controls" controlslist="nodownload noremoteplayback" class="vid">
				<!-- 	<source src="" type="video/mp4" class="video"> -->
					当前浏览器不支持 video直接播放
				</video>
			</div>
			<script type="text/javascript">
				var aid = '<?php echo $aid; ?>';
				$.post('/get_video',{aid:aid},function(data){
				sourceDom = $("<source src=\""+ data +"\"> type='video/mp4' </source>");
				   $(".vid").append(sourceDom);
				   // // 自动播放
				   $('.vid').attr('autoplay',"autoplay");
				   // $(".vid").get(0).play();

				})


			</script>
			<!--侧栏伸展-->
			<div class="menu">
				<div class="clearfix collapse collapse-wrap">
					<div class=" Course-Details">
						<div class="summarize l">
							<dl>
								<dt><?php echo $course['title']; ?>-<?php echo $course['videorating']; ?>课程</dt>
								<dd><?php echo $course['click']; ?>人观看</dd>
								<dd>讲师:<?php echo $course['lecturer']; ?></dd>
							</dl>
						</div>
						<div class="course-cover l">
							<a href="javaScript:;">
								<img src="<?php echo $course['litpic']; ?>" alt="<?php echo $course['title']; ?>"></a>
						</div>
					</div>
					<div class="Tab">
						<ul>
							<li>
								目录</li>
						</ul>
					</div>
				
					<div class="collapse-cont2" id="list-lessons" style="height: calc(100% - 170px);overflow-x: hidden;">
							<ul>
									
								<?php if(empty($course['chapter']) || (($course['chapter'] instanceof \think\Collection || $course['chapter'] instanceof \think\Paginator ) && $course['chapter']->isEmpty())): if(is_array($course['course_list']) || $course['course_list'] instanceof \think\Collection || $course['course_list'] instanceof \think\Paginator): $k = 0; $__LIST__ = $course['course_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($k % 2 );++$k;?>
								<li>
									
									<div class="Course-List" style="display: block;">

										<ul>
											<!-- False, False -->
											<li class="rel">
												<a id="lesson_id_<?php echo $cl['aid']; ?>" class="ellipsis " href="/video_play?aid=<?php echo $cl['aid']; ?>" title="<?php echo $cl['title']; ?>">
													<?php if($cl['aid'] == $aid): ?>
													<img src="/public/static/index/images/icons.gif" alt="" class="icon-music">
													<?php endif; ?>
													<span class="pl10">
													<?php if($cl['arcrank'] == 1): ?>
														<b class="Watch-permissions abs">免费</b>
													<?php elseif($cl['arcrank'] == 2): ?>
														<b class="Watch-permissions abs">会员</b>
													<?php endif; ?><?php echo $cl['title']; ?></span>
												
												</a>
											</li>
				
										</ul>
									</div>
								</li>
								<?php endforeach; endif; else: echo "" ;endif; else: if(is_array($course['chapter']) || $course['chapter'] instanceof \think\Collection || $course['chapter'] instanceof \think\Paginator): $key = 0; $__LIST__ = $course['chapter'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($key % 2 );++$key;?>
									<li>
										<div class="collapse-head <?php if($cha_id != $cc['id']): ?>child-hidden<?php endif; ?>">
											<span class="r toggle-outline">∧</span>
											<span class=" l ellipsis" style="width: 260px;"><?php echo $cc['title']; ?></span>
										</div>
										<div class="Course-List" <?php if($cha_id != $cc['id']): ?>style="display: none;"<?php else: ?>style="display: block;"<?php endif; ?>>
											<ul>
												<?php if(is_array($course['course_list']) || $course['course_list'] instanceof \think\Collection || $course['course_list'] instanceof \think\Paginator): $k = 0; $__LIST__ = $course['course_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($k % 2 );++$k;if($cl['cha_id'] == $cc['id']): ?>
												<!-- False, False -->
														<li class="rel">
															<a id="lesson_id_<?php echo $cl['aid']; ?>" class="ellipsis " href="/video_play?aid=<?php echo $cl['aid']; ?>" title="<?php echo $cl['title']; ?>">
																<?php if($cl['aid'] == $aid): ?>
																	<img src="/public/static/index/images/icons.gif" alt="" class="icon-music">
																<?php endif; ?>
																<span class="pl10">
																<?php if($cl['arcrank'] == 1): ?>
																	<b class="Watch-permissions abs">免费</b>
																<?php elseif($cl['arcrank'] == 2): ?>
																	<b class="Watch-permissions abs">会员</b>
																<?php endif; ?>
															<?php echo $cl['title']; ?></span>
															</a>
														</li>
													<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					
											</ul>
										</div>
									</li>
								<?php endforeach; endif; else: echo "" ;endif; endif; ?>


								
							</ul>
					</div>
					
					<!-- 目录右下角广告 -->
					<!-- <div id="ads_banner">
						<a href="https://act.jcpeixun.com/topic/20191012/?kecheng" target="_blank">
							<img src="/public/static/index/picture/20191101090320754.png" />
						</a>
						<span class="close_ads" title="关闭">×</span>
					</div> -->
				</div>
			</div>
			
		</div>
	</body>

	<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		// 关闭视频画中画功能
		let v = $('.vid')
		v[0]['disablePictureInPicture'] = true;
		
		//课程大纲展开、收缩
		$(".collapse-head").click(function (e) {
		    e.stopPropagation();
		    var ctext = $(this).find(".toggle-outline");
		    var $box = $(this).siblings(".Course-List");
		    $box.slideToggle();
		    if ($(this).hasClass("child-hidden")) {
		        ctext.text("∧");
		        $(this).removeClass("child-hidden");
		    } else {
		        ctext.text("∨");
		        $(this).addClass("child-hidden");
		    }
		});
	</script>
</html>
