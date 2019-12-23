$(function(){

	$(".wrap").scroll(function(){
		if($(this)[0].scrollTop + $(this).height() >= $(this)[0].scrollHeight){

		var id = $('.active').find('a').attr('data-id');
		var page = $('.list_attr_'+id).attr('data-id');
		var pid = $('#pid').val();
		var none_info = $('.div_attr_'+id).text();
		if(none_info == '我是有底线的'){
			return false;
		}

		$.post('/?m=mobile&c=MCourseCenter&a=course_show_list',{id:id,page:page,pid:pid},function(data){
			var html = '';
			page = parseInt(page)+1;
			// console.log(page);
			$.each(data,function(item,val){
				html+='<li>';
				html+='<a href="mcourse_show?id='+val.aid+'" class="see" role="button" data-id="6972">';
				html+='<img class="lazy" src="'+val.litpic+'" height="100" class="img-responsive" alt="" />';
				html+='<h5>'+val.title+'</h5><div class="info"><p>';
				html+='<span>'+val.videorating+'</span></p>';
				html+='<p><span>'+val.click+'</span>人在学</p></div></a></li>';
			})
			if(data.length < 8){
				$('.div_attr_'+id).html('我是有底线的');
				$('.div_attr_'+id).css('display','block');
			}

			$('.list_attr_'+id+' ul').append(html);
			$('.list_attr_'+id).attr('data-id',page);
		})

		}
	})

})

$(".tabs").on("click", "li", function(){
	var id = $(this).find('a').attr('data-id');
	var page = $('.list_attr_'+id).attr('data-id');
	var pid = $('#pid').val();
	if(id != '0' && page == '1'){
		var html = '';
		$.post('/?m=mobile&c=MCourseCenter&a=course_show_list',{id:id,page:page,pid:pid},function(data){
			$.each(data,function(item,val){
				html+='<li>';
				html+='<a href="mcourse_show?id='+val.aid+'" class="see" role="button" data-id="6972">';
				html+='<img class="lazy" src="'+val.litpic+'" height="100" class="img-responsive" alt="" />';
				html+='<h5>'+val.title+'</h5><div class="info"><p>';
				html+='<span>'+val.videorating+'</span></p>';
				html+='<p><span>'+val.click+'</span>人在学</p></div></a></li>';
			})
			if(data.length < 8){
				$('.div_attr_'+id).html('我是有底线的');
				$('.div_attr_'+id).css('display','block');
			}
			$('.list_attr_'+id+' ul').append(html);
			$('.list_attr_'+id).attr('data-id','2');
		})
	}
	$('.content').css('display','none');
	$('.list_attr_'+id).css('display','block');

	$(this).addClass('active').siblings().removeClass('active');
})