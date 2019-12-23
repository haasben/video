$(function () {

    var vUname = /^([a-z0-9_-]){3,40}$/i;
    var vUemail = /^\w+([-+.]\w+)*@\w+([-+.]\w+)*\.\w+([-+.]\w+)*$/;
    var vUmobile = /^1\d{10}$/;
    var vCname = /^[\u0391-\uFFE5]{2,40}$/; ;

    function $trim(arg) {
        return $.trim(arg);
    }

    /* 返回地址栏参数的值 */
    function GetQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    
     /*记住用户名*/
    $("#jizhu").change(function () {
        if ($("#jizhu").attr("checked")) {
            $("#jizhu").val("1");
        } else {
            $("#jizhu").val("0");
        }
    });

     /*记住用户名*/
    if (uname != "") {
        $("#uname").val(uname);
        $("#jizhu").attr("checked", true);
    }
    
    /* 记住用户名
    $("#re_uname").change(function () {
    $("#re_uname").val($("#re_uname").prop("checked")?"1":"0");
    }); */
    /* 自动登录 */
    $("#auto_login").change(function () {
        $("#auto_login").val($("#auto_login").prop("checked") ? "1" : "0");
    });

    
     $("#uname,#upwd").focus(function () {
        var sEmail = $("#uname").val()
        if ($trim(sEmail) == "用户名/邮箱/手机号") {
            $("#uname").val("");
        }
        $(this).attr("class", "txt_blue2-260-30");
        if ($(this).attr("id") == "uname") {
            $("#e_tips").attr("class", "").html("");
        } else if ($(this).attr("id") == "upwd") {
            $("#p_tips").attr("class", "").html("");
        }
    }).blur(function () {
        $(this).attr("class", "txt_gray3-260-30");
    });

    //登陆成功，设置延时跳转[等待论坛登陆时间]
    function setLoginSucceedTips() {
        var num = 3;
        $("#btns2").html("正在登录，请稍候...<b>" + num + "</b>").show();
        var time = setInterval(function () {
            num--;
            if (num <= 1) {
                clearInterval(time);
            }
            $("#btns2 b").text(num);
        }, 1000);
    }

    function LoginValidate(){
        var sUname = $trim($("#uname").val());
        var sUpwd = $trim($("#upwd").val());
        var token = $("#token").val();
        var callback = escape($("input[name='callback']").val());
        //var callback = escape($("#callback").val());
        //if (!(vUname.test(sUname) || vUemail.test(sUname) || vUmobile.test(sUname) || vCname.test(sUname))) {
        if (!sUname) {
            $("#uname").attr("class", "txt_red2-260-30");
            $("#n_tips").attr("class", "cred").html("邮箱/手机号");
        } else if (sUpwd.length < 6 || sUpwd.length > 20) {
            $("#upwd").attr("class", "txt_red2-260-30");
            $("#p_tips").attr("class", "cred").html("请输入正确的密码");
        } else {
            $.post('/login', $("#loginForm").serialize()).done(function (d) {
                if (d.code == "0") {//如果帐号不存在,提示
                    $("#p_tips").attr("class", "cred").html("您输入的账号不存在，请核对后重新输入");
                    $("input[name='__token__']").val(d.token);

                }else if (d.code == "2") {//如果密码不正确，提示
                    $("#p_tips").attr("class", "cred").html("您输入的账号和密码不匹配，请重新输入");
                    $("input[name='__token__']").val(d.token);
                }else if (d.code == "1") {//如果输入正确
                    $("#p_tips").text("登陆中...,若长时间无反应请切换浏览器急速模式");
                    //ajaxJsonp($("#loginForm").attr("action") + "?uname=" + (sUname) + "&upwd=" + escape(sUpwd) + "&token=" + token + "&callback=" + callback, function (data) {
                        $("#p_tips").text("登陆成功");
                         setTimeout(function () {
                            location.href=d.url;
                            // $(".wk__own__dialog").show();
                        }, 1000);

                        // if (data.error == "0") {
                        //     autologinBBS();
                        //     setLoginSucceedTips();
                        // } else {
                        //     $("#p_tips").text("返回验证失败");
                        //     $("#p_tips").attr("class", "cred").html(data.msg);
                        // }
                    // });
                }else if(d.code == "4"){
                     $("#p_tips").text("账号未激活");
                         setTimeout(function () {
                            $("input[name='__token__']").val(d.token);
                            location.href=d.url;
                            // $(".wk__own__dialog").show();
                        }, 1000);

                }else {
                    $("#p_tips").attr("class", "cred").html("操作无效，稍后再试");
                    $("input[name='__token__']").val(d.token);
                }
            });
        }
    }

    $("#loginForm").delegate("#login", "click", LoginValidate);

    $("#uname,#upwd").keydown(function (event) {
        if (event.which == 13) {
            LoginValidate();
        }
    });

});