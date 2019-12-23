<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\phpStudy\PHPTutorial\WWW\video/application/mobile\view\search\index.htm";i:1574393492;s:68:"D:\phpStudy\PHPTutorial\WWW\video\application\mobile\view\footer.htm";i:1574329228;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>搜索</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile/css/style.css"/>

	</head>
	<body>
		<div class="wrap">
			<header class="search_header">
				<a href="./" class="back"><img src="/public/static/mobile/img/icon-return.png" ></a>
				<div class="search">
					<input type="text" name="" class="txt" placeholder="请输入关键词" />
					<button type="button" class="search_btn">搜索</button>
				</div>
			</header>
			
			<div class="container">
				<?php if(empty($keywords) || (($keywords instanceof \think\Collection || $keywords instanceof \think\Paginator ) && $keywords->isEmpty())): ?>
				<div class="keys_list">
					<h3>热门搜索</h3>
					<div>
						<?php if(is_array($searchHotData) || $searchHotData instanceof \think\Collection || $searchHotData instanceof \think\Paginator): $i = 0; $__LIST__ = $searchHotData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<a href="/msearch?keywords=<?php echo $v['word']; ?>"><?php echo $v['word']; ?></a>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</div>

				<?php else: ?>

				<div class="search_list" style="">
					<h3><span>“<?php echo $keywords; ?>”</span>相关搜索内容</h3>
					<ul>
						<?php if(is_array($searchData) || $searchData instanceof \think\Collection || $searchData instanceof \think\Paginator): $i = 0; $__LIST__ = $searchData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<div class="kc_img">
								<a href="/mcourse_show?id=<?php echo $v['aid']; ?>">
									<img src="<?php echo $v['litpic']; ?>" height="100">
								</a>
							</div>
							<div class="kc_text">
								<a href="/mcourse_show?id=<?php echo $v['aid']; ?>">
									<div class="title"><?php echo $v['title']; ?></div>
									<p><?php echo mb_substr(strip_tags(htmlspecialchars_decode($v['content'])),0,20); ?></p> <!-- 课程描述 -->
									<div class="class_hour">
										<span><?php echo $v['click']; ?>人在学</span>&nbsp;&nbsp;|&nbsp;&nbsp;
										<span>更新至：<?php echo $v['hours']; ?>课时</span>
									</div>
								</a>
							</div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			
			<!-- 底部 -->
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
		</div>
		
		<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// 点击搜索
			$('.search_btn').on('click', function(){
				const key = $('.txt').val();
				if(key == ''){
					alert('请输入关键词');return false;
				}
				window.location.href="/msearch?keywords="+key;
				
			})
		</script>
	</body>
</html>
