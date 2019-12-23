// 头部菜单按钮事件
$('.menu_bar').on("click", function(e){
	$(".nav").css("transform","translateX(0)");
	e.stopPropagation();
})

$(document).bind('click', function(){
	$('.nav').css('transform','translateX(600px)');
})
$('.nav').bind("click", function(e){
	e.stopPropagation();
})


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



// 账户设置tab切换
$("#setting .tab").on('click', "li", function(){
	$(this).addClass('active').siblings().removeClass('active');
	let id = $(this).attr('data-id');
	$('.box1').hide();
	$('#box'+id).show();
})







// 获得URL某个参数
function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}