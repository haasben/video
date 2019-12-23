// JavaScript Document
$(function(){
	//显示隐藏
	$("[data-role=collapsible]").hover(function(){
		$(this).addClass("open");
	},function(){
		$(this).removeClass("open");		
	})
	
	//跟随屏幕
	$(window).scroll(function(){
		if($(window).scrollTop()>=594)
		{
			$("[data-role=fixed]").addClass("fixed594");
			$("[data-role=fixed]").find(".scrollJiage").show();
		}else{
			$("[data-role=fixed]").removeClass("fixed594");
			$("[data-role=fixed]").find(".scrollJiage").hide();
		}
	})
	//返回顶部
	$("#totop").click(function(){
		$("html,body").animate({
				scrollTop: 0
		},
		1000);
	})
	//$
	$(".right_side").outerWidth($(".inner").width()-$(".left_side").outerWidth())
})
	
