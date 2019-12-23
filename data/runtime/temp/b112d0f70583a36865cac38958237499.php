<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\PHPTutorial\WWW\video/application/index\view\index\index.htm";i:1573788748;}*/ ?>
﻿<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="renderer" content="webkit" />
		<meta name="sogou_site_verification" content="TCcuf8HNfy" />
		<meta name="360-site-verification" content="106ea053b9ddbe61a7d52e3ed32f9d88" />
		<meta name="baidu-site-verification" content="6XuLXOoEsf" />
		<meta http-equiv="x-dns-prefetch-control" content="on" />
		<meta name="baidu-site-verification" content="I931PVHzQl" />
		<title><?php echo $web_config['web_name']; ?></title>
		<meta name="keywords" content="<?php echo $web_config['web_keywords']; ?>" />
		<meta name="description" content="<?php echo $web_config['web_description']; ?>" />
		<meta name="copyright" content="" />
		<link rel="shortcut icon" href="<?php echo $web_config['web_ico']; ?>" />

		<link href="/public/static/index/css/jc.v2.css" rel="stylesheet" />
		<link href="/public/static/index/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/public/static/index/css/jc.v2_1.css" />
		<link rel="stylesheet" href="/public/static/index/css/bootstrap.min_1.css" />
		<link rel="stylesheet" href="/public/static/index/js/swiper/css/swiper.min.css" />
		<link href="/public/static/index/css/index.css" rel="stylesheet" />
		<link rel="stylesheet" href="/public/static/index/css/style.css" />
		<link rel="stylesheet" href="/public/static/index/css/jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" href="/public/static/index/css/home.css"/>

		<script src="/public/static/index/js/jquery-1.11.3.js"></script>
		<script src="/public/static/index/js/jquery.cookie.js"></script>
		


	</head>
	<body id="index20150101" style="background:#fff;">
		<div class="con-wrap con-wrap1">
			<div class="container con1">
				<div class="row">
					<div class="col-xs-24">
						<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;if($b['pid'] == 13): ?>
							<a href="<?php echo $b['links']; ?>" <?php if($b['target'] ==1): ?>target="_blank"<?php endif; ?>><img src="<?php echo $b['litpic']; ?>" ></a>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>
			</div>
		</div>

		<!--/广告位-->
		<div class="con-wrap con-wrap2">
			<div class="container">
				<div class="row">
					<div class="col-xs-5">
						<a href="/">
							<img src="<?php echo $web_config['web_logo']; ?>" width="248" height="69" title="<?php echo $web_config['web_title']; ?>" alt="<?php echo $web_config['web_title']; ?>" />
						</a>
					</div>
					<div class="col-xs-10 col-xs-offset-2">
						<div class="search-area-wrap">
							<div class="search-area clearfix">
								<input type="text" name="txtSearch" class="txt-search1" id="txtSearch" placeholder="请输入要搜索的内容" />
								<a href="javascript:;" class="btn-search1" id="btn-search1" onfocus="this.blur();"><span class="glyphicon glyphicon-search f18"></span></a>
							</div>
						</div>
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
					<div class="col-xs-5 col-xs-offset-2">
						<div class="row">
							<div class="col-xs-12" id="left_noregistered">
								<div class="mt15 text-center h40 lh40" style="border:1px solid #ddd;">
									<a href="/login?tab=2" class="btn-register">用户注册</a>
								</div>
							</div>
							<div class="col-xs-12">
								<div class='btn-icon-wrap' style="margin-top:15px" id="left_nologin">
									<a href="/login?tab=1" class="btn-icon btn-icon1">用户登录</a>
									<i></i>
								</div>

								<?php if(!(empty($userData) || (($userData instanceof \think\Collection || $userData instanceof \think\Paginator ) && $userData->isEmpty()))): ?>
								<div class="myjc l mr20 mt15 h40" id="myjc" style="background-color: #f3f3f3;">
									<dl class="myjc-dl">
										<dt>
											<i class="i1"></i><i class="i2"></i>
											<a href="/member" class="btn_myjc">学员中心</a>
											<s class="s1"></s>
										</dt>
										<dd>
										
											<div class="f2 f" id="logined_20140121" style="display: block;">
												<h4 class="m0 mt5 mb5 cgray6">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $userData['username']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
													<span style="color:#188eee;font-size: 12px"><?php echo $userData['level_name']; ?></span>
												</h4>
												<p class="m0">

												</p>
											</div>
											<div class="f3 clearfix" style="border-bottom: 1px solid #eee;">
												<ul class="ul ul1">
													<li><a href="/member?tab=4" class="btn-link btn-link9">账户设置</a></li>
													<li><a href="/member?tab=3" class="btn-link btn-link9">我的订单</a></li>

												</ul>
												<ul class="ul ul2">
													<li style="background:url(/public/static/index/images/bg_20130926001.gif) no-repeat scroll 40px 0 transparent;">
														<a href="/member?tab=2" class="btn-link btn-link9">学习记录 &gt;</a></li>
													<li><a href="/member?tab=2&c=2" class="btn-link btn-link9">我的收藏 &gt;</a></li>

												</ul>
											</div>
											<div class="text-right h25 lh22 pr10">
												<a href="javascript:" class="fw logout">[退出]</a>
											</div>
										</dd>
									</dl>
								</div>
								<script type="text/javascript">
									 if ($("#myjc").length) {
						        $("#myjc").delegate("dl.myjc-dl", "mouseover", function (event) {
						            $(this).addClass("hover");
						        }).delegate("dl.myjc-dl", "mouseout", function (event) {
						            $(this).removeClass("hover");
						        });
						    }

									$('#left_nologin').addClass('dn');
									$('#left_noregistered').addClass('dn');
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
					</div>
				</div>
			</div>
		</div>
		<!--/logo,搜索,登录,注册-->
		<div class="con-wrap con-wrap3" style="margin-bottom: 0;">
			<div class="container">
				<div class="row">
					<div class="col-xs-24">
						<div class="banner-nav-wrap">
							<div class="row">
								<div class="col-xs-24">
									<div class="banner-nav clearfix">
										<ul id="topNav">
											<li class="list1 list" data-sid="s3">
												<a href="/" class="btn-link btn-link6">网站首页</a>
											</li>
											<?php if(is_array($cate) || $cate instanceof \think\Collection || $cate instanceof \think\Paginator): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
											<li class="list2 list" data-sid="s3">

												<a href="<?php if($v['is_part'] == 0): ?>/<?php echo $v['dirname']; ?>?id=<?php echo $v['id']; else: ?><?php echo $v['typelink']; endif; ?>" class="btn-link btn-link6"><?php echo $v['typename']; ?></a>
											</li>
											<?php endforeach; endif; else: echo "" ;endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
		<!-- 			<div class="col-xs-4">
						<div class="sidebar_nav">
							<div class="row">
								<div class="col-xs-14">
									<a href="javascript:"><img src="/public/static/index/images/li.png" >关注领福利</a>
								</div>
								<div class="col-xs-10">
									<a href="javascript:">会员中心</a>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<!--/导航-->
		<div class="con-wrap con-wrap4">

			<div class="container" style="margin-bottom: 10px;">
			    <div class="row">
			     <div class="col-xs-24">
			      <img src="/public/static/index/picture/pic.jpg"  >
			     </div>
			    </div>
			   </div>

			<!-- banner -->
			<div class="container">
				<div class="row">
					<div class="col-xs-24" id="banner_list">
						<div class="swiper-container" id="banner_list" style="z-index: 0;">
							<div class="swiper-wrapper">

								<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;if($b['pid'] == 7): ?>
								<div class="swiper-slide">
									<div class="item" style="background:url('<?php echo $b['litpic']; ?>') scroll no-repeat center top transparent;background-size: cover;">
										<a href="<?php echo $b['links']; ?>" <?php if($b['target'] ==1): ?>target="_blank"<?php endif; ?> style='display:block;height:390px;border:1px solid #ccc;' alt=""></a>
									</div>
								</div>
								<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</div>
							<!-- 如果需要分页器 -->
							<div class="swiper-pagination"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="con-wrap con-wrap5">
				<div class="container">
					<div class="row">
						<div class="col-xs-24">
							<div class="panel panel5">
								<div class="row">
									<div class="m-title">
										<div class="col-xs-5">
											<div>
												<h2>学员心声</h2>
											</div>
										</div>
										<div class="col-xs-19">
											<div class="m-title-content">
											</div>
										</div>
									</div>
								</div>
								<div class="row" id="c50">
										<?php if(is_array($voice) || $voice instanceof \think\Collection || $voice instanceof \think\Paginator): $i = 0; $__LIST__ = $voice;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
									<div class="col-xs-6">
										<div class="thumbnail thumbnail1">
											<div class="thumb-content-wrapper">
												<div class="thumb-imgs">
													<a href="/voice?id=<?php echo $v['aid']; ?>" target="_blank" class="see" role="button" data-id="<?php echo $n['aid']; ?>">
														<img class="lazy" src="<?php echo $v['litpic']; ?>" data-original='<?php echo $v['litpic']; ?>'
														 style=" width:282px; height:161px;" class="img-responsive" alt="<?php echo $v['title']; ?>" />
													</a>
												</div>
												<div class="thumb-models"></div>
												<div class="thumb-texts">
													<p class="m0 mb10 cwhite h60 oh"><?php echo mb_substr(strip_tags(htmlspecialchars_decode($v['content'])),0,40); ?></p>
													<p class="text-center"><a href="/voice?id=<?php echo $v['aid']; ?>" target="_blank" class="btn-study see" data-id="<?php echo $n['aid']; ?>">点击观看</a></p>
												</div>
											</div>
			
											<div class="caption row">
												<div class="col-xs-24 text-left">
													<h5>
														<a href="/voice?id=<?php echo $v['aid']; ?>" target="_blank" class="btn-link btn-link6" role="button">
															<?php echo $v['title']; ?>
														</a>
													</h5>
			
													<div class="row">
														<div class="col-xs-10">
														</div>
														<div class="col-xs-10 col-xs-offset-4">
															<div class="fw cgray6 text-right">
																<a class="btnlogin" href="/voice?id=<?php echo $v['aid']; ?>" target="_blank">免费观看</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>

			
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="container">
				<div class="row" style="padding-top: 15px;" id="banner_apply">

					<?php if(is_array($banner) || $banner instanceof \think\Collection || $banner instanceof \think\Paginator): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;if($b['pid'] == 9): ?>
					<div class="col-xs-6">
						<div class='ttimg'>
							<a <?php if($b['target'] ==1): ?>target="_blank"<?php endif; ?> href="<?php echo $b['links']; ?>" title="<?php echo $b['title']; ?>" style="display: block;width: 100%;">
								<img class='lazy' src="<?php echo $b['litpic']; ?>" alt="" style='display: block;margin: 0 auto;'>
							</a>
						</div>
					</div>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>

			</div>
		</div>
		<!--/首屏广告位-->

		<div class="con-wrap con-wrap5">
			<div class="container">
				<div class="row">
					<div class="col-xs-24">
						<div class="panel panel5">
							<div class="row">
								<div class="m-title">
									<div class="col-xs-5">
										<div>
											<h2>热门课程 </h2>
										</div>
									</div>
									<div class="col-xs-19">
										<div class="m-title-content">
											<ul>
												<li data-id="c50" class="on"><a class="btn-nav-link btn-nav-link6" href="javascript:">新课上架</a></li>
									<!-- 			<li data-id="c51"><a class="btn-nav-link btn-nav-link6" href="javascript:">直播课程表</a></li> -->
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="row" id="c50">
								<?php if(is_array($newCourse) || $newCourse instanceof \think\Collection || $newCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $newCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$n): $mod = ($i % 2 );++$i;?>

								<div class="col-xs-6">
									<div class="thumbnail thumbnail1">
										<div class="thumb-content-wrapper" data-url="/course_show?id=<?php echo $n['aid']; ?>">
											<div class="thumb-imgs">
												<a href="/course_show?id=<?php echo $n['aid']; ?>" class="see" role="button" data-id="<?php echo $n['aid']; ?>">
													<img class="lazy" src="<?php echo $n['litpic']; ?>" data-original='<?php echo $n['litpic']; ?>'
													 style=" width:282px; height:161px;" class="img-responsive" alt="" />
												</a>
											</div>
											<div class="thumb-models"></div>
											<div class="thumb-texts">
												<p class="m0 mb10 cwhite h60 oh"></p>
												<p class="text-center"><a href="/course_show?id=<?php echo $n['aid']; ?>" class="btn-study see" data-id="<?php echo $n['aid']; ?>">点击学习</a></p>
											</div>
										</div>

										<div class="caption row">
											<div class="col-xs-24 text-left">
												<h5>
													<a href="/course_show?id=<?php echo $n['aid']; ?>" class="btn-link btn-link6" role="button">
														<?php echo $n['title']; ?>
													</a>
												</h5>

												<div class="row">
													<div class="col-xs-10">
														<div class="">
															<a href="/course_show?id=<?php echo $n['aid']; ?>" class="btn-cblue500 see" data-id="<?php echo $n['aid']; ?>"> 更新至<?php echo $n['total']; ?>课时 </a>
														</div>
													</div>
													<div class="col-xs-10 col-xs-offset-4">
														<div class="fw cgray6 text-right">
															<?php if($n['is_free'] == '是'): ?>
																<a class="/course_show?id=<?php echo $n['aid']; ?>">免费试看</a>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>

							</div>
							<div class="row dn" id="c51">

<!-- 								<div class="col-xs-6">
									<div class="thumbnail thumbnail1">
										<div class="thumb-content-wrapper" data-url="https://live.daodaotv.com/watch/235064">
											<div class="thumb-imgs">
												<a href="https://live.daodaotv.com/watch/235064" class="see" role="button" data-id="737">
													<img src="https:///public/static/index/.jcpeixun.com/upload/api/2019/6/20190613165116545694.jpg" data-original="https:///public/static/index/.jcpeixun.com/upload/api/2019/6/20190613165116545694.jpg"
													 style=" width:280px; height:160px;" class="img-responsive lazy" alt="" />
												</a>
											</div>
											<div class="thumb-models"></div>
											<div class="thumb-texts">
												<p class="m0 mb5 cwhite h60 oh">1. 初学者 2. 在校大学生 3. 毕业生 4. 工控行业工作者</p>
												<p class="text-center"><a href="https://live.daodaotv.com/watch/235064" class="btn-study see" data-id="737">点击学习</a></p>
											</div>
										</div>

										<div class="caption row">
											<div class="col-xs-24 text-left">

												<h5>
													<a href="https://live.daodaotv.com/watch/235064" class="btn-link btn-link6 see" role="button" data-id="737">
														ABB机器人工作站模拟仿真搬运案例
													</a>
												</h5>
												<div class="row">
													<div class="col-xs-10">
														<div class="cblue500 f14">
															10月30日19:30
														</div>
													</div>
													<div class="col-xs-10 col-xs-offset-4">
														<div class="fw cgray6 text-right"> 免费</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div> -->

							</div>
						</div>
						<!--/panel-->
					</div>
				</div>
			</div>
		</div>
		<!--/热门课程-->

		<div class="con-wrap con-wrap6">
			<div class="container">
				<div class="row">
					<div class="col-xs-24">
						<div class="panel panel6">
							<div class="row">
								<div class="m-title">
									<div class="col-xs-5">
										<div>
											<h2><?php echo $team['typename']; ?></h2>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-5">
									<div style="background-color: #E6E9ED;width:100%;height: 405px;margin-left: -5px;margin-top: -12px;" id="banner_video">
										<a href="<?php echo $team['typelink']; ?>" title="">
											<img class="lazy" src="<?php echo $team['litpic']; ?>" alt="<?php echo $team['seo_title']; ?>" width="240" height="420">
										</a>
									</div>
								</div>

								<div class="col-xs-19">
									<div class="row video_list" id="c60">
										<?php if(is_array($team['child']) || $team['child'] instanceof \think\Collection || $team['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $team['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tc): $mod = ($i % 2 );++$i;?>
										<div class="col-xs-6">
											<div class="thumbnail thumbnail2">
												<div class="thumb-content-wrapper" data-url="">
													<div class="thumb-imgs">
														<a href="javascript:;" role="button">
															<img class="img-responsive lazy" src="<?php echo $tc['litpic']; ?>" style=" width:230px; height: 185px;"  alt="<?php echo $tc['title']; ?>" /> 
														</a>
													</div>
													<div class="name"><?php echo $tc['title']; ?></div>
												</div>
											</div>
										</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							</div>
						</div>
						<!--/panel-->
					</div>
				</div>
			</div>
		</div>
		<!--/工控邦团队-->

				<div class="con-wrap con-wrap7" style="margin-bottom: 40px;">
			<div class="container">
				<div class="row">
					<div class="col-xs-24">
						<div class="panel panel6">
							<div class="row">
								<div class="m-title">
									<div class="col-xs-5">
										<div>
											<h2><?php echo $totor['typename']; ?></h2>
										</div>
									</div>
									<div class="col-xs-19">
										<div class="m-title-content">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-5">
									<div style="background-color: #E6E9ED;width:100%;height: 390px;margin-left: -5px;margin-top: -12px;" id="banner_qianghua">
										<img class="lazy" src="<?php echo $totor['litpic']; ?>" alt="" width="240" height="420">
									</div>
								</div>

								<div class="col-xs-19">
									<div class="row kecheng_list" id="c71">

										<?php if(is_array($totor['child']) || $totor['child'] instanceof \think\Collection || $totor['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $totor['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tc): $mod = ($i % 2 );++$i;?>
										<div class="col-xs-6">
											<div class="thumbnail thumbnail2">
												<div class="thumb-content-wrapper" data-url="">
													<div class="thumb-imgs">
														<a  href="javascript:;" class="" role="button">
															<img class="lazy" src="<?php echo $tc['litpic']; ?>" style="width:219px; height:140px;" class="img-responsive" alt="" />
														</a>
													</div>
													<div class="thumb-models3" style="text-align: center;margin: 0 auto;padding: 10px;"></div>
													<div class="thumb-texts3" style="text-align: center;margin: 0 auto;width: 100%;">
														<img src="/public/static/index/picture/qrcode.png" style="width: 60%;" >
													</div>
												</div>
												<div class="caption row">
													<div class="col-xs-24 text-left">
														<h5 class="mt5 h15 oh">
															<a href="" target="_index" class="btn-link btn-link6" role="button" id="423"><?php echo $tc['title']; ?></a>
														</h5>
													</div>
												</div>
											</div>
										</div>
										<?php endforeach; endif; else: echo "" ;endif; ?>
										

									</div>

								
								</div>
							</div>
							<!--/panel-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/导师-->

		<div class="con-wrap con-wrap7" style="margin-bottom: 40px;">
			<div class="container">
				<div class="row">
					<div class="col-xs-24">
						<div class="panel panel6">
							<div class="row">
								<div class="m-title">
									<div class="col-xs-5">
										<div>
											<h2>友情链接</h2>
										</div>
									</div>
									<div class="col-xs-19">
									</div>
								</div>
							</div>
		
							<div class="row">
								<div class="col-xs-24">
									<?php if(is_array($linkData) || $linkData instanceof \think\Collection || $linkData instanceof \think\Paginator): $i = 0; $__LIST__ = $linkData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ld): $mod = ($i % 2 );++$i;?>
									<a href="<?php echo $ld['url']; ?>" <?php if($ld['target']==1): ?>target="_blank"<?php endif; ?> title="<?php echo $ld['title']; ?>">
									<div class="col-xs-4">
										<img src="<?php echo $ld['logo']; ?>" title="<?php echo $ld['title']; ?>" >
									</div>
									</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/友情链接-->
		<!--/footer-->
		<style type="text/css">
			
			.fixed-top{
				position: fixed;
    			right: 0;
			}
			

		</style>


		
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

		<script type="text/javascript" src="/public/static/index/js/jquery.fancybox.js"></script>
		<script src="/public/static/index/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="/public/static/index/js/tools.v1.js" type="text/javascript"></script>
		<script src="/public/static/index/js/swiper/js/swiper.min.js" type="text/javascript"></script>
		<script src="/public/static/index/js/index.js" type="text/javascript"></script>
		<!-- 上课提醒弹窗 -->
		<script src="/public/static/index/js/template.js"></script>

		<script>
			//关闭对应的弹窗
			$(".shut,.closes").click(function() {
				$('.' + $(this).attr("data-name")).fadeOut();
			});

			//扩大点击课程的范围
			$(".thumb-content-wrapper").hover(function(e) {
				e.preventDefault();
				// $(this).click(function() {
				// 	0.
				// 	var _url = $(this).attr("data-url");
				// 	window.location.href = _url;
				// });
			});
			
			// 轮播图
			var mySwiper = new Swiper ('.swiper-container', {
				direction: 'horizontal', // 垂直切换选项
				loop: true, // 循环模式选项
				autoplay: true,
				
				// 如果需要分页器
				pagination: {
				  el: '.swiper-pagination',
				},
			})      
		</script>
