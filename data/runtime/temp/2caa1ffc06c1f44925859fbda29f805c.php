<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\WWW\video/application/mobile\view\mlogin\register.htm";i:1574386730;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>注册</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>注册</h3>
			</header>
			
			<div class="container login">
				<form>
					<div class="b">
						<input type="text" name="" class="username" placeholder="请输入手机号"/>
					</div>
					<div class="b">
						<input type="text" name="" class="email" placeholder="请输入邮箱地址"/>
					</div>
					<div class="b">
						<input type="password" name="" class="password" placeholder="请输入密码"/>
					</div>

					<div class="b codes">
						<input type="text" name="" class="pwd" placeholder="请输入验证码" />
						<input type="button" name="" class="code" value="获取验证码" />
					</div>
					<div class="b">
						<input type="checkbox" name="" class="check" id="check" /><label for="check">我同意《用户条款》</label>
					</div>
					<div class="b">
						<input type="button" class="submit" value="注册"/>
					</div>
					<div class="handle reg">
						<span>已有账号？<a href="/mlogin">立即登录</a></span>
					</div>
				</form>
			</div>
			
		</div>
		
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$('.code').on("click", function(){
			    const phone = $('.username').val()
			    if(!(/^1[3456789]\d{9}$/.test(phone)) || phone == ''){ 
			     layer.msg('请输入正确的手机号码',{icon:5,time:1000});  
			     return false; 
			    } 
			    let that = $(this);
			    let time = 60;
			    that.attr("disabled",true)

			    let timer = setInterval(()=>{
				     that.css("background-color","#ccc");
				     time--
				     that.val(time + 's后获取')
				     if(time == 0){
				      that.attr("disabled",false)
				      that.css("background-color","#4CB3F7");
				      that.val("重新获取")
				      clearInterval(timer)
				     }
			    },1000)
			    $.post('<?php echo url("mobile/mlogin/sen_msg"); ?>',{mobile:phone},function(data){
			    	if(data == 1){
			    		layer.msg('验证码发送成功',{icon:1,time:1000}); 
			    	}else if(data == 2){
			    		layer.msg('验证码获取过于频繁',{icon:5,time:1000});
			    	}

			    })

			   })
			// 注册
			$(".submit").on("click",function(){
				const username = $(".username").val(),
					  code = $(".pwd").val();
					  email = $('.email').val();
					  password = $('.password').val();
				if(!$(".check")[0].checked){
					layer.msg("请同意用户条款");return false;
				}
				$.ajax({
					url:'',
					type:'post',
					data:{
						umobile:username,
						uEmail:email,
						uPwd:password,
						validateCode:code
					},
					dataType:'json',
					success:function(data){
						if(data.code == 1){
							layer.msg(data.msg,{icon:1,time:1000},function(){

								window.location.href="/mlogin";
							});  
						}else if(data.code == 2){
							layer.msg(data.msg,{icon:5,time:1000});  
						}else{
							layer.msg(data.msg,{icon:5,time:1000});  
						}
					},
					error:function(){
						
					}
				})
			})
		</script>
	</body>
</html>
