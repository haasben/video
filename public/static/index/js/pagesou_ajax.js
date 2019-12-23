
var purlName; //全局变量，分页参数名称

//创建带有页码的地址
function cUrl(argName, page) {
    var url = location.protocol + '//' + location.host + location.pathname;
    var args = location.search;
    var reg = new RegExp('([\?&]?)' + argName + '=[^&]*[&$]?', 'gi');
    args = args.replace(reg, '$1');
    if (args == '' || args == null) {
        args += '?' + argName + '=' + page;
    } else if (args.substr(args.length - 1, 1) == '?' || args.substr(args.length - 1, 1) == '&') {
        args += argName + '=' + page;
    } else {
        args += '&' + argName + '=' + page;
    }
    return url + args;
}
//返回地址栏参数的值
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}
//分页控件
var open_pager = function (container) {
    var sd_pager = this;
    this.firstText = "1...";
    this.prevText = "&lt上一页";
    this.nextText = "下一页&gt";
    this.lastText = "尾页";
    //this.totalText = "共{0}条记录 ";
    this.totalText = "";
    this.showPageButtons = 3;
    this.showFirst = true;
    this.showLast = true;
    this.currentCss = "current";
    this.linkCss = "page";
    this.pagemoreCss = "pmore";
    this.prevnextCss = "turn";
    this.totalTextCss = "cutPage-statistics";
    this.totalRows = 0;
    this.argName = "page"; //分页参数
    purlName = this.argName;
    this.pageSize = 10;
    this.currentPage = 1;
    this.showPrevNext = true;
    this.showNumButtons = true;
    this.showTotalTip = true; //是否显示左边全部页数提示。
    this.showGoNum = false; //显示页码跳转
    this.pageToFuncName = ""; //页面跳转函数-只针对ajax用
    this.allowClone = false; //是否允许克隆一个相同的分页
    this.cloneName = "";
    this.pageFuncName = "";
    this.callBack = null;
    // this.wrapper = container;
    this.wrapper = document.getElementById(container);
    container = document.getElementById(container);
    this.pageClick = function (pg) { };
    this.createUrl = function (page) { //生成带分页参数的url(参数-当前页)
        var url = location.protocol + '//' + location.host + location.pathname;
        var args = location.search;
        var reg = new RegExp('([\?&]?)' + this.argName + '=[^&]*[&$]?', 'gi');
        args = args.replace(reg, '$1');
        if (args == '' || args == null) {
            args += '?' + this.argName + '=' + page;
        } else if (args.substr(args.length - 1, 1) == '?' || args.substr(args.length - 1, 1) == '&') {
            args += this.argName + '=' + page;
        } else {
            args += '&' + this.argName + '=' + page;
        }
        return url + args;
    };
    this.addButton = function (txt, css, pg) {
        var _pgbtn = document.createElement("a");
        //_pgbtn.href = 'javascript:;';//注：属性改为该值，IE6不支持
        //_pgbtn.href = '#';
        if (sd_pager.currentPage != pg) {
            _pgbtn.href = "javascript:" + sd_pager.pageFuncName + "(" + pg + ")";
        }
        else {
            _pgbtn.href = "javascript:;";
        }

        _pgbtn.className = css;
        _pgbtn.innerHTML = txt;
        _pgbtn.setAttribute("page", pg);
        container.appendChild(_pgbtn);
    }
    this.addTextButton = function (txt, css) {
        var _pgbtn = document.createElement("a"); _pgbtn.className = css; _pgbtn.innerHTML = txt; container.appendChild(_pgbtn);
    }
    this.addCurrentPage = function (txt) {
        var _pgbtn = document.createElement("b"); _pgbtn.innerHTML = txt; container.appendChild(_pgbtn);
    }
    this.addTotalText = function (txt, css) {
        var _spnTotal = document.createElement("span"); _spnTotal.className = css; _spnTotal.innerHTML = txt; container.appendChild(_spnTotal);
    }
    this.addGoto = function (txt, css) {
        var _spanGoto = document.createElement("span"); _spanGoto.className = css; _spanGoto.innerHTML = txt;
        container.appendChild(_spanGoto);
    }
    //输出分页HTML
    this.output = function () {
        //如果传入的当前页不是数字，默认设为1
        var reg = /\d/;
        if (!reg.test(sd_pager.currentPage)) {
            sd_pager.currentPage = 1;
        }
        //若要局部刷新分页请注释下面1行
        //this.currentPage = GetQueryString("page") == null ? 1 : parseInt(GetQueryString("page")); //从地址栏获取参数设置当前页
        container.innerHTML = '';
        if (this.totalRows > 0) {
            if (this.showTotalTip) {
                this.addTotalText(this.totalText.replace("{0}", this.totalRows), this.totalTextCss);
            }
            var _ttps = parseInt(this.totalRows / this.pageSize); //总页数
            if (this.totalRows % this.pageSize > 0) { _ttps++; } //如果总条数不是每页显示条数的整数倍，总页数+1
            if (_ttps == 1)//如果只有1页，不输出页码
                return;
            var _start = parseInt(this.currentPage) - parseInt(this.showPageButtons) + 1; //开始页
            //var _start = parseInt(this.currentPage) -2; //开始页

            if (_start <= 0) { _start = 1; }
            //var _end = parseInt(this.currentPage) + parseInt(this.showPageButtons) - 2; //结束页
            var _end = parseInt(this.currentPage) + parseInt(this.showPageButtons) - 0; //结束页

            if (this.currentPage == 1)
                _end = parseInt(this.currentPage) + parseInt(this.showPageButtons); //结束页
            if (_end > _ttps) { _end = _ttps; }

            var _pgbtn = null;

            //如果当前页大于1，显示上一页按钮
            //            if (this.showPrevNext && this.currentPage > 1) {
            //                if (this.currentPage - 1 <= 0) { this.addButton(this.prevText, this.linkCss, 1); }
            //                else { this.addButton(this.prevText, this.linkCss, this.currentPage - 1); }
            //            }
            if (this.showPrevNext) {
                if (this.currentPage - 1 <= 0) { this.addButton(this.prevText, this.linkCss, 1); }
                else { this.addButton(this.prevText, this.linkCss, this.currentPage - 1); }
            }

            if (_start >= 2 && this.showFirst) {
                //显示首页
                this.addButton(this.firstText, this.linkCss, 1);
            }

            //显示数字页码按钮
            if (this.showNumButtons) {
                // if (_start > 2 || (_start == 2 && !this.showFirst)) { this.addTextButton('...', this.linkCss); }
                for (var i = _start; i <= _end; i++) {
                    if (i == this.currentPage) { this.addCurrentPage(i); }
                    else { this.addButton(i, this.linkCss, i); }
                }
                if (_end < _ttps) { this.addTextButton('...', this.pagemoreCss); }
            }
            //显示尾页按钮
            if (this.showLast && _end < _ttps)
            //this.addButton(this.lastText, this.linkCss, _ttps);
                this.addButton(_ttps, this.linkCss, _ttps);

            //如果当前页小于总页数，显示下一页按钮
            //            if (this.showPrevNext && this.currentPage < _ttps) {
            //                if (this.currentPage + 1 > _ttps) { this.addButton(this.nextText, this.linkCss, _ttps); }
            //                else { this.addButton(this.nextText, this.linkCss, this.currentPage + 1); }
            //            }
            if (this.showPrevNext) {
                if (this.currentPage + 1 > _ttps) { this.addButton(this.nextText, this.linkCss, _ttps); }
                else { this.addButton(this.nextText, this.linkCss, this.currentPage + 1); }
            }

            //显示跳转按钮
            if (this.showGoNum && this.showPageButtons < _ttps) {
                this.addGoto("转到<input id='_gotxt' style='width:40px;' class='_gotxt' value='" + sd_pager.currentPage + "'/><input id='pageJump' onclick='" + this.pageToFuncName + "(this)' class='_gobtn' type='button' value='确定'/>", "goto");
            }

            //Clone一个相同的分页
            if (this.allowClone && this.cloneName != "") {
                var cloneVal = container.innerHTML;
                //alert(container);
                document.getElementById(this.cloneName).innerHTML = cloneVal;
            }

        }
    }
};

//-----end 分页控件