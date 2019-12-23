
/*	jc.tools.v1 */
$.extend({

	/**
	 * Cookie plugin
	 *
	 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
	 * Dual licensed under the MIT and GPL licenses:
	 * http://www.opensource.org/licenses/mit-license.php
	 * http://www.gnu.org/licenses/gpl.html
	 *
	 *
	 * Create a cookie with the given name and value and other optional parameters.
	 *
	 * @example $.cookie('the_cookie', 'the_value');
	 * @desc Set the value of a cookie.
	 * @example $.cookie('the_cookie', 'the_value', {expires: 7, path: '/', domain: 'jquery.com', secure: true});
	 * @desc Create a cookie with all available options.
	 * @example $.cookie('the_cookie', 'the_value');
	 * @desc Create a session cookie.
	 * @example $.cookie('the_cookie', null);
	 * @desc Delete a cookie by passing null as value.
	 *
	 * @param String name The name of the cookie.
	 * @param String value The value of the cookie.
	 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
	 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
	 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
	 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
	 *                             when the the browser exits.
	 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
	 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
	 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
	 *                        require a secure protocol (like HTTPS).
	 * @type undefined
	 *
	 * @name $.cookie
	 * @cat Plugins/Cookie
	 * @author Klaus Hartl/klaus.hartl@stilbuero.de
	 */
	cookie:function(name,value,options){
		if(typeof value!='undefined'){options=options||{};if(value===null){value='';options=$.extend({},options);options.expires=-1}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000))}else{date=options.expires}expires='; expires='+date.toUTCString()}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('')}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break}}}return cookieValue}
	},

	/*
		jc
		2013.1.1
		ningyb
	*/
	jc : {
		/*
		   判断是否登录
		*/
		isLogined: function(){
			var logined = $.cookie("learnerId");
			if (logined) {
				return true;
			}
			return false;
		},
		/*
			判断是否注册（新版注册 entrance = 1）
		*/
		isRegistered: function(){
			var 
				entrance = $.cookie("regEntrance"),
				emailpass = $.cookie("emailPass")
			;
			if (entrance == "1" && emailpass=="1") {
				return true;
			}
			return false;
		},
		/*
			判断手机是否通过验证（新版注册 entrance = 1）
		*/
		mobileIsPass: function(){
			var 
				entrance = $.cookie("regEntrance"),
				mobile = $.cookie("mobilePass")
			;
			if (entrance == "1" && mobile == "1") {
				return true;
			}
			return false;
		},
		/*
			获取会员等级（ps：得先判断登录，再获取会员等级）
		*/
		getLearnerGrade: function(){
			return $.cookie("C_LearnerGrade");
		}

	},
	/*
	 * 登录
	 */
	login: {
		/*
		 * 弹窗登录
		 */
		windows: function(){
			var d = dialog({
					id: "windowLogin",
					title: "您尚未登陆",
					content: '<iframe id="test-iframe" width="100%" height="99%" frameborder="0" framespacing="0" src="http://www.jcpeixun.com/windows/login_register.aspx?callback=' + "norefresh" + '" scrolling="no"></iframe>',
					align: 'left',
					fixed: true,
					zIndex: 1050,
					padding: 0,
					skin: 'min-dialog tips',
					width: '280',
					height: '350'
				});
				d.showModal();
		},
		windowsRemove: function(){
			dialog.get('windowLogin').remove();
		},
		windowsClose: function(){
			dialog.get('windowLogin').close();
		},
		/*
		 * 页面登录
		 */
		page: function(){
			window.top.location.href = "http://www.jcpeixun.com/newlogin.aspx";
		}
		
	},
	/*
	 * 购物车
	 */
	cart: {
		/*
		
			提交商品到购物车
			goods_id: 商品id
		*/
		one: function(goods_id){
			var
				$f = $("<form>")
						.attr({
							"id": "cart-oneform",
							"method": "post",
							"action": "http://www.jcpeixun.com/pay/cart.aspx"
						})
						,
				$hdn1 = $("<input type='hidden'>")
							.attr({
								"name": "payproductlist",
								"value": goods_id
							}).appendTo($f)
			;
			$("body").prepend($f);
			$f.submit();
		}
	},
	/*
	 * 订单
	 */
	order: {

		/*创建订单：*/
		create: function (buyJSON) {
                    /*
                    buyJSON数据说明：

                    var buyJSON = { "product_id": "产品ID", "class_id": "小班课ID【可为空】", "from_activity": "1表示来自活动页订单【可为空，如果是活动页面必填】", "type_id": "活动页ID【可为空，如果是活动页面必填】", "orderName": "自定义订单名称【可为空】", "orderPrice": "加密后的自定义价格【可为空】", "originPrice": "加密后的自定义原价【可为空】", "orderDesc": "自定义订单描述【可为空】", "buy_num": "购买数量【可为空，默认1】", "event_id": "事件ID【可为空】", "orderRemark":"订单备注，可用于保存手机姓名【可为空】","callbackURL": "支付成功后的回调地址【可为空】"};
                
                    //例子1：购买产品
                    var buyJSON = { "product_id": "3", "from_activity": 1, "type_id": 150715, "callbackURL": location.href };

                    //例子1-A：购买产品,且需要填写姓名手机
                    var buyJSON = { "product_id": "3", "from_activity": 1, "type_id": 150715,"orderRemark":"134000000，张飞", "callbackURL": location.href };

                
                    //例子2：购买小班
                    var buyJSON = {"class_id": "54", "from_activity": 0, "type_id": 0, "callbackURL": location.href };

                    //例子3：所有参数
                    var buyJSON = { "product_id": "3", "class_id": "", "from_activity": 1, "type_id": 150715, "orderName": "", "orderPrice": "", "originPrice": "", "orderDesc": "", "buy_num": "", "event_id": "","orderRemark":"", "callbackURL": location.href };
                
                    */
                   
                    // 提交地址  
                    var action = "http://course.jcpeixun.com/pay/createProductOrder";
                    // 创建Form  
                    var _form = $('<form style="display:none;"></form>');
                    _form.attr('action', action);
                    _form.attr('method', 'post');
                    //说明：不支持提交到新窗口页面，浏览器会阻止弹出窗口


                    // 创建Input  附加到Form
                    $('<input type="text" name="payproduct_id" value="' + (buyJSON.product_id ? buyJSON.product_id : "") + '" />').appendTo(_form);
                    $('<input type="text" name="class_id" value="' + (buyJSON.class_id ? buyJSON.class_id : "") + '" />').appendTo(_form);
                    $('<input type="text" name="TYPE" value="' + (buyJSON.type_id ? buyJSON.type_id : "") + '" />').appendTo(_form);
                    $('<input type="text" name="ordername" value="' + (buyJSON.orderName ? buyJSON.orderName : "") + '" />').appendTo(_form);
                    $('<input type="text" name="orderprice" value="' + (buyJSON.orderPrice ? buyJSON.orderPrice : "") + '" />').appendTo(_form);
                    $('<input type="text" name="originprice" value="' + (buyJSON.originPrice ? buyJSON.originPrice : "") + '" />').appendTo(_form);
                    $('<input type="text" name="orderdesc" value="' + (buyJSON.orderDesc ? buyJSON.orderDesc : "") + '" />').appendTo(_form);
                    $('<input type="text" name="buy_num" value="' + (buyJSON.buy_num ? buyJSON.buy_num : "") + '" />').appendTo(_form);
                    $('<input type="text" name="event_id" value="' + (buyJSON.event_id ? buyJSON.event_id : "") + '" />').appendTo(_form);
                    $('<input type="text" name="callbackURL" value="' + (buyJSON.callbackURL ? buyJSON.callbackURL : "") + '" />').appendTo(_form);
                    $('<input type="text" name="from_activity" value="' + (buyJSON.from_activity ? buyJSON.from_activity : "") + '" />').appendTo(_form);
                    $('<input type="text" name="orderRemark" value="' + (buyJSON.orderRemark ? buyJSON.orderRemark : "") + '" />').appendTo(_form);
                    $('<input type="text" name="buydays" value="' + (buyJSON.buydays ? buyJSON.buydays : "") + '" />').appendTo(_form);
                    $('<input type="text" name="cover" value="' + (buyJSON.cover ? buyJSON.cover : "") + '" />').appendTo(_form);

                    $("body").prepend(_form);

                    // 提交表单  
                    _form.submit();

                },



		/*
			
			提交订单
			
			payproduct_id：商品ID
			TYPE：订单类型（用户统计订单）
			callbackURL：支付成功后的成功页面
			ordername：订单名称
			orderprice：支付价格（加密后传输）
			originprice：原价
			buy_num：数量
			orderdesc: 订单描述
		 */
		one: function(payproduct_id, TYPE, callbackURL, ordername, orderprice, originprice, buy_num, event_id, orderdesc){
			var 
				$f = $("<form>")
						.attr({
							"id":"order-oneform",
							"method":"post",
							"action":"http://www.jcpeixun.com/pay/order-product.aspx"
						})
						,
				$hdn1 = $("<input type='hidden'>")
							.attr({
								"name": "payproduct_id",
								"value": payproduct_id
							}).appendTo($f)
						,
				$hdn2 = $("<input type='hidden'>")
							.attr({
								"name": "TYPE",
								"value": TYPE
							}).appendTo($f)
						,
				$hdn3 = $("<input type='hidden'>")
							.attr({
								"name": "callbackURL",
								"value": callbackURL
							}).appendTo($f)
						,
				$hdn4 = $("<input type='hidden'>")
							.attr({
								"name": "ordername",
								"value": ordername
							}).appendTo($f)
						,
				$hdn5 = $("<input type='hidden'>")
							.attr({
								"name": "orderprice",
								"value": orderprice
							}).appendTo($f)
						,
				$hdn6 = $("<input type='hidden'>")
							.attr({
								"name": "originprice",
								"value": originprice
							}).appendTo($f)
						,
				$hdn7 = $("<input type='hidden'>")
							.attr({
								"name": "buy_num",
								"value": buy_num
							}).appendTo($f)
						,
				$hdn8 = $("<input type='hidden'>")
							.attr({
								"name": "event_id",
								"value": event_id
							}).appendTo($f)
						,
				$hdn9 = $("<input type='hidden'>")
							.attr({
								"name": "orderdesc",
								"value": orderdesc
							}).appendTo($f)
			;
			$("body").prepend($f);
			$f.submit();
		}
		
	},
	/*

            <div class="message-expand">
		        <h3 class="message-title">欢迎给我们留言</h3>
		        <div class="message-form">
			        <form role="form" method="post" action="">
				        <div class="form-group">
					        <textarea class="form-control" rows="3" id="txtMgs" name="txtMgs" placeholder="骚年，哪有不爽，来喷吧！"></textarea>
				        </div>
				        <div class="form-group">
					        <input type="password" class="form-control" id="txtMobile" name="txtMobile" placeholder="求手机号码，产品经理给您跪了！" />
				        </div>
				        <div class="form-group">
					        <a href="javascript:;" role="button" class="btn-message mc" id="btn-message">确定留言</a>
				        </div>
			        </form>
		        </div>
		        <a href="javascript:;" class="message-close">X</a>
            </div>
            <div class="message-pre">
                <a href="javascript:;" id="btn-pre-message" class="btn-pre-message">我要<br />留言</a>
            </div>

	*/
	message: {
		mesPanel: function(){
			var $m = "<div class='message-expand'><h3 class='message-title'>欢迎给我们留言</h3><div class='message-form'><form id='mesform' role='form' method='post' action=''><div class='form-group'><textarea class='form-control' rows='3' id='txtMgs' name='content' placeholder='你有什么问题？可以给我们留言，我们竭尽全力为你解决'></textarea></div><div class='form-group'><input type='text' class='form-control' id='txtMobile' name='phone' placeholder='请输入手机号码，方便为你答疑解惑！' /></div><div class='form-group'><input type='text' name='validateCode' id='validateCode' placeholder='请输入验证码' class='form-control' style='width: 60%;'><img id = 'imgvili' src='http://api.data.jcpeixun.com/imageValidate.aspx' style='float: right;height: 35px;width: 80px;display: block;margin-top: -35px;'></div><div class='form-group'><a href='javascript:;' role='button' class='btn-message mc' id='btn-message'>确定留言</a></div></form></div><a href='javascript:;' class='message-close'>X</a></div><div class='message-pre'><a href='javascript:;' id='btn-pre-message' class='btn-pre-message'>我要<br />留言</a></div>";
			$("body").prepend($m);
			$(".message-expand").on("click","#btn-message",function(){
				var 
					txtMgs = $("#txtMgs").val(),
					txtMobile = $("#txtMobile").val(),
					txtCode = $("#validateCode").val()
				;
				$.cookie("CheckCode",txtCode,{expires: 7});
				
				if(!(/^(13[0-9]|14[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9])\d{8}$/).test(txtMobile)){
					var d = dialog({
						title: '温馨提示',
						content: '请输入正确的手机号码',
						quickClose: true,
						align: 'top left',
						fixed: true,
						zIndex: 200000,
						okValue: '我知道了',
						ok: function () {
							$("#txtMobile").focus();
						}
					});
					d.show(document.getElementById('txtMobile'));
					$("#txtMobile").focus();
				}else if(txtCode == ''){
					var d = dialog({
						title: '温馨提示',
						content: '请输入验证码',
						quickClose: true,
						align: 'top left',
						fixed: true,
						zIndex: 200000,
						okValue: '我知道了',
						ok: function () {
							$("#validateCode").focus();
						}
					});
					d.show(document.getElementById('validateCode'));
					$("#validateCode").focus();
				}else{
					var _code = $.cookie("CheckCode");
					$.getJSON("http://api.data.jcpeixun.com/user/CreateMsg?func=addMsg&CheckCode="+_code,$("#mesform").serialize()+"&jsoncallback=?",function(d){
						if(d.errcode=="0" && d.errmsg == "ok"){
					 		var d = dialog({
								title: '温馨提示',
								content: '留言成功!如紧急,请拨免费咨询:400-111-4100',
								quickClose: true,
								align: 'top left',
								fixed: true,
								zIndex: 200000,
								okValue: '我知道了',
								ok: function () {
									$(".message-expand").hide(500);
									$(".message-pre").show();
								}
							});
							d.show(document.getElementById('btn-message'));
					 	}else{
					 		alert(d.errmsg);
					 	}
					});
				}
			});

			$("#btn-pre-message").on("click", function () {
				$(".message-pre").hide();
				$(".message-expand").show(500);

			});

			$(".message-close").on("click", function () {
				$(".message-expand").hide(500);
				$(".message-pre").show();
			});
		}


	},
	
	kefu: {
		online: function(){
			var $k = "<div class='online-kefu' id='online-kefu'><div id='BDBridgeFixedWrap'></div><a id='btn-kefu-close' class='btn-kefu-close' href='javascript:;' title='关闭'>X</a></div><div class='online-kefu-pre' id='online-kefu-pre'><a href='javascript:;' id='btn-kefu-pre' class='btn-kefu-pre'>在线<br>客服</a></div>";
			$("body").append($k);
			
			$("#online-kefu-pre").on("click",function(){
				$("#online-kefu-pre").hide();
				$("#online-kefu").show(500);

				
			});

			$("#btn-kefu-close").on("click",function(){
				$("#online-kefu").hide(500);
				$("#online-kefu-pre").show();
			});


		}
	},

	ad: {
		loadAd: function(_id, doc, _width, _height){
			if($("#"+doc).length){
				$.post("http://www.jcpeixun.com/ashx/ad.aspx", { id: _id, width: _width, height: _height }, function (msg) {
					$("#" + doc).html(msg);
				});
			}
		}

	},
	/*
		$.request

		demo:
			   url:index.html?para=111
			   document.write($.request.getQueStr(location.href,"para"));
	*/
	request: {

		getQueStr: function(url,ref){
			var str=url.substr(url.indexOf('?')+1);if(str.indexOf('&')!=-1){var arr=str.split('&');for(i in arr){if(arr[i].split('=')[0]==ref){return arr[i].split('=')[1]}}}else{return url.substr(url.indexOf('=')+1)}
		},

		getQueStr2: function(ref){
			var reg=new RegExp("(^|&)"+ref+"=([^&]*)(&|$)");var r=window.location.search.substr(1).match(reg);if(r!=null)return unescape(r[2]);return null;
		},

		setQueStr: function(url,ref,value){
			var str="";if(url.indexOf('?')!=-1){str=url.substr(url.indexOf('?')+1)}else{return url+"?"+ref+"="+value}var returnurl="";var setparam="";var arr;var modify="0";if(str.indexOf('&')!=-1){arr=str.split('&');for(i in arr){if(arr[i].split('=')[0]==ref){setparam=value;modify="1"}else{setparam=arr[i].split('=')[1]}returnurl=returnurl+arr[i].split('=')[0]+"="+setparam+"&"}returnurl=returnurl.substr(0,returnurl.length-1);if(modify=="0"){if(returnurl==str){returnurl=returnurl+"&"+ref+"="+value}}}else{if(str.indexOf('=')!=-1){arr=str.split('=');if(arr[0]==ref){setparam=value;modify="1"}else{setparam=arr[1]}returnurl=arr[0]+"="+setparam;if(modify=="0"){if(returnurl==str){returnurl=returnurl+"&"+ref+"="+value}}}else{returnurl=ref+"="+value}}return url.substr(0,url.indexOf('?'))+"?"+returnurl;
		},

		delQueStr:function(url,ref){
			var str="";if(url.indexOf('?')!=-1){str=url.substr(url.indexOf('?')+1)}else{return url}var arr="";var returnurl="";var setparam="";if(str.indexOf('&')!=-1){arr=str.split('&');for(i in arr){if(arr[i].split('=')[0]!=ref){returnurl=returnurl+arr[i].split('=')[0]+"="+arr[i].split('=')[1]+"&"}}return url.substr(0,url.indexOf('?'))+"?"+returnurl.substr(0,returnurl.length-1)}else{arr=str.split('=');if(arr[0]==ref){return url.substr(0,url.indexOf('?'))}else{return url}}
		}

	},
	/*
		$.format

		demo:

			var tem = "{0} is {1}";
			document.write($.format(tem, "this", "format"));

	*/
	format: {
		string:function(source,params){if(arguments.length==1)return function(){var args=$.makeArray(arguments);args.unshift(source);return $.format.apply(this,args)};if(arguments.length>2&&params.constructor!=Array){params=$.makeArray(arguments).slice(1)}if(params.constructor!=Array){params=[params]}$.each(params,function(i,n){source=source.replace(new RegExp("\\{"+i+"\\}","g"),n)});return source}
	},

	/*

		get server by email

	*/
	GotoEmailHost:function(email){
		var hash={'qq.com':'http://mail.qq.com','gmail.com':'http://mail.google.com','sina.com':'http://mail.sina.com.cn','163.com':'http://mail.163.com','126.com':'http://mail.126.com','yeah.net':'http://www.yeah.net/','sohu.com':'http://mail.sohu.com/','tom.com':'http://mail.tom.com/','sogou.com':'http://mail.sogou.com/','139.com':'http://mail.10086.cn/','hotmail.com':'http://www.hotmail.com','live.com':'http://login.live.com/','live.cn':'http://login.live.cn/','live.com.cn':'http://login.live.com.cn','189.com':'http://webmail16.189.cn/webmail/','189.cn':'http://webmail16.189.cn/webmail/','yahoo.com.cn':'http://mail.cn.yahoo.com/','yahoo.cn':'http://mail.cn.yahoo.com/','eyou.com':'http://www.eyou.com/','21cn.com':'http://mail.21cn.com/','188.com':'http://www.188.com/','foxmail.coom':'http://www.foxmail.com'};var url=email.split('@')[1];return hash[url];
	},
	/*

		validate email

	*/
	CheckEmail:function(email){
		return /^\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-+.]\w+)*$/.test(email)
	},
	/*

		validate mobile

	*/
	CheckMobile:function(mobile){
		return /^1[3|4|5|7|8][0-9]\d{8}$/.test(mobile)
	},
	/*

		validate uname

	*/
	CheckUname:function(uname){
		return /^([a-z0-9_-]){5,15}$/i.test(uname)
	},
	/*

		validate upwd

	*/
	CheckUpwd:function(upwd){
		return /^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,20}$/.test(upwd)
	},
	/*

		validate tname

	*/
	CheckTname:function(tname){
		return /^[\u0391-\uFFE5]{2,5}$/.test(tname)
	},
	/*

		validate number

	*/
	CheckNumber1:function(number1){
		return /^[1-9]\d*$/.text(number1)
	},
	/*

		copyToClipBoard

	*/
	CopyToClipBoard:function(str){
		var clipBoardContent="";clipBoardContent+=str;if(window.clipboardData){window.clipboardData.clearData();window.clipboardData.setData("Text",clipBoardContent)}else{return false}return true;
	},
	/*

		GetBrowserInfor
		
	*/
	GetBrowserInfor:function(){
		var browser={msie:false,firefox:false,opera:false,safari:false,chrome:false,netscape:false,appname:'unknown',version:0},userAgent=window.navigator.userAgent.toLowerCase();if(/(msie|firefox|opera|chrome|netscape)\D+(\d[\d.]*)/.test(userAgent)){browser[RegExp.$1]=true;browser.appname=RegExp.$1;browser.version=RegExp.$2}else if(/version\D+(\d[\d.]*).*safari/.test(userAgent)){browser.safari=true;browser.appname='safari';browser.version=RegExp.$2}return browser.msie?"ie "+browser.version:browser.appname+browser.version
	},
	/*
		生成number位随机（小于32）
	*/
	CreateRadom:function(number){
		if(!isNaN(number)){var charactors="abcd2ef3gh4ij5k6mn7pq8rst9uvwxyz";var value='',i;for(j=1;j<=number;j++){i=parseInt(32*Math.random());value=value+charactors.charAt(i)}return value}else{return"parameter："+number+" not's number"}
	},

	
	/* 
		时间比较 
	*/
	CompareTime: function(startTime,endTime){
		var start = startTime.split("/");
		var end = endTime.split("/");
		var sdate=new Date(start[0],start[1],start[2],start[3],start[4],start[5]);
		var edate=new Date(end[0],end[1],end[2],end[3],end[4],end[5]);
		if(sdate.getTime()>edate.getTime())
		{
			return true;
		}
		return false;
	},

	/* 
		锚点跳转 
	*/
	anchor: function(p,fn) {
		$("html,body").animate({ scrollTop: $("#" + p + "").offset().top }, 1000,fn);
	},

	/* 
		锚点跳转2 
	*/
	anchor2: function(p,t,fn) {
		$("html,body").animate({ scrollTop: $("#" + p + "").offset().top + t }, 1000,fn);
	},

	/*	
		文字垂直无缝滚动	
	*/
	VerticalRoll: function(id){
		setInterval(function () {
			$("#"+id+" li:last").hide().insertBefore($("#"+id+" li:first")).slideDown(1000);
		}, 5000);
	},

	/*
		收藏网站
		demo:<a href="javascript:addToFavorite('技成(自动化)培训','http://www.jcpeixun.com/');">加入收藏</a>
	*/
	addToFavorite: function(title,url) {
		if (document.all) {
			window.external.AddFavorite(url, title);
		} else {
			if (window.sidebar) {
				window.sidebar.addPanel(title, url, "");
			} else {
				alert("对不起，您的浏览器不支持此操作!\n请您使用菜单栏或Ctrl+D收藏本站。");
			}
		}
	},
	/*
		formatdate("2013-1-19", "yyyy-mm-dd hh:mm:ss")
		formatdate("2013-1-19 3:30:00", "yyyy-mm-dd hh:mm:ss")
	*/
	formatDate: function(date){
		try{
			return new Date(Date.parse(date.replace(/-/g, "/")));
		}catch(ex){
		
		}
	}


});


/*! artDialog v6.0.2 | https://github.com/aui/artDialog */
!function(){function a(b){var d=c[b],e="exports";return"object"==typeof d?d:(d[e]||(d[e]={},d[e]=d.call(d[e],a,d[e],d)||d[e]),d[e])}function b(a,b){c[a]=b}var c={};b("jquery",function(){return jQuery}),b("popup",function(a){function b(){this.destroyed=!1,this.__popup=c("<div />").attr({tabindex:"-1"}).css({display:"none",position:"absolute",outline:0}).html(this.innerHTML).appendTo("body"),this.__backdrop=c("<div />"),this.node=this.__popup[0],this.backdrop=this.__backdrop[0],d++}var c=a("jquery"),d=0,e=!("minWidth"in c("html")[0].style),f=!e;return c.extend(b.prototype,{node:null,backdrop:null,fixed:!1,destroyed:!0,open:!1,returnValue:"",autofocus:!0,align:"bottom left",backdropBackground:"#000",backdropOpacity:.7,innerHTML:"",className:"ui-popup",show:function(a){if(this.destroyed)return this;var b=this,d=this.__popup;return this.__activeElement=this.__getActive(),this.open=!0,this.follow=a||this.follow,this.__ready||(d.addClass(this.className),this.modal&&this.__lock(),d.html()||d.html(this.innerHTML),e||c(window).on("resize",this.__onresize=function(){b.reset()}),this.__ready=!0),d.addClass(this.className+"-show").attr("role",this.modal?"alertdialog":"dialog").css("position",this.fixed?"fixed":"absolute").show(),this.__backdrop.show(),this.reset().focus(),this.__dispatchEvent("show"),this},showModal:function(){return this.modal=!0,this.show.apply(this,arguments)},close:function(a){return!this.destroyed&&this.open&&(void 0!==a&&(this.returnValue=a),this.__popup.hide().removeClass(this.className+"-show"),this.__backdrop.hide(),this.open=!1,this.blur(),this.__dispatchEvent("close")),this},remove:function(){if(this.destroyed)return this;this.__dispatchEvent("beforeremove"),b.current===this&&(b.current=null),this.__unlock(),this.__popup.remove(),this.__backdrop.remove(),e||c(window).off("resize",this.__onresize),this.__dispatchEvent("remove");for(var a in this)delete this[a];return this},reset:function(){var a=this.follow;return a?this.__follow(a):this.__center(),this.__dispatchEvent("reset"),this},focus:function(){var a=this.node,d=b.current;if(d&&d!==this&&d.blur(!1),!c.contains(a,this.__getActive())){var e=this.__popup.find("[autofocus]")[0];!this._autofocus&&e?this._autofocus=!0:e=a,this.__focus(e)}return b.current=this,this.__popup.addClass(this.className+"-focus"),this.__zIndex(),this.__dispatchEvent("focus"),this},blur:function(){var a=this.__activeElement,b=arguments[0];return b!==!1&&this.__focus(a),this._autofocus=!1,this.__popup.removeClass(this.className+"-focus"),this.__dispatchEvent("blur"),this},addEventListener:function(a,b){return this.__getEventListener(a).push(b),this},removeEventListener:function(a,b){for(var c=this.__getEventListener(a),d=0;d<c.length;d++)b===c[d]&&c.splice(d--,1);return this},__getEventListener:function(a){var b=this.__listener;return b||(b=this.__listener={}),b[a]||(b[a]=[]),b[a]},__dispatchEvent:function(a){var b=this.__getEventListener(a);this["on"+a]&&this["on"+a]();for(var c=0;c<b.length;c++)b[c].call(this)},__focus:function(a){try{this.autofocus&&!/^iframe$/i.test(a.nodeName)&&a.focus()}catch(b){}},__getActive:function(){try{var a=document.activeElement,b=a.contentDocument,c=b&&b.activeElement||a;return c}catch(d){}},__zIndex:function(){var a=b.zIndex++;this.__popup.css("zIndex",a),this.__backdrop.css("zIndex",a-1),this.zIndex=a},__center:function(){var a=this.__popup,b=c(window),d=c(document),e=this.fixed,f=e?0:d.scrollLeft(),g=e?0:d.scrollTop(),h=b.width(),i=b.height(),j=a.width(),k=a.height(),l=(h-j)/2+f,m=382*(i-k)/1e3+g,n=a[0].style;n.left=Math.max(parseInt(l),f)+"px",n.top=Math.max(parseInt(m),g)+"px"},__follow:function(a){var b=a.parentNode&&c(a),d=this.__popup;if(this.__followSkin&&d.removeClass(this.__followSkin),b){var e=b.offset();if(e.left*e.top<0)return this.__center()}var f=this,g=this.fixed,h=c(window),i=c(document),j=h.width(),k=h.height(),l=i.scrollLeft(),m=i.scrollTop(),n=d.width(),o=d.height(),p=b?b.outerWidth():0,q=b?b.outerHeight():0,r=this.__offset(a),s=r.left,t=r.top,u=g?s-l:s,v=g?t-m:t,w=g?0:l,x=g?0:m,y=w+j-n,z=x+k-o,A={},B=this.align.split(" "),C=this.className+"-",D={top:"bottom",bottom:"top",left:"right",right:"left"},E={top:"top",bottom:"top",left:"left",right:"left"},F=[{top:v-o,bottom:v+q,left:u-n,right:u+p},{top:v,bottom:v-o+q,left:u,right:u-n+p}],G={left:u+p/2-n/2,top:v+q/2-o/2},H={left:[w,y],top:[x,z]};c.each(B,function(a,b){F[a][b]>H[E[b]][1]&&(b=B[a]=D[b]),F[a][b]<H[E[b]][0]&&(B[a]=D[b])}),B[1]||(E[B[1]]="left"===E[B[0]]?"top":"left",F[1][B[1]]=G[E[B[1]]]),C+=B.join("-")+" "+this.className+"-follow",f.__followSkin=C,b&&d.addClass(C),A[E[B[0]]]=parseInt(F[0][B[0]]),A[E[B[1]]]=parseInt(F[1][B[1]]),d.css(A)},__offset:function(a){var b=a.parentNode,d=b?c(a).offset():{left:a.pageX,top:a.pageY};a=b?a:a.target;var e=a.ownerDocument,f=e.defaultView||e.parentWindow;if(f==window)return d;var g=f.frameElement,h=c(e),i=h.scrollLeft(),j=h.scrollTop(),k=c(g).offset(),l=k.left,m=k.top;return{left:d.left+l-i,top:d.top+m-j}},__lock:function(){var a=this,d=this.__popup,e=this.__backdrop,g={position:"fixed",left:0,top:0,width:"100%",height:"100%",overflow:"hidden",userSelect:"none",opacity:0,background:this.backdropBackground};d.addClass(this.className+"-modal"),b.zIndex=b.zIndex+2,this.__zIndex(),f||c.extend(g,{position:"absolute",width:c(window).width()+"px",height:c(document).height()+"px"}),e.css(g).animate({opacity:this.backdropOpacity},150).insertAfter(d).attr({tabindex:"0"}).on("focus",function(){a.focus()})},__unlock:function(){this.modal&&(this.__popup.removeClass(this.className+"-modal"),this.__backdrop.remove(),delete this.modal)}}),b.zIndex=1024,b.current=null,b}),b("dialog-config",{content:'<span class="ui-dialog-loading">Loading..</span>',title:"",statusbar:"",button:null,ok:null,cancel:null,okValue:"ok",cancelValue:"cancel",cancelDisplay:!0,width:"",height:"",padding:"",skin:"",quickClose:!1,cssUri:"../css/ui-dialog.css",innerHTML:'<div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tr><td i="header" class="ui-dialog-header"><button i="close" class="ui-dialog-close">&#215;</button><div i="title" class="ui-dialog-title"></div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content"></div></td></tr><tr><td i="footer" class="ui-dialog-footer"><div i="statusbar" class="ui-dialog-statusbar"></div><div i="button" class="ui-dialog-button"></div></td></tr></table></div>'}),b("dialog",function(a){var b=a("jquery"),c=a("popup"),d=a("dialog-config"),e=d.cssUri;if(e){var f=a[a.toUrl?"toUrl":"resolve"];f&&(e=f(e),e='<link rel="stylesheet" href="'+e+'" />',b("base")[0]?b("base").before(e):b("head").append(e))}var g=0,h=new Date-0,i=!("minWidth"in b("html")[0].style),j="createTouch"in document&&!("onmousemove"in document)||/(iPhone|iPad|iPod)/i.test(navigator.userAgent),k=!i&&!j,l=function(a,c,d){var e=a=a||{};("string"==typeof a||1===a.nodeType)&&(a={content:a,fixed:!j}),a=b.extend(!0,{},l.defaults,a),a._=e;var f=a.id=a.id||h+g,i=l.get(f);return i?i.focus():(k||(a.fixed=!1),a.quickClose&&(a.modal=!0,e.backdropOpacity||(a.backdropOpacity=0)),b.isArray(a.button)||(a.button=[]),void 0!==d&&(a.cancel=d),a.cancel&&a.button.push({id:"cancel",value:a.cancelValue,callback:a.cancel,display:a.cancelDisplay}),void 0!==c&&(a.ok=c),a.ok&&a.button.push({id:"ok",value:a.okValue,callback:a.ok,autofocus:!0}),l.list[f]=new l.create(a))},m=function(){};m.prototype=c.prototype;var n=l.prototype=new m;return l.create=function(a){var d=this;b.extend(this,new c);var e=b(this.node).html(a.innerHTML);return this.options=a,this._popup=e,b.each(a,function(a,b){"function"==typeof d[a]?d[a](b):d[a]=b}),a.zIndex&&(c.zIndex=a.zIndex),e.attr({"aria-labelledby":this._$("title").attr("id","title:"+this.id).attr("id"),"aria-describedby":this._$("content").attr("id","content:"+this.id).attr("id")}),this._$("close").css("display",this.cancel===!1?"none":"").attr("title",this.cancelValue).on("click",function(a){d._trigger("cancel"),a.preventDefault()}),this._$("dialog").addClass(this.skin),this._$("body").css("padding",this.padding),a.quickClose&&b(this.backdrop).on("onmousedown"in document?"mousedown":"click",function(){return d._trigger("cancel"),!1}),this._esc=function(a){var b=a.target,e=b.nodeName,f=/^input|textarea$/i,g=c.current===d,h=a.keyCode;!g||f.test(e)&&"button"!==b.type||27===h&&d._trigger("cancel")},b(document).on("keydown",this._esc),this.addEventListener("remove",function(){b(document).off("keydown",this._esc),delete l.list[this.id]}),g++,l.oncreate(this),this},l.create.prototype=n,b.extend(n,{content:function(a){return this._$("content").empty("")["object"==typeof a?"append":"html"](a),this.reset()},title:function(a){return this._$("title").text(a),this._$("header")[a?"show":"hide"](),this},width:function(a){return this._$("content").css("width",a),this.reset()},height:function(a){return this._$("content").css("height",a),this.reset()},button:function(a){a=a||[];var c=this,d="",e=0;return this.callbacks={},"string"==typeof a?(d=a,e++):b.each(a,function(a,b){b.id=b.id||b.value,c.callbacks[b.id]=b.callback;var f="";b.display===!1?f=' style="display:none"':e++,d+='<button type="button" data-id="'+b.id+'"'+f+(b.disabled?" disabled":"")+(b.autofocus?' autofocus class="ui-dialog-autofocus"':"")+">"+b.value+"</button>"}),this._$("footer")[e?"show":"hide"](),this._$("button").html(d).on("click","[data-id]",function(a){var d=b(this);d.attr("disabled")||c._trigger(d.data("id")),a.preventDefault()}),this},statusbar:function(a){return this._$("statusbar").html(a)[a?"show":"hide"](),this},_$:function(a){return this._popup.find("[i="+a+"]")},_trigger:function(a){var b=this.callbacks[a];return"function"!=typeof b||b.call(this)!==!1?this.close().remove():this}}),l.oncreate=b.noop,l.getCurrent=function(){return c.current},l.get=function(a){return void 0===a?l.list:l.list[a]},l.list={},l.defaults=d,l}),window.dialog=a("dialog")}();


/*!art-template - Template Engine | http://aui.github.com/artTemplate/*/
!function(){function a(a){return a.replace(t,"").replace(u,",").replace(v,"").replace(w,"").replace(x,"").split(y)}function b(a){return"'"+a.replace(/('|\\)/g,"\\$1").replace(/\r/g,"\\r").replace(/\n/g,"\\n")+"'"}function c(c,d){function e(a){return m+=a.split(/\n/).length-1,k&&(a=a.replace(/\s+/g," ").replace(/<!--[\w\W]*?-->/g,"")),a&&(a=s[1]+b(a)+s[2]+"\n"),a}function f(b){var c=m;if(j?b=j(b,d):g&&(b=b.replace(/\n/g,function(){return m++,"$line="+m+";"})),0===b.indexOf("=")){var e=l&&!/^=[=#]/.test(b);if(b=b.replace(/^=[=#]?|[\s;]*$/g,""),e){var f=b.replace(/\s*\([^\)]+\)/,"");n[f]||/^(include|print)$/.test(f)||(b="$escape("+b+")")}else b="$string("+b+")";b=s[1]+b+s[2]}return g&&(b="$line="+c+";"+b),r(a(b),function(a){if(a&&!p[a]){var b;b="print"===a?u:"include"===a?v:n[a]?"$utils."+a:o[a]?"$helpers."+a:"$data."+a,w+=a+"="+b+",",p[a]=!0}}),b+"\n"}var g=d.debug,h=d.openTag,i=d.closeTag,j=d.parser,k=d.compress,l=d.escape,m=1,p={$data:1,$filename:1,$utils:1,$helpers:1,$out:1,$line:1},q="".trim,s=q?["$out='';","$out+=",";","$out"]:["$out=[];","$out.push(",");","$out.join('')"],t=q?"$out+=text;return $out;":"$out.push(text);",u="function(){var text=''.concat.apply('',arguments);"+t+"}",v="function(filename,data){data=data||$data;var text=$utils.$include(filename,data,$filename);"+t+"}",w="'use strict';var $utils=this,$helpers=$utils.$helpers,"+(g?"$line=0,":""),x=s[0],y="return new String("+s[3]+");";r(c.split(h),function(a){a=a.split(i);var b=a[0],c=a[1];1===a.length?x+=e(b):(x+=f(b),c&&(x+=e(c)))});var z=w+x+y;g&&(z="try{"+z+"}catch(e){throw {filename:$filename,name:'Render Error',message:e.message,line:$line,source:"+b(c)+".split(/\\n/)[$line-1].replace(/^\\s+/,'')};}");try{var A=new Function("$data","$filename",z);return A.prototype=n,A}catch(B){throw B.temp="function anonymous($data,$filename) {"+z+"}",B}}var d=function(a,b){return"string"==typeof b?q(b,{filename:a}):g(a,b)};d.version="3.0.0",d.config=function(a,b){e[a]=b};var e=d.defaults={openTag:"<%",closeTag:"%>",escape:!0,cache:!0,compress:!1,parser:null},f=d.cache={};d.render=function(a,b){return q(a,b)};var g=d.renderFile=function(a,b){var c=d.get(a)||p({filename:a,name:"Render Error",message:"Template not found"});return b?c(b):c};d.get=function(a){var b;if(f[a])b=f[a];else if("object"==typeof document){var c=document.getElementById(a);if(c){var d=(c.value||c.innerHTML).replace(/^\s*|\s*$/g,"");b=q(d,{filename:a})}}return b};var h=function(a,b){return"string"!=typeof a&&(b=typeof a,"number"===b?a+="":a="function"===b?h(a.call(a)):""),a},i={"<":"&#60;",">":"&#62;",'"':"&#34;","'":"&#39;","&":"&#38;"},j=function(a){return i[a]},k=function(a){return h(a).replace(/&(?![\w#]+;)|[<>"']/g,j)},l=Array.isArray||function(a){return"[object Array]"==={}.toString.call(a)},m=function(a,b){var c,d;if(l(a))for(c=0,d=a.length;d>c;c++)b.call(a,a[c],c,a);else for(c in a)b.call(a,a[c],c)},n=d.utils={$helpers:{},$include:g,$string:h,$escape:k,$each:m};d.helper=function(a,b){o[a]=b};var o=d.helpers=n.$helpers;d.onerror=function(a){var b="Template Error\n\n";for(var c in a)b+="<"+c+">\n"+a[c]+"\n\n";"object"==typeof console&&console.error(b)};var p=function(a){return d.onerror(a),function(){return"{Template Error}"}},q=d.compile=function(a,b){function d(c){try{return new i(c,h)+""}catch(d){return b.debug?p(d)():(b.debug=!0,q(a,b)(c))}}b=b||{};for(var g in e)void 0===b[g]&&(b[g]=e[g]);var h=b.filename;try{var i=c(a,b)}catch(j){return j.filename=h||"anonymous",j.name="Syntax Error",p(j)}return d.prototype=i.prototype,d.toString=function(){return i.toString()},h&&b.cache&&(f[h]=d),d},r=n.$each,s="break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",t=/\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|\s*\.\s*[$\w\.]+/g,u=/[^\w$]+/g,v=new RegExp(["\\b"+s.replace(/,/g,"\\b|\\b")+"\\b"].join("|"),"g"),w=/^\d[^,]*|,\d[^,]*/g,x=/^,+|,+$/g,y=/^$|,+/;e.openTag="{{",e.closeTag="}}";var z=function(a,b){var c=b.split(":"),d=c.shift(),e=c.join(":")||"";return e&&(e=", "+e),"$helpers."+d+"("+a+e+")"};e.parser=function(a){a=a.replace(/^\s/,"");var b=a.split(" "),c=b.shift(),e=b.join(" ");switch(c){case"if":a="if("+e+"){";break;case"else":b="if"===b.shift()?" if("+b.join(" ")+")":"",a="}else"+b+"{";break;case"/if":a="}";break;case"each":var f=b[0]||"$data",g=b[1]||"as",h=b[2]||"$value",i=b[3]||"$index",j=h+","+i;"as"!==g&&(f="[]"),a="$each("+f+",function("+j+"){";break;case"/each":a="});";break;case"echo":a="print("+e+");";break;case"print":case"include":a=c+"("+b.join(",")+");";break;default:if(/^\s*\|\s*[\w\$]/.test(e)){var k=!0;0===a.indexOf("#")&&(a=a.substr(1),k=!1);for(var l=0,m=a.split("|"),n=m.length,o=m[l++];n>l;l++)o=z(o,m[l]);a=(k?"=":"=#")+o}else a=d.helpers[c]?"=#"+c+"("+b.join(",")+");":"="+a}return a},"function"==typeof define?define(function(){return d}):"undefined"!=typeof exports?module.exports=d:this.template=d}();

/*
	图片广告切换效果，支持元素顺序呈现
	demo:

			<div class="DB_tab25">
				<ul class="DB_bgSet">
					<li style="background:url(images/bj1.jpg) no-repeat 100% 100%;"></li>
					<li style="background:#e66c57"></li>
					<li style="background:#202f3d"></li>
					<li style="background:url(images/bj2.jpg) no-repeat 100% 100%;"></li>
				</ul>

				<ul class="DB_imgSet">
					<li>
						<a href=""><img class="DB_1_1" src="images/kjzname.png" alt=""></a>
						<a href=""><img class="DB_1_2" src="images/kjzjx.png" alt=""></a>
						<a href=""><img class="DB_1_3" src="images/bn_01.png" alt=""></a>
					</li>

					<li>
						<img class="DB_2_1" src="images/addchelun.png" alt="">
						<img class="DB_2_2" src="images/addt.png" alt="">
						<img class="DB_2_3" src="images/zw.png" alt="">
					</li>

					<li>
						<img class="DB_3_1" src="images/bn32.png" alt="">
						<img class="DB_3_2" src="images/bn33.png" alt="">
						<img class="DB_3_3" src="images/bn3.png" alt="">
					</li>

					<li>
						<img class="DB_4_1" src="images/bn_04.png" alt="">
						<img class="DB_4_2" src="images/bn_042.png" alt="">
						<img class="DB_4_3" src="images/bn_043.png" alt="">
						<img class="DB_4_4" src="images/bn_044.png" alt="">
					</li>
				</ul>

				<div class="DB_menuWrap">
					<ul class="DB_menuSet">
						<li><img src="images/btn_off.png" alt=""></li>
						<li><img src="images/btn_off.png" alt=""></li>
						<li><img src="images/btn_off.png" alt=""></li>
						<li><img src="images/btn_off.png" alt=""></li>
					</ul>
					<div class="DB_next"><img src="images/nextArrow.png" alt="NEXT"></div>
					<div class="DB_prev"><img src="images/prevArrow.png" alt="PREV"></div>
				</div>

			</div>
			<script type="text/javascript">
			$('.DB_tab25').DB_tabMotionBanner({
				key:'b28551',
				autoRollingTime:10000,                            
				bgSpeed:500,
				motion:{
					DB_1_1:{left:-50,opacity:0,speed:1000,delay:500},
					DB_1_2:{left:-50,opacity:0,speed:1000,delay:1000},
					DB_1_3:{left:100,opacity:0,speed:1000,delay:1500},
					DB_2_1:{top:50,opacity:0,speed:1000,delay:500},
					DB_2_2:{top:50,opacity:0,speed:1000,delay:1000},
					DB_2_3:{top:100,opacity:0,speed:1000,delay:1500},
					DB_3_1:{left:-50,opacity:0,speed:1000,delay:500},
					DB_3_2:{top:50,opacity:0,speed:1000,delay:1000},
					DB_3_3:{top:0,opacity:0,speed:1000,delay:1500},
					DB_4_1:{top:50,opacity:0,speed:1000,delay:500},
					DB_4_2:{top:0,opacity:0,speed:1000,delay:1000},
					DB_4_3:{top:0,opacity:0,speed:1000,delay:1500},
					DB_4_4:{top:30,opacity:0,speed:1000,delay:2000},
					DB_4_5:{top:100,opacity:0,speed:1000,delay:3000},
					end:null
				}
			})
			</script>
		
*/
;(function(a){a.fn.DB_tabMotionBanner=function(b){var c={key:"",autoRollingTime:3000,bgSpeed:1000,motion:""};a.extend(c,b);return this.each(function(){var h=a(this);var k=h.find(".DB_imgSet");var r=h.find(".DB_imgSet li");var i=h.find(".DB_menuSet");var m=h.find(".DB_menuSet li");var e=h.find(".DB_bgSet li");var q=h.find(".DB_next");var g=h.find(".DB_prev");var f=r.length;var p=0;var j=0;s();function s(){l();d();t();o()}function l(){k.css({position:"relative"});r.css({position:"absolute"});for(var y=0;y<f;y++){if(y==p){r.eq(y).show()}else{r.eq(y).hide()}}for(var y=0;y<r.length;y++){var x=r.eq(y).find("img");for(var w=0;w<x.length;w++){var A=x.eq(w);var v=c.motion[A.attr("class")];if(v!=null){var z=Number(A.css("left").split("px")[0]);var B=Number(A.css("top").split("px")[0]);A.data({x2:z,y2:B,x1:z+v.left,y1:B+v.top,opacity:v.opacity,speed:v.speed,delay:v.delay==null?0:v.delay})}}}}function d(){h.bind("mouseenter",function(){clearInterval(j);q.show();g.show()});h.bind("mouseleave",function(){t();q.hide();g.hide()});m.bind("click",function(){if(a(this).index()!=p){p=a(this).index();o()}});m.bind("mouseenter",function(){n(a(this).find("img"),"src","_off","_on")});m.bind("mouseleave",function(){if(p!=a(this).index()){n(a(this).find("img"),"src","_on","_off")}});q.bind("click",function(){u()});g.bind("click",function(){p--;if(p==-1){p=f-1}o()})}function u(){p=++p%f;o()}function t(){j=setInterval(u,c.autoRollingTime)}function o(){for(var z=0;z<r.length;z++){var A=r.eq(z);var y=e.eq(z);if(p==z){A.show();var x=A.find("img");for(var w=0;w<x.length;w++){var A=x.eq(w);var v=c.motion[A.attr("class")];if(v!=null){if(A.attr("src").indexOf(".png")>0&&a.browser.msie&&a.browser.version<9){A.css({left:A.data("x1"),top:A.data("y1"),opacity:1,display:"none"})}else{A.css({left:A.data("x1"),top:A.data("y1"),opacity:A.data("opacity")})}A.stop().delay(A.data("delay")).queue(function(){a(this).css("display","block");a(this).dequeue()}).animate({left:A.data("x2"),top:A.data("y2"),opacity:1},A.data("speed"))}}n(m.eq(z).find("img"),"src","_off","_on");m.eq(z).addClass("select");y.stop(true,true).fadeIn(c.bgSpeed)}else{A.hide();n(m.eq(z).find("img"),"src","_on","_off");m.eq(z).removeClass("select");y.stop(true,true).fadeOut(c.bgSpeed)}}}function n(w,z,v,x){var y=w.attr(z);if(String(y).search(v)!=-1){w.attr(z,y.replace(v,x))}}})}})(jQuery);


/*

	$.toJSON

	demo:

		var obj = {
                name: "jack",
                age:18
            }

		$.toJSON(obj);


*/
(function($){'use strict';var escape=/["\\\x00-\x1f\x7f-\x9f]/g,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},hasOwn=Object.prototype.hasOwnProperty;$.toJSON=typeof JSON==='object'&&JSON.stringify?JSON.stringify:function(o){if(o===null){return'null'}var pairs,k,name,val,type=$.type(o);if(type==='undefined'){return undefined}if(type==='number'||type==='boolean'){return String(o)}if(type==='string'){return $.quoteString(o)}if(typeof o.toJSON==='function'){return $.toJSON(o.toJSON())}if(type==='date'){var month=o.getUTCMonth()+1,day=o.getUTCDate(),year=o.getUTCFullYear(),hours=o.getUTCHours(),minutes=o.getUTCMinutes(),seconds=o.getUTCSeconds(),milli=o.getUTCMilliseconds();if(month<10){month='0'+month}if(day<10){day='0'+day}if(hours<10){hours='0'+hours}if(minutes<10){minutes='0'+minutes}if(seconds<10){seconds='0'+seconds}if(milli<100){milli='0'+milli}if(milli<10){milli='0'+milli}return'"'+year+'-'+month+'-'+day+'T'+hours+':'+minutes+':'+seconds+'.'+milli+'Z"'}pairs=[];if($.isArray(o)){for(k=0;k<o.length;k++){pairs.push($.toJSON(o[k])||'null')}return'['+pairs.join(',')+']'}if(typeof o==='object'){for(k in o){if(hasOwn.call(o,k)){type=typeof k;if(type==='number'){name='"'+k+'"'}else if(type==='string'){name=$.quoteString(k)}else{continue}type=typeof o[k];if(type!=='function'&&type!=='undefined'){val=$.toJSON(o[k]);pairs.push(name+':'+val)}}}return'{'+pairs.join(',')+'}'}};$.quoteString=function(str){if(str.match(escape)){return'"'+str.replace(escape,function(a){var c=meta[a];if(typeof c==='string'){return c}c=a.charCodeAt();return'\\u00'+Math.floor(c/16).toString(16)+(c%16).toString(16)})+'"'}return'"'+str+'"'}}(jQuery));

/*

	倒计时

*/
(function($){$.fn.extend({countdown:function(options){var defaults={id1:"cdown_tips",id2:"send_code",timer:60};var options=$.extend(defaults,options);return this.each(function(){var obj=$(this);var o=options;obj.html("<a id=\"send_code\" href=\"javascript:;\" class=\"btn_orange1-100-25\">点击获取验证码</a><strong style=\"display: none;\" class=\"cdown_tips\" id=\"cdown_tips\">60秒后才能再发送</strong>");var $id1=$("#"+o.id1,obj);var $id2=$("#"+o.id2,obj);$id2.click(function(){$id2.hide();var i=o.timer;var fn=function(){$id1.html(i+"秒后才能再次发送");!i&&$id1.hide()&&$id2.show()&&clearInterval(o.timer);i--};o.timer=setInterval(fn,1000);fn();$id1.show()})})}})})(jQuery);


/* 

	hoverForIE6 
	a标签:hover，延时加载

*/
(function($){$.fn.hoverForIE6=function(option){var s=$.extend({current:"hover",delay:10},option||{});$.each(this,function(){var timer1=null,timer2=null,flag=false;$(this).bind("mouseover",function(){if(flag){clearTimeout(timer2)}else{var _this=$(this);timer1=setTimeout(function(){_this.addClass(s.current);flag=true},s.delay)}}).bind("mouseout",function(){if(flag){var _this=$(this);timer2=setTimeout(function(){_this.removeClass(s.current);flag=false},s.delay)}else{clearTimeout(timer1)}})})}})(jQuery);


/*

	自动显示邮箱下拉列表

	demo:

	$('#uEmail').autoMail({
        emails: ['qq.com', '163.com', '126.com', 'sina.com', 'sohu.com', 'yahoo.cn', 'gmail.com', 'hotmail.com', 'live.cn']
    });

 */
(function($){
	$.fn.autoMail = function(options){
		var opts = $.extend({}, $.fn.autoMail.defaults, options);
		return this.each(function(){
			var $this = $(this);
			var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

			var top = $this.offset().top + $this.height() + 6;
			var left = $this.offset().left;
			var $mailBox = $('<div id="mailBox" style="top:'+top+'px;left:'+left+'px;width:'+$this.width()+'px"></div>');
			$('body').append($mailBox);

			/*设置高亮li*/
			function setEmailLi(index){
				$('#mailBox li').removeClass('cmail').eq(index).addClass('cmail');
			}
			/*初始化邮箱列表*/
			var emails = o.emails;
			var init = function(input){
				/*取消浏览器自动提示*/
				input.attr('autocomplete','off');
				/*添加提示邮箱列表*/
				if(input.val()!=""){
					/*var emailList = '<p>请选择邮箱类型</p><ul>';*/
					var emailList = "";
					for(var i = 0; i < emails.length; i++) {
						emailList += '<li>'+input.val()+'@'+emails[i]+'</li>';
					}
					emailList += '</ul>';
					$mailBox.html(emailList).show(0);
				}else{
					$mailBox.hide(0);
				}
				/*添加鼠标事件*/
				$('#mailBox li').hover(function(){
					$('#mailBox li').removeClass('cmail');
					$(this).addClass('cmail');
				},function(){
					$(this).removeClass('cmail');
				}).click(function(){
					input.val($(this).html());
					$mailBox.hide(0);
				});
			}
			/*当前高亮下标*/
			var eindex = -1;
			/*监听事件*/
			$this.focus(function(){
				if($this.val().indexOf('@') == -1){
					init($this);
				}else{
					$mailBox.hide(0);
				}
			}).blur(function(){
				setTimeout(function(){
					$mailBox.hide(0);
				},1000);//
			}).keyup(function(event){
				if($this.val().indexOf('@') == -1){
					/*上键*/
					if(event.keyCode == 40){
						eindex ++;
						if(eindex >= $('#mailBox li').length){
							eindex = 0;
						}
						setEmailLi(eindex);
					/*下键*/
					}else if(event.keyCode == 38){
						eindex --;
						if(eindex < 0){
							eindex = $('#mailBox li').length-1;
						}
						setEmailLi(eindex);
					/*回车键*/
					}else if(event.keyCode == 13){
						if(eindex >= 0){
							$this.val($('#mailBox li').eq(eindex).html());
							$mailBox.hide(0);
						}
					}else{
						eindex = -1;
						init($this);
					}
				}else{
					$mailBox.hide(0);
				}
			/*如果在表单中，防止回车提交*/
			}).keydown(function(event){
				if(event.keyCode == 13){
					return false;
				}
			});
		});
	}
	$.fn.autoMail.defaults = {
		emails:[]
	}
})(jQuery);


/*
	弹层提示
	jcTip
	ty：（error:错误；succ:成功；notice:消息；loading:等待）
*/
$(function(){$.fn.jcTip=function(options){var defaults={timeOut:2000,ty:"notice",msg:""};var options=$.extend(defaults,options);var $tip=$(this);var type=options.ty;var msg=options.msg;var tipHtml='';if(type=='loading'){tipHtml='<img alt="" src="/images/loading.gif">'+(msg?msg:'请稍候...')}else if(type=='notice'){tipHtml='<span class="gtl_ico_hits"></span>'+msg}else if(type=='error'){tipHtml='<span class="gtl_ico_fail"></span>'+msg}else if(type=='succ'){tipHtml='<span class="gtl_ico_succ"></span>'+msg}if($('.msgbox_layer_wrap')){$('.msgbox_layer_wrap').remove()}if(st){clearTimeout(st)}$("body").prepend("<div class='msgbox_layer_wrap'><span id='mode_tips_v2' style='z-index: 10000;' class='msgbox_layer'><span class='gtl_ico_clear'></span>"+tipHtml+"<span class='gtl_end'></span></span></div>");$(".msgbox_layer_wrap").show();var st=setTimeout(function(){$(".msgbox_layer_wrap").hide();clearTimeout(st)},options.timeOut)}});

/* 
	弹窗
	Boxen 
*/
(function($){$.fn.extend({boxen:function(url,options){switch(typeof url){case'object':options=url;break;case'string':options=$.extend({},{url:url,urlAttribute:null},options);break}return this.click(function(e){$.Boxen.open(this,options);return false})}});$.Boxen={defaults:{urlParams:{},showTitleBar:true,showCloseButton:true,title:'温馨提示',titleAttribute:'title',closeButtonText:'X',width:600,height:380,url:null,urlAttribute:'href',overlayOpacity:0.4,overlayColor:null,modal:true,postOpen:function(contentAreaElement){},postClose:function(){}},bigIFrame:null,overlay:null,container:null,options:null,titleBar:null,closeButton:null,contentWindow:null,contentArea:null,ie6:false,setOptions:function(options){this.options=$.extend({},this.defaults,options||{});return this},getFullUrl:function(){var url=this.options.url;url+=url.indexOf('?')==-1?'?':'&';return url+=$.param(this.options.urlParams)},init:function(){_this=this;this.isIE6=$.browser.msie&&parseInt($.browser.version)<7;if($.browser.opera){$.support.opacity=true}$('#boxen_overlay, #boxen_container').remove();this.overlay=$('<div />').attr('id','boxen_overlay').css({opacity:this.options.overlayOpacity,backgroundColor:this.options.overlayColor,display:'none',position:'absolute',top:0,left:0,zIndex:10000});if(!this.options.modal){this.overlay.click(function(e){$.Boxen.close();return false})}this.container=$('<div />').attr('id','boxen_container').width(this.options.width).height(this.options.height).css({position:'absolute',left:'50%',top:'50%',marginLeft:Math.round(this.options.width/-2)+'px',marginTop:Math.round(this.options.height/-2)+'px',display:'none',zIndex:10001,'box-shadow':'0 5px 15px #333333','border-radius':'3px'});if(this.isIE6){this.bigIFrame=$('<iframe>').attr('id','boxen_big_iframe').css({zIndex:9999,position:'absolute',top:0,left:0,opacity:0}).appendTo('body');this._sizeOverlay();this._centreContent();$(window).bind('scroll.Boxen',function(e){_this._centreContent()}).bind('resize.Boxen',function(e){_this._sizeOverlay();_this._centreContent()})}else{this.overlay.css({position:'fixed',width:'100%',height:'100%'});this.container.css('position','fixed')}this.overlay.appendTo('body');this.container.appendTo('body');this.contentWindow=$('<div />').attr('id','boxen_content').appendTo(this.container);if(this.options.showTitleBar){this.titleBar=$('<div />').attr('id','boxen_titlebar').append($('<span>').attr('id','boxen_title').html(this.options.title)).appendTo(this.contentWindow);if(this.options.showCloseButton){this.closeButton=$('<a />').attr({href:'javascript:void(0)',id:'boxen_close_button',title:'关闭'}).click(function(e){$.Boxen.close();return false}).appendTo(this.titleBar);if(this.options.closeButtonText){this.closeButton.append($('<span />').html(this.options.closeButtonText))}}else{this.closeButton=null}}else{this.titleBar=null}this.contentArea=$('<div />').attr('id','boxen_content_area').appendTo(this.contentWindow);return this},show:function(callback){this.overlay.fadeIn('fast');this.container.fadeIn('fast',function(){var _this=$.Boxen;if(null!==_this.options.url){var iFrame=$('<iframe />').attr({id:'boxen_iframe_content_'+new Date().getTime(),width:_this.getContentAreaWidth(),height:_this.getContentAreaHeight(),frameBorder:0,src:_this.getFullUrl()}).appendTo(_this.contentArea)}else{_this.contentArea.width(_this.getContentAreaWidth()).height(_this.getContentAreaHeight())}_this.options.postOpen(_this.getContentAreaElement())});return this},close:function(){try{if(this.isIE6){$(window).unbind('scroll.Boxen').unbind('resize.Boxen');throw'IE6'}this.container.fadeOut('fast',function(){$(this).remove()});this.overlay.fadeOut('fast',function(){$(this).remove()})}catch(e){$('#boxen_big_iframe, #boxen_overlay, #boxen_container').remove()}this.options.postClose();return this},open:function(domElement,options){this.setOptions(options);if(domElement){this.options.title=this.options.titleAttribute&&$(domElement).attr(this.options.titleAttribute)||this.options.title;this.options.url=this.options.urlAttribute&&$(domElement).attr(this.options.urlAttribute)||this.options.url}this.init().show();return this},_centreContent:function(){if(this.options.height<$(window).height()){var topMargin=Math.round(this.options.height/-2)+$(document).scrollTop();this.container.css({marginTop:topMargin+'px'})}},_sizeOverlay:function(){this.bigIFrame.css({width:($(document).width()-21)+'px',height:($(document).height()-4)+'px'});this.overlay.css({width:($(document).width()-21)+'px',height:($(document).height()-4)+'px'})},getContentAreaElement:function(){return this.contentArea.get(0)},getContentAreaHeight:function(){return this.titleBar?this.options.height-this.titleBar.outerHeight():this.options.height},getContentAreaWidth:function(){return this.options.width}}})(jQuery);


/* 
	时间倒计时
	jQuery Countdown plugin v1.0  
	http://www.littlewebthings.com/projects/countdown/  
	Copyright 2010, Vassilis Dourdounis
*/
(function($){$.fn.countDown=function(options){config={};$.extend(config,options);diffSecs=this.setCountDown(config);if(config.onComplete){$.data($(this)[0],'callback',config.onComplete)}if(config.omitWeeks){$.data($(this)[0],'omitWeeks',config.omitWeeks)}$('#'+$(this).attr('id')+' .digit').html('<div class="top"></div><div class="bottom"></div>');$(this).doCountDown($(this).attr('id'),diffSecs,500);return this};$.fn.stopCountDown=function(){clearTimeout($.data(this[0],'timer'))};$.fn.startCountDown=function(){this.doCountDown($(this).attr('id'),$.data(this[0],'diffSecs'),500)};$.fn.setCountDown=function(options){var targetTime=new Date();if(options.targetDate){targetTime=new Date(options.targetDate.month+'/'+options.targetDate.day+'/'+options.targetDate.year+' '+options.targetDate.hour+':'+options.targetDate.min+':'+options.targetDate.sec+(options.targetDate.utc?' UTC':''))}else if(options.targetOffset){targetTime.setFullYear(options.targetOffset.year+targetTime.getFullYear());targetTime.setMonth(options.targetOffset.month+targetTime.getMonth());targetTime.setDate(options.targetOffset.day+targetTime.getDate());targetTime.setHours(options.targetOffset.hour+targetTime.getHours());targetTime.setMinutes(options.targetOffset.min+targetTime.getMinutes());targetTime.setSeconds(options.targetOffset.sec+targetTime.getSeconds())}var nowTime=new Date();diffSecs=Math.floor((targetTime.valueOf()-nowTime.valueOf())/1000);$.data(this[0],'diffSecs',diffSecs);return diffSecs};$.fn.doCountDown=function(id,diffSecs,duration){$this=$('#'+id);if(diffSecs<=0){diffSecs=0;if($.data($this[0],'timer')){clearTimeout($.data($this[0],'timer'))}}secs=diffSecs%60;mins=Math.floor(diffSecs/60)%60;hours=Math.floor(diffSecs/60/60)%24;if($.data($this[0],'omitWeeks')==true){days=Math.floor(diffSecs/60/60/24);weeks=Math.floor(diffSecs/60/60/24/7)}else{days=Math.floor(diffSecs/60/60/24)%7;weeks=Math.floor(diffSecs/60/60/24/7)}$this.dashChangeTo(id,'seconds_dash',secs,duration?duration:800);$this.dashChangeTo(id,'minutes_dash',mins,duration?duration:1200);$this.dashChangeTo(id,'hours_dash',hours,duration?duration:1200);$this.dashChangeTo(id,'days_dash',days,duration?duration:1200);$this.dashChangeTo(id,'weeks_dash',weeks,duration?duration:1200);$.data($this[0],'diffSecs',diffSecs);if(diffSecs>0){e=$this;t=setTimeout(function(){e.doCountDown(id,diffSecs-1)},1000);$.data(e[0],'timer',t)}else if(cb=$.data($this[0],'callback')){$.data($this[0],'callback')()}};$.fn.dashChangeTo=function(id,dash,n,duration){$this=$('#'+id);for(var i=($this.find('.'+dash+' .digit').length-1);i>=0;i--){var d=n%10;n=(n-d)/10;$this.digitChangeTo('#'+$this.attr('id')+' .'+dash+' .digit:eq('+i+')',d,duration)}};$.fn.digitChangeTo=function(digit,n,duration){if(!duration){duration=800}if($(digit+' div.top').html()!=n+''){$(digit+' div.top').css({'display':'none'});$(digit+' div.top').html((n?n:'0')).slideDown(duration);$(digit+' div.bottom').animate({'height':''},duration,function(){$(digit+' div.bottom').html($(digit+' div.top').html());$(digit+' div.bottom').css({'display':'block','height':''});$(digit+' div.top').hide().slideUp(10)})}}})(jQuery);



(function($){
    $.fn.quickAd = function(settings){
        settings = $.extend({
            width:580,
            height:350,
            html:"",
            top:195,
            sec:5, //秒
            border:true,
            closelink:""
        },settings);
        var fkxc_ad = 0;
        var bodyWidth = $(window).width();

		var wrapper1_id ="wrapper1"+settings.width;
		var wrapper2_id ="wrapper2"+settings.width;
		var wrapper3_id ="wrapper3"+settings.width;

        var _adBodyContainerID = "bigAd_"+settings.width;
        var _adCloseContainerID = "bitAdClose_"+settings.width;;

		var wrapper1 = "<div id=\""+wrapper1_id+"\"></div>";
		var wrapper2 = "<div style=\"position:relative\" id=\""+wrapper2_id+"\"></div>";

		var wrapper3 = "<div id=\""+wrapper3_id+"\"><div style=\"margin: 0px auto; width: 380px;\" class=\"clearfix\" id=\"countdown_dashboard_main\"><div class=\"dash weeks_dash\"><div class=\"digit2\" id=\"cdtxt2013040910\">距开课</div><div class=\"digit2\">仅剩∶</div></div><div class=\"dash hours_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">时</div></div><div class=\"dash minutes_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">分</div></div><div class=\"dash seconds_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">秒</div></div></div></div>";
		//var wrapper3 = "<div id=\""+wrapper3_id+"\"><div style=\"margin: 0px auto; width: 450px;\" class=\"clearfix\" id=\"countdown_dashboard_main\"><div class=\"dash weeks_dash\"><div class=\"digit2\" id=\"cdtxt2013040910\">距报名结束</div><div class=\"digit2\">仅剩∶</div></div><div class=\"dash days_dash\"><div class=\"digit\"><div class=\"top\" style=\"display: none;\">&nbsp;</div><div class=\"bottom\" style=\"display: block;\">0</div></div><div class=\"digit\"><div class=\"top\" style=\"display: none;\">0</div><div class=\"bottom\" style=\"display: block;\">0</div></div><div class=\"digit2\">天</div></div><div class=\"dash hours_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">时</div></div><div class=\"dash minutes_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">分</div></div><div class=\"dash seconds_dash\"><div class=\"digit\">0</div><div class=\"digit\">0</div><div class=\"digit2\">秒</div></div></div></div>";

		var closeHtml = "<a href=\""+settings.closelink+"\" target=\"_blank\" id=\"__close_ad\">X</a>";
		if(settings.closelink=="#"){
			closeHtml="<a id=\"__close_ad\">X</a>";
		}

        //
        var _adContent = '<div class=\'bigAd\' id="'+_adBodyContainerID+'" onclick="_hmt.push([\'_trackEvent\', \'my_btn_gkktc\', \'click\', \'ad_btn_my_gkktc\',\'1\']);"></div>';
        //
        var _adCloseBtn = '<div class=\'bitAdClose\' id="'+_adCloseContainerID+'" onclick="_hmt.push([\'_trackEvent\', \'my_btn_gkkgb\', \'click\', \'ad_btn_my_gkkgb\',\'1\']);">'+closeHtml+'</div>';
        var self = $(this);

		$(this).empty().html(wrapper1);
		$("#"+wrapper1_id).empty().html(wrapper2);
        $("#"+wrapper2_id).empty().html(wrapper3+_adContent+_adCloseBtn);

        $('#__close_ad').click(function(){
            self.hide();
        })

        if(settings.border){
            $("#"+wrapper1_id).css("border","2px solid #eee");
        }

        $('#'+_adBodyContainerID).empty().html(settings.html);
		$("#"+wrapper1_id).css({
            'width':settings.width+'px',
            'height':settings.height+'px',
            'position': 'fixed',
            'z-index': 20000,
            //'top':0,settings.top+'px',
            'bottom':'0',
            //'left':(((bodyWidth - settings.width) / 2)+15) + 'px',
			'left':'50%',
			'margin-left':'-250px',
			'display':'none',
			'padding':'10px',
			'background-color':'#f3f3f3',
			'border-radius':'3px'
        }).animate({bottom:'10px',opacity: 'show'}, 1000).animate();


		if($.browser.msie&&$.browser.version=="6.0"){
			$("#"+wrapper1_id).css({
				'width':settings.width+'px',
				'height':settings.height+'px',
				//'position': 'fixed',
				'z-index': 20000,
				//'top':0,settings.top+'px',
				'bottom':'0',
				//'left':(((bodyWidth - settings.width) / 2)+15) + 'px',
				'left':'50%',
				'margin-left':'-250px',
				'display':'none',
				'padding':'10px',
				'background-color':'#f3f3f3',
				'border-radius':'3px',
				'position': 'absolute'
				//'top': 'expression(eval(document.documentElement.scrollTop+195))'
				//'top':document.documentElement.scrollTop+195
			}).animate({bottom:'10px',opacity: 'show'}, 1000).animate();
		}



        $('#'+_adCloseContainerID).css({
            'width':'40px','height':'20px','line-height':'20px','background-color':'#eee',
            'text-align': 'center', 'opacity': '0.8','top':'0',
			'position': 'absolute',
            //'left':((bodyWidth - settings.width) / 2+(settings.width-(160-140))) + 'px',
			'right':'5px',
			//'margin-left':'270px',
			'z-index': 20001,'display':'none'
        }).animate({opacity: 'show'}, 1000);
		//.mouseover(function(){$(this).css({"background-color":"#fff"});}).mouseout(function(){$(this).css({"background-color":"#eee"});});

		$("#__close_ad").css({"color":"#666","text-decoration":"none"}).mouseover(function(){
			$(this).css({"color":"#333","font-weight":"700"});
		}).mouseout(function(){
			$(this).css({"color":"#666","font-weight":"400"});
		});


    }
})(jQuery);


!function(e){function s(e,t){e=e.replace("#","");r=parseInt(e.substring(0,2),16);g=parseInt(e.substring(2,4),16);b=parseInt(e.substring(4,6),16);result="rgba("+r+","+g+","+b+","+t/100+")";return result}function o(e,t){e=String(e).replace(/[^0-9a-f]/gi,"");if(e.length<6){e=e[0]+e[0]+e[1]+e[1]+e[2]+e[2]}t=t||0;var n="#",r,i;for(i=0;i<3;i++){r=parseInt(e.substr(i*2,2),16);r=Math.round(Math.min(Math.max(0,r+r*t),255)).toString(16);n+=("00"+r).substr(r.length)}return n}var t=new Array("#1ABC9C","#2ecc71","#3498db","#9b59b6","#34495e","#f1c40f","#e67e22","#e74c3c");var n=new Array("NE","SE","SW","NW");var i={fade:false,color:"random",boxShadow:false,angle:"random"};e.fn.flatshadow=function(r){var u=e.extend({},i,r);return this.each(function(){el=e(this);if(u.fade==true){width=Math.round(el.outerWidth()/3);height=Math.round(el.outerHeight()/3)}else{width=Math.round(el.outerWidth());height=Math.round(el.outerHeight())}if(u.boxShadow!=false){var r=u.boxShadow}if(u.color!="random"&&!el.attr("data-color")){var i=u.color}else{var i=t[Math.floor(Math.random()*t.length)];if(el.attr("data-color")){var i=el.attr("data-color")}}if(u.angle!="random"&&!el.attr("data-angle")){var a=u.angle}else{var a=n[Math.floor(Math.random()*n.length)];if(el.attr("data-angle")){var a=el.attr("data-angle")}}var f=o(i,-.3);var l="";if(u.boxShadow!=false){var c=""}else{var c="none"}switch(a){case"N":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+="0px "+h*2*-1+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+="0px "+h*-1+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"NE":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+=h*2+"px "+h*2*-1+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h+"px "+h*-1+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"E":for(var h=1;h<=width;h++){if(u.boxShadow!=false)c+=h*2+"px "+"0px 0px "+s(r,50-h/width*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h+"px "+"0px 0px "+p;if(h!=width){l+=", ";c+=", "}}break;case"SE":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+=h*2+"px "+h*2+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h+"px "+h+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"S":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+="0px "+h*2+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+="0px "+h+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"SW":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+=h*2*-1+"px "+h*2+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h*-1+"px "+h+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"W":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+=h*2*-1+"px "+"0px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h*-1+"px "+"0px 0px "+p;if(h!=height){l+=", ";c+=", "}}break;case"NW":for(var h=1;h<=height;h++){if(u.boxShadow!=false)c+=h*2*-1+"px "+h*2*-1+"px 0px "+s(r,50-h/height*100);if(u.fade!=false){var p=s(f,100-h/height*100)}else{var p=f}l+=h*-1+"px "+h*-1+"px 0px "+p;if(h!=height){l+=", ";c+=", "}}break}el.css({background:i,color:o(i,1),"text-shadow":l,"box-shadow":c})})}}(window.jQuery);


/*
	页面插入flash
	SWFObject v2.2 <http://code.google.com/p/swfobject/>
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/
var swfobject=function(){var D="undefined",r="object",S="Shockwave Flash",W="ShockwaveFlash.ShockwaveFlash",q="application/x-shockwave-flash",R="SWFObjectExprInst",x="onreadystatechange",O=window,j=document,t=navigator,T=false,U=[h],o=[],N=[],I=[],l,Q,E,B,J=false,a=false,n,G,m=true,M=function(){var aa=typeof j.getElementById!=D&&typeof j.getElementsByTagName!=D&&typeof j.createElement!=D,ah=t.userAgent.toLowerCase(),Y=t.platform.toLowerCase(),ae=Y?/win/.test(Y):/win/.test(ah),ac=Y?/mac/.test(Y):/mac/.test(ah),af=/webkit/.test(ah)?parseFloat(ah.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,X=!+"\v1",ag=[0,0,0],ab=null;if(typeof t.plugins!=D&&typeof t.plugins[S]==r){ab=t.plugins[S].description;if(ab&&!(typeof t.mimeTypes!=D&&t.mimeTypes[q]&&!t.mimeTypes[q].enabledPlugin)){T=true;X=false;ab=ab.replace(/^.*\s+(\S+\s+\S+$)/,"$1");ag[0]=parseInt(ab.replace(/^(.*)\..*$/,"$1"),10);ag[1]=parseInt(ab.replace(/^.*\.(.*)\s.*$/,"$1"),10);ag[2]=/[a-zA-Z]/.test(ab)?parseInt(ab.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0}}else{if(typeof O.ActiveXObject!=D){try{var ad=new ActiveXObject(W);if(ad){ab=ad.GetVariable("$version");if(ab){X=true;ab=ab.split(" ")[1].split(",");ag=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}}catch(Z){}}}return{w3:aa,pv:ag,wk:af,ie:X,win:ae,mac:ac}}(),k=function(){if(!M.w3){return}if((typeof j.readyState!=D&&j.readyState=="complete")||(typeof j.readyState==D&&(j.getElementsByTagName("body")[0]||j.body))){f()}if(!J){if(typeof j.addEventListener!=D){j.addEventListener("DOMContentLoaded",f,false)}if(M.ie&&M.win){j.attachEvent(x,function(){if(j.readyState=="complete"){j.detachEvent(x,arguments.callee);f()}});if(O==top){(function(){if(J){return}try{j.documentElement.doScroll("left")}catch(X){setTimeout(arguments.callee,0);return}f()})()}}if(M.wk){(function(){if(J){return}if(!/loaded|complete/.test(j.readyState)){setTimeout(arguments.callee,0);return}f()})()}s(f)}}();function f(){if(J){return}try{var Z=j.getElementsByTagName("body")[0].appendChild(C("span"));Z.parentNode.removeChild(Z)}catch(aa){return}J=true;var X=U.length;for(var Y=0;Y<X;Y++){U[Y]()}}function K(X){if(J){X()}else{U[U.length]=X}}function s(Y){if(typeof O.addEventListener!=D){O.addEventListener("load",Y,false)}else{if(typeof j.addEventListener!=D){j.addEventListener("load",Y,false)}else{if(typeof O.attachEvent!=D){i(O,"onload",Y)}else{if(typeof O.onload=="function"){var X=O.onload;O.onload=function(){X();Y()}}else{O.onload=Y}}}}}function h(){if(T){V()}else{H()}}function V(){var X=j.getElementsByTagName("body")[0];var aa=C(r);aa.setAttribute("type",q);var Z=X.appendChild(aa);if(Z){var Y=0;(function(){if(typeof Z.GetVariable!=D){var ab=Z.GetVariable("$version");if(ab){ab=ab.split(" ")[1].split(",");M.pv=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}else{if(Y<10){Y++;setTimeout(arguments.callee,10);return}}X.removeChild(aa);Z=null;H()})()}else{H()}}function H(){var ag=o.length;if(ag>0){for(var af=0;af<ag;af++){var Y=o[af].id;var ab=o[af].callbackFn;var aa={success:false,id:Y};if(M.pv[0]>0){var ae=c(Y);if(ae){if(F(o[af].swfVersion)&&!(M.wk&&M.wk<312)){w(Y,true);if(ab){aa.success=true;aa.ref=z(Y);ab(aa)}}else{if(o[af].expressInstall&&A()){var ai={};ai.data=o[af].expressInstall;ai.width=ae.getAttribute("width")||"0";ai.height=ae.getAttribute("height")||"0";if(ae.getAttribute("class")){ai.styleclass=ae.getAttribute("class")}if(ae.getAttribute("align")){ai.align=ae.getAttribute("align")}var ah={};var X=ae.getElementsByTagName("param");var ac=X.length;for(var ad=0;ad<ac;ad++){if(X[ad].getAttribute("name").toLowerCase()!="movie"){ah[X[ad].getAttribute("name")]=X[ad].getAttribute("value")}}P(ai,ah,Y,ab)}else{p(ae);if(ab){ab(aa)}}}}}else{w(Y,true);if(ab){var Z=z(Y);if(Z&&typeof Z.SetVariable!=D){aa.success=true;aa.ref=Z}ab(aa)}}}}}function z(aa){var X=null;var Y=c(aa);if(Y&&Y.nodeName=="OBJECT"){if(typeof Y.SetVariable!=D){X=Y}else{var Z=Y.getElementsByTagName(r)[0];if(Z){X=Z}}}return X}function A(){return !a&&F("6.0.65")&&(M.win||M.mac)&&!(M.wk&&M.wk<312)}function P(aa,ab,X,Z){a=true;E=Z||null;B={success:false,id:X};var ae=c(X);if(ae){if(ae.nodeName=="OBJECT"){l=g(ae);Q=null}else{l=ae;Q=X}aa.id=R;if(typeof aa.width==D||(!/%$/.test(aa.width)&&parseInt(aa.width,10)<310)){aa.width="310"}if(typeof aa.height==D||(!/%$/.test(aa.height)&&parseInt(aa.height,10)<137)){aa.height="137"}j.title=j.title.slice(0,47)+" - Flash Player Installation";var ad=M.ie&&M.win?"ActiveX":"PlugIn",ac="MMredirectURL="+O.location.toString().replace(/&/g,"%26")+"&MMplayerType="+ad+"&MMdoctitle="+j.title;if(typeof ab.flashvars!=D){ab.flashvars+="&"+ac}else{ab.flashvars=ac}if(M.ie&&M.win&&ae.readyState!=4){var Y=C("div");X+="SWFObjectNew";Y.setAttribute("id",X);ae.parentNode.insertBefore(Y,ae);ae.style.display="none";(function(){if(ae.readyState==4){ae.parentNode.removeChild(ae)}else{setTimeout(arguments.callee,10)}})()}u(aa,ab,X)}}function p(Y){if(M.ie&&M.win&&Y.readyState!=4){var X=C("div");Y.parentNode.insertBefore(X,Y);X.parentNode.replaceChild(g(Y),X);Y.style.display="none";(function(){if(Y.readyState==4){Y.parentNode.removeChild(Y)}else{setTimeout(arguments.callee,10)}})()}else{Y.parentNode.replaceChild(g(Y),Y)}}function g(ab){var aa=C("div");if(M.win&&M.ie){aa.innerHTML=ab.innerHTML}else{var Y=ab.getElementsByTagName(r)[0];if(Y){var ad=Y.childNodes;if(ad){var X=ad.length;for(var Z=0;Z<X;Z++){if(!(ad[Z].nodeType==1&&ad[Z].nodeName=="PARAM")&&!(ad[Z].nodeType==8)){aa.appendChild(ad[Z].cloneNode(true))}}}}}return aa}function u(ai,ag,Y){var X,aa=c(Y);if(M.wk&&M.wk<312){return X}if(aa){if(typeof ai.id==D){ai.id=Y}if(M.ie&&M.win){var ah="";for(var ae in ai){if(ai[ae]!=Object.prototype[ae]){if(ae.toLowerCase()=="data"){ag.movie=ai[ae]}else{if(ae.toLowerCase()=="styleclass"){ah+=' class="'+ai[ae]+'"'}else{if(ae.toLowerCase()!="classid"){ah+=" "+ae+'="'+ai[ae]+'"'}}}}}var af="";for(var ad in ag){if(ag[ad]!=Object.prototype[ad]){af+='<param name="'+ad+'" value="'+ag[ad]+'" />'}}aa.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+ah+">"+af+"</object>";N[N.length]=ai.id;X=c(ai.id)}else{var Z=C(r);Z.setAttribute("type",q);for(var ac in ai){if(ai[ac]!=Object.prototype[ac]){if(ac.toLowerCase()=="styleclass"){Z.setAttribute("class",ai[ac])}else{if(ac.toLowerCase()!="classid"){Z.setAttribute(ac,ai[ac])}}}}for(var ab in ag){if(ag[ab]!=Object.prototype[ab]&&ab.toLowerCase()!="movie"){e(Z,ab,ag[ab])}}aa.parentNode.replaceChild(Z,aa);X=Z}}return X}function e(Z,X,Y){var aa=C("param");aa.setAttribute("name",X);aa.setAttribute("value",Y);Z.appendChild(aa)}function y(Y){var X=c(Y);if(X&&X.nodeName=="OBJECT"){if(M.ie&&M.win){X.style.display="none";(function(){if(X.readyState==4){b(Y)}else{setTimeout(arguments.callee,10)}})()}else{X.parentNode.removeChild(X)}}}function b(Z){var Y=c(Z);if(Y){for(var X in Y){if(typeof Y[X]=="function"){Y[X]=null}}Y.parentNode.removeChild(Y)}}function c(Z){var X=null;try{X=j.getElementById(Z)}catch(Y){}return X}function C(X){return j.createElement(X)}function i(Z,X,Y){Z.attachEvent(X,Y);I[I.length]=[Z,X,Y]}function F(Z){var Y=M.pv,X=Z.split(".");X[0]=parseInt(X[0],10);X[1]=parseInt(X[1],10)||0;X[2]=parseInt(X[2],10)||0;return(Y[0]>X[0]||(Y[0]==X[0]&&Y[1]>X[1])||(Y[0]==X[0]&&Y[1]==X[1]&&Y[2]>=X[2]))?true:false}function v(ac,Y,ad,ab){if(M.ie&&M.mac){return}var aa=j.getElementsByTagName("head")[0];if(!aa){return}var X=(ad&&typeof ad=="string")?ad:"screen";if(ab){n=null;G=null}if(!n||G!=X){var Z=C("style");Z.setAttribute("type","text/css");Z.setAttribute("media",X);n=aa.appendChild(Z);if(M.ie&&M.win&&typeof j.styleSheets!=D&&j.styleSheets.length>0){n=j.styleSheets[j.styleSheets.length-1]}G=X}if(M.ie&&M.win){if(n&&typeof n.addRule==r){n.addRule(ac,Y)}}else{if(n&&typeof j.createTextNode!=D){n.appendChild(j.createTextNode(ac+" {"+Y+"}"))}}}function w(Z,X){if(!m){return}var Y=X?"visible":"hidden";if(J&&c(Z)){c(Z).style.visibility=Y}else{v("#"+Z,"visibility:"+Y)}}function L(Y){var Z=/[\\\"<>\.;]/;var X=Z.exec(Y)!=null;return X&&typeof encodeURIComponent!=D?encodeURIComponent(Y):Y}var d=function(){if(M.ie&&M.win){window.attachEvent("onunload",function(){var ac=I.length;for(var ab=0;ab<ac;ab++){I[ab][0].detachEvent(I[ab][1],I[ab][2])}var Z=N.length;for(var aa=0;aa<Z;aa++){y(N[aa])}for(var Y in M){M[Y]=null}M=null;for(var X in swfobject){swfobject[X]=null}swfobject=null})}}();return{registerObject:function(ab,X,aa,Z){if(M.w3&&ab&&X){var Y={};Y.id=ab;Y.swfVersion=X;Y.expressInstall=aa;Y.callbackFn=Z;o[o.length]=Y;w(ab,false)}else{if(Z){Z({success:false,id:ab})}}},getObjectById:function(X){if(M.w3){return z(X)}},embedSWF:function(ab,ah,ae,ag,Y,aa,Z,ad,af,ac){var X={success:false,id:ah};if(M.w3&&!(M.wk&&M.wk<312)&&ab&&ah&&ae&&ag&&Y){w(ah,false);K(function(){ae+="";ag+="";var aj={};if(af&&typeof af===r){for(var al in af){aj[al]=af[al]}}aj.data=ab;aj.width=ae;aj.height=ag;var am={};if(ad&&typeof ad===r){for(var ak in ad){am[ak]=ad[ak]}}if(Z&&typeof Z===r){for(var ai in Z){if(typeof am.flashvars!=D){am.flashvars+="&"+ai+"="+Z[ai]}else{am.flashvars=ai+"="+Z[ai]}}}if(F(Y)){var an=u(aj,am,ah);if(aj.id==ah){w(ah,true)}X.success=true;X.ref=an}else{if(aa&&A()){aj.data=aa;P(aj,am,ah,ac);return}else{w(ah,true)}}if(ac){ac(X)}})}else{if(ac){ac(X)}}},switchOffAutoHideShow:function(){m=false},ua:M,getFlashPlayerVersion:function(){return{major:M.pv[0],minor:M.pv[1],release:M.pv[2]}},hasFlashPlayerVersion:F,createSWF:function(Z,Y,X){if(M.w3){return u(Z,Y,X)}else{return undefined}},showExpressInstall:function(Z,aa,X,Y){if(M.w3&&A()){P(Z,aa,X,Y)}},removeSWF:function(X){if(M.w3){y(X)}},createCSS:function(aa,Z,Y,X){if(M.w3){v(aa,Z,Y,X)}},addDomLoadEvent:K,addLoadEvent:s,getQueryParamValue:function(aa){var Z=j.location.search||j.location.hash;if(Z){if(/\?/.test(Z)){Z=Z.split("?")[1]}if(aa==null){return L(Z)}var Y=Z.split("&");for(var X=0;X<Y.length;X++){if(Y[X].substring(0,Y[X].indexOf("="))==aa){return L(Y[X].substring((Y[X].indexOf("=")+1)))}}}return""},expressInstallCallback:function(){if(a){var X=c(R);if(X&&l){X.parentNode.replaceChild(l,X);if(Q){w(Q,true);if(M.ie&&M.win){l.style.display="block"}}if(E){E(B)}}a=false}}}}();



/*
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);


/*
 *格式化数字、货币的显示
 *!
 * accounting.js v0.3.2, copyright 2011 Joss Crowcroft, MIT license, http://josscrowcroft.github.com/accounting.js
 */
(function(p,z){function q(a){return!!(""===a||a&&a.charCodeAt&&a.substr)}function m(a){return u?u(a):"[object Array]"===v.call(a)}function r(a){return"[object Object]"===v.call(a)}function s(a,b){var d,a=a||{},b=b||{};for(d in b)b.hasOwnProperty(d)&&null==a[d]&&(a[d]=b[d]);return a}function j(a,b,d){var c=[],e,h;if(!a)return c;if(w&&a.map===w)return a.map(b,d);for(e=0,h=a.length;e<h;e++)c[e]=b.call(d,a[e],e,a);return c}function n(a,b){a=Math.round(Math.abs(a));return isNaN(a)?b:a}function x(a){var b=c.settings.currency.format;"function"===typeof a&&(a=a());return q(a)&&a.match("%v")?{pos:a,neg:a.replace("-","").replace("%v","-%v"),zero:a}:!a||!a.pos||!a.pos.match("%v")?!q(b)?b:c.settings.currency.format={pos:b,neg:b.replace("%v","-%v"),zero:b}:a}var c={version:"0.3.2",settings:{currency:{symbol:"$",format:"%s%v",decimal:".",thousand:",",precision:2,grouping:3},number:{precision:0,grouping:3,thousand:",",decimal:"."}}},w=Array.prototype.map,u=Array.isArray,v=Object.prototype.toString,o=c.unformat=c.parse=function(a,b){if(m(a))return j(a,function(a){return o(a,b)});a=a||0;if("number"===typeof a)return a;var b=b||".",c=RegExp("[^0-9-"+b+"]",["g"]),c=parseFloat((""+a).replace(/\((.*)\)/,"-$1").replace(c,"").replace(b,"."));return!isNaN(c)?c:0},y=c.toFixed=function(a,b){var b=n(b,c.settings.number.precision),d=Math.pow(10,b);return(Math.round(c.unformat(a)*d)/d).toFixed(b)},t=c.formatNumber=function(a,b,d,i){if(m(a))return j(a,function(a){return t(a,b,d,i)});var a=o(a),e=s(r(b)?b:{precision:b,thousand:d,decimal:i},c.settings.number),h=n(e.precision),f=0>a?"-":"",g=parseInt(y(Math.abs(a||0),h),10)+"",l=3<g.length?g.length%3:0;return f+(l?g.substr(0,l)+e.thousand:"")+g.substr(l).replace(/(\d{3})(?=\d)/g,"$1"+e.thousand)+(h?e.decimal+y(Math.abs(a),h).split(".")[1]:"")},A=c.formatMoney=function(a,b,d,i,e,h){if(m(a))return j(a,function(a){return A(a,b,d,i,e,h)});var a=o(a),f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format);return(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal))};c.formatColumn=function(a,b,d,i,e,h){if(!a)return[];var f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format),l=g.pos.indexOf("%s")<g.pos.indexOf("%v")?!0:!1,k=0,a=j(a,function(a){if(m(a))return c.formatColumn(a,f);a=o(a);a=(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal));if(a.length>k)k=a.length;return a});return j(a,function(a){return q(a)&&a.length<k?l?a.replace(f.symbol,f.symbol+Array(k-a.length+1).join(" ")):Array(k-a.length+1).join(" ")+a:a})};if("undefined"!==typeof exports){if("undefined"!==typeof module&&module.exports)exports=module.exports=c;exports.accounting=c}else"function"===typeof define&&define.amd?define([],function(){return c}):(c.noConflict=function(a){return function(){p.accounting=a;c.noConflict=z;return c}}(p.accounting),p.accounting=c)})(this);

/*
 *图片懒加载
 * Lazy Load - jQuery plugin for lazy loading images
 *
 * Copyright (c) 2007-2012 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 *
 * Version:  1.7.2
 *
 */
(function(a,b){$window=a(b),a.fn.lazyload=function(c){function f(){var b=0;d.each(function(){var c=a(this);if(e.skip_invisible&&!c.is(":visible"))return;if(!a.abovethetop(this,e)&&!a.leftofbegin(this,e))if(!a.belowthefold(this,e)&&!a.rightoffold(this,e))c.trigger("appear");else if(++b>e.failure_limit)return!1})}var d=this,e={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return c&&(undefined!==c.failurelimit&&(c.failure_limit=c.failurelimit,delete c.failurelimit),undefined!==c.effectspeed&&(c.effect_speed=c.effectspeed,delete c.effectspeed),a.extend(e,c)),$container=e.container===undefined||e.container===b?$window:a(e.container),0===e.event.indexOf("scroll")&&$container.bind(e.event,function(a){return f()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,c.one("appear",function(){if(!this.loaded){if(e.appear){var f=d.length;e.appear.call(b,f,e)}a("<img />").bind("load",function(){c.hide().attr("src",c.data(e.data_attribute))[e.effect](e.effect_speed),b.loaded=!0;var f=a.grep(d,function(a){return!a.loaded});d=a(f);if(e.load){var g=d.length;e.load.call(b,g,e)}}).attr("src",c.data(e.data_attribute))}}),0!==e.event.indexOf("scroll")&&c.bind(e.event,function(a){b.loaded||c.trigger("appear")})}),$window.bind("resize",function(a){f()}),f(),this},a.belowthefold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.height()+$window.scrollTop():e=$container.offset().top+$container.height(),e<=a(c).offset().top-d.threshold},a.rightoffold=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.width()+$window.scrollLeft():e=$container.offset().left+$container.width(),e<=a(c).offset().left-d.threshold},a.abovethetop=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollTop():e=$container.offset().top,e>=a(c).offset().top+d.threshold+a(c).height()},a.leftofbegin=function(c,d){var e;return d.container===undefined||d.container===b?e=$window.scrollLeft():e=$container.offset().left,e>=a(c).offset().left+d.threshold+a(c).width()},a.inviewport=function(b,c){return!a.rightofscreen(b,c)&&!a.leftofscreen(b,c)&&!a.belowthefold(b,c)&&!a.abovethetop(b,c)},a.extend(a.expr[":"],{"below-the-fold":function(c){return a.belowthefold(c,{threshold:0,container:b})},"above-the-top":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-screen":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-screen":function(c){return!a.rightoffold(c,{threshold:0,container:b})},"in-viewport":function(c){return!a.inviewport(c,{threshold:0,container:b})},"above-the-fold":function(c){return!a.belowthefold(c,{threshold:0,container:b})},"right-of-fold":function(c){return a.rightoffold(c,{threshold:0,container:b})},"left-of-fold":function(c){return!a.rightoffold(c,{threshold:0,container:b})}})})(jQuery,window);


/**
 * @package Xslider - A slider plugin for jQuery
 * @version 0.5
 * @author xhowhy <http://x1989.com>
 **/
(function($){
	$.fn.Xslider = function(options){var settings ={
			affect: 'scrollx', //效果  有scrollx|scrolly|fade|none
			speed: 1200, //动画速度
			space: 6000, //时间间隔
			auto: true, //自动滚动
			trigger: 'mouseover', //触发事件 注意用mouseover代替hover
			conbox: '.conbox', //内容容器id或class
			ctag: 'a', //内容标签 默认为<a>
			switcher: '.switcher', //切换触发器id或class
			stag: 'a', //切换器标签 默认为a
			current:'cur', //当前切换器样式名称
			rand:false //是否随机指定默认幻灯图片
		};
		settings = $.extend({}, settings, options);
		var index = 1;
		var last_index = 0;
		var $conbox = $(this).find(settings.conbox),$contents = $conbox.find(settings.ctag);
		var $switcher = $(this).find(settings.switcher),$stag = $switcher.find(settings.stag);
		if(settings.rand) {index = Math.floor(Math.random()*$contents.length);slide();}
		if(settings.affect == 'fade'){$.each($contents,function(k, v){(k === 0) ? $(this).css({'position':'absolute','z-index':9}):$(this).css({'position':'absolute','z-index':1,'opacity':0});
			});
		}
		function slide(){if (index >= $contents.length) index = 0;
			$stag.removeClass(settings.current).eq(index).addClass(settings.current);
			switch(settings.affect){case 'scrollx':
					$conbox.width($contents.length*$contents.width());
					$conbox.stop().animate({left:-$contents.width()*index},settings.speed);
					break;
				case 'scrolly':
					$contents.css({display:'block'});
					$conbox.stop().animate({top:-$contents.height()*index+'px'},settings.speed);
					break;
				case 'fade':
					$contents.eq(last_index).stop().animate({'opacity': 0}, settings.speed/2).css('z-index',1)
							 .end()
							 .eq(index).css('z-index',9).stop().animate({'opacity': 1}, settings.speed/2)
					break;
				case 'none':
					$contents.hide().eq(index).show();
					break;
			}
			last_index = index;
			index++;
		};
		if(settings.auto) var Timer = setInterval(slide, settings.space);
		$stag.bind(settings.trigger,function(){_pause()
			index = $(this).index();
			slide();
			_continue()
		});
		$conbox.hover(_pause,_continue);
		function _pause(){
			clearInterval(Timer);
		}
		function _continue(){
			if(settings.auto)Timer = setInterval(slide, settings.space);
		}
	}
})(jQuery);


/*
	By sean at 2010.07,  modified on 2010.09.10;

	Example:
	$(".productshow").slider({//.productshow是要移动对象的外框;
		unitdisplayed:3,//可视的单位个数   必需项;
		movelength:1,//要移动的单位个数    必需项;
		maxlength:null,//可视宽度或高度    默认查找要移动对象外层的宽或高度;
		scrollobj:null,//要移动的对象     默认查找productshow下的ul;
		unitlen:null,//移动的单位宽或高度     默认查找li的尺寸;
		nowlength:null,//移动最长宽或高（要移动对象的宽度或高度）   默认由li个数乘以unitlen所得的积;
		dir:"H",//水平移动还是垂直移动，默认H为水平移动，传入V或其他字符则表示垂直移动;
		autoscroll:1000//自动移动间隔时间     默认null不自动移动;
	});
*/
jQuery.extend(jQuery.easing,{
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	}
});
(function($){
	$.fn.slider=function(settings){
		settings=$.extend({},$.fn.slider.defaults,settings);
		this.each(function(){
			var scrollobj=settings.scrollobj || $(this).find("ul");
			var maxlength=settings.maxlength || (settings.dir=="H" ? scrollobj.parent().width() : scrollobj.parent().height());//length of the wrapper visible;
			var scrollunits=scrollobj.find("li");//units to move;
			var unitlen=settings.unitlen || (settings.dir=="H" ? scrollunits.eq(0).outerWidth() : scrollunits.eq(0).outerHeight());
			var unitdisplayed=settings.unitdisplayed;//units num displayed;
			var nowlength=settings.nowlength || scrollunits.length*unitlen;//length of the scrollobj;
			var offset=0;
			var sn=0;
			var movelength=unitlen*settings.movelength;
			var moving=false;//moving now?;
			var btnright=$(this).find("a.aright");
			var btnleft=$(this).find("a.aleft");

			if(settings.dir=="H"){
				scrollobj.css("left","0px");
			}else{
				scrollobj.css("top","0px");
			}
			if(nowlength>maxlength){
				btnleft.addClass("agrayleft");
				btnright.removeClass("agrayright");
				offset=nowlength-maxlength;
			}else{
				btnleft.addClass("agrayleft");
				btnright.addClass("agrayright");
			}

			btnleft.click(function(){
				if($(this).is("[class*='agrayleft']")){return false;}
				if(!moving){
					moving=true;
					sn-=movelength;
					if(sn>unitlen*unitdisplayed-maxlength){
						jQuery.fn.slider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
					}else{
						jQuery.fn.slider.scroll(scrollobj,0,settings.dir,function(){moving=false;});
						sn=0;
						$(this).addClass("agrayleft");
					}
					btnright.removeClass("agrayright");
				}
				return false;
			});
			btnright.click(function(){
				if($(this).is("[class*='agrayright']")){return false;}
				if(!moving){
					moving=true;
					sn+=movelength;
					if(sn<offset-(unitlen*unitdisplayed-maxlength)){
						jQuery.fn.slider.scroll(scrollobj,-sn,settings.dir,function(){moving=false;});
					}else{
						jQuery.fn.slider.scroll(scrollobj,-offset,settings.dir,function(){moving=false;});//滚动到最后一个位置;
						sn=offset;
						$(this).addClass("agrayright");
					}
					btnleft.removeClass("agrayleft");
				}
				return false;
			});

			if(settings.autoscroll){
				jQuery.fn.slider.autoscroll($(this),settings.autoscroll);
			}

		})
	}
})(jQuery);

jQuery.fn.slider.defaults = {
	maxlength:0,
	scrollobj:null,
	unitlen:0,
	nowlength:0,
	dir:"H",
	autoscroll:null
};
jQuery.fn.slider.scroll=function(obj,w,dir,callback){
	if(dir=="H"){
		obj.animate({
			left:w
		},500,"easeInSine",callback);
	}else{
		obj.animate({
			top:w
		},500,"easeInSine",callback);
	}
};
jQuery.fn.slider.autoscroll=function(obj,time){
	var  vane="right";
	function autoscrolling(){
		if(vane=="right"){
			if(!obj.find("a.agrayright").length){
				obj.find("a.aright").trigger("click");
			}else{
				vane="left";
			}
		}
		if(vane=="left"){
			if(!obj.find("a.agrayleft").length){
				obj.find("a.aleft").trigger("click");
			}else{
				vane="right";
			}
		}
	}
	var scrollTimmer=setInterval(autoscrolling,time);
	obj.hover(function(){
		clearInterval(scrollTimmer);
	},function(){
		scrollTimmer=setInterval(autoscrolling,time);
	});
};




$(function () {
    $(document.body).append("<div id=\"pop\" style=\"display:none;\"><div id=\"popHead\"><a onclick=\"_hmt.push(['_trackEvent', 'messager', 'click', 'messager_popClose','1']);\" id=\"popClose\" title=\"关闭\">关闭</a><h2>温馨提示</h2></div><div onclick=\"_hmt.push(['_trackEvent', 'messager', 'click', 'messager_popContent','1']);\" id=\"popContent\"><dl><dt id=\"popTitle\"><a href=\"http://yanue.info/\" target=\"_blank\">这里是参数</a></dt><dd id=\"popIntro\">这里是内容简介</dd></dl> <p id=\"popMore\"><a class=\"mr20\" id=\"btn_huifu\" href=\"javascript:;\">回复</a><a href=\"http://www.jcpeixun.com/\" target=\"_blank\" class=\"look\">查看 »</a></p></div></div>");
});
/*
    jc.pop
*/
(function ($j) {
    $j.positionFixed = function (el) {
        $j(el).each(function () {
            new fixed(this);
        })
        return el;
    }
    $j.fn.positionFixed = function () {
        return $j.positionFixed(this);
    }
    var fixed = $j.positionFixed.impl = function (el) {
        var o = this;
        o.sts = {
            target: $j(el).css('position', 'fixed'),
            container: $j(window)
        }
        o.sts.currentCss = {
            top: o.sts.target.css('top'),
            right: o.sts.target.css('right'),
            bottom: o.sts.target.css('bottom'),
            left: o.sts.target.css('left')
        }
        if (!o.ie6) return;
        o.bindEvent();
    }
    $j.extend(fixed.prototype, {
        ie6: navigator.userAgent.indexOf("MSIE 6.0") > 0,
        bindEvent: function () {
            var o = this;
            o.sts.target.css('position', 'absolute')
            o.overRelative().initBasePos();
            o.sts.target.css(o.sts.basePos)
            o.sts.container.scroll(o.scrollEvent()).resize(o.resizeEvent());
            o.setPos();
        },
        overRelative: function () {
            var o = this;
            var relative = o.sts.target.parents().filter(function () {
                if ($j(this).css('position') == 'relative') return this;
            })
            if (relative.size() > 0) relative.after(o.sts.target)
            return o;
        },
        initBasePos: function () {
            var o = this;
            o.sts.basePos = {
                top: o.sts.target.offset().top - (o.sts.currentCss.top == 'auto' ? o.sts.container.scrollTop() : 0),
                left: o.sts.target.offset().left - (o.sts.currentCss.left == 'auto' ? o.sts.container.scrollLeft() : 0)
            }
            return o;
        },
        setPos: function () {
            var o = this;
            o.sts.target.css({
                top: o.sts.container.scrollTop() + o.sts.basePos.top,
                left: o.sts.container.scrollLeft() + o.sts.basePos.left
            })
        },
        scrollEvent: function () {
            var o = this;
            return function () {
                o.setPos();
            }
        },
        resizeEvent: function () {
            var o = this;
            return function () {
                setTimeout(function () {
                    o.sts.target.css(o.sts.currentCss);
                    o.initBasePos();
                    o.setPos();
                }, 1)
            }
        }
    })
})(jQuery);

jQuery(function ($j) {
    $j('#footer').positionFixed();
});

function Pop(title, url, intro, sBottom) {
    this.title = title;
    this.url = url;
    this.intro = intro;
	this.sBottom = sBottom;//是否显示 查看 回复
    this.apearTime = 1000;
    this.hideTime = 500;
    this.delay = 1000 * 60 * 60;
    /*添加信息*/
    this.addInfo();
    /*显示*/
    this.showDiv();
    /*关闭*/
    this.closeDiv();
	/*是否隐藏 回复 查看*/
	this.showBottom();
}
Pop.prototype = {
	showBottom: function(){
		if(this.sBottom=="true"){
			$("#popMore").show();
		}else{
			$("#popMore").hide();
		}
	},
    addInfo: function () {
        $("#popTitle a").attr('href', this.url).html(this.title);
        $("#popIntro").html(this.intro);
        $("#popMore a.look").attr('href', this.url);
    },
    showDiv: function (time) {
        if (!($.browser.msie && ($.browser.version == "6.0") && !$.support.style)) {
            $('#pop').slideDown(this.apearTime).delay(this.delay).fadeOut(400);
        } else {/*调用jquery.fixed.js,解决ie6不能用fixed*/
            $('#pop').show();
            jQuery(function ($j) {
                $j('#pop').positionFixed();
            })
        }
    },
    closeDiv: function () {
        $("#popClose").click(function () {
            $('#pop').hide();
        }
    );
    }
}



/*	适用：通过调用js本身的日期函数得到的日期	*/
Date.prototype.Format = function(formatStr)
{
	var str = formatStr;
	var Week = ['日','一','二','三','四','五','六'];

	str=str.replace(/yyyy|YYYY/,this.getFullYear());
	str=str.replace(/yy|YY/,(this.getYear() % 100)>9?(this.getYear() % 100).toString():'0' + (this.getYear() % 100));

	str=str.replace(/MM/,(this.getMonth()+1)>9?(this.getMonth()+1).toString():'0' + (this.getMonth()+1));
	str=str.replace(/M/g,(this.getMonth()+1));

	str=str.replace(/w|W/g,Week[this.getDay()]);

	str=str.replace(/dd|DD/,this.getDate()>9?this.getDate().toString():'0' + this.getDate());
	str=str.replace(/d|D/g,this.getDate());

	str=str.replace(/hh|HH/,this.getHours()>9?this.getHours().toString():'0' + this.getHours());
	str=str.replace(/h|H/g,this.getHours());
	str=str.replace(/mm/,this.getMinutes()>9?this.getMinutes().toString():'0' + this.getMinutes());
	str=str.replace(/m/g,this.getMinutes());

	str=str.replace(/ss|SS/,this.getSeconds()>9?this.getSeconds().toString():'0' + this.getSeconds());
	str=str.replace(/s|S/g,this.getSeconds());

	return str;
};
/*	适用：手动拼接成日期格式的日期	*/
Date.prototype.Format2 = function(formatStr)
{
	var str = formatStr;
	var Week = ['日','一','二','三','四','五','六'];

	str=str.replace(/yyyy|YYYY/,this.getFullYear());
	str=str.replace(/yy|YY/,(this.getYear() % 100)>9?(this.getYear() % 100).toString():'0' + (this.getYear() % 100));

	str=str.replace(/MM/,this.getMonth()>9?this.getMonth().toString():'0' + this.getMonth());
	str=str.replace(/M/g,this.getMonth());

	str=str.replace(/w|W/g,Week[this.getDay()]);

	str=str.replace(/dd|DD/,this.getDate()>9?this.getDate().toString():'0' + this.getDate());
	str=str.replace(/d|D/g,this.getDate());

	str=str.replace(/hh|HH/,this.getHours()>9?this.getHours().toString():'0' + this.getHours());
	str=str.replace(/h|H/g,this.getHours());
	str=str.replace(/mm/,this.getMinutes()>9?this.getMinutes().toString():'0' + this.getMinutes());
	str=str.replace(/m/g,this.getMinutes());

	str=str.replace(/ss|SS/,this.getSeconds()>9?this.getSeconds().toString():'0' + this.getSeconds());
	str=str.replace(/s|S/g,this.getSeconds());

	return str;
};

/*	清除两边的空格		*/
String.prototype.trim = function () {
    return this.replace(/(^\s*)|(\s*$)/g, '');
};

/*	合并多个空白为一个空白	*/
String.prototype.ResetBlank = function () {
    var regEx = /\s+/g;
    return this.replace(regEx, ' ');
};

/*	保留数字	*/
String.prototype.GetNum = function () {
    var regEx = /[^\d]/g;
    return this.replace(regEx, '');
};

/*	保留中文	*/
String.prototype.GetCN = function () {
    var regEx = /[^\u4e00-\u9fa5\uf900-\ufa2d]/g;
    return this.replace(regEx, '');
};

/*	String转化为Number		*/
String.prototype.ToInt = function () {
    return isNaN(parseInt(this)) ? this.toString() : parseInt(this);
};

/* 时间比较 */
function CompareTime(startTime,endTime){
	var start = startTime.split("/");
	var end = endTime.split("/");
	var sdate=new Date(start[0],start[1],start[2],start[3],start[4],start[5]);
	var edate=new Date(end[0],end[1],end[2],end[3],end[4],end[5]);
	if(sdate.getTime()>edate.getTime())
	{
		return true;
	}
	return false;
}

/* 锚点跳转 */
function anchor(p,fn) {
	$("html,body").animate({ scrollTop: $("#" + p + "").offset().top }, 1000,fn);
}

/* 锚点跳转2 */
function anchor2(p,t,fn) {
	$("html,body").animate({ scrollTop: $("#" + p + "").offset().top + t }, 1000,fn);
}

/*	文字垂直无缝滚动	*/
function VerticalRoll(id){
	setInterval(function () {
		$("#"+id+" li:last").hide().insertBefore($("#"+id+" li:first")).slideDown(1000);
	}, 5000);
}

/*
	收藏网站
	demo:<a href="javascript:addToFavorite('技成(自动化)培训','http://www.jcpeixun.com/');">加入收藏</a>
*/
function addToFavorite(title,url) {
    if (document.all) {
        window.external.AddFavorite(url, title);
    } else {
        if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        } else {
            alert("对不起，您的浏览器不支持此操作!\n请您使用菜单栏或Ctrl+D收藏本站。");
        }
    }
}
/*

formatDate("2013-1-19", "yyyy-MM-dd HH:mm:ss")
formatDate("2013-1-19 3:30:00", "yyyy-MM-dd HH:mm:ss")

*/
function formatDate(date){
	try{
		return new Date(Date.parse(date.replace(/-/g, "/")));
	}catch(ex){
	
	}
}


/*!
* SuperSlide v2.1.1 
* 轻松解决网站大部分特效展示问题
* 详尽信息请看官网：http://www.SuperSlide2.com/
*
* Copyright 2011-2013, 大话主席
*
* 请尊重原创，保留头部版权
* 在保留版权的前提下可应用于个人或商业用途

* v2.1.1：修复当调用多个SuperSlide，并设置returnDefault:true 时返回defaultIndex索引错误

*/

!function (a) { a.fn.slide = function (b) { return a.fn.slide.defaults = { type: "slide", effect: "fade", autoPlay: !1, delayTime: 500, interTime: 2500, triggerTime: 150, defaultIndex: 0, titCell: ".hd li", mainCell: ".bd", targetCell: null, trigger: "mouseover", scroll: 1, vis: 1, titOnClassName: "on", autoPage: !1, prevCell: ".prev", nextCell: ".next", pageStateCell: ".pageState", opp: !1, pnLoop: !0, easing: "swing", startFun: null, endFun: null, switchLoad: null, playStateCell: ".playState", mouseOverStop: !0, defaultPlay: !0, returnDefault: !1 }, this.each(function () { var c = a.extend({}, a.fn.slide.defaults, b), d = a(this), e = c.effect, f = a(c.prevCell, d), g = a(c.nextCell, d), h = a(c.pageStateCell, d), i = a(c.playStateCell, d), j = a(c.titCell, d), k = j.size(), l = a(c.mainCell, d), m = l.children().size(), n = c.switchLoad, o = a(c.targetCell, d), p = parseInt(c.defaultIndex), q = parseInt(c.delayTime), r = parseInt(c.interTime); parseInt(c.triggerTime); var Q, t = parseInt(c.scroll), u = parseInt(c.vis), v = "false" == c.autoPlay || 0 == c.autoPlay ? !1 : !0, w = "false" == c.opp || 0 == c.opp ? !1 : !0, x = "false" == c.autoPage || 0 == c.autoPage ? !1 : !0, y = "false" == c.pnLoop || 0 == c.pnLoop ? !1 : !0, z = "false" == c.mouseOverStop || 0 == c.mouseOverStop ? !1 : !0, A = "false" == c.defaultPlay || 0 == c.defaultPlay ? !1 : !0, B = "false" == c.returnDefault || 0 == c.returnDefault ? !1 : !0, C = 0, D = 0, E = 0, F = 0, G = c.easing, H = null, I = null, J = null, K = c.titOnClassName, L = j.index(d.find("." + K)), M = p = -1 == L ? p : L, N = p, O = p, P = m >= u ? 0 != m % t ? m % t : t : 0, R = "leftMarquee" == e || "topMarquee" == e ? !0 : !1, S = function () { a.isFunction(c.startFun) && c.startFun(p, k, d, a(c.titCell, d), l, o, f, g) }, T = function () { a.isFunction(c.endFun) && c.endFun(p, k, d, a(c.titCell, d), l, o, f, g) }, U = function () { j.removeClass(K), A && j.eq(N).addClass(K) }; if ("menu" == c.type) return A && j.removeClass(K).eq(p).addClass(K), j.hover(function () { Q = a(this).find(c.targetCell); var b = j.index(a(this)); I = setTimeout(function () { switch (p = b, j.removeClass(K).eq(p).addClass(K), S(), e) { case "fade": Q.stop(!0, !0).animate({ opacity: "show" }, q, G, T); break; case "slideDown": Q.stop(!0, !0).animate({ height: "show" }, q, G, T) } }, c.triggerTime) }, function () { switch (clearTimeout(I), e) { case "fade": Q.animate({ opacity: "hide" }, q, G); break; case "slideDown": Q.animate({ height: "hide" }, q, G) } }), B && d.hover(function () { clearTimeout(J) }, function () { J = setTimeout(U, q) }), void 0; if (0 == k && (k = m), R && (k = 2), x) { if (m >= u) if ("leftLoop" == e || "topLoop" == e) k = 0 != m % t ? (0 ^ m / t) + 1 : m / t; else { var V = m - u; k = 1 + parseInt(0 != V % t ? V / t + 1 : V / t), 0 >= k && (k = 1) } else k = 1; j.html(""); var W = ""; if (1 == c.autoPage || "true" == c.autoPage) for (var X = 0; k > X; X++) W += "<li>" + (X + 1) + "</li>"; else for (var X = 0; k > X; X++) W += c.autoPage.replace("$", X + 1); j.html(W); var j = j.children() } if (m >= u) { l.children().each(function () { a(this).width() > E && (E = a(this).width(), D = a(this).outerWidth(!0)), a(this).height() > F && (F = a(this).height(), C = a(this).outerHeight(!0)) }); var Y = l.children(), Z = function () { for (var a = 0; u > a; a++) Y.eq(a).clone().addClass("clone").appendTo(l); for (var a = 0; P > a; a++) Y.eq(m - a - 1).clone().addClass("clone").prependTo(l) }; switch (e) { case "fold": l.css({ position: "relative", width: D, height: C }).children().css({ position: "absolute", width: E, left: 0, top: 0, display: "none" }); break; case "top": l.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + u * C + 'px"></div>').css({ top: -(p * t) * C, position: "relative", padding: "0", margin: "0" }).children().css({ height: F }); break; case "left": l.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + u * D + 'px"></div>').css({ width: m * D, left: -(p * t) * D, position: "relative", overflow: "hidden", padding: "0", margin: "0" }).children().css({ "float": "left", width: E }); break; case "leftLoop": case "leftMarquee": Z(), l.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; width:' + u * D + 'px"></div>').css({ width: (m + u + P) * D, position: "relative", overflow: "hidden", padding: "0", margin: "0", left: -(P + p * t) * D }).children().css({ "float": "left", width: E }); break; case "topLoop": case "topMarquee": Z(), l.wrap('<div class="tempWrap" style="overflow:hidden; position:relative; height:' + u * C + 'px"></div>').css({ height: (m + u + P) * C, position: "relative", padding: "0", margin: "0", top: -(P + p * t) * C }).children().css({ height: F }) } } var $ = function (a) { var b = a * t; return a == k ? b = m : -1 == a && 0 != m % t && (b = -m % t), b }, _ = function (b) { var c = function (c) { for (var d = c; u + c > d; d++) b.eq(d).find("img[" + n + "]").each(function () { var b = a(this); if (b.attr("src", b.attr(n)).removeAttr(n), l.find(".clone")[0]) for (var c = l.children(), d = 0; d < c.size(); d++) c.eq(d).find("img[" + n + "]").each(function () { a(this).attr(n) == b.attr("src") && a(this).attr("src", a(this).attr(n)).removeAttr(n) }) }) }; switch (e) { case "fade": case "fold": case "top": case "left": case "slideDown": c(p * t); break; case "leftLoop": case "topLoop": c(P + $(O)); break; case "leftMarquee": case "topMarquee": var d = "leftMarquee" == e ? l.css("left").replace("px", "") : l.css("top").replace("px", ""), f = "leftMarquee" == e ? D : C, g = P; if (0 != d % f) { var h = Math.abs(0 ^ d / f); g = 1 == p ? P + h : P + h - 1 } c(g) } }, ab = function (a) { if (!A || M != p || a || R) { if (R ? p >= 1 ? p = 1 : 0 >= p && (p = 0) : (O = p, p >= k ? p = 0 : 0 > p && (p = k - 1)), S(), null != n && _(l.children()), o[0] && (Q = o.eq(p), null != n && _(o), "slideDown" == e ? (o.not(Q).stop(!0, !0).slideUp(q), Q.slideDown(q, G, function () { l[0] || T() })) : (o.not(Q).stop(!0, !0).hide(), Q.animate({ opacity: "show" }, q, function () { l[0] || T() }))), m >= u) switch (e) { case "fade": l.children().stop(!0, !0).eq(p).animate({ opacity: "show" }, q, G, function () { T() }).siblings().hide(); break; case "fold": l.children().stop(!0, !0).eq(p).animate({ opacity: "show" }, q, G, function () { T() }).siblings().animate({ opacity: "hide" }, q, G); break; case "top": l.stop(!0, !1).animate({ top: -p * t * C }, q, G, function () { T() }); break; case "left": l.stop(!0, !1).animate({ left: -p * t * D }, q, G, function () { T() }); break; case "leftLoop": var b = O; l.stop(!0, !0).animate({ left: -($(O) + P) * D }, q, G, function () { -1 >= b ? l.css("left", -(P + (k - 1) * t) * D) : b >= k && l.css("left", -P * D), T() }); break; case "topLoop": var b = O; l.stop(!0, !0).animate({ top: -($(O) + P) * C }, q, G, function () { -1 >= b ? l.css("top", -(P + (k - 1) * t) * C) : b >= k && l.css("top", -P * C), T() }); break; case "leftMarquee": var c = l.css("left").replace("px", ""); 0 == p ? l.animate({ left: ++c }, 0, function () { l.css("left").replace("px", "") >= 0 && l.css("left", -m * D) }) : l.animate({ left: --c }, 0, function () { l.css("left").replace("px", "") <= -(m + P) * D && l.css("left", -P * D) }); break; case "topMarquee": var d = l.css("top").replace("px", ""); 0 == p ? l.animate({ top: ++d }, 0, function () { l.css("top").replace("px", "") >= 0 && l.css("top", -m * C) }) : l.animate({ top: --d }, 0, function () { l.css("top").replace("px", "") <= -(m + P) * C && l.css("top", -P * C) }) } j.removeClass(K).eq(p).addClass(K), M = p, y || (g.removeClass("nextStop"), f.removeClass("prevStop"), 0 == p && f.addClass("prevStop"), p == k - 1 && g.addClass("nextStop")), h.html("<span>" + (p + 1) + "</span>/" + k) } }; A && ab(!0), B && d.hover(function () { clearTimeout(J) }, function () { J = setTimeout(function () { p = N, A ? ab() : "slideDown" == e ? Q.slideUp(q, U) : Q.animate({ opacity: "hide" }, q, U), M = p }, 300) }); var bb = function (a) { H = setInterval(function () { w ? p-- : p++, ab() }, a ? a : r) }, cb = function (a) { H = setInterval(ab, a ? a : r) }, db = function () { z || (clearInterval(H), bb()) }, eb = function () { (y || p != k - 1) && (p++, ab(), R || db()) }, fb = function () { (y || 0 != p) && (p--, ab(), R || db()) }, gb = function () { clearInterval(H), R ? cb() : bb(), i.removeClass("pauseState") }, hb = function () { clearInterval(H), i.addClass("pauseState") }; if (v ? R ? (w ? p-- : p++, cb(), z && l.hover(hb, gb)) : (bb(), z && d.hover(hb, gb)) : (R && (w ? p-- : p++), i.addClass("pauseState")), i.click(function () { i.hasClass("pauseState") ? gb() : hb() }), "mouseover" == c.trigger ? j.hover(function () { var a = j.index(this); I = setTimeout(function () { p = a, ab(), db() }, c.triggerTime) }, function () { clearTimeout(I) }) : j.click(function () { p = j.index(this), ab(), db() }), R) { if (g.mousedown(eb), f.mousedown(fb), y) { var ib, jb = function () { ib = setTimeout(function () { clearInterval(H), cb(0 ^ r / 10) }, 150) }, kb = function () { clearTimeout(ib), clearInterval(H), cb() }; g.mousedown(jb), g.mouseup(kb), f.mousedown(jb), f.mouseup(kb) } "mouseover" == c.trigger && (g.hover(eb, function () { }), f.hover(fb, function () { })) } else g.click(eb), f.click(fb) }) } } (jQuery), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, { def: "easeOutQuad", swing: function (a, b, c, d, e) { return jQuery.easing[jQuery.easing.def](a, b, c, d, e) }, easeInQuad: function (a, b, c, d, e) { return d * (b /= e) * b + c }, easeOutQuad: function (a, b, c, d, e) { return -d * (b /= e) * (b - 2) + c }, easeInOutQuad: function (a, b, c, d, e) { return (b /= e / 2) < 1 ? d / 2 * b * b + c : -d / 2 * (--b * (b - 2) - 1) + c }, easeInCubic: function (a, b, c, d, e) { return d * (b /= e) * b * b + c }, easeOutCubic: function (a, b, c, d, e) { return d * ((b = b / e - 1) * b * b + 1) + c }, easeInOutCubic: function (a, b, c, d, e) { return (b /= e / 2) < 1 ? d / 2 * b * b * b + c : d / 2 * ((b -= 2) * b * b + 2) + c }, easeInQuart: function (a, b, c, d, e) { return d * (b /= e) * b * b * b + c }, easeOutQuart: function (a, b, c, d, e) { return -d * ((b = b / e - 1) * b * b * b - 1) + c }, easeInOutQuart: function (a, b, c, d, e) { return (b /= e / 2) < 1 ? d / 2 * b * b * b * b + c : -d / 2 * ((b -= 2) * b * b * b - 2) + c }, easeInQuint: function (a, b, c, d, e) { return d * (b /= e) * b * b * b * b + c }, easeOutQuint: function (a, b, c, d, e) { return d * ((b = b / e - 1) * b * b * b * b + 1) + c }, easeInOutQuint: function (a, b, c, d, e) { return (b /= e / 2) < 1 ? d / 2 * b * b * b * b * b + c : d / 2 * ((b -= 2) * b * b * b * b + 2) + c }, easeInSine: function (a, b, c, d, e) { return -d * Math.cos(b / e * (Math.PI / 2)) + d + c }, easeOutSine: function (a, b, c, d, e) { return d * Math.sin(b / e * (Math.PI / 2)) + c }, easeInOutSine: function (a, b, c, d, e) { return -d / 2 * (Math.cos(Math.PI * b / e) - 1) + c }, easeInExpo: function (a, b, c, d, e) { return 0 == b ? c : d * Math.pow(2, 10 * (b / e - 1)) + c }, easeOutExpo: function (a, b, c, d, e) { return b == e ? c + d : d * (-Math.pow(2, -10 * b / e) + 1) + c }, easeInOutExpo: function (a, b, c, d, e) { return 0 == b ? c : b == e ? c + d : (b /= e / 2) < 1 ? d / 2 * Math.pow(2, 10 * (b - 1)) + c : d / 2 * (-Math.pow(2, -10 * --b) + 2) + c }, easeInCirc: function (a, b, c, d, e) { return -d * (Math.sqrt(1 - (b /= e) * b) - 1) + c }, easeOutCirc: function (a, b, c, d, e) { return d * Math.sqrt(1 - (b = b / e - 1) * b) + c }, easeInOutCirc: function (a, b, c, d, e) { return (b /= e / 2) < 1 ? -d / 2 * (Math.sqrt(1 - b * b) - 1) + c : d / 2 * (Math.sqrt(1 - (b -= 2) * b) + 1) + c }, easeInElastic: function (a, b, c, d, e) { var f = 1.70158, g = 0, h = d; if (0 == b) return c; if (1 == (b /= e)) return c + d; if (g || (g = .3 * e), h < Math.abs(d)) { h = d; var f = g / 4 } else var f = g / (2 * Math.PI) * Math.asin(d / h); return -(h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g)) + c }, easeOutElastic: function (a, b, c, d, e) { var f = 1.70158, g = 0, h = d; if (0 == b) return c; if (1 == (b /= e)) return c + d; if (g || (g = .3 * e), h < Math.abs(d)) { h = d; var f = g / 4 } else var f = g / (2 * Math.PI) * Math.asin(d / h); return h * Math.pow(2, -10 * b) * Math.sin((b * e - f) * 2 * Math.PI / g) + d + c }, easeInOutElastic: function (a, b, c, d, e) { var f = 1.70158, g = 0, h = d; if (0 == b) return c; if (2 == (b /= e / 2)) return c + d; if (g || (g = e * .3 * 1.5), h < Math.abs(d)) { h = d; var f = g / 4 } else var f = g / (2 * Math.PI) * Math.asin(d / h); return 1 > b ? -.5 * h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) + c : .5 * h * Math.pow(2, -10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) + d + c }, easeInBack: function (a, b, c, d, e, f) { return void 0 == f && (f = 1.70158), d * (b /= e) * b * ((f + 1) * b - f) + c }, easeOutBack: function (a, b, c, d, e, f) { return void 0 == f && (f = 1.70158), d * ((b = b / e - 1) * b * ((f + 1) * b + f) + 1) + c }, easeInOutBack: function (a, b, c, d, e, f) { return void 0 == f && (f = 1.70158), (b /= e / 2) < 1 ? d / 2 * b * b * (((f *= 1.525) + 1) * b - f) + c : d / 2 * ((b -= 2) * b * (((f *= 1.525) + 1) * b + f) + 2) + c }, easeInBounce: function (a, b, c, d, e) { return d - jQuery.easing.easeOutBounce(a, e - b, 0, d, e) + c }, easeOutBounce: function (a, b, c, d, e) { return (b /= e) < 1 / 2.75 ? d * 7.5625 * b * b + c : 2 / 2.75 > b ? d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c : 2.5 / 2.75 > b ? d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c : d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c }, easeInOutBounce: function (a, b, c, d, e) { return e / 2 > b ? .5 * jQuery.easing.easeInBounce(a, 2 * b, 0, d, e) + c : .5 * jQuery.easing.easeOutBounce(a, 2 * b - e, 0, d, e) + .5 * d + c } });


/*
    表单验证
    Validform version 5.3.2
    By sean during April 7, 2010 - March 26, 2013
    For more information, please visit http://validform.rjboy.cn
    Validform is available under the terms of the MIT license.
*/

(function (d, f, b) { var g = null, j = null, i = true; var e = { tit: "提示信息", w: { "*": "不能为空！", "*6-16": "请填写6到16位任意字符！", "n": "请填写数字！", "n6-16": "请填写6到16位数字！", "s": "不能输入特殊字符！", "s6-18": "请填写6到18位字符！", "p": "请填写邮政编码！", "m": "请填写手机号码！", "e": "邮箱地址格式不对！", "url": "请填写网址！" }, def: "请填写正确信息！", undef: "datatype未定义！", reck: "两次输入的内容不一致！", r: "通过信息验证！", c: "正在检测信息…", s: "请{填写|选择}{0|信息}！", v: "所填信息没有经过验证，请稍后…", p: "正在提交数据…" }; d.Tipmsg = e; var a = function (l, n, k) { var n = d.extend({}, a.defaults, n); n.datatype && d.extend(a.util.dataType, n.datatype); var m = this; m.tipmsg = { w: {} }; m.forms = l; m.objects = []; if (k === true) { return false } l.each(function () { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; var p = this; p.settings = d.extend({}, n); var o = d(p); p.validform_status = "normal"; o.data("tipmsg", m.tipmsg); o.delegate("[datatype]", "blur", function () { var q = arguments[1]; a.util.check.call(this, o, q) }); o.delegate(":text", "keypress", function (q) { if (q.keyCode == 13 && o.find(":submit").length == 0) { o.submit() } }); a.util.enhance.call(o, p.settings.tiptype, p.settings.usePlugin, p.settings.tipSweep); p.settings.btnSubmit && o.find(p.settings.btnSubmit).bind("click", function () { o.trigger("submit"); return false }); o.submit(function () { var q = a.util.submitForm.call(o, p.settings); q === b && (q = true); return q }); o.find("[type='reset']").add(o.find(p.settings.btnReset)).bind("click", function () { a.util.resetForm.call(o) }) }); if (n.tiptype == 1 || (n.tiptype == 2 || n.tiptype == 3) && n.ajaxPost) { c() } }; a.defaults = { tiptype: 1, tipSweep: false, showAllError: false, postonce: false, ajaxPost: false }; a.util = { dataType: { "*": /[\w\W]+/, "*6-16": /^[\w\W]{6,16}$/, n: /^\d+$/, "n6-16": /^\d{6,16}$/, s: /^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]+$/, "s6-18": /^[\u4E00-\u9FA5\uf900-\ufa2d\w\.\s]{6,18}$/, p: /^[0-9]{6}$/, m: /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$/, e: /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/, url: /^(\w+:\/\/)?\w+(\.\w+)+.*$/ }, toString: Object.prototype.toString, isEmpty: function (k) { return k === "" || k === d.trim(this.attr("tip")) }, getValue: function (m) { var l, k = this; if (m.is(":radio")) { l = k.find(":radio[name='" + m.attr("name") + "']:checked").val(); l = l === b ? "" : l } else { if (m.is(":checkbox")) { l = ""; k.find(":checkbox[name='" + m.attr("name") + "']:checked").each(function () { l += d(this).val() + "," }); l = l === b ? "" : l } else { l = m.val() } } l = d.trim(l); return a.util.isEmpty.call(m, l) ? "" : l }, enhance: function (l, m, n, k) { var o = this; o.find("[datatype]").each(function () { if (l == 2) { if (d(this).parent().next().find(".Validform_checktip").length == 0) { d(this).parent().next().append("<span class='Validform_checktip' />"); d(this).siblings(".Validform_checktip").remove() } } else { if (l == 3 || l == 4) { if (d(this).siblings(".Validform_checktip").length == 0) { d(this).parent().append("<span class='Validform_checktip' />"); d(this).parent().next().find(".Validform_checktip").remove() } } } }); o.find("input[recheck]").each(function () { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; var q = d(this); var p = o.find("input[name='" + d(this).attr("recheck") + "']"); p.bind("keyup", function () { if (p.val() == q.val() && p.val() != "") { if (p.attr("tip")) { if (p.attr("tip") == p.val()) { return false } } q.trigger("blur") } }).bind("blur", function () { if (p.val() != q.val() && q.val() != "") { if (q.attr("tip")) { if (q.attr("tip") == q.val()) { return false } } q.trigger("blur") } }) }); o.find("[tip]").each(function () { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; var q = d(this).attr("tip"); var p = d(this).attr("altercss"); d(this).focus(function () { if (d(this).val() == q) { d(this).val(""); if (p) { d(this).removeClass(p) } } }).blur(function () { if (d.trim(d(this).val()) === "") { d(this).val(q); if (p) { d(this).addClass(p) } } }) }); o.find(":checkbox[datatype],:radio[datatype]").each(function () { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; var q = d(this); var p = q.attr("name"); o.find("[name='" + p + "']").filter(":checkbox,:radio").bind("click", function () { setTimeout(function () { q.trigger("blur") }, 0) }) }); o.find("select[datatype][multiple]").bind("click", function () { var p = d(this); setTimeout(function () { p.trigger("blur") }, 0) }); a.util.usePlugin.call(o, m, l, n, k) }, usePlugin: function (o, l, n, r) { var s = this, o = o || {}; if (s.find("input[plugin='swfupload']").length && typeof (swfuploadhandler) != "undefined") { var k = { custom_settings: { form: s, showmsg: function (v, t, u) { a.util.showmsg.call(s, v, l, { obj: s.find("input[plugin='swfupload']"), type: t, sweep: n }) } } }; k = d.extend(true, {}, o.swfupload, k); s.find("input[plugin='swfupload']").each(function (t) { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; d(this).val(""); swfuploadhandler.init(k, t) }) } if (s.find("input[plugin='datepicker']").length && d.fn.datePicker) { o.datepicker = o.datepicker || {}; if (o.datepicker.format) { Date.format = o.datepicker.format; delete o.datepicker.format } if (o.datepicker.firstDayOfWeek) { Date.firstDayOfWeek = o.datepicker.firstDayOfWeek; delete o.datepicker.firstDayOfWeek } s.find("input[plugin='datepicker']").each(function (t) { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; o.datepicker.callback && d(this).bind("dateSelected", function () { var u = new Date(d.event._dpCache[this._dpId].getSelected()[0]).asString(Date.format); o.datepicker.callback(u, this) }); d(this).datePicker(o.datepicker) }) } if (s.find("input[plugin*='passwordStrength']").length && d.fn.passwordStrength) { o.passwordstrength = o.passwordstrength || {}; o.passwordstrength.showmsg = function (u, v, t) { a.util.showmsg.call(s, v, l, { obj: u, type: t, sweep: n }) }; s.find("input[plugin='passwordStrength']").each(function (t) { if (this.validform_inited == "inited") { return true } this.validform_inited = "inited"; d(this).passwordStrength(o.passwordstrength) }) } if (r != "addRule" && o.jqtransform && d.fn.jqTransSelect) { if (s[0].jqTransSelected == "true") { return } s[0].jqTransSelected = "true"; var m = function (t) { var u = d(".jqTransformSelectWrapper ul:visible"); u.each(function () { var v = d(this).parents(".jqTransformSelectWrapper:first").find("select").get(0); if (!(t && v.oLabel && v.oLabel.get(0) == t.get(0))) { d(this).hide() } }) }; var p = function (t) { if (d(t.target).parents(".jqTransformSelectWrapper").length === 0) { m(d(t.target)) } }; var q = function () { d(document).mousedown(p) }; if (o.jqtransform.selector) { s.find(o.jqtransform.selector).filter('input:submit, input:reset, input[type="button"]').jqTransInputButton(); s.find(o.jqtransform.selector).filter("input:text, input:password").jqTransInputText(); s.find(o.jqtransform.selector).filter("input:checkbox").jqTransCheckBox(); s.find(o.jqtransform.selector).filter("input:radio").jqTransRadio(); s.find(o.jqtransform.selector).filter("textarea").jqTransTextarea(); if (s.find(o.jqtransform.selector).filter("select").length > 0) { s.find(o.jqtransform.selector).filter("select").jqTransSelect(); q() } } else { s.jqTransform() } s.find(".jqTransformSelectWrapper").find("li a").click(function () { d(this).parents(".jqTransformSelectWrapper").find("select").trigger("blur") }) } }, getNullmsg: function (o) { var n = this; var m = /[\u4E00-\u9FA5\uf900-\ufa2da-zA-Z\s]+/g; var k; var l = o[0].settings.label || ".Validform_label"; l = n.siblings(l).eq(0).text() || n.siblings().find(l).eq(0).text() || n.parent().siblings(l).eq(0).text() || n.parent().siblings().find(l).eq(0).text(); l = l.replace(/\s(?![a-zA-Z])/g, "").match(m); l = l ? l.join("") : [""]; m = /\{(.+)\|(.+)\}/; k = o.data("tipmsg").s || e.s; if (l != "") { k = k.replace(/\{0\|(.+)\}/, l); if (n.attr("recheck")) { k = k.replace(/\{(.+)\}/, ""); n.attr("nullmsg", k); return k } } else { k = n.is(":checkbox,:radio,select") ? k.replace(/\{0\|(.+)\}/, "") : k.replace(/\{0\|(.+)\}/, "$1") } k = n.is(":checkbox,:radio,select") ? k.replace(m, "$2") : k.replace(m, "$1"); n.attr("nullmsg", k); return k }, getErrormsg: function (s, n, u) { var o = /^(.+?)((\d+)-(\d+))?$/, m = /^(.+?)(\d+)-(\d+)$/, l = /(.*?)\d+(.+?)\d+(.*)/, q = n.match(o), t, r; if (u == "recheck") { r = s.data("tipmsg").reck || e.reck; return r } var p = d.extend({}, e.w, s.data("tipmsg").w); if (q[0] in p) { return s.data("tipmsg").w[q[0]] || e.w[q[0]] } for (var k in p) { if (k.indexOf(q[1]) != -1 && m.test(k)) { r = (s.data("tipmsg").w[k] || e.w[k]).replace(l, "$1" + q[3] + "$2" + q[4] + "$3"); s.data("tipmsg").w[q[0]] = r; return r } } return s.data("tipmsg").def || e.def }, _regcheck: function (t, n, u, A) { var A = A, y = null, v = false, o = /\/.+\//g, k = /^(.+?)(\d+)-(\d+)$/, l = 3; if (o.test(t)) { var s = t.match(o)[0].slice(1, -1); var r = t.replace(o, ""); var q = RegExp(s, r); v = q.test(n) } else { if (a.util.toString.call(a.util.dataType[t]) == "[object Function]") { v = a.util.dataType[t](n, u, A, a.util.dataType); if (v === true || v === b) { v = true } else { y = v; v = false } } else { if (!(t in a.util.dataType)) { var m = t.match(k), z; if (!m) { v = false; y = A.data("tipmsg").undef || e.undef } else { for (var B in a.util.dataType) { z = B.match(k); if (!z) { continue } if (m[1] === z[1]) { var w = a.util.dataType[B].toString(), r = w.match(/\/[mgi]*/g)[1].replace("/", ""), x = new RegExp("\\{" + z[2] + "," + z[3] + "\\}", "g"); w = w.replace(/\/[mgi]*/g, "/").replace(x, "{" + m[2] + "," + m[3] + "}").replace(/^\//, "").replace(/\/$/, ""); a.util.dataType[t] = new RegExp(w, r); break } } } } if (a.util.toString.call(a.util.dataType[t]) == "[object RegExp]") { v = a.util.dataType[t].test(n) } } } if (v) { l = 2; y = u.attr("sucmsg") || A.data("tipmsg").r || e.r; if (u.attr("recheck")) { var p = A.find("input[name='" + u.attr("recheck") + "']:first"); if (n != p.val()) { v = false; l = 3; y = u.attr("errormsg") || a.util.getErrormsg.call(u, A, t, "recheck") } } } else { y = y || u.attr("errormsg") || a.util.getErrormsg.call(u, A, t); if (a.util.isEmpty.call(u, n)) { y = u.attr("nullmsg") || a.util.getNullmsg.call(u, A) } } return { passed: v, type: l, info: y} }, regcheck: function (n, s, m) { var t = this, k = null, l = false, r = 3; if (m.attr("ignore") === "ignore" && a.util.isEmpty.call(m, s)) { if (m.data("cked")) { k = "" } return { passed: true, type: 4, info: k} } m.data("cked", "cked"); var u = a.util.parseDatatype(n); var q; for (var p = 0; p < u.length; p++) { for (var o = 0; o < u[p].length; o++) { q = a.util._regcheck(u[p][o], s, m, t); if (!q.passed) { break } } if (q.passed) { break } } return q }, parseDatatype: function (r) { var q = /\/.+?\/[mgi]*(?=(,|$|\||\s))|[\w\*-]+/g, o = r.match(q), p = r.replace(q, "").replace(/\s*/g, "").split(""), l = [], k = 0; l[0] = []; l[0].push(o[0]); for (var s = 0; s < p.length; s++) { if (p[s] == "|") { k++; l[k] = [] } l[k].push(o[s + 1]) } return l }, showmsg: function (n, l, m, k) { if (n == b) { return } if (k == "bycheck" && m.sweep && (m.obj && !m.obj.is(".Validform_error") || typeof l == "function")) { return } d.extend(m, { curform: this }); if (typeof l == "function") { l(n, m, a.util.cssctl); return } if (l == 1 || k == "byajax" && l != 4) { j.find(".Validform_info").html(n) } if (l == 1 && k != "bycheck" && m.type != 2 || k == "byajax" && l != 4) { i = false; j.find(".iframe").css("height", j.outerHeight()); j.show(); h(j, 100) } if (l == 2 && m.obj) { m.obj.parent().next().find(".Validform_checktip").html(n); a.util.cssctl(m.obj.parent().next().find(".Validform_checktip"), m.type) } if ((l == 3 || l == 4) && m.obj) { m.obj.siblings(".Validform_checktip").html(n); a.util.cssctl(m.obj.siblings(".Validform_checktip"), m.type) } }, cssctl: function (l, k) { switch (k) { case 1: l.removeClass("Validform_right Validform_wrong").addClass("Validform_checktip Validform_loading"); break; case 2: l.removeClass("Validform_wrong Validform_loading").addClass("Validform_checktip Validform_right"); break; case 4: l.removeClass("Validform_right Validform_wrong Validform_loading").addClass("Validform_checktip"); break; default: l.removeClass("Validform_right Validform_loading").addClass("Validform_checktip Validform_wrong") } }, check: function (v, t, n) { var o = v[0].settings; var t = t || ""; var k = a.util.getValue.call(v, d(this)); if (o.ignoreHidden && d(this).is(":hidden") || d(this).data("dataIgnore") === "dataIgnore") { return true } if (o.dragonfly && !d(this).data("cked") && a.util.isEmpty.call(d(this), k) && d(this).attr("ignore") != "ignore") { return false } var s = a.util.regcheck.call(v, d(this).attr("datatype"), k, d(this)); if (k == this.validform_lastval && !d(this).attr("recheck") && t == "") { return s.passed ? true : false } this.validform_lastval = k; var r; g = r = d(this); if (!s.passed) { a.util.abort.call(r[0]); if (!n) { a.util.showmsg.call(v, s.info, o.tiptype, { obj: d(this), type: s.type, sweep: o.tipSweep }, "bycheck"); !o.tipSweep && r.addClass("Validform_error") } return false } var q = d(this).attr("ajaxurl"); if (q && !a.util.isEmpty.call(d(this), k) && !n) { var m = d(this); if (t == "postform") { m[0].validform_subpost = "postform" } else { m[0].validform_subpost = "" } if (m[0].validform_valid === "posting" && k == m[0].validform_ckvalue) { return "ajax" } m[0].validform_valid = "posting"; m[0].validform_ckvalue = k; a.util.showmsg.call(v, v.data("tipmsg").c || e.c, o.tiptype, { obj: m, type: 1, sweep: o.tipSweep }, "bycheck"); a.util.abort.call(r[0]); var u = d.extend(true, {}, o.ajaxurl || {}); var p = { type: "POST", cache: false, url: q, data: "param=" + encodeURIComponent(k) + "&name=" + encodeURIComponent(d(this).attr("name")), success: function (x) { if (d.trim(x.status) === "y") { m[0].validform_valid = "true"; x.info && m.attr("sucmsg", x.info); a.util.showmsg.call(v, m.attr("sucmsg") || v.data("tipmsg").r || e.r, o.tiptype, { obj: m, type: 2, sweep: o.tipSweep }, "bycheck"); r.removeClass("Validform_error"); g = null; if (m[0].validform_subpost == "postform") { v.trigger("submit") } } else { m[0].validform_valid = x.info; a.util.showmsg.call(v, x.info, o.tiptype, { obj: m, type: 3, sweep: o.tipSweep }); r.addClass("Validform_error") } r[0].validform_ajax = null }, error: function (x) { if (x.status == "200") { if (x.responseText == "y") { u.success({ status: "y" }) } else { u.success({ status: "n", info: x.responseText }) } return false } if (x.statusText !== "abort") { var y = "status: " + x.status + "; statusText: " + x.statusText; a.util.showmsg.call(v, y, o.tiptype, { obj: m, type: 3, sweep: o.tipSweep }); r.addClass("Validform_error") } m[0].validform_valid = x.statusText; r[0].validform_ajax = null; return true } }; if (u.success) { var w = u.success; u.success = function (x) { p.success(x); w(x, m) } } if (u.error) { var l = u.error; u.error = function (x) { p.error(x) && l(x, m) } } u = d.extend({}, p, u, { dataType: "json" }); r[0].validform_ajax = d.ajax(u); return "ajax" } else { if (q && a.util.isEmpty.call(d(this), k)) { a.util.abort.call(r[0]); r[0].validform_valid = "true" } } if (!n) { a.util.showmsg.call(v, s.info, o.tiptype, { obj: d(this), type: s.type, sweep: o.tipSweep }, "bycheck"); r.removeClass("Validform_error") } g = null; return true }, submitForm: function (o, l, k, r, t) { var w = this; if (w[0].validform_status === "posting") { return false } if (o.postonce && w[0].validform_status === "posted") { return false } var v = o.beforeCheck && o.beforeCheck(w); if (v === false) { return false } var s = true, n; w.find("[datatype]").each(function () { if (l) { return false } if (o.ignoreHidden && d(this).is(":hidden") || d(this).data("dataIgnore") === "dataIgnore") { return true } var z = a.util.getValue.call(w, d(this)), A; g = A = d(this); n = a.util.regcheck.call(w, d(this).attr("datatype"), z, d(this)); if (!n.passed) { a.util.showmsg.call(w, n.info, o.tiptype, { obj: d(this), type: n.type, sweep: o.tipSweep }); A.addClass("Validform_error"); if (!o.showAllError) { A.focus(); s = false; return false } s && (s = false); return true } if (d(this).attr("ajaxurl") && !a.util.isEmpty.call(d(this), z)) { if (this.validform_valid !== "true") { var y = d(this); a.util.showmsg.call(w, w.data("tipmsg").v || e.v, o.tiptype, { obj: y, type: 3, sweep: o.tipSweep }); A.addClass("Validform_error"); y.trigger("blur", ["postform"]); if (!o.showAllError) { s = false; return false } s && (s = false); return true } } else { if (d(this).attr("ajaxurl") && a.util.isEmpty.call(d(this), z)) { a.util.abort.call(this); this.validform_valid = "true" } } a.util.showmsg.call(w, n.info, o.tiptype, { obj: d(this), type: n.type, sweep: o.tipSweep }); A.removeClass("Validform_error"); g = null }); if (o.showAllError) { w.find(".Validform_error:first").focus() } if (s) { var q = o.beforeSubmit && o.beforeSubmit(w); if (q === false) { return false } w[0].validform_status = "posting"; if (o.ajaxPost || r === "ajaxPost") { var u = d.extend(true, {}, o.ajaxpost || {}); u.url = k || u.url || o.url || w.attr("action"); a.util.showmsg.call(w, w.data("tipmsg").p || e.p, o.tiptype, { obj: w, type: 1, sweep: o.tipSweep }, "byajax"); if (t) { u.async = false } else { if (t === false) { u.async = true } } if (u.success) { var x = u.success; u.success = function (y) { o.callback && o.callback(y); w[0].validform_ajax = null; if (d.trim(y.status) === "y") { w[0].validform_status = "posted" } else { w[0].validform_status = "normal" } x(y, w) } } if (u.error) { var m = u.error; u.error = function (y) { o.callback && o.callback(y); w[0].validform_status = "normal"; w[0].validform_ajax = null; m(y, w) } } var p = { type: "POST", async: true, data: w.serializeArray(), success: function (y) { if (d.trim(y.status) === "y") { w[0].validform_status = "posted"; a.util.showmsg.call(w, y.info, o.tiptype, { obj: w, type: 2, sweep: o.tipSweep }, "byajax") } else { w[0].validform_status = "normal"; a.util.showmsg.call(w, y.info, o.tiptype, { obj: w, type: 3, sweep: o.tipSweep }, "byajax") } o.callback && o.callback(y); w[0].validform_ajax = null }, error: function (y) { var z = "status: " + y.status + "; statusText: " + y.statusText; a.util.showmsg.call(w, z, o.tiptype, { obj: w, type: 3, sweep: o.tipSweep }, "byajax"); o.callback && o.callback(y); w[0].validform_status = "normal"; w[0].validform_ajax = null } }; u = d.extend({}, p, u, { dataType: "json" }); w[0].validform_ajax = d.ajax(u) } else { if (!o.postonce) { w[0].validform_status = "normal" } var k = k || o.url; if (k) { w.attr("action", k) } return o.callback && o.callback(w) } } return false }, resetForm: function () { var k = this; k.each(function () { this.reset && this.reset(); this.validform_status = "normal" }); k.find(".Validform_right").text(""); k.find(".passwordStrength").children().removeClass("bgStrength"); k.find(".Validform_checktip").removeClass("Validform_wrong Validform_right Validform_loading"); k.find(".Validform_error").removeClass("Validform_error"); k.find("[datatype]").removeData("cked").removeData("dataIgnore").each(function () { this.validform_lastval = null }); k.eq(0).find("input:first").focus() }, abort: function () { if (this.validform_ajax) { this.validform_ajax.abort() } } }; d.Datatype = a.util.dataType; a.prototype = { dataType: a.util.dataType, eq: function (l) { var k = this; if (l >= k.forms.length) { return null } if (!(l in k.objects)) { k.objects[l] = new a(d(k.forms[l]).get(), {}, true) } return k.objects[l] }, resetStatus: function () { var k = this; d(k.forms).each(function () { this.validform_status = "normal" }); return this }, setStatus: function (k) { var l = this; d(l.forms).each(function () { this.validform_status = k || "posting" }); return this }, getStatus: function () { var l = this; var k = d(l.forms)[0].validform_status; return k }, ignore: function (k) { var l = this; var k = k || "[datatype]"; d(l.forms).find(k).each(function () { d(this).data("dataIgnore", "dataIgnore").removeClass("Validform_error") }); return this }, unignore: function (k) { var l = this; var k = k || "[datatype]"; d(l.forms).find(k).each(function () { d(this).removeData("dataIgnore") }); return this }, addRule: function (n) { var m = this; var n = n || []; for (var l = 0; l < n.length; l++) { var p = d(m.forms).find(n[l].ele); for (var k in n[l]) { k !== "ele" && p.attr(k, n[l][k]) } } d(m.forms).each(function () { var o = d(this); a.util.enhance.call(o, this.settings.tiptype, this.settings.usePlugin, this.settings.tipSweep, "addRule") }); return this }, ajaxPost: function (k, m, l) { var n = this; d(n.forms).each(function () { if (this.settings.tiptype == 1 || this.settings.tiptype == 2 || this.settings.tiptype == 3) { c() } a.util.submitForm.call(d(n.forms[0]), this.settings, k, l, "ajaxPost", m) }); return this }, submitForm: function (k, l) { var m = this; d(m.forms).each(function () { var n = a.util.submitForm.call(d(this), this.settings, k, l); n === b && (n = true); if (n === true) { this.submit() } }); return this }, resetForm: function () { var k = this; a.util.resetForm.call(d(k.forms)); return this }, abort: function () { var k = this; d(k.forms).each(function () { a.util.abort.call(this) }); return this }, check: function (m, k) { var k = k || "[datatype]", o = this, n = d(o.forms), l = true; n.find(k).each(function () { a.util.check.call(this, n, "", m) || (l = false) }); return l }, config: function (k) { var l = this; k = k || {}; d(l.forms).each(function () { var m = d(this); this.settings = d.extend(true, this.settings, k); a.util.enhance.call(m, this.settings.tiptype, this.settings.usePlugin, this.settings.tipSweep) }); return this } }; d.fn.Validform = function (k) { return new a(this, k) }; function h(n, m) { var l = (d(window).width() - n.outerWidth()) / 2, k = (d(window).height() - n.outerHeight()) / 2, k = (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + (k > 0 ? k : 0); n.css({ left: l }).animate({ top: k }, { duration: m, queue: false }) } function c() { if (d("#Validform_msg").length !== 0) { return false } j = d('<div id="Validform_msg"><div class="Validform_title">' + e.tit + '<a class="Validform_close" href="javascript:void(0);">&chi;</a></div><div class="Validform_info"></div><div class="iframe"><iframe frameborder="0" scrolling="no" height="100%" width="100%"></iframe></div></div>').appendTo("body"); j.find("a.Validform_close").click(function () { j.hide(); i = true; if (g) { g.focus().addClass("Validform_error") } return false }).focus(function () { this.blur() }); d(window).bind("scroll resize", function () { !i && h(j, 400) }) } d.Showmsg = function (k) { c(); a.util.showmsg.call(f, k, 1, {}) }; d.Hidemsg = function () { j.hide(); i = true } })(jQuery, window);


/*
*星状评价
*!
* jQuery Raty - A Star Rating Plugin
*
* The MIT License
*
* @author  : Washington Botelho
* @doc     : http://wbotelhos.com/raty
* @version : 2.6.0
*
*/
; (function ($) { 'use strict'; var methods = { init: function (options) { return this.each(function () { this.self = $(this); methods.destroy.call(this.self); this.opt = $.extend(true, {}, $.fn.raty.defaults, options); methods._adjustCallback.call(this); methods._adjustNumber.call(this); if (this.opt.starType !== 'img') { methods._adjustStarType.call(this) } methods._adjustPath.call(this); methods._createStars.call(this); if (this.opt.cancel) { methods._createCancel.call(this) } if (this.opt.precision) { methods._adjustPrecision.call(this) } methods._createScore.call(this); methods._apply.call(this, this.opt.score); methods._target.call(this, this.opt.score); if (this.opt.readOnly) { methods._lock.call(this) } else { this.style.cursor = 'pointer'; methods._binds.call(this) } this.self.data('options', this.opt) }) }, _adjustCallback: function () { var options = ['number', 'readOnly', 'score', 'scoreName']; for (var i = 0; i < options.length; i++) { if (typeof this.opt[options[i]] === 'function') { this.opt[options[i]] = this.opt[options[i]].call(this) } } }, _adjustNumber: function () { this.opt.number = methods._between(this.opt.number, 1, this.opt.numberMax) }, _adjustPath: function () { this.opt.path = this.opt.path || ''; if (this.opt.path && this.opt.path.charAt(this.opt.path.length - 1) !== '/') { this.opt.path += '/' } }, _adjustPrecision: function () { this.opt.half = true; this.opt.targetType = 'score' }, _adjustStarType: function () { this.opt.path = ''; var replaces = ['cancelOff', 'cancelOn', 'starHalf', 'starOff', 'starOn']; for (var i = 0; i < replaces.length; i++) { this.opt[replaces[i]] = this.opt[replaces[i]].replace('.', '-') } }, _apply: function (score) { methods._fill.call(this, score); if (score) { if (score > 0) { this.score.val(methods._between(score, 0, this.opt.number)) } methods._roundStars.call(this, score) } }, _between: function (value, min, max) { return Math.min(Math.max(parseFloat(value), min), max) }, _binds: function () { if (this.cancel) { methods._bindOverCancel.call(this); methods._bindClickCancel.call(this); methods._bindOutCancel.call(this) } methods._bindOver.call(this); methods._bindClick.call(this); methods._bindOut.call(this) }, _bindClick: function () { var that = this; that.stars.on('click.raty', function (evt) { var star = $(this); that.score.val((that.opt.half || that.opt.precision) ? that.self.data('score') : (this.alt || star.data('alt'))); if (that.opt.click) { that.opt.click.call(that, +that.score.val(), evt) } }) }, _bindClickCancel: function () { var that = this; that.cancel.on('click.raty', function (evt) { that.score.removeAttr('value'); if (that.opt.click) { that.opt.click.call(that, null, evt) } }) }, _bindOut: function () { var that = this; that.self.on('mouseleave.raty', function (evt) { var score = +that.score.val() || undefined; methods._apply.call(that, score); methods._target.call(that, score, evt); if (that.opt.mouseout) { that.opt.mouseout.call(that, score, evt) } }) }, _bindOutCancel: function () { var that = this; that.cancel.on('mouseleave.raty', function (evt) { var cancel = $(this), cancelOff = that.opt.path + that.opt.cancelOff; if (that.opt.starType === 'img') { cancel.attr('src', cancelOff) } else { var cancelOn = that.opt.path + that.opt.cancelOn; cancel.removeClass(cancelOn).addClass(cancelOff) } if (that.opt.mouseout) { var score = +that.score.val() || undefined; that.opt.mouseout.call(that, score, evt) } }) }, _bindOver: function () { var that = this, action = that.opt.half ? 'mousemove.raty' : 'mouseover.raty'; that.stars.on(action, function (evt) { var score = methods._getScoreByPosition.call(that, evt, this); methods._fill.call(that, score); if (that.opt.half) { methods._roundStars.call(that, score); that.self.data('score', score) } methods._target.call(that, score, evt); if (that.opt.mouseover) { that.opt.mouseover.call(that, score, evt) } }) }, _bindOverCancel: function () { var that = this; that.cancel.on('mouseover.raty', function (evt) { var cancelOn = that.opt.path + that.opt.cancelOn, star = $(this), starOff = that.opt.path + that.opt.starOff; if (that.opt.starType === 'img') { star.attr('src', cancelOn); that.stars.attr('src', starOff) } else { that.stars.attr('class', starOff); var cancelOff = that.opt.path + that.opt.cancelOff; star.removeClass(cancelOff).addClass(cancelOn) } methods._target.call(that, null, evt); if (that.opt.mouseover) { that.opt.mouseover.call(that, null) } }) }, _buildScoreField: function () { return $('<input />', { name: this.opt.scoreName, type: 'hidden' }).appendTo(this) }, _createCancel: function () { var icon = this.opt.path + this.opt.cancelOff, cancel = $('<' + this.opt.starType + ' />', { title: this.opt.cancelHint, 'class': 'raty-cancel' }); if (this.opt.starType === 'img') { cancel.attr({ src: icon, alt: 'x' }) } else { cancel.attr('data-alt', 'x').addClass(icon) } if (this.opt.cancelPlace === 'left') { this.self.prepend('&#160;').prepend(cancel) } else { this.self.append('&#160;').append(cancel) } this.cancel = cancel }, _createScore: function () { var score = $(this.opt.targetScore); this.score = score.length ? score : methods._buildScoreField.call(this) }, _createStars: function () { for (var i = 1; i <= this.opt.number; i++) { var attrs, icon = (this.opt.score && this.opt.score >= i) ? 'starOn' : 'starOff', title = methods._getHint.call(this, i); icon = this.opt.path + this.opt[icon]; if (this.opt.starType !== 'img') { attrs = { 'data-alt': i, 'class': icon} } else { attrs = { src: icon, alt: i} } attrs.title = title; $('<' + this.opt.starType + ' />', attrs).appendTo(this); if (this.opt.space) { this.self.append(i < this.opt.number ? '&#160;' : '') } } this.stars = this.self.children(this.opt.starType) }, _error: function (message) { $(this).text(message); $.error(message) }, _fill: function (score) { var hash = 0; for (var i = 1; i <= this.stars.length; i++) { var icon, star = this.stars.eq(i - 1), turnOn = methods._turnOn.call(this, i, score); if (this.opt.iconRange && this.opt.iconRange.length > hash) { var irange = this.opt.iconRange[hash]; icon = methods._getIconRange.call(this, irange, turnOn); if (i <= irange.range) { if (this.opt.starType === 'img') { star.attr('src', icon) } else { star.attr('class', icon) } } if (i === irange.range) { hash++ } } else { icon = this.opt.path + this.opt[turnOn ? 'starOn' : 'starOff']; if (this.opt.starType === 'img') { star.attr('src', icon) } else { star.attr('class', icon) } } } }, _getIconRange: function (irange, turnOn) { return this.opt.path + (turnOn ? irange.on || this.opt.starOn : irange.off || this.opt.starOff) }, _getScoreByPosition: function (evt, icon) { var star = $(icon), score = parseInt(icon.alt || star.data('alt'), 10); if (this.opt.half) { var size = methods._getSize.call(this), percent = parseFloat((evt.pageX - star.offset().left) / size); if (this.opt.precision) { score = score - 1 + percent } else { score = score - 1 + (percent > 0.5 ? 1 : 0.5) } } return score }, _getSize: function () { var size; if (this.opt.starType === 'img') { size = this.stars[0].width } else { size = parseFloat(this.stars.eq(0).css('font-size')) } if (!size) { methods._error.call(this, 'Could not be possible get the icon size!') } return size }, _turnOn: function (i, score) { return this.opt.single ? (i === score) : (i <= score) }, _getHint: function (score) { var hint = this.opt.hints[score - 1]; return hint === '' ? '' : hint || score }, _lock: function () { var score = parseInt(this.score.val(), 10), hint = score ? methods._getHint.call(this, score) : this.opt.noRatedMsg; this.style.cursor = ''; this.title = hint; this.score.prop('readonly', true); this.stars.prop('title', hint); if (this.cancel) { this.cancel.hide() } this.self.data('readonly', true) }, _roundStars: function (score) { var rest = (score % 1).toFixed(2); if (rest > this.opt.round.down) { var icon = 'starOn'; if (this.opt.halfShow && rest < this.opt.round.up) { icon = 'starHalf' } else if (rest < this.opt.round.full) { icon = 'starOff' } var star = this.stars[Math.ceil(score) - 1]; if (this.opt.starType === 'img') { star.src = this.opt.path + this.opt[icon] } else { star.style.className = this.opt[icon] } } }, _target: function (score, evt) { if (this.opt.target) { var target = $(this.opt.target); if (!target.length) { methods._error.call(this, 'Target selector invalid or missing!') } var mouseover = evt && evt.type === 'mouseover'; if (score === undefined) { score = this.opt.targetText } else if (score === null) { score = mouseover ? this.opt.cancelHint : this.opt.targetText } else { if (this.opt.targetType === 'hint') { score = methods._getHint.call(this, Math.ceil(score)) } else if (this.opt.precision) { score = parseFloat(score).toFixed(1) } var mousemove = evt && evt.type === 'mousemove'; if (!mouseover && !mousemove && !this.opt.targetKeep) { score = this.opt.targetText } } if (score) { score = this.opt.targetFormat.toString().replace('{score}', score) } if (target.is(':input')) { target.val(score) } else { target.html(score) } } }, _unlock: function () { this.style.cursor = 'pointer'; this.removeAttribute('title'); this.score.removeAttr('readonly'); this.self.data('readonly', false); for (var i = 0; i < this.opt.number; i++) { this.stars[i].title = methods._getHint.call(this, i + 1) } if (this.cancel) { this.cancel.css('display', '') } }, cancel: function (click) { return this.each(function () { var el = $(this); if (el.data('readonly') !== true) { methods[click ? 'click' : 'score'].call(el, null); this.score.removeAttr('value') } }) }, click: function (score) { return this.each(function () { if ($(this).data('readonly') !== true) { methods._apply.call(this, score); if (this.opt.click) { this.opt.click.call(this, score, $.Event('click')) } methods._target.call(this, score) } }) }, destroy: function () { return this.each(function () { var self = $(this), raw = self.data('raw'); if (raw) { self.off('.raty').empty().css({ cursor: raw.style.cursor }).removeData('readonly') } else { self.data('raw', self.clone()[0]) } }) }, getScore: function () { var score = [], value; this.each(function () { value = this.score.val(); score.push(value ? +value : undefined) }); return (score.length > 1) ? score : score[0] }, move: function (score) { return this.each(function () { var integer = parseInt(score, 10), opt = $(this).data('options'), decimal = (+score).toFixed(1).split('.')[1]; if (integer >= opt.number) { integer = opt.number - 1; decimal = 10 } var size = methods._getSize.call(this), point = size / 10, star = $(this.stars[integer]), percent = star.offset().left + point * parseInt(decimal, 10), evt = $.Event('mousemove', { pageX: percent }); star.trigger(evt) }) }, readOnly: function (readonly) { return this.each(function () { var self = $(this); if (self.data('readonly') !== readonly) { if (readonly) { self.off('.raty').children('img').off('.raty'); methods._lock.call(this) } else { methods._binds.call(this); methods._unlock.call(this) } self.data('readonly', readonly) } }) }, reload: function () { return methods.set.call(this, {}) }, score: function () { var self = $(this); return arguments.length ? methods.setScore.apply(self, arguments) : methods.getScore.call(self) }, set: function (options) { return this.each(function () { var self = $(this), actual = self.data('options'), news = $.extend({}, actual, options); self.raty(news) }) }, setScore: function (score) { return this.each(function () { if ($(this).data('readonly') !== true) { methods._apply.call(this, score); methods._target.call(this, score) } }) } }; $.fn.raty = function (method) { if (methods[method]) { return methods[method].apply(this, Array.prototype.slice.call(arguments, 1)) } else if (typeof method === 'object' || !method) { return methods.init.apply(this, arguments) } else { $.error('Method ' + method + ' does not exist!') } }; $.fn.raty.defaults = { cancel: false, cancelHint: 'Cancel this rating!', cancelOff: 'cancel-off.png', cancelOn: 'cancel-on.png', cancelPlace: 'left', click: undefined, half: false, halfShow: true, hints: ['bad', 'poor', 'regular', 'good', 'gorgeous'], iconRange: undefined, mouseout: undefined, mouseover: undefined, noRatedMsg: 'Not rated yet!', number: 5, numberMax: 20, path: undefined, precision: false, readOnly: false, round: { down: 0.25, full: 0.6, up: 0.76 }, score: undefined, scoreName: 'score', single: false, space: true, starHalf: 'http://images.jcpeixun.com/u/star-half.png', starOff: 'http://images.jcpeixun.com/u/star-off.png', starOn: 'http://images.jcpeixun.com/u/star-on.png', starType: 'img', target: undefined, targetFormat: '{score}', targetKeep: false, targetScore: undefined, targetText: '', targetType: 'hint'} })(jQuery);


/**
* 判断是否手机端访问
* jQuery.browser.mobile (http://detectmobilebrowser.com/)
*
* jQuery.browser.mobile will be true if the browser is a mobile device
*
**/
(function (a) { (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)) })(navigator.userAgent || navigator.vendor || window.opera);




/*
    jc.common.js
    v1
    2013.1.1
    ningyb
*/
var jc = {
    /*
       判断是否登录
    */
    "isLogined": function(){
        var logined = $.cookie("learnerId");
        if (logined != null) {
            return true;
        }
        return false;
    },
    /*
        判断是否注册（新版注册 entrance = 1）
    */
    "isRegistered": function(){
        var entrance = $.cookie("regEntrance");
        var emailpass = $.cookie("emailPass");
        if (entrance == "1" && emailpass=="1") {
            return true;
        }
        return false;
    },
    /*
        判断手机是否通过验证（新版注册 entrance = 1）
    */
    "mobileIsPass": function(){
        var entrance = $.cookie("regEntrance");
        var mobile = $.cookie("mobilePass");
        if (entrance == "1" && mobile == "1") {
            return true;
        }
        return false;
    },
	/*
		获取会员等级（注：先判断登录，再获取会员等级）
	*/
	"getLearnerGrade": function(){
		return $.cookie("C_LearnerGrade");
	}

}
