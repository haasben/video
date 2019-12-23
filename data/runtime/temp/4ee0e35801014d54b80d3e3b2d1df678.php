<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\WWW\video/application/mobile\view\mlogin\login.htm";i:1574322204;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>登录</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>登录</h3>
			</header>
			<div class="container login">
				<form>
					<div class="b">
						<input type="text" name="" class="username" placeholder="用户名/手机/邮箱"/>
					</div>
					<div class="b">
						<input type="password" name="" class="pwd" placeholder="请输入密码" />
					</div>
					<input type="hidden" id="token" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>">
					<div class="b">
						<input type="button" class="submit" value="登录"/>
					</div>
					<div class="handle">
						<a href="/update_pwd">忘记密码？</a>
						<span>没有账号？<a href="/mregister">立即注册</a></span>
					</div>
				</form>
			</div>
		</div>
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// 登录
			$(".submit").on('click',function(){
				const username = $(".username").val(),
					  password = $('.pwd').val();
					  token = $('#token').val();
				
				$.ajax({
					url:'',
					type:'post',
					data:{
						uname:username,
						upwd:password,
						__token__:token
					},
					dataType:'json',
					success:function(data){
						if(data.code == 1){
							layer.msg(data.msg,{icon:1,time:1500},function(){
								window.location.href = data.url;
							});
						}else if(data.code == 4){
							layer.msg(data.msg,{icon:5,time:1500},function(){
								window.location.href = data.url;
							});
						}else{
							layer.msg(data.msg,{icon:5,time:1500});
							$("input[name='__token__']").val(data.token);
						}
					},
					error:function(){
						
					}
				})
			})
		</script>
	</body>
</html>
