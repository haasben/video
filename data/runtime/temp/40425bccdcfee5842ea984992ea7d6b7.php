<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"D:\phpStudy\PHPTutorial\WWW\video/application/index\view\course_center\course_show.htm";i:1574736292;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\search.htm";i:1573528354;s:70:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\haslogged.htm";i:1573701866;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\footer.htm";i:1573700791;}*/ ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>变频器、伺服和步进驱动技术应用-工控邦培训网</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/player.css">
		<link href="/public/static/index/css/lesson/course.css" rel="stylesheet" />
		<link href="/public/static/index/css/lesson/course_v2019.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>

		<link rel="shortcut icon" href="<?php echo $web_config['icon']; ?>" />

		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />

		<script type="text/javascript" src="/public/static/index/js/jquery-1.10.2.min.js"></script>

		<link rel="stylesheet" type="text/css" href="/public/static/index/css/jquery.fancybox.css" media="screen" />
		<script type="text/javascript" src="/public/static/index/js/jquery.fancybox.js"></script>

		<script type="text/javascript" src="/public/static/index/js/jquery.superslide.2.1.1.js"></script>
		<script type="text/javascript" src="/public/static/index/js/basic.js"></script>
		<script src="/public/static/index/js/pagesou_ajax.js" type="text/javascript"></script>
		<script src="/public/static/index/js/tools.v1.js" type="text/javascript"></script>

<!-- 		<script src="/public/static/index/js/jquery.lazyload.js" type="text/javascript"></script>

		<script src="/public/static/index/js/swfobject.js" type="text/javascript"></script> -->

		<style type="text/css">
			#boxen_titlebar {
				position: relative;
				height: 30px;
				line-height: 30px;
				background-color: rgb(37, 153, 242) !important;
				color: #333;
				font-size: 18px;
				font-weight: 700;
				font-family: 'Microsoft Yahei';
				padding: 15px;
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
				width: 520px;
			}

			#boxen_content_area {
				background: #fff;
				width: 100%;
				height: 240px !important;
				box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.6) !important;
				padding-top: 20px;
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
			}

			#boxen_container {
				width: 550px;
				height: 260px position: fixed;
				left: 50%;
				top: 50%;
				margin-left: -275px;
				margin-top: -160px;
				z-index: 10001;
				box-shadow: rgb(51, 51, 51) 0px 5px 15px;
				border-radius: 10px !important;
			}

			#boxen_title {
				position: relative;
				height: 30px;
				line-height: 30px;
				background-color: #eee;
				color: #fff;
				font-size: 20px;
				font-weight: normal;
				font-family: 'Microsoft Yahei';
				padding: 15px;
				background: rgb(37, 153, 242);
				border-top-left-radius: 10px;
				border-top-right-radius: 10px;
			}

			#boxen_close_button {
				border: none;
				position: absolute;
				right: 0;
				top: 15px;
				width: 28px;
				text-align: center;
				outline: none;
				text-decoration: none;
				font-size: 18px;
				font-family: Arial;
				font-weight: normal;
				color: #fff;
				padding-right: 5px;
			}

			/*新改版的课程说明样式*/
			.kc_span p .shijian {
				color: #1caaea;
			}

			.kc_span p .ques {
				color: #fff;
				background: #c9c9c9;
				border-radius: 100%;
				font-size: 15px;
				display: inline-block;
				width: 22px;
				height: 22px;
				line-height: 22px;
				text-align: center;
			}

			.kc_span p .comment-star {
				display: inline-block;
				width: 78px;
				height: 14px;
				background: url(/public/static/index/images/stars.jpg) no-repeat;
			}

			.kc_span p .star-0 {
				background-position: -80px 0;
			}

			.kc_span p .star-1 {
				background-position: -64px 0;
			}

			.kc_span p .star-2 {
				background-position: -48px 0;
			}

			.kc_span p .star-3 {
				background-position: -32px 0;
			}

			.kc_span p .star-4 {
				background-position: -16px 0;
			}

			.kc_span p .star-5 {
				background-position: 0 0;
			}

			.sharesdiv {
				float: right;
				width: 200px;
				margin-top: -40px;
				margin-right: -40px;
				padding-top: 0 !important;
				padding-left: 0 !important;
			}

			.reset p .discount_price {
				font-size: 30px;
				color: #ff4d4d;
				font-weight: normal;
			}

			.reset p .discount_price em {
				font-size: 18px;
			}

			.reset p .discount_price i {
				font-style: normal;
				font-size: 32px;
				font-weight: bold;
			}

			.reset p .price {
				font-size: 14px;
				text-decoration: line-through;
				color: #999;
			}

			.reset .btn {
				display: inline-block;
				padding: 0;
				width: 120px;
				height: 40px;
				line-height: 40px;
				margin-right: 10px;
				font-size: 14px;
				margin-top: 10px;
			}

			.reset .btn:hover {
				background: #FF7272;
				border-color: #fff;
			}

			.reset .buy_vip {
				background: #fff;
				color: #FF4D4D;
				border: 1px solid #FF4D4D;
			}

			.reset .buy_vip:hover {
				background: #FF4D4D;
				color: #fff;
				border-color: #fff;
			}

			.reset .btn:active {
				background: #CD3131;
			}

			.reset .detail {
				color: #999;
				font-size: 12px;
				position: absolute;
				bottom: 0;
				right: 0;
			}

			.reset .detail .ques {
				color: #fff;
				background: #c9c9c9;
				border-radius: 100%;
				font-size: 12px;
				display: inline-block;
				width: 16px;
				height: 16px;
				line-height: 16px;
				text-align: center;
				margin-left: 2px;
			}
		</style>
	</head>
	<body id="lesson_20140110">
		<div class="wrap">
			<!--header-->
			<style type="text/css">
				.user-wrap .user-head {
					width: 98px;
					white-space: nowrap;
					text-overflow: ellipsis;
				}

				.user-wrap .user-head .caret {
					z-index: 1;
				}

				.user-wrap .user-head .user-head-inner {
					width: 100%;
					z-index: 0;
					border: 0;
					text-align: center;
				}

				.user-wrap .user-head .user-head-inner img {
					border-radius: 3px;
				}

				.h-user {
					float: right;
					width: 230px;
					margin-top: -70px;
					height: 70px;
				}
			</style>
			<div class="header">
				<div class="inner clearfix">
			<!--container-->
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

				<div style="clear: both;"></div>

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
			<!--header-->
			<!--navbar-->

			<!--navbar-->
			<!--container-->
			<div class="container">
				<!--头部导航栏-->

<!-- 				<div class="navbar">
					<ul class="main-nav inner">
						<li class="active"><a href="course.html">选课中心</a></li>
						<li><a href="majorcourse.html?f5=PLC&plctype=140">三菱视频教程</a></li>
						<li><a href="majorcourse.html?f5=PLC&plctype=143">西门子视频教程</a></li>
						<li><a href="majorcourse.html?f5=PLC&plctype=146">欧姆龙视频教程</a></li>
						<li><a href="majorcourse.html?f5=变频器">变频器视频教程</a></li>
						<li><a href="majorcourse.html?f5=电工">电工基础</a></li>
						<li><a href="majorcourse.html?f5=数控">数控</a></li>
						<li><a href="searc.html?keyword=组态">组态/PID</a></li>
						<li><a href="search.html?keyword=案例">工程案例详解</a></li>
					</ul>
				</div> -->
				<div style="clear: both;"></div>
				<!--bread-crumb-->
				<!--课程简介-->

				<div class="bread-crumb inner">
					<a href="/">首页</a> <em class="fs">&gt;</em> 
<!-- 					<a href="">选课中心</a><em class="fs">&gt;</em> -->
					<span><a href="javascript:"><?php echo $course_info['title']; ?></a></span>
				</div>
				<div style="clear: both;"></div>
				<!--课程简介-->
				<div class="inner">
					<div class="bd1 bds bdgrayd bgwhite pt20 pl20 pr20 clearfix pb20">
						<div class="w468 l vedio rel">
							<div id="player" style="width: 468px;">
								<a href="/video_play?id=<?php echo $course_info['aid']; ?>" target="_blank" class="see check-login" data-id="6972">
									<img src="<?php echo $course_info['litpic']; ?>" width="468" height="265">
									<i class="icon-vedio"></i></a>
								<span><a target="_blank" style="width:100%;" title="本课时暂无在线试看"><img src="/public/static/index/picture/nofile.png" style="width:100%; display: none;"></a></span>
							</div>
<!-- 							<div style="display: none; position: absolute; width: 320px; height: 163px; top: 40px; padding: 10px; left: 50%; margin-left: -160px; background-color: rgb(255, 255, 255); z-index: 1;"
							 id="huodong_dialog">
								<a href="http://www.jcpeixun.com/lesson1/vip_day.aspx?from=payler_index" target="_blank">
									<img src="/public/static/index/picture/20150910-01.png"></a>
								<div><a id="huodong_dialog_close" style="position: absolute; right: 17px; top: 0; font-size: 26px; cursor: pointer; color: #fff; width: 20px; height: 20px;">×</a></div>
							</div> -->
<!-- 							<script type="text/javascript">
								$(function() {
									//关闭播放弹出广告
									$("#huodong_dialog_close").click(function() {
										$("#huodong_dialog").hide();
									});
								});
							</script> -->
						</div>

						<div class="w672 r" style="padding-top: 0; position: relative;">
							<h3 class="h20 lh20 f20 n" style="color: #333;"><?php echo $course_info['title']; ?></h3>
							<!--加上类别标签-->
							<p class="category">
								<a href='javascript:;'><?php echo $course_info['typename']; ?></a>
							</p>
							<!--讲师-->
							<p class="tec-name">讲师：<?php echo $course_info['lecturer']; ?></p>
							<!--课程介绍-->
							<div class="p2em f14 bds bdb bdgrayd lh22 pb6"><?php echo mb_substr(htmlspecialchars_decode($v['content']),0,30); ?></div>
							<div class="reset">
								<form id="course_form" name="course_form" method="post" autocomplete="off">
									<div class="fix-box">
										<p class="gray6">
											<span class="mr10 discount_price">￥<?php echo $course_info['amount']; ?></span><span class="mr10 price">原价:&nbsp;￥<?php echo $course_info['amount']; ?></span>
										</p>
									</div>
						
									<input id="paycourse_id" name="paycourse_id" type="hidden" value="<?php echo $course_info['aid']; ?>" />

							
										<?php if($userData['level'] == 3): ?>
											<a class='btn btn-active w165 f18 quick_buy' href="/video_play?id=<?php echo $course_info['aid']; ?>">立即观看 </a>
										<?php else: if($course_info['is_free'] == '是'): ?>
												<a class='btn btn-active w165 f18 quick_buy' href="/video_play?id=<?php echo $course_info['aid']; ?>">立即观看</a>
												<?php else: if(empty($mainCourse) || (($mainCourse instanceof \think\Collection || $mainCourse instanceof \think\Paginator ) && $mainCourse->isEmpty())): ?>
													<a class='btn btn-active w165 f18 quick_buy btnPay' href="javascript:;">立即购买</a>
													<?php else: ?>
														<a class='btn btn-active w165 f18 quick_buy' href="/video_play?id=<?php echo $course_info['aid']; ?>">立即观看 </a>
												<?php endif; endif; endif; ?>
									



									
								
			
								</form>
								<p class="detail">
									<span><?php echo $course_info['click']; ?></span>人正在学
									| 课程进度：更新至<span><?php echo $course_info['count']; ?></span>课时
									| 有效期: <span>365</span>天<span class='ques' style='cursor: pointer;'>?</span>
								</p>
								<div class="tag-top">有效期自支付成功后开始计算。单课程购买用户需关注课程有效期，合理安排好学习计划。</div>
							</div>
						</div>
						<div style="clear: both;"></div>
						<!--新添加的收藏和推荐手机观看-->
						<div class="include-box">
							<a href="javascript:;" id="btn-addToFav" style="width: 40px;">
								<i class="icon-bg"></i>
								<b>收藏</b>
							</a>
							<a href="javascript:;" id="access">
								<i class="icon-bg"></i>
								<b style="left: 15px;">推荐手机观看</b>
								<span class="QR-code">
									<img src="/public/static/index/picture/download.png" alt="" style="width: auto;" />
								</span>
							</a>
						</div>
					</div>
					<div class="tabs-nav1" data-role="fixed" id="mini-play-navbar">
						<a data-path="ajax/part/kechengbiao" data-role="course-intro" class="active kechengbiao" href="javascript:;">课程表<em class="badge">试听</em></a>
						<a data-path="ajax/part/content" class="kechengjianjie" data-role="course-syll" href="javascript:;">课程简介</a>
					</div>
					

				</div>
				<!--bread-crumb-->
				<!--课程简介-->
				<div class="inner mt20 clearfix" id="inner-container">
					<!--左侧栏目块-->
					<!--选项卡内容-->
					<div class="tabCon">
						<div class="tabConBox" id="part-kechengbiao">
							<!--课程视频大纲-->
							<div class="w880 box1 mt0">
								<div class="bhead">
									<h3>课程设置</h3>
									<span><em><?php echo $course_info['hours']; ?></em>个课时</span>

								
									<?php if($userData['level'] == 3): ?>
										<a href="/video_play?id=<?php echo $course_info['aid']; ?>" target="_blank" class="see check-login" data-id="6972">开始学习</a>

									<?php else: if($course_info['is_free'] == '是'): ?>
										<a href="/video_play?id=<?php echo $course_info['aid']; ?>" target="_blank" class="see check-login" data-id="6972">开始学习</a>
										<?php else: if(empty($mainCourse) || (($mainCourse instanceof \think\Collection || $mainCourse instanceof \think\Paginator ) && $mainCourse->isEmpty())): ?>
												<a class='quick_buy btnPay' href="javascript:;">立即购买</a>

											<?php else: ?>
											<a href="/video_play?id=<?php echo $course_info['aid']; ?>" target="_blank" class="see check-login" data-id="6972">开始学习</a>
											<?php endif; endif; endif; ?>

								</div>
								<div>
									<ul class="listview4">
										<?php if(is_array($chapter) || $chapter instanceof \think\Collection || $chapter instanceof \think\Paginator): $k = 0; $__LIST__ = $chapter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
										<li class="list-collapse">
										
										<div class="collapse-head toggle-collapse <?php if($k>1): ?>child-hidden<?php endif; ?>">
												<h3><?php echo $v['title']; ?></h3>
												<span class="toggle-outline"></span>
											</div>
										<div class="collapse-cont" <?php if($k>1): ?>style="display: none;" <?php endif; ?>>
											<ul class="listview5">

											<?php if(is_array($course_info['list']) || $course_info['list'] instanceof \think\Collection || $course_info['list'] instanceof \think\Paginator): $k = 0; $__LIST__ = $course_info['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($k % 2 );++$k;if($cl['cha_id'] == $v['id']): ?>
											<li><span class="w550 l">
												<input type="checkbox" class="form-checkbox dn"><a class="check-login" href="/video_play?aid=<?php echo $cl['aid']; ?>" target="_blank">
														<?php echo $cl['title']; ?>
													</a></span><span class="colblue l">
														<?php if($userData['level'] == 3): ?>
															已购买
															</span>
															<a class="icon-btn r check-login" href="/video_play?aid=<?php echo $cl['aid']; ?>" target="_blank">
																<i class="iconfont">&#xe612;</i> <span class="txt">马上学习</span></a> 

														<?php else: if(empty($mainCourse) || (($mainCourse instanceof \think\Collection || $mainCourse instanceof \think\Paginator ) && $mainCourse->isEmpty())): if($cl['arcrank'] == 1): ?>
																免费
																</span>
															<a class="icon-btn r check-login" href="/video_play?aid=<?php echo $cl['aid']; ?>" target="_blank">
																<i class="iconfont">&#xe612;</i> <span class="txt">马上学习</span></a> 
															<?php else: if(empty($smallCourse) || (($smallCourse instanceof \think\Collection || $smallCourse instanceof \think\Paginator ) && $smallCourse->isEmpty())): ?>
																	</span>
																	<a class="icon-btn r check-login btnPay_cou" href="javascript:;" data-id="<?php echo $cl['aid']; ?>">
																		<i class="iconfont">&#xe612;</i> <span class="txt">立即购买</span></a> 
																<?php else: if(in_array($cl['aid'],$smallCourse)){ ?>
																		</span>
																	<a class="icon-btn r check-login" href="/video_play?aid=<?php echo $cl['aid']; ?>" target="_blank">
																		<i class="iconfont">&#xe612;</i> <span class="txt">马上学习</span></a> 

																	<?php }else{ ?>

																			</span>
																	<a class="icon-btn r check-login btnPay_cou" href="javascript:;" data-id="<?php echo $cl['aid']; ?>">
																		<i class="iconfont">&#xe612;</i> <span class="txt">立即购买</span></a> 

																	<?php }; endif; ?>


																￥ <?php echo $cl['users_price']; endif; else: ?>
																已购买
																</span>
																<a class="icon-btn r check-login" href="/video_play?aid=<?php echo $cl['aid']; ?>" target="_blank">
																	<i class="iconfont">&#xe612;</i> <span class="txt">马上学习</span></a> 
															<?php endif; endif; ?>


														
											</li>
											<?php endif; endforeach; endif; else: echo "" ;endif; ?>
											
											</ul>
										</div>
										
										</li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
								</div>

							</div>
							<!--课程视频大纲-->

						</div>
						<div class="tabConBox hide" id="part-content">
							<div class="w880 box1 mt0">
								<div class="bhead">
									<h3>课程简介</h3>
									
								</div>
								<div style="padding: 5px 0;"></div>
								<?php echo htmlspecialchars_decode($course_info['content']); ?>
						</div>
						</div>
					</div>
					<!--左侧栏目块-->

					<!--右侧栏目块-->
					<div class="w300 r">
						<!--广告图-->

						<!--广告图-->
						<!--老师介绍-->
						<div class="box1 mt5">
							<div class="bhead">
								<h3>老师介绍</h3>
							</div>
							<div class="pt10 pb10 pl20 pr20 f14">
								<div class="clearfix pt10 pb10">
									<div class="w100 l">
										<a href="javascript:;">
											<img src="/public/static/index/picture/190d3ee4b7d44e20b0f1e92edc7c8eed.gif" class="img-radius" width="100" height="100"
											 alt=""></a>
									</div>
									<div class="w140 pl10 l">
										<h4 class="f16 gray3">
											<?php echo $course_info['lecturer']; ?></h4>

									</div>
								</div>
								<p>
									<?php echo htmlspecialchars_decode($course_info['Instructors']); ?>
								</p>
							</div>
							<div class="bfoot pl20 pr20 f14">
								<p class="clearfix">
									<span class="l">课程总数（<?php echo $course_info['hours']; ?>）</span><!--  <span class="r hand" id="like-teacher-btn">
										<i class="iconfont f14 colblue">&#xe601;</i> 赞（<label id="like-teacher-num">80</label>）</span> -->
								</p>
							</div>
						</div>

		<script type="text/javascript">
						
						$('.kechengjianjie').click(function(){

							$('.kechengjianjie').addClass('active');
							$('.kechengbiao').removeClass('active');
							$('#part-content').removeClass('hide');
							$('#part-kechengbiao').addClass('hide');
						})
						$('.kechengbiao').click(function(){

							$('.kechengbiao').addClass('active');
							$('.kechengjianjie').removeClass('active');
							$('#part-kechengbiao').removeClass('hide');
							$('#part-content').addClass('hide');
						})

						$('.btnPay').click(function(){
							
							var data = $('#course_form').serialize();
							$.post('<?php echo url("index/courseCenter/get_url"); ?>',data,function(data){
									if(data.code == 2){
										window.location.href = '/login?tab=1';
									}else if(data.code == 1){
										var url = '/paycourse?orderid='+data.orderid+'&token='+data.token+'&callback='+data.url;
										window.location.href = url;
									}else if(data.code == 3){
										alert(data.msg);
									}
							})

						})


						$('.btnPay_cou').click(function(){
							
							var data = $('#course_form').serialize();

							data += '&cou_id='+$(this).attr('data-id');
							$.post('<?php echo url("index/courseCenter/get_url"); ?>',data,function(data){
									if(data.code == 2){
										window.location.href = '/login?tab=1';
									}else if(data.code == 1){
										var url = '/paycourse?orderid='+data.orderid+'&token='+data.token+'&callback='+data.url;
										window.location.href = url;
									}else if(data.code == 3){
										alert(data.msg);
									}
							})

						})

							$(function() {
								//课程大纲展开、收缩
								$(".toggle-collapse").click(function(e) {
									e.stopPropagation();
									var ctext = $(this).find(".toggle-outline");
									var $box = $(this).siblings(".collapse-cont");
									$box.slideToggle();


									if ($(this).hasClass("child-hidden")) {
										// ctext.text("∧");
										$(this).removeClass("child-hidden");
									} else {
										// ctext.text("∨");
										$(this).addClass("child-hidden");
									}

								});

								// //加入购物车学习【购买整个课】
								// $(".btnPay").click(function(event) {
									
								// });
								//tip提示
								$(".ques").hover(function() {
									$(".tag-top").show();
									$(this).css("cursor", "pointer");
								}, function() {
									$(".tag-top").hide();
								});

							});


					</script>

					</div>
					<!--右侧栏目块-->
				</div>

			</div>

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

			