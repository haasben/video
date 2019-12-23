// 修改头像
$("#avatars_pic").click(function(){
	$("#upload").click()
})
// 上传回显
$('#upload').on('change',function(){
	let pics = this.files;
	
	for(var i = 0; i < pics.length; i++ ){
		let fr = new FileReader();
		fr.onload = function(e){
			console.log(this.result)
			$("#avatars_pic").attr("src",this.result)
		}
	  fr.readAsDataURL(pics[i]);//读取文件
	}
})

// 账户设置 tab切换
$("#zw_4 .recordTitle").on("click", "li",function(){
	let id = $(this).attr("data-id")
	$(this).addClass('on')
	$(this).siblings().removeClass('on')
	$('.set_up').hide()
	$("#set"+id).show()
})

// 学习记录 tab切换
$("#zw_2 .recordTitle").on("click", "li",function(){
	let id = $(this).attr("data-id")
	$(this).addClass('on')
	$(this).siblings().removeClass('on')
	$('.record1').hide()
	$("#record"+id).show()

})

// 订单中心
$("#zw_3 .orderTitle").on("click", "li",function(){
	let id = $(this).attr("data-id")
	$(this).addClass('on')
	$(this).siblings().removeClass('on')
	$('.orderList').hide()
	$("#order"+id).show()
})


// 左边导航切换
$('.leftMenu').on("click","li", function(){
	let name = $(this).attr("data-name")
	click_name(name);
	$(this).addClass("active").siblings().removeClass("active")
	$(".centerRight").hide()
	$("#"+name).show()
	
})

function click_name(name){
	if(name == 'zw_2'){
		$.post('/?m=index&c=member&a=learn',function(data){
			var html = '';
			html+='<ul>';
			$.each(data.Learn,function(item,v){
				html+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
				html+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时'+v.hours+'</span><span>更新至：'+v.count+'课时</span></div></div></li>'

			})
			html+='</ul>';
			$('#record1').html(html);
			var html2 = '';
			html2+='<ul>';
			$.each(data.collect,function(item,v){
				html2+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
				html2+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时'+v.hours+'</span><span>更新至：'+v.count+'课时</span></div></div></li>'

			})
			html2+='</ul>';
			$('#record1').html(html);
			$('#record2').html(html2);
		})
	}else if(name == 'zw_3'){
		$.post('/?m=index&c=member&a=order_list',function(data){
			var html = '';
			var html2 = '';
			html+='<ul>';
			html2+=html;
			var html3 = '';
			html3+=html;
			var html4 = '';
			html4+=html;
			$.each(data,function(item,v){
				html+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
				html+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时:'+v.hours+'</span>';
				html+='<span>课程有效时长：365天</span></div>';
				html+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>';
				if(v.order_status == 0){
					html+='</div><div class="status">待支付</div><div class="handle"><a href="javascript:">去支付</a></div></div></div></li>'; 
					html2+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
					html2+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时:'+v.hours+'</span>';
					html2+='<span>课程有效时长：365天</span></div>';
					html2+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>';
					html2+='</div><div class="status">待支付</div><div class="handle"><a href="javascript:">去支付</a></div></div></div></li>'; 
				}else if(v.order_status == 1){
					
					html+='</div><div class="status">已支付</div></div></div></li>';
					html3+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
					html3+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时:'+v.hours+'</span>';
					html3+='<span>课程有效时长：365天</span></div>';
					html3+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>';
					html3+='</div><div class="status">已支付</div></div></div></li>'; 
				}else if(v.order_status == -1){
					
					html+='</div><div class="status">订单取消</div></div></div></li>';
					html4+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
					html4+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时:'+v.hours+'</span>';
					html4+='<span>课程有效时长：365天</span></div>';
					html4+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>';
					html4+='</div><div class="status">订单取消</div></div></div></li>'; 
				}else if(v.order_status == 4){
					html+='</div><div class="status">订单过期</div></div></div></li>';
				}else if(v.order_status == 5){
					html+='</div><div class="status">支付失败</div></div></div></li>';
				}
			})
			html+='</ul>';
			html2+='</ul>';
			html3+='</ul>';
			html4+='</ul>';
			// console.log(html2);
			$('#order1').html(html);
			$('#order2').html(html2);
			$('#order3').html(html3);
			$('#order4').html(html4);
		})
	}else if(name == 'zw_6'){
		$.post('/?m=index&c=member&a=bought_course',function(data){
			var html = '';
			html+='<ul>';
			$.each(data,function(item,v){
				html+='<li><div class="kc_img"><a href="/course_show?id='+v.aid+'"><img width="260" height="150" src="'+v.litpic+'"></a></div>';
				html+='<div class="kc_text"><div class="title">'+v.title+'</div><div class="class_hour"><span>课时:'+v.hours+'</span>';
				html+='<span>课程有效时长：365天</span></div>';
				html+='<div class="box"><div class="price"><span class="jin">￥'+v.order_amount+'</span>';
			})
			html+='</ul>';
			$('#bought_course').html(html);
		})
	}

	
}

$('#btn').click(function(){

	var data = $("#info").serialize();
	$.post('/?m=index&c=member&a=edit_users',data,function(data){
			alert(data.msg);
	})
	return false;
})
$('#btn1').click(function(){

	var data = $("#info1").serialize();
	$.post('/?m=index&c=member&a=edit_pass',data,function(data){
		alert(data.msg);
		if(data.code == 1){
			window.location.href="/login?tab=1";
			
		}
	})
	return false;
})

//修改手机号
$('#get_code').click(function(){

	if($('#get_code').text() != '获取验证码'){
		return false;
	}
	$.post('/?m=index&c=member&a=sen_msg',function(data){
		if(data == '1'){
			var timesRun = 180;
			var interval = setInterval(function(){
			    timesRun -= 1;
			    var text = timesRun+'s后可以重新获取验证码';
			    $('#get_code').html(text)
			    if(timesRun === 0){    
			        clearInterval(interval);   
			        $('#get_code').html('获取验证码');
			    }
			}, 1000);
		}else{
			alert('验证码发送失败，请稍后再试');
		}


	})

})

$('#bnt3').click(function(){

	var newmobile = $('#newmobile').val();
	var code = $('#code').val();
	if(code == '' && newmobile == ''){
		alert('请填写完整');return false;
	}
	$.post('/?m=index&c=member&a=edit_phone',{code:code,newmobile:newmobile},function(data){


		alert(data.msg);

	})
	return false;



})


// 支付界面事件
$(function(){
	let height = $(document).height();
	$(".wx_qr").css("height",height);
	
	$(".wechat").on("click", function(){

		var token = $('.token').val();
		var order_code = $('.order_code').text();
		var transaction_type = $('.transaction_type').val();
		var level = $('.level').val();

			$.post('/?m=index&c=Pay&a=pay_wechat_png',{token:token,order_code:order_code,transaction_type:transaction_type,level:level},function(data){
			if(data.code == '1111'){
				window.location.href="/login?tab=1";
			}else if(data.code == '2222'){
				window.location.href="/";
			}else if(data.code == '3333'){
				//$(".wx_qr").hide();
				alert('获取二维码失败，请稍后再试');
			}else{
				$('#wechat_code').attr("src",data.data);
					// clearInterval(time);
					if(data.num == 1){
							var time = setInterval(function () {
	                        	$.post('/?m=index&c=Pay&a=pay_status',{order_code:order_code,transaction_type:transaction_type},function(data){
	                        		if(data.code == 1){
	                        			window.location.href=GetQueryString('callback');
	                        		}
	                        	})
	                        // $(".wk__own__dialog").show();
	                    }, 2000);
					}
					

			}

		})

	

		
		$(".wx_qr").show();
	})
	
	$(".cha").on("click", function(){
		
		$(".wx_qr").hide();
	})
})

function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
// 定位
$(function(){
	let str = window.location.search.split('?')[1];
	let arr = str.split('&');
	let par = arr[0].split('=')[1];
	let child = '';

	if(arr.length>1){
		child = arr[1].split('=')[1];
	}
	let name = '';
	$('.leftMenu li').each(function(){
		name = $(this).attr('data-name');
		let id = name.split('_')[1];
		if(id == par){
			$(this).addClass("active").siblings().removeClass("active")
			$(".centerRight").hide()
			// console.log(name);
			click_name(name);
			$("#"+name).show()
			return false
		}
	})
	if(child != ''){
		let childs = $("#"+name + " .recordTitle li")
		childs.each(function(){
			let cid = $(this).attr("data-id")
			if(cid == child){
				$(this).addClass('on').siblings().removeClass('on')
				$('.record1').hide()
				$("#record"+cid).show()
			}
		})
	}
})