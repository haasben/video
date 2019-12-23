
var apiURL = {
    "loginPage": "/login",
    "join": "/ajax/j-o-i-n",
    "checkMobile": "/ajax/checkmobile",
    "checkEmail": "/ajax/checkemail",
    "sendRegSMS": "/ajax/sendregsms",
    "checkSMS": "/ajax/checksmscode",
    "checkImageCode": "ajax/checkImageCode"
};

function HttpURL(u) {
    var domain = $("#domain").val();
    return domain == "localhost" ? (apiURL[u] + ".aspx") : (apiURL[u]);
}

function login() {
    var version = $("#flow-version").val();

   if(version == "B"){
         //B版本登录切换
        location.href = HttpURL("loginPage")+"?callback="+escape($("#callback").val());
   }else{

        //A版本登录切换：
        $(".login_way_count").click();
   }
}



function toUpperCase(obj) {
    obj.value=obj.value.toUpperCase()
}

var uid = "";
$(function () {
    $(".label input[type='checkbox']").removeAttr('checked');
    $(".stitchingCourse").text("");
    $(".label input[type='checkbox']").click(function () {
        var maxcheckedLen = 5;
        var checkedLen = $(".label input[type='checkbox']:checked").length;
       
        if (maxcheckedLen < checkedLen) {
            toastfun("您至多可以选择5项哦!");
            $(this).prop("checked", false);
            return false;
        } else {
            $(".stitchingCourse").append($(this).val() + ",");          
        }
    });



    function Radom4() {
        var charactors = "abcd2ef3gh4ij5k6mn7pq8rst9uvwxyz";
        var value = '', i;
        for (j = 1; j <= 4; j++) {
            i = parseInt(35 * Math.random());
            value = value + charactors.charAt(i);
        }
        return value;
    }

    function gotoEmailHost(email, away) {
        var url = email.split('@')[1];
        if (away == 1) {
            window.location.href = hash[url];
        } else if (away == 2) {
            window.open(hash[url], '_blank');
        }
    }

    function CountDown(timer) {
        var id1 = "cdown_tips";
        var id2 = "sendCode";
        //$("#" + id2).hide();
        var $id1 = $("#" + id1);
        var i = timer;
        var fn = function () {
            $id1.html("还有" + i + "秒可重发");
            !i && $id1.hide() && $("#" + id2).show() && $("#sendedCode-tips").hide() && clearInterval(timer);
            i--;
        };
        timer = setInterval(fn, 1000);
        fn();
        $id1.show();
    }

    var hash = {
        'qq.com': 'http://mail.qq.com',
        'vip.qq.com': 'http://mail.vip.qq.com',
        'gmail.com': 'http://mail.google.com',
        'sina.com': 'http://mail.sina.com.cn',
        '163.com': 'http://mail.163.com',
        '126.com': 'http://mail.126.com',
        'yeah.net': 'http://www.yeah.net/',
        'sohu.com': 'http://mail.sohu.com/',
        'tom.com': 'http://mail.tom.com/',
        'sogou.com': 'http://mail.sogou.com/',
        '139.com': 'http://mail.10086.cn/',
        'hotmail.com': 'http://www.hotmail.com',
        'live.com': 'http://login.live.com/',
        'live.cn': 'http://login.live.cn/',
        'live.com.cn': 'http://login.live.com.cn',
        '189.com': 'http://webmail16.189.cn/webmail/',
        'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
        'yahoo.cn': 'http://mail.cn.yahoo.com/',
        'eyou.com': 'http://www.eyou.com/',
        '21cn.com': 'http://mail.21cn.com/',
        '188.com': 'http://www.188.com/',
        'foxmail.coom': 'http://www.foxmail.com',
        'simmtech-xian.com': ''
    };

    if ($('#uEmail').attr("data-autocomplete") || $('#uEmail').attr("data-autocomplete") == "on") {
        $('#uEmail').autoMail({
            emails: ['qq.com', '163.com', '126.com', 'sina.com', 'sohu.com', 'yahoo.cn', 'gmail.com', 'hotmail.com', 'live.cn']
        });
    }

    var vUemail = /^\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-+.]\w+)*$/;
    var uMobileRegular = /^(13[0-9]|14[0-9]|15[0-9]|17[0-9]|16[0-9]|19[0-9]|18[0-9])\d{8}$/;


    function $trim(arg) {
        return $.trim(arg);
    }

    $("#uEmail").focus(function () {
        var sEmail = $("#uEmail").val();
        if ($trim(sEmail) == "建议使用QQ邮箱") {
            $("#uEmail").val("");
        }
        $("#e_tips").attr("class", "cgray5").html("请输入常用邮箱");
        $(this).addClass("txt_blue2-260-30");
    }).blur(function () { $(this).removeClass("txt_red2-260-30 txt_blue2-260-30"); });

    $("#utrueName").focus(function () {
        $("#utrueName_tips").html("");
        $(this).addClass("txt_blue2-260-30");
    }).blur(function () { $(this).removeClass("txt_red2-260-30 txt_blue2-260-30"); });

    $("#uPwd").focus(function () {
        $(this).prop("type", "password");
        $("#e_tips").attr("class", "cgray5").html("");
        var sEmail = $("#uEmail").val();
        if (!vUemail.test($trim(sEmail))) {
            $("#e_tips").attr("class", "cred").html("请输入常用邮箱");
            $("#uEmail").addClass("txt_red2-260-30");
        } else {
            var t_sEmail = $trim(sEmail);
            var i_sEmail = t_sEmail.substring(t_sEmail.indexOf("@") + 1);
            if (!hash[i_sEmail]) {
                $("#e_tips").attr("class", "cred").html("为了确保您能及时收到邮件，建议使用QQ邮箱");
                $("#uEmail").addClass("txt_red2-260-30");
            } else {
                /*验证邮箱是否已经注册*/
                $.post('/?m=index&c=login&a=check_email', $("#regForm").serialize()).done(function (d) {
                    if (d == "0") {
                        /*邮箱已经注册*/
                        $("#e_tips").attr("class", "cred").html("该邮箱已被注册,请更换邮箱，或直接<a href=\"javascript:;\"  onclick=\"login()\">登录</a>");
                        $("#uEmail").addClass("txt_red2-260-30");
                        return false;
                    }else if (d == 2){
                        $("#e_tips").attr("class", "cred").html("邮箱格式错误");
                        $("#uEmail").addClass("txt_red2-260-30");
                    }
                });

            }

        }
        var sPwd = $(this).val();
        $("#w_tips").attr("class", "cgray5").html("6-20字符，可使用字母、数字或符号的组合");
        $(this).addClass("txt_blue2-260-30");
    }).blur(function () { $(this).removeClass("txt_red2-260-30 txt_blue2-260-30"); });

    $("#umobile").focus(function () {
        $(this).addClass("txt_blue2-260-30");
    }).blur(function () {
        var umobile = $("#umobile").val();
        if (!(uMobileRegular).test(umobile)) {
            $("#m_tips").attr("class", "cred").html("请输入正确的手机号码.");
            $("#umobile").addClass("txt_red2-260-30"); //attr
        }
        else {
            $("#m_tips").attr("class", "cred").html("");
            //$("#umobile").attr("class", "reg_txt txt_gray3-260-30");
            $("#umobile").removeClass("txt_red2-260-30 txt_blue2-260-30");
        }
    })

    $("#validateCode").focus(function () {
        $(this).addClass("txt_blue2-260-30"); //attr
    }).blur(function () { $(this).removeClass("txt_blue2-260-30"); });

    //表单验证 ：验证手机，姓名，邮箱，密码
    function validateForm() {
        var umobile = $("#umobile").val();
        // var sEmail = $("#uEmail").val();
        var sPwd = $("#uPwd").val();
        var validateCode = $("#validateCode").val();
        // var utrueName = $("#utrueName").val();

        if (!(uMobileRegular).test(umobile)) {
            $("#m_tips").attr("class", "cred").html("请输入正确的手机号码.");
            $("#umobile").addClass("txt_red2-260-30");
            return false;
        }
        // if (utrueName == "") {
        //     $("#utrueName_tips").attr("class", "cred").html("还未输入姓名！");
        //     $("#utrueName").addClass("txt_red2-260-30");
        //     return false;

        // }
        //if (!vUemail.test($trim(sEmail))) {
        // var t_sEmail = $trim(sEmail);
        // var pre_Email = sEmail.substring(0, t_sEmail.indexOf("@"));
        // var i_sEmail = t_sEmail.substring(t_sEmail.indexOf("@") + 1);
        
        // if (!hash[i_sEmail]) {
        //     $("#e_tips").attr("class", "cred").html("请输入常用邮箱");
        //     $("#uEmail").addClass("txt_red2-260-30");
        //     return false;
        // }
        // if (pre_Email.length < 3 || pre_Email.length > 30) {
        //     $("#e_tips").attr("class", "cred").html("请输入正确邮箱，邮箱账号长度需介于3-30个字符之间");
        //     $("#uEmail").addClass("txt_red2-260-30");
        //     return false;
        // }
        // else {
        //     $("#uEmail").removeClass("txt_red2-260-30");
        // }
        
        if ($trim(sPwd).length < 6 || $trim(sPwd).length > 20) {
            $("#w_tips").attr("class", "cred").html("请输入正确的密码 6-20个字符");
            $("#uPwd").addClass("txt_red2-260-30");
            return false;
        }
        return true;
    }


    //参数：发送按钮对象
    function sendCode($this) {
        //表单信息必须先填写完整。
        if(!validateForm()) {
            return false;
        }
        var csrf=stoken;
        var umobile=$("#umobile").val();
        if(!(uMobileRegular).test(umobile)) {
            alert("请输入正确的手机号码");
        }else{
            $this.attr("disabled","disabled");
            $this.css({"background":"#aaa","color":"#fff"});
            $.post('/?m=index&c=login&a=verification',{ mobile: umobile }).done(function(d) {
                if(d=="1") {
                    $("#m_tips").attr("class","cred").html("您的手机号已经可以直接登陆，点击<a href=\"javascript:;\"  onclick=\"login()\">登录</a>");
                    $this.removeAttr("disabled");
                    return false;
                } else {
                    var jn_d=$.parseJSON($("#cur_user").val());
                    umobile=$.trim($("#umobile").val());
                    var umobiles="";
                    $this.attr("disabled","disabled");
                    $this.css({"background":"#aaa","color":"#fff"});
                    $("#csrf").val(csrf);

                    //避免验证码发送失败，点击获取验证码同时注册账号
                    // $.post(HttpURL("join"),$("#regForm").serialize()).done(function(dd) {
                        // if(dd=="1") {
                            $.post('/?m=index&c=login&a=sen_msg',smsEncryptToken).done(function(d) {
                                if(d=="1") {
                                    // alert("验证码发送成功，请注意查收");
                                    //$("#sendedCode-tips").show();
                                    CountDown(120);
                                    $this.html("短信已发送");
                                    $this.attr("disabled","disabled");
                                    $this.css({"background":"#aaa","color":"#fff"});
                                } else if(d=="-4") {
                                    alert("不能频繁发验证码，请3分钟后再试");
                                    $this.attr("disabled","disabled");
                                    $this.css({"background":"#aaa","color":"#fff"}); 
                                } else {
                                    alert("发送失败");
                                    $this.attr("disabled","disabled");
                                    $this.css({"background":"#aaa","color":"#fff"});
                                }
                                $this.removeAttr("disabled");
                            });
                            //isLogin();
                        // }else {
                        //     alert(dd);
                        // }
                    // });
                }
            });
        }
    }

    /* 发送验证码 */
    $("#sendCode").click(function() {
        if(!validateForm()) {
            return false;
        }

        //提示安全验证：
        $("#verifycode").fadeIn();
        $("#verifycode-ipt").val("");
    });



    //点击确认验证码：
    $("#verifycode-btn").click(function() {
        var code = $("#verifycode-ipt").val();
        if(code == "") {
            $("#verifycode-tips").text("请输入图形验证码！")
        } else {
            $.post("/?m=index&c=login&a=checkImageCode",{ "code": code },function(res) {
                // res=eval('('+res+')');
                console.log(res);
                if(res.error==0) {
                    $(".dialog").fadeOut();
                    $("#imageCode").val(code);
                    //执行发送
                    sendCode($("#sendCode"));
                } else {
                    $("#verifycode-tips").text("输入不正确，请重新输入！");
                    changeImageCode();
                }
            });
        }
    });

    //切换验证码：
    $("#verifycode-change").click(function() {
        changeImageCode();
    })
    //切换验证码：
    function changeImageCode() {

        var src = "/?m=Admin&c=Admin&a=vertify";
        if (src.indexOf('?') > -1) {
            src += '&';
        } else {
            src += '?';
        }
        src += 'r='+Math.floor(Math.random()*100);
        $('#verifycode-img').attr('src', src);//重载验证码
    
    }
    
     //查询手机号码归属地
//  function getMobileArea(callback){
//      $.ajax({
//          type: 'get',
//          url : 'http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel='+$("#umobile").val(),
//          dataType : 'script',
//          async:true,
//          cache: false,
//          success:function(data){
//              var prov = __GetZoneResult_.province;
//              callback(prov);
//          }
//      });
//  }
//  
    
    
    //点击注册按钮
    $("#reg_form").delegate("#register", "click", function () {
        var umobile = $("#umobile").val();
        var sEmail = $("#uEmail").val();
        var sPwd = $("#uPwd").val();
        var validateCode = $("#validateCode").val();
        // var utrueName = $("#utrueName").val();

        if (!validateForm()) {
            return false;
        }

        if ($("#agree").prop("checked") == false) {
            alert("请同意 用户条款 和 隐私条款");
            return false;
        }
        if (validateCode == "") {
            alert("请输入验证码");
            return false;
        }

        $("#btns").hide();
        $("#btns2").show();
        var callback = $("#callback").val();
        //console.log(callback);
        //检查短信验证码：
        $.post('/?m=index&c=login&a=register', $("#regForm").serialize()).done(function (d) {
            if (d.code == "1") {                                                                                        
                //统计专题页面过来的注册量
               // $.getJSON("http://act.jcpeixun.com/api/topicLogvisits.aspx?type=register&tid=" + $("#tid").val() + "&paraurl=" + $("#paraurl").val() + "&callback=?"); //接口url
                    alert('注册成功');                      
                
                    $("#btns2").hide();
                    setTimeout(function () {
                        window.location.href= 'http://'+document.domain+"/activation?callback=/login?tab=1";
                        // $(".wk__own__dialog").show();
                    }, 2000);

           
            } else if (d.code == "0") {
                alert("验证码输入错误");
                $("#btns").show(); $("#btns2").hide();
            } else {
                alert(d.msg);
                $("#btns").show(); $("#btns2").hide();
            }
        });
        
//      getMobileArea(function(prov){
//          if((prov == "上海" || prov == "北京" || prov == "山东" || prov == "河南" || prov == "湖北" || prov == "江苏") && callback == 'http://www.jcpeixun.com/'){
//              $("#province").html(prov);
//              $(".wk__own__dialog").fadeIn();
//              $(".wk__own__dialog .dialog_content").fadeIn();
//          }else{
//              $(".wk__own__dialog").hide();
//          }
//      });
    });
        

    //新用户报名
//  $(".apply").click(function(){
//      var type = "683613";
//      getMobileArea(function(prov){
//          var apply_remark = "地区："+prov+"";
//          $.getJSON("http://api.data.jcpeixun.com/activity/addApply.aspx?func=addProject&", { "projectname": type, "truename": $("#utrueName").val(), "mobile": $("#umobile").val(), "remark": apply_remark }).done(function (res) {
//              if (res.errcode == "0" && res.data > 0) {//报名成功
//                  $(".wk__own__dialog").fadeIn();
//                  $(".wk__own__dialog .dialog_contents").fadeIn();
//                  $(".wk__own__dialog .dialog_content").hide();
//                  return true;
//              }
//          });
//      });
//  });
    
    //通过登录账号获取UID
    function isLogin() {
        $.getJSON("https://apidata.jcpeixun.com/user/loginstate_cross_domain?jsoncallback=?", function (res) {
            if (res.login == "1") {
                uid = res.learnerId;
            }
        });
    }

    //提交学习兴趣
    $(".change_btn").click(function () {
        var callback = $("#callback").val();
        $.post("https://apidata.jcpeixun.com/user/user_detailinfo.aspx?func=save", { uid: uid, courseOfInterest: $(".stitchingCourse").text() }).done(function (res) {
            res = JSON.parse(res);
            if (res.errcode == "0") {
                toastfun("您的学习兴趣提交成功!");
                $(".wk__own__dialog").hide();
                location.href = callback;
            } else {
                toastfun(res.errmsg);
            }
        });
    });
    
    
    
});