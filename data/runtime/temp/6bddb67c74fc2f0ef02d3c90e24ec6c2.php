<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\wwwroot\www.gkbplc.com/application/index\view\login\login.htm";i:1574212473;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="chrome=1">
	    <meta name="renderer" content="webkit">
		<title>欢迎来到登录页+注册页_工空邦</title>
		<meta name="baidu-site-verification" content="Zztanq9tV5"/>
	    <meta name="keywords" content=""/>
	    <meta name="descriprtion" content=""/>
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link href="<?php echo $web_config['web_basehost']; ?>" rel="shortcut icon" />
		<link type="text/css" href="/public/static/index/css/automail.css" rel="stylesheet" media="all" />
		<link rel="stylesheet" href="/public/static/index/css/commons.css" />
		<link rel="stylesheet" href="/public/static/index/css/fix.css" />
		<link rel="stylesheet" href="/public/static/index/css/bootstrap.3.0.min.css">
		<style type="text/css">
			.container{width: 870px!important;}
			#mailBox{top: 180px!important;left: 100px!important;width: 240px!important;}
			.f18{font-size: 18px;font-weight: normal;}
			h3{margin-bottom: 0!important;margin-top: 0!important;}	
	        .register_forms .tips {height: 25px;line-height: 25px;text-indent: 90px;}
	        .dialog {display: none;width: 100%;height: 100%;z-index: 999;position: fixed;background: rgba(0,0,0,.3);}
			.dialog-content {width: 340px;height: 475px;background: #fff;position: fixed;border-radius: 6px;box-shadow: 0 0 3px 3px rgba(0,0,0,.2);top: 0;left: 0;right: 0;bottom: 0;margin: auto;z-index: 666;text-align: center;}
			.dialog .top-btn {width: 340px;height: 120px;background: url(/public/static/index/images/top.jpg);background-repeat: no-repeat;position: relative;}
			.dialog .close-btn {display: block;position: absolute;top: 0;right: 0;background:#fff;width:30px;height:30px;border-radius: 30px;color: #3589d2;text-align: center;line-height: 30px;cursor: pointer;font-size: 22px;margin-top: 0;}
	
	        .dialog .row span{display: block;font-size: 16px;color:#666666;line-height: 30px;}
	        .dialog .content{width: 340px;}
	        .dialog .content table{width: 300px;height: 210px;margin: auto;}
	        .dialog .jump{display: block;width: 120px;margin-top: 40px;margin: 30px auto;font-size: 14px;text-decoration: none;color: #83878A;}
	        .dialog .jump:hover{color: #2495C7;}
			.row {margin-left: 0; margin-right: 0; }
	        .verifycode .dialog-content{padding: 30px 0;height: 280px;}
	        .verifycode-line{ border: 1px solid #e6e6e6;width: 80%;    margin: 0 auto;    text-align: left;}
	        .verifycode-line img{border-right: 1px solid #e6e6e6;width: auto;display: block;}
	        .verifycode-change{width: 80%;margin: 0 auto;text-align: left;}
	        .verifycode-change a{font-size: 12px;color: #4FC1E9;}
	        .verifycode-ipt{height: 40px; border: 0px; width: 145px; font-size: 16px; display: block; float: right; margin-top: -40px; margin-right: 0px; padding-left: 5px;} .verifycode-btn{color: #fff;width: 120px;display: block; margin: 0 auto; font-size: 16px; height: 36px; line-height: 36px; padding: 0;background: -ms-linear-gradient(top, #1896ed, #114f9a); background: -webkit-gradient(linear, 0% 0%, 0% 100%,from(#1896ed), to(#114f9a)); background: -moz-linear-gradient(top,#1896ed,#ffa92b); background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#1896ed), to(#114f9a)); background: -o-linear-gradient(top, #1896ed, #114f9a); FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=0,startColorStr=#1896ed,endColorStr=#114f9a);}
	        .verifycode-tips{height: 30px;}
			
			
            /*提示*/
	        .toast{
			    position: fixed;
			    top: 50%;
			    left: 42%;
			    border-radius: 5px;
			    background: rgba(0,0,0,.8);
			    width: 200px;
			    padding: 10px 5px;
			    margin-left: auto;
			    margin-right: auto;
			    margin-top: auto;
			    margin-bottom: auto;
			    z-index: 9999999999999;
			}
			.text-center {
			    text-align: center;
			}
			.color-f {
			    color: #fff;
			}
			.f14{
			    font-size: 14px;
			}
			b {
			    font-weight: 400;
			}
	        
			/*兴趣选择弹窗*/
			.wk__own__dialog{width:100%;height:100%;position:fixed;left:0;top:0;margin:0 auto;background:none;z-index:10000000;display: none;}
			.wk__own__dialog .dialog__mask{width:100%;height:100%;background-color:rgba(0,0,0,.5);}
			.wk__own__dialog .dialog__area{position:fixed;top:0px;left:0;right:0;bottom:0;margin:auto;width:960px;height:560px;background:#fff;border-radius:5px;}
			.wk__own__dialog .dialog__area .closes{display:block;font-size:22px;color:#fff;font-weight:lighter;position:absolute;right:-30px;top:0px;opacity:.5;border:1px solid #fff;border-radius:100%;width:24px;height:24px;line-height:24px;text-align:center;}
			.wk__own__dialog .dialog__header{background:#fff;padding:50px 50px 30px 50px;text-align:left;border-radius:5px;}
			.wk__own__dialog .dialog__header .title{font-size:30px;color:#188EEE;}
			.wk__own__dialog .dialog_content{padding:0 50px;}
			.wk__own__dialog .dialog_content .tabbox{float:left;width:48%;margin:5px;height:130px;}
			.wk__own__dialog .dialog_content .tabbox .title{font-size:24px;color:#333444;text-align:left;margin-left:12px;}
			.wk__own__dialog .dialog_content .tabbox ul li{float:left;width:30%;text-align:center;margin:5px;position: relative;}
			.wk__own__dialog .dialog_content .tabbox ul li label{display:block;font-size:14px;color:#666777;height:30px;line-height:30px;}
			.tabbox ul li input{
				display: block;
			    position: absolute;
			    top: 7px;
			}
			.tabbox ul li span{
				display: block;
			    position: absolute;
			    left: 30px;
			}
			.wk__own__dialog .btn_group{
				width: 100%;
				margin: 0 auto;
			}
			.wk__own__dialog .reset_btn{display: inline-block;width:120px;height:36px;line-height:36px;text-align:center;background:linear-gradient(270deg,rgba(0,141,255,1) 0%,rgba(47,186,255,1) 100%);box-shadow:0px 3px 9px rgba(24,142,238,0.3);color:#fff;margin-top:80px;cursor:pointer;position: absolute;left: 35%;}
			.wk__own__dialog .change_btn{display: inline-block;width:120px;height:36px;line-height:36px;text-align:center;background:linear-gradient(270deg,rgba(0,141,255,1) 0%,rgba(47,186,255,1) 100%);box-shadow:0px 3px 9px rgba(24,142,238,0.3);color:#fff;margin-top:80px;cursor:pointer;position: absolute;right: 35%;}
			
			
			.wk__own__dialog input[type="checkbox"]{width: 16px;height: 16px;text-align: center;vertical-align: middle; line-height: 15px!important;}
			.wk__own__dialog input[type="checkbox"]::before{content: "";position: absolute;top: 0;left: 0;background: #fff;width: 100%;height: 100%;border: 1px solid #d9d9d9}
			.wk__own__dialog input[type="checkbox"]:checked::before{content: "\2713";background-color: #fff;position: absolute;top: 0;left: 0;width:100%;border: 1px solid #188EEE;color: #188EEE;font-size: 16px;font-weight: bold;}
    	</style>

	</head>
	<body>
 
		
		<!--安全验证-->
	    <div class="dialog verifycode" id="verifycode">
         	<div class="dialog-content">
             	<div><h3 class="top-btns close-btn">×</h3></div>
	             <div class="row lh24">
	                <h3 class="f18">安全验证：</h3><br>
	                <p style="padding-bottom: 10px;">请您输入验证码</p>
	                <div  class="verifycode-line">
	                    <img id="verifycode-img" src="<?php echo url('Admin/Admin/vertify'); ?>" style="width: 120px;" />
	                    <input type="text" autocomplete="off"  class="verifycode-ipt" id="verifycode-ipt" placeholder="输入左侧验证码" onkeyup="toUpperCase(this)"/>
	                </div>
	                <div class="verifycode-change" >
	                    <a href="javascript:;" id="verifycode-chang" onclick="fleshVerify()">看不清？换一张</a>
	                </div>
	                <br>
	                <div id="verifycode-tips" class="verifycode-tips cred"></div>
	                <a href="javascript:;" id="verifycode-btn" class="verifycode-btn pubtn_in" style="color:#fff;">验&nbsp;&nbsp;&nbsp;证</a>
	            </div>
         	</div>
    	</div>
    	<input type="hidden" id="domain" value=".jcpeixun.com">
    	<!--头部-->
		<header>
			<section class="global_nav">
				<div class="nav">
                    <a href="/" title="<?php echo $web_config['web_name']; ?>" class="logo">
                    	<img src="<?php echo $web_config['web_logo']; ?>" alt="" />
                    </a>
                </div>
			</section>
		</header>
		<!--banner-->
		<div class="container-fluid banner-bg">
			<div class="container">
				<div class="content-box">
					<div class="tab-content">
						<ul id="tabs">
							<li class="tab" id="tab_login">
								<a href="javascript:;">
									<span class="change_name">登录</span>
									<em class="line"></em>
								</a>
							</li>
							<li class="tab current" id="tab_register">
								<a href="javascript:;">
									<span class="change_name">注册</span>
									<em class="line"></em>
								</a>
							<!-- 	<div class="drop">
									<i>注册即得工控视频与资料下载</i>
									<div class="drops"></div>
								</div> -->
							</li>
						</ul>
						<div class="clear"></div>
					</div>
					<div id="changebar-box">
						<!--登录窗口-->
						<div class="tabbox" id="login_tabbox" style="display: none;">
							<!--账号登录-->
							<div class="login_forms" id="account" style="display: none;">
								<div class="login_box">
									<form id="loginForm" method="post" action="/login">
						            <!-- 	<input type="hidden" id="checkLoginURL" value="/ajax/verificationLogin" > -->
            							<input type="hidden" id="token" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>">
					            		<p class="title">账号登录</p>
						            	<!--账号-->
						            	<div class="group">
						            		<input type="text" id="uname" name="uname" class="txt_gray3-260-30" placeholder="请输入用户名/邮箱/手机号" maxlength="40" />
							                <input type="hidden"  name="callback" value="<?php echo $web_config['web_basehost']; ?>" />
							                <i class="titles">账户号</i>
						            	</div>
						            	<div class="tips">
						            		<label for="uname" id="n_tips">&nbsp;</label>
						            	</div>
						            	<!--密码-->
						            	<div class="group">
						            		<input type="password" id="upwd" name="upwd" class="txt_gray3-260-30" placeholder="6位以上字母、数字或符号"/>
						            		<i class="titles">密码</i>
						            	</div>
						            	<div class="tips">
						            		<label for="upwd" id="p_tips">&nbsp;</label>
						            	</div>
						            	<div class="group" style="line-height: 0;height: 20px;">
						            		<!-- <input type="checkbox" checked="checked" tabindex="4" id="jizhu" name="jizhu" value="1" />
						            		<label for="jizhu">记住账号</label> -->
						               <!--      <a href="http://www.jcpeixun.com/forgotpw/find_pwd1.aspx" target="_blank" class="f14 forget">忘记密码？</a> -->
						            	</div>
						            	<div class="group" id="btns1">
						            		<a class="pubtn_in" href="javascript:;" id="login">立即登录</a>
						            	</div>
						            	<div class="group btns2" id="btns2" style="display: none;">正在登录，请稍候...<b></b></div>
				<!-- 		            	<div class="group" style="text-align:center;position: relative;width: 260px;margin: 0 auto;">
						            		<div style="border-bottom: 1px solid #eee;height: 1px;width: 100%;margin-top: 40px;">
					                        	<span style="position: relative;top: -20px;background: #fff;padding: 6px 10px;font-size: 16px;">快捷登陆</span>
					                        </div>
					                        <div style="margin-top:22px;">
					                        	<a href="javascript:;" style="display: inline-block;" class="wx">
					                        		<img src="/public/static/index/picture/wx.png" alt="" />
					                        		<span style="font-size: 16px;color: #999AAA;">微信登录</span>
					                        	</a>
					                        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					                        	<a href="https://app.jcpeixun.com/oauth/qq/qq_login?callback=http%3a%2f%2fpassport.jcpeixun.com%2fjoin" target="_blank">
					                        		<img src="/public/static/index/picture/qq.png" alt="" />
					                        		<span style="font-size: 16px;color: #999AAA;">QQ登录</span>
					                        	</a>
					                        </div>
						            	</div> -->
					            	</form>
								</div>
							</div>
							<!--快捷方式登录-->
							<div id="shortcut" style="display: block;">
								<!--<p class="title"><img src="/public/static/index/picture/wx.png" alt="" style="width: auto;"/><span>微信扫码登录</span></p>
								<em>微信扫码即可登录</em>-->
					<!-- 			<iframe src="https://app.jcpeixun.com/oauth/wechat/wechat_login?callback=http%3a%2f%2fpassport.jcpeixun.com%2fjoin" width="360px" height="420px" style="border: none;">
								</iframe> -->
								<div class="quick_away">
		                        	<a href="javascript:;" class="login_way_count">
		                        		<img src="/public/static/index/picture/shortcut2.png" alt="" style="width: auto;"/>
		                        		<span style="font-size: 16px;color: #999AAA;">账号登录</span>
		                        	</a>
		                        	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		                        	<a href="https://app.jcpeixun.com/oauth/qq/qq_login?callback=http%3a%2f%2fpassport.jcpeixun.com%2fjoin" target="_blank">
		                        		<img src="/public/static/index/picture/qq.png" alt="" style="width: auto;"/>
		                        		<span style="font-size: 16px;color: #999AAA;">QQ登录</span>
		                        	</a>
		                        </div>
							</div>
							<div class="gift">
								<?php if(!empty($ad)){ ?>

									<img src="<?php echo $ad['litpic']; ?>" alt="<?php echo $ad['title']; ?>" class="img"/>
									
									<?php }; ?>
							</div>
						</div>
						<!--注册窗口-->
						<div class="tabbox" style="display: block;" id="register_tabbox">
							<div class="register_forms" id="reg_form">
								<div class="register_box">
									<form id="regForm" method="post" action="" enctype="multipart/form-data" autocomplete="off">
										<input type="hidden" name="vipexp" id="vipexp" value="">
                 						<input type="hidden" name="imageCode" id="imageCode" value="" />
                 						<input type="hidden" id="token" name="token" value="<?php echo \think\Request::instance()->token(); ?>">
										<p class="title">注册账号</p>
										<!--用户姓名-->
								<!-- 		<div class="groups">
											<input type="text" id="utrueName" name="utrueName" class="reg_txt txt_gray3-260-30" title="您的用户名，例如：王先生/女士" placeholder="您的用户名，例如：王先生/女士" maxlength="10" />
											<i class="titles">用户名</i>
										</div> -->
										<div class="tips">
											<label for="utrueName" id="utrueName_tips"></label>
										</div>
										<!--QQ邮箱-->
										<div class="groups">
											<input type="text" id="uEmail" name="uEmail" class="reg_txt txt_gray3-260-30" title="使用QQ邮箱" placeholder="使用QQ邮箱"  autocomplete="off" data-autocomplete="on"/>
											<i class="titles">QQ邮箱</i>
										</div>
										<div class="tips">
											 <label for="uEmail" id="e_tips">&nbsp;</label>
										</div>
										<!--密码-->
										<div class="groups">
											<input type="password" style="display: none;">
				                            <input type="text" id="uPwd" name="uPwd" class="reg_txt txt_gray3-260-30" autocomplete="off" placeholder="6位以上字母、数字或符号"/>
				                            <input type="hidden" name="uclass" id="uclass" value="" />
                            				<input type="hidden" name="callback" id="callback" value="http://passport.jcpeixun.com/join" />
                            				<input type="hidden" name="landPage" id="landPage" value="http://passport.jcpeixun.com/join" />
                            				<input type="hidden" name="ulinkuserid" id="ulinkuserid" value="" />
											<i class="titles">密码</i>
										</div>
										<div class="tips">
											<label for="uPwd" id="w_tips">&nbsp;</label>
										</div>
										<!--手机号码-->
										<div class="groups">
											<input type="tel" id="umobile" name="umobile" maxlength="11" class="reg_txt txt_gray3-260-30" title="手机号码" placeholder="请输入您的手机号码" onkeyup="value=value.replace(/[^\d]/g,'') " onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" />
											<i class="titles">手机号</i>
										</div>
										<div class="tips">
											<label for="umobile" id="m_tips">&nbsp;</label>
										</div>
										<!--验证码-->
										<div class="groups">
											<input type="text" name="validateCode" id="validateCode" class="reg_txt txt_gray3-260-30" style="width: 238px;padding-left: 15px;" placeholder="请输入短信验证码" />
			                                <input type="hidden" name="va" value="1" />
											<button type="button" id="sendCode" data_tips="获取验证码" class="mt5 sendCode"  rel="sms-encrypt-data"  rel-formobile="umobile">获取验证码</button>
											<strong id="sendedCode-tips" style="display:none;">短信已发送</strong>
										</div>
										<div class="tips">
											<p for="ucode" id="Code">&nbsp;<label id="cdown_tips" class="cdown_tips" style="display: none;">120秒后才能再发送</label>&nbsp;</p>
										</div>
										<!--同意用户条款-->
										<div class="single">
											<input type="checkbox" id="agreement" checked="checked" class="clear"/>
											<label for="agreement" class="agreement"><a href="javascript:;" class="f14" >我已授权工控邦向本人推荐课程通知服务</a></label>
											<input type="checkbox" id="agree" checked="checked" class="clear" style="margin-top: 15px;"/>
                            				<label for="agree" class="agree">我同意并遵守<a href="javascript:;" class="f14">《工控邦培训网用户条款》</a></label>
										</div>
										<!--注册按钮-->
										<div class="btns" id="btns">
											<span class="pubtn">
												<i class="btn_l1"></i>
												<a class="pubtn_in" href="javascript:" id="register">
													<span class="pubtn_bg">立即注册</span>
												</a>
												<i class="btn_l2"></i>
											</span>
										</div>
										<div class="btns2" id="btns2" style="display: none;">正在注册，请稍候<b>...</b></div>
                                        <div style="display: none;" class="stitchingCourse"></div>
										<input type="hidden" name="learnerId_recommend" id="learnerId_recommend" value="0" />
                						<input type="hidden" name="gettype" id="gettype" value="getpassword" />
                						<input type="hidden" name="csrf" id="csrf" value="" />
                						<input type="hidden" id="tid" name="tid" value=""/>
                						<input type="hidden" id="paraurl" name="paraurl" value=""/>
										
									</form>
								</div>
							</div>
							<div class="gift">
									<?php if(!empty($ad)){ ?>

									<img src="<?php echo $ad['litpic']; ?>" alt="<?php echo $ad['title']; ?>" class="img"/>
									
									<?php }; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<!-- 		<footer>
		    <div class="constrain">
		        <p><?php echo $web_config['web_copyright']; ?></p>
		    </div>
		</footer> -->
		<input type="hidden" id="flow-version" value="A" />
		
    	<script type="text/javascript" src="/public/static/index/js/jquery-1.8.2.min.js"></script>
	    <script>
	        var smsEncryptToken = {};
		</script>
		<script src="/public/static/index/js/bm2017.min.js"></script>
	    <script type="text/javascript" src="/public/static/index/js/auto_add_email.js"></script>
	    <script type="text/javascript" src="/public/static/index/js/register_v2019.js"></script>
	    <script type="text/javascript" src="/public/static/index/js/login_v2019.js"></script>
	    <script type="text/javascript" src="/public/static/index/js/login.util.js"></script>

	    <script>
	    	
	    	function fleshVerify(){
                var src = "<?php echo url('Admin/Admin/vertify'); ?>";
                if (src.indexOf('?') > -1) {
                    src += '&';
                } else {
                    src += '?';
                }
                src += 'r='+Math.floor(Math.random()*100);
                $('#verifycode-img').attr('src', src);//重载验证码
            }


	       var stoken = '8700FC398F5A39C38D6B316E00EFE8C45960AD12';
	       var uname = '';
	        
	       function GetRequest() { 
				var url = location.search; //获取url中"?"符后的字串 
				var theRequest = new Object(); 
				if (url.indexOf("?") != -1) { 
					var str = url.substr(1); 
					strs = str.split("&"); 
					for(var i = 0; i < strs.length; i ++) { 
						theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]); 
					} 
				} 
				return theRequest; 
			} 
			var requestParam = GetRequest();
			var target=requestParam["target"];//区分是账号登录还是微信快捷方式登录
			
			var tab = requestParam["tab"];//tab=1就是登录界面，tab=2就是注册界面
			//展示账号登录
			if(target==1){
				$("#account").show();
	   			$("#shortcut").hide();
			}
				console.log(tab);																        
	        //根据旧页面传过来的tab来判断展示登录还是注册(tab==1展示登录界面，不传参数展示注册界面)
	        if(tab == 1){
	        //登录界面
	        	$("#login_tabbox").show();
				$("#account").show();
				$("#shortcut").hide();
				$("#register_tabbox").hide();
				$("#tab_login").addClass("current");
	        	$("#tab_register").removeClass("current");
	        }else
	        
			
	        
	        $(function () {
	            $("#uEmail,#uPwd").val("");
	        });
	        $(".close-btn").click(function() {
	            $(".dialog").hide();
	        });
			
			 //关闭对应的弹窗
			$(".shut,.closes").click(function(){
				$('.' + $(this).attr("data-name")).fadeOut();
			});
			
			//重置按钮
			$(".reset_btn").click(function () {
			    $(".stitchingCourse").text("");
			    $(".label input[type='checkbox']").removeAttr('checked');
			});


			//点击账号登录
			$("#tab_login").click(function(){
				$("#login_tabbox").show();
				$("#account").show();
				$("#shortcut").hide();
				$("#register_tabbox").hide();
				$("#tab_login").addClass("current");
	        	$("#tab_register").removeClass("current");
			});
			
			//切换tab
			function changeTab(){
				var $l = $('#tabs li');
				var $div = $('#changebar-box .tabbox');
				$l.click(function(){
					var $this = $(this);
					var $t = $this.index();
					$l.attr("class","tab");
					$this.addClass('current');
					$div.css('display','none');
					$div.eq($t).css('display','block');
				});
			}
			changeTab();
			
			//切换微信登陆
	   		$(".wx").click(function(){
	   			$("#account").hide();
	   			$("#shortcut").show();
	   		});

	   		//提示
	   		function toastfun(c) {
	   		    $('body').append('<span class="toast text-center"><b class="color-f f14">' + c + '</b></span>');
	   		    setTimeout(function () {
	   		        $('.toast').fadeOut();
	   		    }, 3000);
	   		};
	    </script>
	   <!-- <script>
			var _hmt = _hmt || [];
			(function() {
			  var hm = document.createElement("script");
			  hm.src = "https://hm.baidu.com/hm.js?24f703d117664e38c0d0ce50f3b67f33";
			  var s = document.getElementsByTagName("script")[0]; 
			  s.parentNode.insertBefore(hm, s);
			})();
		</script> -->
	</body>
</html>