<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\WWW\video/application/mobile\view\member\learn.htm";i:1574388878;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>学习记录</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap" id="study">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3>学习记录</h3>
			</header>
			
			<div class="container">
				<ul class="tab">
					<li class="active" data-id="1">学习记录</li>
					<li data-id="2">收藏课程</li>
				</ul>
				
				<div class="recode" id="box1" data-id="1">
					<ul>
						
					</ul>
				</div>
				
				<div class="recode" id="box2" data-id="1" style="display: none;">
					<ul>
	
					</ul>
				</div>
			</div>
		</div>
		
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/index.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function(){
				let t = GetQueryString('t');
				let lis = $('.tab li');
				let page = $('#box'+t).attr('data-id');
				lis.each(function(){
					if($(this).attr('data-id') == t){
						$(this).addClass('active').siblings().removeClass("active");
						$('.recode').hide();
						$("#box"+t).show();
						return false;
					}
				})
				get_data(t,page);
				// 学习记录tab切换
				$("#study .tab").on('click', "li", function(){
					$(this).addClass('active').siblings().removeClass('active');
					let id = $(this).attr('data-id');
					$('.recode').hide();
					$('#box'+id).show();
					var page = $('#box'+id).attr('data-id');
					if(page !=1){
						return false;
					}
					get_data(id,page);


				})

				function get_data(t,page){
					$.post('/learn',{type:t,page:page},function(data){
						var html = '';
						$.each(data,function(item,v){
							html+='<li><div class="kc_img"><a href="/mcourse_show?id='+v.aid+'"><img src="'+v.litpic+'" ></a>'
							html+='</div><div class="kc_text"><a href="/mcourse_show?id='+v.aid+'"><div class="title">'+v.title+'</div>'
							html+='<div class="class_hour"><span>课时：'+v.hours+'</span>'
							html+='<span>更新至：'+v.count+'课时</span></div></a></div></li>';
						})
						$('#box'+t+' ul').append(html);
						$('#box'+t).attr('data-id',2);
					})

				}

			})
		</script>
	</body>
</html>
