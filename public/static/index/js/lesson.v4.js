/*
    lesson.v4.js
    2014.01.10
*/
$(function () {

    var $lesson_20140110 = $("#lesson_20140110"),
        $lesson_play_20140110 = $("#lesson_play_20131129"),
        $cart_20140110 = $("#cart_20140110"),
        $order_20140110 = $("#order_20140110"),
        $paysuc_20140110 = $("#paysuc_20140110")
    ;


    var courses = {
        lessonCount: function (selector) {
            return selector.length;
        },
        lessonPrice: function (selector) {
            var p = 0, i = 0;
            for (; i < selector.length; i++) {
                p += parseInt($(selector[i]).attr("data-price"));
            };
            return accounting.formatNumber(p, 2, ",");
        },
        optCountPrice: function () {
            var $cbxs = $("[id^='tb_lesson'] tbody input:checked");
            $("#lessonCount").html(courses.lessonCount($cbxs));
            $("#totalPrice").html(courses.lessonPrice($cbxs));
        },
        /*
        判断是否登陆
        true:已登陆, false:未登录
        */
        CheckLogin: function (away) {
            var login = $.cookie("learnerId");
            if (login == null) {
                if (away == "0" || away == "") {
                    window.parent.location.href = "/newlogin.aspx?callback=" + escape(document.URL);
                } else if (away == "1") {
                    $.fancybox.open({
                        href: 'http://www.jcpeixun.com/login/logins.html?callback= ' + escape(document.URL) + '',
                        type: 'iframe',
                        padding: 10,
                        width: '400',
                        height: '440',
                        keys: {
                            close: [27]
                        }
                    });
                };
                return false;
            }
            else {
                return true;
            }
        },
        Checkmobilepass: function () {
            var login = $.cookie("regEntrance");
            var mobile = $.cookie("mobilePass");
            if (login == "1" && mobile == "0") {
                $.Boxen.open(window, {
                    url: "/emailregister/v_mobile.aspx",
                    urlParams: { callback: document.URL, a: "down", jk: "site.down.1" },
                    width: 500, height: 450
                });
                return false;
            }
            else {
                return true;
            }
        },
        /*  下载  */
        _download: function (lessname, _lessonid) {
            if (courses.CheckLogin(1)) {
                $.getJSON("http://www.jcpeixun.com/ashx/loginstate_cross_domain.aspx?jsoncallback=?").done(function (d) {
                    //d = $.parseJSON(d);
                    if (d.grade == "银牌学员" || d.grade == "金牌学员" || d.grade == "白金学员") {
                        $.Boxen.open(window, {
                            url: "http://course.jcpeixun.com/p/down",
                            urlParams: { callback: document.URL, lessonid: _lessonid },
                            width: 500,
                            height: 400,
                            title: lessname
                        });
                    } else {
                        if (courses.Checkmobilepass()) {
                            $.Boxen.open(window, {
                                url: "/windows/down.aspx",
                                urlParams: { callback: document.URL, lessonid: _lessonid },
                                width: 500,
                                height: 400,
                                title: lessname
                            });
                            //return false;
                        }
                    };
                });

            }
        }
    };


    /*   课程详细页   */
    if ($lesson_20140110.length) {
        //


        //点击全选按钮
        $("#sltAll").click(function () {
            $("#sltAll").prop("checked", $(this).prop("checked"));
            $("[id^='tb_chapter'] :checkbox[disabled!='disabled']").prop("checked", $(this).prop("checked"));
            courses.optCountPrice();
        });
        //点击章
        $("[id^='chapter']").click(function () {
            var $this = $(this);
            var $parents = $this.parents("[id^='tb_chapter'] thead");
            $this.parents("[id^='tb_chapter'] thead").siblings("tbody").find(":checkbox[disabled!='disabled']").prop("checked", $this.prop("checked"));

            //$("[id^='tb_chapter'] :checkbox").prop("checked", $(this).prop("checked"));
            courses.optCountPrice();
        });

        //点击节
        $("[id^='section']:checkbox").click(function (event) {
            $(this).parents("thead").next("tbody:first").find("[id^='lesson']:checkbox").prop("checked", $(this).prop("checked"));
            courses.optCountPrice();
        });

        //点击课时
        $("[id^='lesson']:checkbox").click(function (event) {
            var $objs1 = $(this).parents("[id^='tb_lesson'] tbody").find(":checkbox");
            $(this).parents("[id^='tb_lesson'] tbody").siblings("thead").find("[id^='section']:checkbox").prop("checked", $objs1.length == $objs1.filter(":checked").length);
            courses.optCountPrice();
        });

        //点击章下面的checkbox
        var $objs = $("[id^='tb_chapter'] tbody :checkbox");
        $objs.click(function (event) {
            $("#sltAll,[id^='chapter']:checkbox").prop("checked", $objs.length == $objs.filter(":checked").length);
        });

        //加入购物车1
        $("#add_cart-1").click(function (event) {
            //if (courses.CheckLogin(1)) {
            document.getElementById("course_form").action = "http://www.jcpeixun.com/pay/cart.aspx";
            document.getElementById("course_form").submit();
            //}
        });
        //立刻购买
        $("#quick_buy").click(function (event) {
            if (courses.CheckLogin(1)) {
                document.getElementById("course_form").action = "http://www.jcpeixun.com/pay/order_course.aspx";
                document.getElementById("course_form").submit();
            }
        });

        //加入购物车2
        $("#add_cart-2").click(function (event) {
            var $id = $("#chapter_nav li.cur a[id^='c']").attr("id");
            var $id2 = $id.replace("c", "");
            var $objs2 = $("#tb_chapter" + $id2 + " tbody :checkbox");
            //var $objs2 = $("table[id$='"+$id2+"'] tbody :checkbox")
            var $checked = $objs2.filter(":checked");

            if ($checked.length < 0) {
                alert("请至少选择1个课时.");
            } else {
                //                if (courses.CheckLogin(1)) {
                var ifed = false;
                var chk_lessonid = "";
                $objs = $("#tb_lesson_" + $id2 + " :checkbox");
                for (var i = 0; i < $objs.length; i++) {
                    ifed = $($objs[i]).prop("checked");
                    if (ifed == true) {
                        chk_lessonid += $($objs[i]).attr("data-lesson-id") + ",";
                        //break;
                    }
                }
                chk_lessonid = chk_lessonid.substr(0, chk_lessonid.length - 1);
                if (chk_lessonid == "") {
                    alert("请至少选择1个课时!");
                } else {
                    $.post("/ashx/order/cart2.aspx", { action: "add", lessonid: chk_lessonid }, function (msg) {
                        $.Boxen.open(window, {
                            url: "/windows/confirm2.aspx",
                            urlParams: { callback: document.URL, t: escape(msg) },
                            width: 420, height: 260
                        });
                    });

                }
                return false;
                //}
            };
        });

        //单个课时加入购物车
        $("[id^='addcart']").click(function (event) {
            var lessonid = $(this).attr("data-lesson-id");
            //            if (courses.CheckLogin(1)) {
            $.post("/ashx/order/cart2.aspx", { action: "add", lessonid: lessonid }, function (msg) {
                $.Boxen.open(window, {
                    url: "/windows/confirm2.aspx",
                    urlParams: { callback: document.URL, t: escape(msg) },
                    width: 420, height: 260
                });
            });
            // };
        });

        var chapter = $.request.getQueStr2("chapter");
        if (chapter != null) {
            $(".chapter_nav").find("li:eq(" + (parseInt(chapter) - 1) + ")").addClass("cur").siblings("li").removeClass("cur");
        };

        //下载课时
        $("[id^=down]").click(function (event) {
            var $this = $(this),
                $lesson_name = $this.attr("data-lesson-name"),
                $lesson_id = $this.attr("data-lesson-id")
            ;
            courses._download($lesson_name, $lesson_id);
        });

        //发表评论
        function cislogin(away) {
            var login = $.cookie("learnerId");
            if (login == null) {
                if (away == "0" || away == "") {
                    window.parent.location.href = "http://www.jcpeixun.com/newlogin.aspx?callback=" + escape(document.URL);
                } else if (away == "1") {
                    $.fancybox.open({
                        href: 'http://www.jcpeixun.com/login/logins.html?callback= ' + escape(document.URL) + '',
                        type: 'iframe',
                        padding: 10,
                        width: '400',
                        height: '440',
                        keys: {
                            close: [27]
                        }
                    });
                };
                return false;
            }
            else {
                return true;
            }
        }

        //未登陆，弹出登陆框
        function login_dialog() {
            var login = $.cookie("learnerId");
            if (login == null) {

                $.fancybox.open({
                    href: 'http://www.jcpeixun.com/login/logins.html?callback=' + escape(document.URL) + '',
                    type: 'iframe',
                    padding: 10,
                    width: '400',
                    height: '440',
                    keys: {
                        close: [27]
                    }
                });


//                var d = dialog({
//                    title: "登陆",
//                    content: '<iframe id="test-iframe" width="100%" height="99%" frameborder="0" framespacing="0" src="http://www.jcpeixun.com/windows/login_register.aspx?callback=' + escape(document.URL) + '" scrolling="no"></iframe>',
//                    align: 'left',
//                    fixed: false,
//                    zIndex: 87,
//                    padding: 0,
//                    skin: 'min-dialog tips',
//                    width: '280',
//                    height: '350'
//                });
                d.showModal();
                return false;
            }
            else {
                return true;
            }
        }

        //发表评论
        $("#add_comment1").click(function (event) {
            //alert("dfsdfsd");
            var comment_val = $("#input_comment1").val();
            if (comment_val.replace("有什么感想，您也来说说吧！", "").length < 1) {
                $("#comment_tips1").html("<span class=\"cred\">评论不能为空</span>");
                $("#input_comment1").focus();
            } else {
                if (cislogin(1)) {

                    //alert($("#comment_form").serialize());
                    $.post("/ashx/lesson/postcousecomment.aspx", $("#comment_form").serialize()).done(function (d) {
                        //alert(d);
                        //$("#comment_tips1").html("<span class=\"cgreen1\">发表成功</span>");
                        $.Boxen.open(window, {
                            url: "http://my.jcpeixun.com/emailregister/learnerRecommend/user_recommend5.aspx",
                            urlParams: { callback: document.URL, comment: "1" },
                            width: 650, height: 400,
                            title: "评论成功，来邀请一个好友一起学习吧！"
                        });
                    });
                }

            };
        });
        $("#input_comment1").click(function (event) {
            var comment_val = $("#input_comment1").val();
            if (comment_val == "有什么感想，您也来说说吧！") {
                $(this).html("");
            };
        });

        var $lessonIntroDl_height = $("#lessonIntroDl").height();
        if ($lessonIntroDl_height > 500) {
            $("#lessonIntroDl").height(500);
        } else {
            $("#expand,#close").hide();
        };
        /* 课程介绍，展开/收起 */
        $("#expand").click(function (event) {
            $(this).hide();
            $("#close").show();
            $("#lessonIntroDl").css({ "height": "auto" });
        });

        $("#close").click(function (event) {
            $(this).hide();
            $("#expand").show();
            if ($lessonIntroDl_height > 500) {
                $("#lessonIntroDl").css({ "height": "500px" });
            } else {
                $("#lessonIntroDl").css({ "height": "auto" });
            };
        });


        var 
            timer1 = null, timer2 = null,
            flag = false
        ;
        /*   章，移近溢出   */
        $("#chapter_nav").delegate("a", "mouseover", function (event) {
            var $this = $(this),
                $id = $this.attr("id").replace("c", "")
            ;
            if (flag) {
                clearTimeout(timer2);
            } else {
                timer1 = setTimeout(function () {
                    $this.parents("li").addClass('cur').siblings('li').removeClass('cur');
                    $("#tb_chapter_" + $id).show().siblings('table').hide();
                    flag = true;
                }, 100);
            };
            $this.mouseout(function (event) {
                if (flag) {
                    //timer2=setTimeout(function(){
                    flag = false;
                    //},50);
                } else {
                    clearTimeout(timer1);
                }
            });
        });

        /*   章，移近溢出   */
        $("#chapter_nav").delegate("a", "click", function (event) {
            $(this).parents("li").addClass('cur').siblings('li').removeClass('cur');
            $("#tb_chapter_" + $id).show().siblings('table').hide();
            /*
            var $this = $(this),
            $id = $this.attr("id").replace("c","")
            ;
            if (flag) {
            clearTimeout(timer2);
            }else{
            timer1 = setTimeout(function(){
            $this.parents("li").addClass('cur').siblings('li').removeClass('cur');
            $("#tb_chapter_"+$id).show().siblings('table').hide();
            flag = true;
            },0);
            };
            $this.mouseout(function(event) {
            if (flag){
            timer2=setTimeout(function(){
            flag = false;
            },50);
            }else{
            clearTimeout(timer1);
            }
            });
            */
        });


    };


    /*  课程播放页  */
    if ($lesson_play_20140110.length) {
        /*  加入购物车  */

        $("#addCart").click(function () {
            var lessonid = $(this).attr("data-lesson-id");

            //var lessonid = $("#paylesson_id").val(); //$(this).attr("data-lesson-id");
            $.post("/ashx/order/cart2.aspx", { action: "add", lessonid: lessonid }, function (msg) {
                $.Boxen.open(window, {
                    url: "/windows/confirm2.aspx",
                    urlParams: { callback: document.URL, t: escape(msg) },
                    width: 420, height: 260
                });
            });
            //if (courses.CheckLogin(1)) {
            //                document.getElementById("lesson_form").action = "http://www.jcpeixun.com/pay/cart.aspx";
            //                document.getElementById("lesson_form").submit();
            //}
        });
        //下载课时
        $("[id^='down']").click(function (event) {
            if (courses.CheckLogin(1)) {
                var $this = $(this),
                $lesson_name = $this.attr("data-lesson-name"),
                $lesson_id = $this.attr("data-lesson-id")
            ;
                courses._download($lesson_name, $lesson_id);
            }
        });
    }

    /*  购物车页  */
    if ($cart_20140110.length) {
        //
        $("#tb1 input[type='checkbox']").prop("checked", true);
        //
        $("#progress .progress-1").show().siblings("ul[class^='progress']").hide();
        //
        var carts = {
            /*   计算购物车中全部商品的原价和优惠价   */
            optCountPrice: function () {
                var 
                    costprice = 0, vipprice = 0, coupon = 0,

                    $cbx_member = $("[id^='cbx-member']:checked"),
                    $member_costprice = 0,
                    $member_vipprice = 0,

                    $cbx_lesson = $("[id^='cbx-lesson']:checked"),
                    $lesson_costprice = 0,
                    $lesson_vipprice = 0;

                if ($cbx_member.length > 0) {
                    for (var i = 0; i < $cbx_member.length; i++) {
                        $member_costprice = $($cbx_member[i]).attr("data-member-costprice");
                        $member_vipprice = $($cbx_member[i]).attr("data-member-vipprice");

                        costprice += parseInt($member_costprice);
                        vipprice += parseInt($member_vipprice);
                    };
                };
                if ($cbx_lesson.length > 0) {
                    for (var i2 = 0; i2 < $cbx_lesson.length; i2++) {
                        $lesson_costprice = $($cbx_lesson[i2]).attr("data-lesson-costprice");
                        $lesson_vipprice = $($cbx_lesson[i2]).attr("data-lesson-vipprice");

                        costprice += parseInt($lesson_costprice);
                        vipprice += parseInt($lesson_vipprice);
                    };
                };

                coupon = parseInt(costprice) - parseInt(vipprice),
                coupon = accounting.formatNumber(coupon, 2, ","),
                costprice = accounting.formatNumber(costprice, 2, ","),
                vipprice = accounting.formatNumber(vipprice, 2, ",");

                $("#cost_price").html("￥" + costprice);
                $("#vip_price").html("￥" + coupon);
                $("#total_price").html("￥" + vipprice);

            },
            /*   计算课程下全部课时的原价和优惠价   */
            optPrice: function () {
                var 
                    $lesson_costprice = 0,
                    $lesson_vipprice = 0,
                    $lesson_number,
                    $lesson_id,

                    $course = $("[data-type='course']"),
                    $lesson,
                    $costprice,
                    $vipprice,
                    $number,
                    $id
                ;
                for (var i = 0; i < $course.length; i++) {
                    var 
                        costprice = 0,
                        vipprice = 0,
                        number = "",
                        id = "",

                        $lesson = $($course[i]).next("tr:first").find("[id^='cbx-lesson']:checked");
                    $lessons = $($course[i]).next("tr:first").find("[data-type='coursecount']");

                    for (var i2 = 0; i2 < $lesson.length; i2++) {
                        $lesson_costprice = $($lesson[i2]).attr("data-lesson-costprice");
                        $lesson_vipprice = $($lesson[i2]).attr("data-lesson-vipprice");
                        $lesson_number = $($lesson[i2]).attr("data-number");
                        $lesson_id = $($lesson[i2]).attr("data-lesson-id");


                        costprice += parseInt($lesson_costprice);
                        vipprice += parseInt($lesson_vipprice);
                        number += "<b class=\"cgray9\">" + $lesson_number + "</b>、";
                        id += $lesson_id + ",";
                    };
                    //alert($lessons.find("[id^='iptcoursecount']").val());
                    //alert($lessons.find('input').attr('youhuiprice'));
                    $iptcoursecout = $lessons.find('input');
                    if (parseInt($iptcoursecout.attr('youhuiprice')) > 0 && $iptcoursecout.attr('allcoursecount') == $iptcoursecout.val()) {
                        vipprice = parseInt($iptcoursecout.attr('youhuiprice'));
                    }
                    //for (var i3 = 0; i3 < $lessons.length; i3++) {
                    //alert($lessons[i].find("[id^='iptcoursecount']"));
                    //                        $courseprice = $($lessons[i].find("[id^='iptcoursecount']"));
                    //                        /*课程有优惠价时显示优惠价*/
                    //                        alert(parseInt($courseprice.attr('youhuiprice')) + "|" + $courseprice.attr('allcoursecount') + "|" + $courseprice.attr('currentcount'));
                    //                        if (parseInt($courseprice.attr('youhuiprice')) > 0 && $courseprice.attr('allcoursecount') == $courseprice.attr('currentcount')) {
                    //                            vipprice = parseInt($courseprice.attr('youhuiprice'));
                    //                        }
                    //}
                    var 
                        costprice = "￥" + accounting.formatNumber(costprice, 2, ","),
                        vipprice = "￥" + accounting.formatNumber(vipprice, 2, ","),
                        number = "课时：" + number.substr(0, number.length - 1),
                        id = id.substring(0, id.length - 1),

                        $costprice = $($course[i]).find("[id^='course-costprice']"),
                        $vipprice = $($course[i]).find("[id^='course-vipprice']"),
                        $number = $($course[i]).find("[id^='lesson-numbers']"),
                        $id = $("#paylesson_id")
                    ;

                    $costprice.html(costprice);
                    $vipprice.html(vipprice);
                    $number.html(number);

                    $id.val(id);

                };
            },
            /*   追加商品ID   */
            optPrice2: function () {
                var 
                    $lesson_costprice = 0,
                    $lesson_vipprice = 0,
                    $lesson_number,
                    $lesson_id,

                    $course = $("[data-type='product']"),
                    $lesson,
                    $costprice,
                    $vipprice,
                    $number,
                    $id
                ;
                for (var i = 0; i < $course.length; i++) {
                    var 
                        costprice = 0,
                        vipprice = 0,
                        number = "",
                        id = "",

                        $lesson = $($course[i]).find("[id^='cbx-lesson']:checked");

                    for (var i2 = 0; i2 < $lesson.length; i2++) {
                        //                        $lesson_costprice = $($lesson[i2]).attr("data-lesson-costprice");
                        //                        $lesson_vipprice = $($lesson[i2]).attr("data-lesson-vipprice");
                        //                        $lesson_number = $($lesson[i2]).attr("data-number");
                        $lesson_id = $($lesson[i2]).attr("data-product-id");

                        //                        costprice += parseInt($lesson_costprice);
                        //                        vipprice += parseInt($lesson_vipprice);
                        //                        number += "<b class=\"cgray9\">" + $lesson_number + "</b>、";
                        id += $lesson_id + ",";
                    };
                    var 
                    //                        costprice = "￥" + accounting.formatNumber(costprice, 2, ","),
                    //                        vipprice = "￥" + accounting.formatNumber(vipprice, 2, ","),
                    //                        number = "课时：" + number.substr(0, number.length - 1),
                        id = id.substring(0, id.length - 1),

                    //                        $costprice = $($course[i]).find("[id^='course-costprice']"),
                    //                        $vipprice = $($course[i]).find("[id^='course-vipprice']"),
                    //                        $number = $($course[i]).find("[id^='lesson-numbers']"),

                        $id = $("#payproduct_id")
                    ;

                    //                    $costprice.html(costprice);
                    //                    $vipprice.html(vipprice);
                    //                    $number.html(number);

                    $id.val(id);

                };
            },
            /*   判断购物车中课程下课时的数量   */
            optLessonCount: function (selector) {
                var 
                    $course = selector.parents("[data-type='lessons']").prev("[data-type='course']"),
                    $cbx_lesson = $course.next("tr:first").find("[id^='cbx-lesson']:checkbox")
                ;
                //
                if ($cbx_lesson.length <= 1) {
                    $course.hide(500);
                    $.doTimeout(500, function () {
                        $course.remove();
                    });
                };
            },
            /*   判断购物车中是否有商品   */
            optIfGood: function () {
                var 
                    $member = $("[data-type='member']"),
                    $course = $("[data-type='course']"),
                    $product = $("[data-type='product']")
                ;
                if (!$member.length && !$course.length && !$product.length) {
                    carts.clearCart();
                };
            },
            /*   清空购物车   */
            clearCart: function () {
                var 
                    $c1 = $("#c1"), $c2 = $("#c2"), $c3 = $("#c3")
                ;
                $c1.hide(500);
                $.doTimeout(500, function () {
                    $c1.remove();
                });

                if (jc.isLogined()) {
                    $c3.show(500);
                } else {
                    $c2.show(500);
                }
            },
            /*   删除选中的商品   */
            delCheckedGood: function () {
                var 
                    $cbx_member = $("[id^='cbx-member']:checked"),
                    $cbx_lesson = $("[id^='cbx-lesson']:checked"),
                    $member = $cbx_member.parents("[data-type='member']"),
                    $lesson = $cbx_lesson.parents("[data-type='lesson']")
                ;
                if ($cbx_member.length) {
                    $member.hide(500);
                    $.doTimeout(500, function () {
                        $member.remove();
                    });
                };
                if ($cbx_lesson.length) {
                    $lesson.hide(500);
                    $.doTimeout(200, function () {
                        $lesson.remove();
                    });

                };
            }

        };

        //如果购物车为空
        var $cart_state = $("#cart-state").val();
        if ($cart_state == "0") {
            carts.clearCart();
        };
        carts.optPrice();

        /*  展开课时 */
        $("[id^='expand']").click(function () {
            $(this)
                .hide()
                .next("[id^='close']").show()
                .parents("tr").next("tr:first").find("table:first").fadeIn(100)
            ;
        });
        /*  收起课时 */
        $("[id^='close']").click(function () {
            $(this)
                .hide()
                .prev("[id^='expand']").show()
                .parents("tr").next("tr:first").find("table:first").fadeOut(100)
            ;
        });

        /*   点击全选   */
        $("#tb1").delegate("#all", "click", function (event) {
            var $all_checked = $(this).prop("checked"),
                $checkbox = $("#tb1 tbody :checkbox").prop("checked", $all_checked);
            carts.optCountPrice();
            carts.optPrice();
        });

        /*   全选/反选（金银牌服务）   */
        var $obj_member = $("#tb1 tbody tr[data-type='member'] :checkbox");
        $obj_member.click(function (event) {
            $("#tb1 #all").prop("checked", $obj_member.length == $obj_member.filter(":checked").length);
            carts.optCountPrice();
            carts.optPrice();
        });

        /*   全选/反选（课程）   */
        var $obj_course = $("#tb1 tbody tr[data-type='course'] :checkbox");
        $obj_course.click(function (event) {
            $("#tb1 #all").prop("checked", $obj_course.length == $obj_course.filter(":checked").length);
            //
            var $this_checked = $(this).prop("checked");
            $(this).parents("tr").next("tr:first").find("table:first input[type='checkbox']").prop("checked", $this_checked);
            //
            carts.optCountPrice();
            carts.optPrice();
        });

        /*   全选/反选（课时）   */
        var $obj_lesson = $("#tb1 tbody tr[data-type='course']").next("tr").find("table:first :checkbox");
        $obj_lesson.click(function (event) {
            //
            $("#tb1 #all").prop("checked", $obj_lesson.length == $obj_lesson.filter(":checked").length);
            //
            var $first_course = $(this).parents("tr").prev("tr[data-type='course']:first");
            //
            $first_course.find(":checkbox").prop("checked", $(this).parents(".table1-2").find(":checked").length > 0);
            //
            //优惠课程价格
            //alert($(this).prop("checked"));
            var $first_coursecount = $(this).parents("tr").find("tr[data-type='coursecount']");
            if ($(this).prop("checked")) {
                $first_coursecount.find('input').val(parseInt($first_coursecount.find('input').val()) + 1);
            }
            else {
                $first_coursecount.find('input').val(parseInt($first_coursecount.find('input').val()) - 1);
            }
            //alert($first_coursecount.find('input').val());
            //var $first_coursecount = $(this).parents("tr").find("tr[data-type='coursecount']");
            //alert($first_coursecount.find('input').attr('currentcount'));

            carts.optCountPrice();
            carts.optPrice();
        });
        /* 全选/反选（商品）*/
        var $obj_product = $("#tb1 tbody tr[data-type='product'] ").find("td:first :checkbox");
        $obj_product.click(function (event) {
            $("#tb1 #all").prop("checked", $obj_product.length == $obj_product.filter(":checked").length);
            //
            var $first_course = $(this).parents("tr").prev("tr[data-type='product']:first");
            //
            $first_course.find(":checkbox").prop("checked", $(this).parents(".table1-2").find(":checked").length > 0);
            //
            carts.optCountPrice();
            carts.optPrice();
            carts.optPrice2();
        });

        /*   点击删除会员   */
        $("[id^='del-member']").click(function (event) {
            if (confirm("确定删除吗？")) {
                var 
                    $member = $(this).parents("tr[data-type='member']")
                ;
                $member.hide(500);
                $.doTimeout(500, function () {
                    $member.remove();
                    carts.optIfGood();
                    carts.optCountPrice();
                    carts.optPrice();
                });
            };
        });

        /*   点击删除课程   */
        $("[id^='del-course']").click(function (event) {
            if (confirm("确定删除吗？")) {
                var 
                    $this = $(this),
                    $course = $(this).parents("tr[data-type='course']")
                ;
                $.post("active.aspx",
                {
                    "id": $this.attr("id").replace("del-course-", ""), "action": "deletecourse"
                }, function (data) {
                    alert(data);
                    window.location.replace("/pay/cart.aspx");
                });
                //                $course.hide(500);
                //                $course.next("tr:first").hide(500);
                //                $.doTimeout(500, function(){
                //                    $course.next("tr:first").remove();
                //                    $course.remove();
                //                    carts.optIfGood();
                //                    carts.optCountPrice();
                //                    carts.optPrice();
                //                });
            };
        });

        /*   点击删除课时   */
        $("[id^='del-lesson']").click(function (event) {
            var 
                $this = $(this),
                $lesson = $this.parent().parent()
            ;
            if (confirm("确定删除吗？")) {
                //
                $.post("active.aspx",
                {
                    "id": $this.attr("id").replace("del-lesson-", ""), "action": "deletelesson"
                }, function (data) {
                    alert(data);
                    window.location.replace("/pay/cart.aspx");
                });
                //
                //                $lesson.hide(500);
                //                $.doTimeout(500, function(){
                //                    carts.optLessonCount($this);
                //                    carts.optIfGood();
                //                    $lesson.remove();
                //                    carts.optCountPrice();
                //                    carts.optPrice();
                //                });
            };
        });

        /*   清空购物车   */
        $("#empty_cart").click(function (event) {
            if (confirm("确定清空购物车吗？")) {
                $.post("active.aspx",
                {
                    "id": $(this).attr("for"), "action": "deleteAll"
                }, function (data) {
                    alert(data);
                    window.location.replace("/pay/cart.aspx");
                });

                //carts.clearCart();
            };
        });


        /*   删除选中的商品    
        $("#del_checked_good").click(function(event) {
        if (confirm("确定删除选中的商品吗？")) {
        carts.delCheckedGood();
        };
        });
        */

        /*   去结算   */
        function cislogin(away) 
        {
            var login = $.cookie("learnerId");
            if (login == null) {
                if (away == "0" || away == "") {
                    window.parent.location.href = "http://www.jcpeixun.com/newlogin.aspx?callback=" + escape(document.URL);
                } else if (away == "1") {

                    $.fancybox.open({
                        href: 'http://www.jcpeixun.com/login/logins.html?callback= '+ escape(document.URL)+'',
                        type: 'iframe',
                        padding: 10,
                        width: '400',
                        height: '440',
                        keys: {
                            close: [27]
                        }
                    });
                };
                return false;
            }
            else {
                return true;
            }
        }
        $("#btn_goto_order").click(function (event) {

            var login = $.cookie("learnerId");
            if (login == null) {
                $.fancybox.open({
                    href: 'http://www.jcpeixun.com/login/logins.html?callback=' + escape(document.URL) + '',
                    type: 'iframe',
                    padding: 10,
                    width: '400',
                    height: '440',
                    keys: {
                        close: [27]
                    }
                });

                d.showModal();
                return false;
            }
            else {
                var $checked_length = $("#tb1 tbody input:checked").length;
                if ($checked_length > 0) {
                    ///window.location.href = "order.html";
                    document.getElementById("cart_form").action = "order.aspx";
                    document.getElementById("cart_form").submit();
                } else {
                    alert("请至少选择一件商品");
                };
            }

          
        });
        //
    }

    /*  订单页  */
    if ($order_20140110.length) {
        $("#progress .progress-2").show().siblings("ul[class^='progress']").hide();

        /* 支付宝支付 */
        $("#zhifubao").click(function () {
            if ($("#ordertype").val() == "1") {
                $("#paytype").val("4");
            } else {
                // $("#paytype").val("1");
                $("#paytype").val("4");
            }
            document.getElementById("form1").action = "createOrder.aspx";
            document.getElementById("form1").submit();

            $.Boxen.open(window, { url: "http://www.jcpeixun.com/pay/payTips1.html", urlParams: { "a": new Date().getMilliseconds(), "ordernumber": $("#ordernumber").val() }, width: 335, height: 210, title: "在线支付提示" });

        });

        //网银支付
        $("#wangyin").click(function () {
            $("#paytype").val('2');
            $.Boxen.open(window, { url: "http://www.jcpeixun.com/pay/wangyin.html",
                urlParams: { "order_id": $("#iptorderid").val(), "itpcredittemp1": $("#itpcredittemp1").val(), "card_id": $("#card_id").val(), "paytype": $("#paytype").val(), "ordertype": $("#ordertype").val(), "ordernumber": $("#ordernumber").val(), "lesson_idlist": $("#lesson_idlist").val(), "product_idlist": $("#product_idlist").val() }, width: 760, height: 380, title: "网银支付"
            });
        });

    }

    /*  支付成功页  */
    if ($paysuc_20140110.length) {
        $("#progress .progress-3").show().siblings("ul[class^='progress']").hide();
    }


});
