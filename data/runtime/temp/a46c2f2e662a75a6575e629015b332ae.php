<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:73:"D:\phpStudy\PHPTutorial\WWW\video/application/index\view\member\index.htm";i:1573798896;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\search.htm";i:1573528354;s:70:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\haslogged.htm";i:1573701866;s:67:"D:\phpStudy\PHPTutorial\WWW\video\application\index\view\footer.htm";i:1573700791;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>个人中心</title>
		<link rel="stylesheet" href="/public/static/index/css/lesson/reset.css" />
		<link rel="stylesheet" href="/public/static/index/css/iconfont.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/basic.css" />
		<link rel="stylesheet" href="/public/static/index/css/lesson/style.css" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/lesson/jquery.fancybox.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/public.css"/>
		<script src="/public/static/index/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		
		

	</head>
	<body>
		<div class="wrap" id="mine">
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
		<!-- 			<div style="clear: both;"></div> -->
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
				<div class="inner contents mt20">
					<div class="centerLeft">
						<ul class="leftMenu clearfix">
							<li class="active" data-name="zw_1">
								<a href="javascript:">我的首页</a>
							</li>
							<li class="" data-name="zw_2">
								<a href="javascript:" >学习记录</a>
							</li>
							<li class="" data-name="zw_3">
								<a href="javascript:">订单中心</a>
							</li>
							<li class="" data-name="zw_4">
								<a href="javascript:">账户设置</a>
							</li>
					<!-- 		<li class="" data-name="zw_5">
								<a href="javascript:">意见反馈</a>
							</li> -->
							<li class="" data-name="zw_6">
								<a href="javascript:">购买的课程</a>
							</li>
						</ul>
					</div>
					<!-- 我的首页 -->
					<div class="centerRight" id="zw_1" style="display: block;">
						<div class="p_info">
							<div class="avatar">
								<img src="<?php echo $userData['head_pic']; ?>">
							</div>
							<div class="infos">
								<h3 class="nickname"><?php echo $userData['username']; ?></h3>
								<span>注册时间：<?php echo date('Y-m-d',$userData['reg_time']); ?></span>
								<p><span><?php echo $userData['mobile']; ?></span><!-- &nbsp;|&nbsp;<a href="javascript:">修改</a> --></p>
								<p><span>我的收藏：</span><a href="javascript:"><?php echo $memberData['collect_count']; ?>个</a></p>
							</div>
						</div>
						<!-- 最近学习记录 -->
						<div class="record">
							<h3>最近学习记录</h3>
							<ul>
								<?php if(is_array($memberData['Learn']) || $memberData['Learn'] instanceof \think\Collection || $memberData['Learn'] instanceof \think\Paginator): $k = 0; $__LIST__ = $memberData['Learn'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ml): $mod = ($k % 2 );++$k;if($k < 4): ?>

									<li>
										<div class="kc_img">
											<a href="/course_show?id=<?php echo $ml['aid']; ?>">
												<img width="260" height="150" src="<?php echo $ml['litpic']; ?>" >
											</a>
										</div>
										<div class="kc_text">
											<div class="title"><?php echo $ml['title']; ?></div>
											<div class="class_hour">
												<span>课时：<?php echo $ml['hours']; ?></span>
												<span>更新至：<?php echo $ml['count']; ?>课时</span>
											</div>
										</div>
									</li>
									<?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>
					
					<!-- 学习记录 -->
					<div class="centerRight" id="zw_2" style="display: none;">
						<ul class="recordTitle">
							<li class="on" data-id="1"><a href="javascript:">学习记录</a></li>
							<li data-id="2"><a href="javascript:">收藏的课程</a></li>
						</ul>
						<!-- 学习记录列表 -->
						<div class="record record1" id="record1">
							

						</div>
						
						<!-- 我的收藏 -->
						<div class="record record1" id="record2" style="display: none;">
	
						</div>
					</div>
				
					<!-- 订单中心 -->
					<div class="centerRight" id="zw_3" style="display: none;" >
						<ul class="orderTitle">
							<li class="on" data-id="1"><a href="javascript:">全部订单</a></li>
							<li data-id="2"><a href="javascript:">待支付</a></li>
							<li data-id="3"><a href="javascript:">交易成功</a></li>
							<li data-id="4"><a href="javascript:">交易关闭</a></li>
						</ul>
						<div class="orderList" id="order1">
							<ul>
	
							</ul>
							<!-- 分页 -->
							<div class="pages">
								
							</div>
						</div>
						<div class="orderList" id="order2" style="display: none;">
							<ul>
	
							</ul>
							<!-- 分页 -->
							<div class="pages">
								
							</div>
						</div>
						<div class="orderList" id="order3" style="display: none;">
							<ul>
			
							</ul>
							<!-- 分页 -->
							<div class="pages">
								
							</div>
						</div>
						<div class="orderList" id="order4" style="display: none;">
							<ul>
	<!-- 							<li>
									<div class="kc_img">
										<a href="course_show.html">
											<img src="/public/static/index/picture/20190827093206582.jpg" >
										</a>
									</div>
									<div class="kc_text">
										<div class="title">变频器、伺服和步进驱动技术应用变频器、伺服和步进驱动技术应用</div>
										<div class="class_hour">
											<span>课程有效时长：365天</span>
											<span>总课时：45个</span>
										</div>
										<div class="box">
											<div class="price">
												<span class="jin">￥299</span>
												<span class="old">￥399</span>
											</div>
											<div class="status">交易关闭</div>
										</div>
									</div>
								</li> -->
							</ul>
							<!-- 分页 -->
							<div class="pages">
								
							</div>
						</div>
					</div>
					
					<!-- 账户设置 -->
					<div class="centerRight" id="zw_4" style="display: none;">
						<ul class="recordTitle" style="margin-bottom: 20px;">
							<li class="on" data-id="1"><a href="javascript:">基本信息</a></li>
							<li class="" data-id="2"><a href="javascript:">修改密码</a></li>
							<li class="" data-id="3"><a href="javascript:">修改手机号</a></li>
						</ul>
						<div class="information set_up" id="set1" style="display: block;">
							<form action="" method="" id="info">
								<div class="avatars">
									<label>头像：</label>
									<input type="file" name="head_pic" id="upload" style="display: none;">
									<input type="hidden" name="head_pic" class="head_pic" value="<?php echo $userData['head_pic']; ?>">
									<img src="<?php echo $userData['head_pic']; ?>" id="avatars_pic" >
								</div>
								<div class="">
									<label>用户名：</label>
									<input type="text" name="username" id="" value="<?php echo $userData['username']; ?>" />
								</div>
								<div class="">
									<label>用户昵称：</label>
									<input type="text" name="nickname" id="" value="<?php echo $userData['nickname']; ?>" />
								</div>
<!-- 								<div class="">
									<label>性别：</label>
									<input type="radio" name="sex" id="" checked /><span>男</span>
									<input type="radio" name="sex" id="" /><span>女</span>
								</div> -->
	<!-- 							<div class="">
									<label>生日：</label>
									<input type="date" name="" id="" value="" />
								</div> -->
		<!-- 						<div class="">
									<label>QQ：</label>
									<input type="text" name="" id="" value="" />
								</div> -->
								<div class="">
									<label>邮箱：</label>
									<input type="text" name="email" id="" value="<?php echo $userData['email']; ?>" />
								</div>
						<!-- 		<div class="">
									<label>单位名称：</label>
									<input type="text" name="" id="" value="" />
								</div> -->
								<div>
									<input type="submit" id="btn" name="" value="提交" />
								</div>
							</form>
						</div>
						
						<script type="text/javascript" src="/public/plugins/layui/layui.js"></script>
						<script type="text/javascript">
							layui.use('upload', function(){
							  var upload = layui.upload;
							  //执行实例
							  var uploadInst = upload.render({
							    elem: '#upload' //绑定元素
							    ,url: '<?php echo url("index/member/pic"); ?>' //上传接口
							    ,choose: function(obj){
								    //将每次选择的文件追加到文件队列
								    var files = obj.pushFile();

								  },done: function(res){
								  	if(res.code == 1){
								  		$('.head_pic').val(res.src);
								  	}else{
								  		alert(res.info);
								  	}


															      //上传完毕回调
							    }
							    ,error: function(){
							      //请求异常回调
							    }
							  });
							});


						</script>
						<div class="update_pwd set_up" id="set2" style="display: none;">
							<form action="" method="" id="info1">
								<div class="">
									<label>旧密码：</label>
									<input type="password" name="oldpass" id="" value="" />
								</div>
								<div class="">
									<label>新密码：</label>
									<input type="password" name="password" id="" value="" />
								</div>
								<div class="">
									<label>确认密码：</label>
									<input type="password" name="sub_password" id="" value="" />
								</div>
								<div class="">
									<input type="submit" id="btn1" name="" value="保存" />
								</div>
							</form>
						</div>
						
						<div class="update_tel set_up" id="set3" style="display: none;">
							<form action="" method="">
								<div class="">
									<label>当前号码：</label>
									<input type="text" name="" id="mobile" value="<?php echo $userData['mobile']; ?>" disabled />
								</div>
								<div class="">
									<label>新号码：</label>
									<input type="text" name="" id="newmobile" value="" />
								</div>
								<div class="">
									<label>验证码：</label>
									<p>
										<input type="text" name="" id="code" value="" />
										<a href="javascript:" class="get_code" id="get_code" style="color: #09f;">获取验证码</a>
									</p>
								</div>
								<div class="">
									<input type="submit" id="bnt3" name="" value="立即修改" />
								</div>
							</form>
						</div>
						
					</div>
					
					<!-- 意见反馈 -->
					<div class="centerRight" id="zw_5" style="display: none;">
						<div class="title">
							<h3>意见反馈</h3>
						</div>
						<div class="record">
							<form action="" method="">
								<div class="">
									<label>内容：</label>
									<textarea></textarea>
								</div>
								<div class="">
									<label>手机号码：</label>
									<input type="text" name="" id="" value="" />
								</div>
								<div class="">
									<input type="submit" id="" name="" value="保存" />
									<input type="button" id="" name="" value="返回" />
								</div>
							</form>
						</div>
					</div>
					<!-- 购买的课程 -->
					<div class="centerRight" id="zw_6" style="display: none;">
						<div class="title">
							<h3>已购买的课程</h3>
						</div>
						<div class="record orderList" id="bought_course">
							<ul>
								<li>
									<div class="kc_img">
										<a href="course_show.html">
											<img src="/public/static/index/picture/20190827093206582.jpg" >
										</a>
									</div>
									<div class="kc_text">
										<div class="title">变频器、伺服和步进驱动技术应用</div>
										<div class="class_hour">
											<span>课程有效时长：365天</span>
											<span>总课时：45个</span>
										</div>
										<div class="box">
											<div class="price">
												<span class="jin">￥399</span>
												<span class="old">￥399</span>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="kc_img">
										<a href="course_show.html">
											<img src="/public/static/index/picture/20190827093206582.jpg" >
										</a>
									</div>
									<div class="kc_text">
										<div class="title">变频器、伺服和步进驱动技术应用变频器、伺服和步进驱动技术应用</div>
										<div class="class_hour">
											<span>课程有效时长：365天</span>
											<span>总课时：45个</span>
										</div>
										<div class="box">
											<div class="price">
												<span class="jin">￥299</span>
												<span class="old">￥399</span>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<!-- 分页 -->
							<div class="pages">
								
							</div>
						</div>
					</div>
					
				</div>
				
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

		
		<script src="/public/static/index/js/mine.js" type="text/javascript" charset="utf-8"></script>

	</body>
</html>

