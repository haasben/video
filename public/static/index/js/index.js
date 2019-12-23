$(function(){
	// 热门课程切换
	$(".m-title-content li").on("mouseover", function () {
	    var $this = $(this),
			$dataid = $this.attr("data-id");
	    $this.addClass("on").siblings("li").removeClass("on");
	    $("#" + $dataid).removeClass("dn").siblings("div[id^='c']").addClass("dn");
	});
	
	
	// 强化技能课
	$("#kecheng_list li").on("mouseover", function () {
	    var $this = $(this);
	    $this.addClass("on").siblings("li").removeClass("on");
	
	    var name = $(this).attr("name");
	   
	    $(".kecheng_list").hide();
	    $("#" + name).show();
	});
})