<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"D:\WWW\video/application/mobile\view\member\member.htm";i:1575878844;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>升级会员</title>
		<link rel="stylesheet" type="text/css" href="/public/static/mobile//css/style.css"/>
		
	</head>
	<body>
		<div class="wrap" id="member">
			<header class="head">
				<a href="javascript:" class="back" onclick="history.go(-1)"><img src="/public/static/mobile//img/icon-return.png" ></a>
				<h3>会员升级</h3>
			</header>
			<div class="container">
				<table>
					<thead>
						<tr>
							<th>选择</th>
							<th>产品名称</th>
							<th>产品价格</th>
							<th>会员期限</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($member_level) || $member_level instanceof \think\Collection || $member_level instanceof \think\Paginator): $i = 0; $__LIST__ = $member_level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><input type="radio" name="vip" value="<?php echo $v['level_id']; ?>" /></td>
							<td><?php echo $v['type_name']; ?></td>
							<td>￥<?php echo $v['price']; ?></td>
							<td>终身</td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
<!-- 				<div class="pay">
					<div class="">
						<input type="radio" name="pay" value="" />
						<img src="/public/static/mobile//img/w1.png" >
					</div>
					<div class="">
						<input type="radio" name="pay" value="" />
						<img src="/public/static/mobile//img/z.png" >
					</div>
				</div> -->
				<button type="button" class="pay_btn">去付款</button>
				<script src="/public/static/mobile/js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
				<script type="text/javascript">
					$(function(){
						$('.pay_btn').click(function(){

							var name = $("input[name='vip']:checked").val();
							if(name == undefined){
								alert('请先选择开通的等级');return false;
							}
							var token = "<?php echo $token; ?>";
							$.post("<?php echo url('index/pay/mem_level_order'); ?>",{level:name,__token__:token},function(data){
								if(data.code == 1){
									window.location.href="<?php echo url('index/pay/mem_activation'); ?>&order_code="+data.data+'&level='+name;
								}else{
									var token = data.token;
									alert(data.msg);
								}
								

							})
						})

					})

				</script>
			</div>
		</div>
		
		
		<script src="/public/static/mobile//js/jquery-1.10.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile//js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/mobile//js/index.js" type="text/javascript" charset="utf-8"></script>
	</body>
</html>
