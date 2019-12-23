<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\phpStudy\PHPTutorial\WWW\video/application/mobile\view\member\edit_users.htm";i:1574387288;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>账户设置</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap" id="setting">
			<header class="head">
				<a href="/mmember" class="back"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>账户设置</h3>
			</header>
			
			<div class="container">
				<ul class="tab">
					<li class="active" data-id="1">基本信息</li>
					<li data-id="2">修改密码</li>
					<li data-id="3">修改手机号</li>
				</ul>
				<div class="box1" id="box1">
					<form class="box1_form">
						<div class="avatars">
							<label>头像：</label>
							<input type="file" name="avatar" id="upload" value="" style="display: none;" />
							<img src="<?php echo $userData['head_pic']; ?>" id="avatars_pic" >
							<input type="hidden" name="head_pic" class="head_pic" value="<?php echo $userData['head_pic']; ?>">
						</div>
						<div class="">
							<label>用户名：</label>
							<input type="text" name="username" id="" value="<?php echo $userData['username']; ?>" />
						</div>
						<div class="">
							<label>用户昵称：</label>
							<input type="text" name="nickname" id="" value="<?php echo $userData['nickname']; ?>" />
						</div>
						<div class="">
							<label>邮箱：</label>
							<input type="text" name="email" id="" value="<?php echo $userData['email']; ?>" />
						</div>
						<div class="submit">
							<input type="button" class="submit_box1" value="提交"/>
						</div>
					</form>
				</div>
				
				<div class="box1" id="box2" style="display: none;">
					<form class="box2_form">
						<div class="">
							<label>原密码：</label>
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
						<div class="submit">
							<input type="button" class="submit_box2" value="保存"/>
						</div>
					</form>
				</div>
				
				<div class="box1" id="box3" style="display: none;">
					<form class="box3_form">
						<div class="">
							<label>当前号码：</label>
							<input type="text" name="" id="mobile" value="<?php echo $userData['mobile']; ?>" disabled="" />
						</div>
						<div class="">
							<label>新号码：</label>
							<input type="text" name="newmobile" id="newmobile" value="" />
						</div>
						<div class="">
							<label>验证码：</label>
							<input type="text" name="code" id="code" value="" />
							<input type="button" name="" class="getcode" value="获取验证码" />
			<!-- 				<a href="javascript:" class="getcode">获取验证码</a> -->
						</div>
						<div class="submit">
							<input type="button" class="submit_box3" value="保存"/>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="/public/plugins/layui/layui.js"></script>
		<script type="text/javascript">
			$('.submit_box1').click(function(){
				var data = $('.box1_form').serialize();
				$.post('<?php echo url("mobile/member/edit_users"); ?>',data,function(data){

					if(data.code == 1){
						layer.msg(data.msg,{icon:1,time:1500});
					}else{
						layer.msg(data.msg,{icon:5,time:1500});
					}
				})
			})

			$('.submit_box2').click(function(){
				var data = $('.box2_form').serialize();
				$.post('<?php echo url("mobile/member/edit_pass"); ?>',data,function(data){

					if(data.code == 1){
						layer.msg(data.msg,{icon:1,time:1500},function(){

							window.location.href="/mlogin";
						});
					}else{
						layer.msg(data.msg,{icon:5,time:1500});
					}
				})
			})

			$('.submit_box3').click(function(){
				var data = $('.box3_form').serialize();
				$.post('<?php echo url("mobile/member/edit_phone"); ?>',data,function(data){

					if(data.code == 1){
						layer.msg(data.msg,{icon:1,time:1500});
					}else{
						layer.msg(data.msg,{icon:5,time:1500});
					}
				})
			})



			$('#box3 .getcode').on('click', function(){
				const phone = $('#mobile').val()
			    if(!(/^1[3456789]\d{9}$/.test(phone)) || phone == ''){ 
			     layer.msg('请输入正确的手机号码',{icon:5,time:1000});  
			     return false; 
			    } 
			    let that = $(this);
			    let time = 60;
			    $.post('<?php echo url("mobile/member/sen_msg"); ?>',{mobile:phone},function(data){
			    	if(data == 1){
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

			    		layer.msg('验证码发送成功',{icon:1,time:1000}); 
			    	}else{
			    		layer.msg('验证码获取过于频繁',{icon:5,time:1000});
			    	}

			    })
			})


			layui.use('upload', function(){
			  var upload = layui.upload;
			  //执行实例
			  var uploadInst = upload.render({
			    elem: '#upload' //绑定元素
			    ,url: '<?php echo url("mobile/member/pic"); ?>' //上传接口
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
		<script type="text/javascript">
			$(function(){
				let t = GetQueryString('t');
				let lis = $('.tab li');
				lis.each(function(){
					if($(this).attr('data-id') == t){
						$(this).addClass('active').siblings().removeClass("active");
						$('.box1').hide();
						$("#box"+t).show();
						return false;
					}
					
				})
				
			})
		</script>
	</body>
</html>
