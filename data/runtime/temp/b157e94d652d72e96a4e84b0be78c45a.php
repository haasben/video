<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wwwroot\www.gkbplc.com/application/mobile\view\case_course\index.htm";i:1574390321;s:60:"D:\wwwroot\www.gkbplc.com\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo $cateName['typename']; ?></title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>
	</head>
	<body>
		<div class="wrap">
			<!-- 头部 -->
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<h3><?php echo $cateName['typename']; ?></h3>
			</header>
			<!-- 内容区 -->
			<div class="container">
				<div class="cont">
					<ul>
						<?php if(is_array($FreeCourse) || $FreeCourse instanceof \think\Collection || $FreeCourse instanceof \think\Paginator): $i = 0; $__LIST__ = $FreeCourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$f): $mod = ($i % 2 );++$i;?>

						<li>
							<a href="/mcourse_show?id=<?php echo $f['aid']; ?>" class="see" role="button" data-id="6972">
							<img class="lazy" src="<?php echo $f['litpic']; ?>" height="100" class="img-responsive" alt="" />
								<h5><?php echo $f['title']; ?></h5>
									<div class="info">
										<p><span><?php echo $f['click']; ?></span>人在学</p>
										<p><a href="mcourse_show?id=<?php echo $f['aid']; ?>">立即观看</a></p>
									</div>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div class="none_data" style="text-align: center;font-size: 12px;display: none">没有更多了</div>
				</div>
				
			</div>
			
			<!-- footer -->
			<footer>
				<ul>
								<footer>
				<ul>
					<li>
						<a href="./">
							<span class="icon">&#xe65a;</span>
							<span class="name">首页</span>
						</a>
					</li>
					<li>
						<a href="/MCourseCenter?id=169">
							<span class="icon">&#xe670;</span>
							<span class="name">课程中心</span>
						</a>
					</li>
					<li>
						<a href="<?php echo url('mobile/member/order_list'); ?>&t=0">
							<span class="icon">&#xe667;</span>
							<span class="name">订单中心</span>
						</a>
					</li>
					<li>
						<a href="/Mmember">
							<span class="icon">&#xe65d;</span>
							<span class="name">我的</span>
						</a>
					</li>
				</ul>
			</footer>
				</ul>
			</footer>
		</div>
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			let isLoad = false, page = 1;
			let timer;
			
			$(".wrap").scroll(function(){
				if($(this)[0].scrollTop + $(this).height() >= $(this)[0].scrollHeight){
					// console.log(page);
					// clearTimeout(timer)
					// timer = setTimeout(()=>{
						page++
						loadData(page);
					// },1000)
				}
			})
			// 异步加载数据
			function loadData(page){
				var id = '<?php echo $id; ?>';
				let html = ''
				$.post('<?php echo url("mobile/MFreeCourse/page_list"); ?>',{page:page,id:id},function(data){
					$.each(data,function(item,val){
						html += `<li>
							<a href="mcourse_show?id=`+val.aid+`" class="see" role="button" data-id="6972">
								<img class="lazy" src="`+val.litpic+`" class="img-responsive" alt="" />
								<h5>`+val.title+`</h5>
								<div class="info">
									<p><span>`+val.click+`</span>人在学</p>
									<p><a href="mcourse_show?id=`+val.aid+`">免费观看</a></p>
								</div>
							</a>
						</li>`
					})

					$(".cont ul").append(html);
					if(data.length < 10){
						$('.none_data').css('display','block');
					}
					
				})

				
			}
		</script>
	</body>
</html>
