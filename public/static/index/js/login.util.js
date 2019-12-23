
function ajaxJsonp(url, success) {
   $.ajax({
        type: "get",
        async: false,
        url: url,
        dataType: "jsonp",
        timeout: 10000,
        jsonp: "jsoncallback",
        jsonpCallback: "jsonp",
        success: function (json) {
            success(json)
        },
        error: function () {
        }
    });
    /* 
    $.getJSON(url, function (data) {
    success(data);
    })
    */
}

//自动登录论坛
function autologinBBS() {
    ajaxJsonp("/ajax/loginstate_cross_domain?action=", function (data) {
        if (data.login == "1") {
            var html = '<div id="ajax_frm_loginform"><form name="ajax_loginform" id="ajax_loginform" method="post" autocomplete="off" target="_self" style="display:none" action="https://bbs.jcpeixun.com/member.php?mod=logging&action=login&loginsubmit=yes&infloat=yes&lssubmit=yes">'
            html += '<input type="hidden" name="fastloginfield" value="username" />'
            html += '<input type="hidden" name="username" id="ls_username" value="' + data.name + '" />'
            html += '<input type="hidden" name="cookietime" id="ls_cookietime" />'
            html += '<input type="hidden" name="password" id="ls_password" value="jc@318a" />'
            html += '<div style="text-align:center;font-size:12px;font-family:\'微软雅黑\';">正在登录，请稍后……</div>'
            html += '<input type="hidden" name="quickforward" value="yes" />'
            html += '<input type="hidden" name="handlekey" value="ls" />'
            html += '<iframe width="400" height="100" frameborder="0" id="hidden_frm" name="hidden_frm" ></iframe>'
            html += '</form>'
            html += '<script type="text/javascript">'
            html += '    (function () { document.getElementById("ajax_loginform").submit();})()'
            html += '<\/script><div>'
            $(html).appendTo("body");
            setTimeout(function () { $("#ajax_frm_loginform").remove() }, 1500);
        }
    })
}
     