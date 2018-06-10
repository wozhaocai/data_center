//去除字符串两边的空格
String.prototype.trim = function () {
    return this.replace(/(^\s+)|(\s+$)/g, "");
}
//检测字符串是否为空
String.prototype.isEmpty = function () {
    return !(/.?[^\s　]+/.test(this));
}
//检测值是否介于某两个指定的值之间
String.prototype.isBetween = function (val, min, max) {
    return isNaN(val) == false && val >= min && val <= max;
}
//获取最大值或最小值
String.prototype.getBetweenVal = function (what) {
    var val = this.split(',');
    var min = val[0];
    var max = val[1] == null ? val[0] : val[1];
    if (parseInt(min) > parseInt(max)) {
        min = max;
        max = val[0];
    }
    return what == 'min' ? (isNaN(min) ? null : min) : (isNaN(max) ? null : max);
}
var validator = function (formObj) {
    this.allTags = formObj.getElementsByTagName('*');
    //字符串验证正则表达式
    this.reg = new Object();
    this.reg.english = /^[a-zA-Z0-9_\-]+$/;
    this.reg.english1 = /^[a-z\.A-Z0-9_\-]+$/;
    this.reg.chinese = /^[\u0391-\uFFE5]+$/;
    this.reg.chinese_english = /^[a-zA-z0-9_\-\u0391-\uFFE5]+$/;
    this.reg.number = /^[-\+]?\d+(\.\d+)?$/;
    this.reg.integer = /^[-\+]?\d+$/;
    this.reg.float = /^[-\+]?\d+(\.\d+)?$/;
    this.reg.date = /^(\d{4})(-|\/)(\d{1,2})\2(\d{1,2})$/;
    this.reg.email = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    this.reg.url = /^(((ht|f)tp(s?))\:\/\/)[a-zA-Z0-9]+\.[a-zA-Z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
    this.reg.phone = /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/;
    this.reg.mobile = /^((\(\d{2,3}\))|(\d{3}\-))?((13\d{9})|(159\d{8}))$/;
    this.reg.ip = /^(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5]).(0|[1-9]\d?|[0-1]\d{2}|2[0-4]\d|25[0-5])$/;
    this.reg.zipcode = /^[1-9]\d{5}$/;
    this.reg.qq = /^[1-9]\d{4,10}$/;
    this.reg.msn = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    this.reg.idcard = /(^\d{15}$)|(^\d{17}[0-9Xx]$)/;
    //错误输出信息
    this.tip = new Object();
    this.tip.unknow = '未找到的验证类型，无法执行验证。';
    this.tip.paramError = '参数设置错误，无法执行验证。';
    this.tip.required = '不允许为空。';
    this.tip.chinese_english = '仅允许中英文字符及下划线 (a-zA-Z0-9_)。';
    this.tip.english = '仅允许英文字符及下划线 (a-zA-Z0-9_)。';
    this.tip.english1 = '仅允许英文字符及下划线 (a-zA-Z0-9_.)。';
    this.tip.chinese = '仅允许中文字符。';
    this.tip.number = '不是一个有效的数字。';
    this.tip.integer = '不是一个有效的整数。';
    this.tip.float = '不是一个有效的浮点数。';
    this.tip.date = '不是一个有效的日期格式。 (例如：2007-06-29)';
    this.tip.email = '不是一个有效的电子邮件格式。';
    this.tip.url = '不是一个有效的超链接格式。';
    this.tip.phone = '不是一个有效的电话号码。';
    this.tip.mobile = '不是一个有效的手机号码。';
    this.tip.ip = '不是一个有效的IP地址。';
    this.tip.zipcode = '不是一个有效的邮政编码。';
    this.tip.qq = '不是一个有效的QQ号码。';
    this.tip.msn = '不是一个有效的MSN帐户。';
    this.tip.idcard = '不是一个有效的身份证号码。';
    //获取控件名称
    this.getControlName = function ()
    {
        return this.element.getAttribute('controlName') == null
               ? '指定控件的值'
               : this.element.getAttribute('controlName');
    }
    //设定焦点
    this.setFocus = function (ele) {
        try {
            ele.focus();
        } catch (e){}
    }
    //设置边框颜色
    this.setBorderColor = function (ele) {
        var borderColor = ele.currentStyle ?
                          ele.currentStyle.borderColor :
                          document.defaultView.getComputedStyle(ele, null)['borderColor'];
        ele.style.borderColor = '#ff9900';
        ele.onkeyup = function () {
            this.style.borderColor = borderColor;
        }
    }
    //输出错误反馈信息
    this.feedback = function (type) {
        try {
            var msg = eval('this.tip.' + type) == undefined ?
                      type :
                      this.getControlName() + eval('this.tip.' + type);
        } catch (e) {
            msg = type;
        }
        this.setBorderColor(this.element);
        alert(msg);
        this.setFocus(this.element);
    };
    //执行字符串验证
    this.validate = function () {
        var v = this.element.value.trim();
        //验证是否允许非空
        var required = this.element.getAttribute('required');
        if (required != null && v.isEmpty()) {
            this.feedback('required');
            return false;
        }
        //验证是否合法格式
        var dataType = this.element.getAttribute('dataType');
        if (!v.isEmpty() && dataType != null &&  dataType.toLowerCase() != 'password') {
            dataType = dataType.toLowerCase();
            try {
                if (!(eval('this.reg.' + dataType)).test(v)) {
                    this.feedback(dataType);
                    return false;
                }
            } catch(e) {
                this.feedback('unknow');
                return false;
            }
        }
        //执行数据验证
        var confirm = this.element.getAttribute('confirm');
        if (confirm != null) {
            try {
                var data = eval('formObj.' + confirm + '.value');
                if (v != data) {
                    alert('两次输入的内容不一致，请重新输入。');
                    this.setBorderColor(this.element);
                    this.setFocus(this.element);
                    return false;
                }
            } catch (e) {
                this.feedback('paramError');
                return false;
            }
        }
        //验证数字大小
        var dataBetween = this.element.getAttribute('dataBetween');
        if (!v.isEmpty() && dataBetween != null) {
            var min = dataBetween.getBetweenVal('min');
            var max = dataBetween.getBetweenVal('max');
            if (min == null || max == null) {
                this.feedback('paramError');
                return false;
            }
            if (!v.isBetween(v.trim(), min, max)) {
                this.feedback(this.getControlName() + '必须是介于 ' + min + '-' + max + ' 之间的数字。');
                return false;
            }
        }
        //验证字符长度
        var dataLength = this.element.getAttribute('dataLength');
        if (!v.isEmpty() && dataLength != null) {
            var min = dataLength.getBetweenVal('min');
            var max = dataLength.getBetweenVal('max');
            if (min == null || max == null) {
                this.feedback('paramError');
                return false;
            }
            if (!v.isBetween(v.trim().length, min, max)) {
                this.feedback(this.getControlName() + '必须是 ' + min + '-' + max + ' 个字符。');
                return false;
            }
        }
        return true;
    };
    //执行初始化操作
    this.init = function () {
        for (var i=0; i<this.allTags.length; i++) {
            if (this.allTags[i].tagName.toUpperCase() == 'INPUT' ||
                this.allTags[i].tagName.toUpperCase() == 'SELECT' ||
                this.allTags[i].tagName.toUpperCase() == 'TEXTAREA')
            {
                this.element = allTags[i];
                if (!this.validate())
                    return false;
            }
        }
    };
    return this.init();
}
