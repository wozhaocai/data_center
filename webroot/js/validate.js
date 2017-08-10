//1 表单项不能为空

function CheckForm()
{
    if (document.form.name.value.length == 0) {
        alert("请输入您姓名!");
        document.form.name.focus();
        return false;
    }
    return true;
}


//2 比较两个表单项的值是否相同

function CheckForm() {
    if (document.form.PWD.value != document.form.PWD_Again.value) {
        alert("您两次输入的密码不一样！请重新输入.");
        document.ADDUser.PWD.focus();
        return false;
    }
    return true;
}

//3 表单项只能为数字和"_",用于电话/银行帐号验证上,可扩展到域名注册等

function isNumber(String)
{
    var Letters = "1234567890-"; //可以自己增加可输入值
    var i;
    var c;
    if (String.charAt(0) == '-')
        return false;
    if (String.charAt(String.length - 1) == '-')
        return false;
    for (i = 0; i < String.length; i++)
    {
        c = String.charAt(i);
        if (Letters.indexOf(c) < 0)
            return false;
    }
    return true;
}
function CheckForm()
{
    if (!isNumber(document.form.TEL.value)) {
        alert("您的电话号码不合法！");
        document.form.TEL.focus();
        return false;
    }
    return true;
}



//4 表单项输入数值/长度限定

function CheckForm()
{
    if (document.form.count.value > 100 || document.form.count.value < 1)
    {
        alert("输入数值不能小于零大于100!");
        document.form.count.focus();
        return false;
    }
    if (document.form.MESSAGE.value.length < 10)
    {
        alert("输入文字小于10!");
        document.form.MESSAGE.focus();
        return false;
    }
    return true;
}

//5 中文/英文/数字/邮件地址合法性判断


function isEnglish(name) //英文值检测
{
    if (name.length == 0)
        return false;
    for (i = 0; i < name.length; i++) {
        if (name.charCodeAt(i) > 128)
            return false;
    }
    return true;
}

function isChinese(name) //中文值检测
{
    if (name.length == 0)
        return false;
    for (i = 0; i < name.length; i++) {
        if (name.charCodeAt(i) > 128)
            return true;
    }
    return false;
}

function isMail(name) // E-mail值检测
{
    if (!isEnglish(name))
        return false;
    i = name.indexOf("@");
    j = name.lastIndexOf("@");
    if (i == -1)
        return false;
    if (i != j)
        return false;
    if (i == name.length)
        return false;
    return true;
}

function isNumber(name) //数值检测
{
    if (name.length == 0)
        return false;
    for (i = 0; i < name.length; i++) {
        if (name.charAt(i) < "0" || name.charAt(i) > "9")
            return false;
    }
    return true;
}

function CheckForm()
{
    if (!isMail(form.Email.value)) {
        alert("您的电子邮件不合法！");
        form.Email.focus();
        return false;
    }
    if (!isEnglish(form.name.value)) {
        alert("英文名不合法！");
        form.name.focus();
        return false;
    }
    if (!isChinese(form.cnname.value)) {
        alert("中文名不合法！");
        form.cnname.focus();
        return false;
    }
    if (!isNumber(form.PublicZipCode.value)) {
        alert("邮政编码不合法！");
        form.PublicZipCode.focus();
        return false;
    }
    return true;
}

//6 限定表单项不能输入的字符

function contain(str, charset)// 字符串包含测试函数
{
    var i;
    for (i = 0; i < charset.length; i++)
        if (str.indexOf(charset.charAt(i)) >= 0)
            return true;
    return false;
}

function CheckForm()
{
    if ((contain(document.form.NAME.value, "%\(\)><")) || (contain(document.form.MESSAGE.value, "%\(\)><")))
    {
        alert("输入了非法字符");
        document.form.NAME.focus();
        return false;
    }
    return true;
}


//7、去空隔函数

function Jtrim(str)
{

    var i = 0;
    var len = str.length;
    if (str == "")
        return(str);
    j = len - 1;
    flagbegin = true;
    flagend = true;
    while (flagbegin == true && i < len)
    {
        if (str.charAt(i) == " ")
        {
            i = i + 1;
            flagbegin = true;
        }
        else
        {
            flagbegin = false;
        }
    }

    while (flagend == true && j >= 0)
    {
        if (str.charAt(j) == " ")
        {
            j = j - 1;
            flagend = true;
        }
        else
        {
            flagend = false;
        }
    }

    if (i > j)
        return ("")

    trimstr = str.substring(i, j + 1);
    return trimstr;
}

//8、用正则表达式限制只能输入数字和英文：onkeyup="value=value.replace(/[\W]/g,'') "onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"

//9、用正则表达式限制只能输入数字：onkeyup="value=value.replace(/[^\d]/g,'') "onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"

//10、用正则表达式限制只能输入全角字符： onkeyup="value=value.replace(/[^\uFF00-\uFFFF]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\uFF00-\uFFFF]/g,''))"

//11、用正则表达式限制只能输入中文：onkeyup="value=value.replace(/[^\u4E00-\u9FA5]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\u4E00-\u9FA5]/g,''))"

//12、日期

function strDateTime(str)
{
    var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
    if (r == null)
        return false;
    var d = new Date(r[1], r[3] - 1, r[4]);
    return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4]);
}

//13、长时间，形如 (2003-12-05 13:04:06)

function strDateTime(str)
{
    var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
    var r = str.match(reg);
    if (r == null)
        return false;
    var d = new Date(r[1], r[3] - 1, r[4], r[5], r[6], r[7]);
    return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4] && d.getHours() == r[5] && d.getMinutes() == r[6] && d.getSeconds() == r[7]);
}

//14、判断字符全部由a-Z或者是A-Z的字字母组成

//<input onblur="if(/[^a-zA-Z]/g.test(this.value))alert('有错')">

//15、判断字符由字母和数字，下划线,点号组成.且开头的只能是下划线和字母

///^([a-zA-z_]{1})([\w]*)$/g.test(str)

//16、身份证的验证

function isIdCardNo(num)
{
    if (isNaN(num)) {
        alert("输入的不是数字！");
        return false;
    }
    var len = num.length, re;
    if (len == 15)
        re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{3})$/);
    else if (len == 18)
        re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\d)$/);
    else {
        alert("输入的数字位数不对！");
        return false;
    }
    var a = num.match(re);
    if (a != null)
    {
        if (len == 15)
        {
            var D = new Date("19" + a[3] + "/" + a[4] + "/" + a[5]);
            var B = D.getYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];
        }
        else
        {
            var D = new Date(a[3] + "/" + a[4] + "/" + a[5]);
            var B = D.getFullYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];
        }
        if (!B) {
            alert("输入的身份证号 " + a[0] + " 里出生日期不对！");
            return false;
        }
    }
    return true;
}

//一、验证类
//1、数字验证内
//1.1 整数
///^(-|\+)?\d+$/.test(str)
//1.2 大于0的整数 （用于传来的ID的验证)
///^\d+$/.test(str)
//1.3 负整数的验证
///^-\d+$/.test(str)
//2、时间类
//2.1 短时间，形如 (13:04:06)
function isTime(str)
{
    var a = str.match(/^(\d{1,2})(:)?(\d{1,2})\2(\d{1,2})$/);
    if (a == null) {
        alert('输入的参数不是时间格式');
        return false;
    }
    if (a[1] > 24 || a[3] > 60 || a[4] > 60)
    {
        alert("时间格式不对");
        return false
    }
    return true;
}
//2.2 短日期，形如 (2003-12-05)
function strDateTime(str)
{
    var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
    if (r == null)
        return false;
    var d = new Date(r[1], r[3] - 1, r[4]);
    return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4]);
}
//2.3 长时间，形如 (2003-12-05 13:04:06)
function strDateTime(str)
{
    var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/;
    var r = str.match(reg);
    if (r == null)
        return false;
    var d = new Date(r[1], r[3] - 1, r[4], r[5], r[6], r[7]);
    return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4] && d.getHours() == r[5] && d.getMinutes() == r[6] && d.getSeconds() == r[7]);
}
//2.4 只有年和月。形如(2003-05,或者2003-5)
//2.5 只有小时和分钟,形如(12:03)
//3、表单类
//3.1 所有的表单的值都不能为空
//<input onblur="if(this.value.replace(/^\s+|\s+$/g,'')=='')alert('不能为空!')">
//3.2 多行文本框的值不能为空。
//3.3 多行文本框的值不能超过sMaxStrleng
//3.4 多行文本框的值不能少于sMixStrleng
//3.5 判断单选框是否选择。
//3.6 判断复选框是否选择.
//3.7 复选框的全选，多选，全不选，反选
//3.8 文件上传过程中判断文件类型
//4、字符类
//4.1 判断字符全部由a-Z或者是A-Z的字字母组成
//<input onblur="if(/[^a-zA-Z]/g.test(this.value))alert('有错')">
//4.2 判断字符由字母和数字组成。
//<input onblur="if(/[^0-9a-zA-Z]/g.test(this.value))alert('有错')">
//4.3 判断字符由字母和数字，下划线,点号组成.且开头的只能是下划线和字母
///^([a-zA-z_]{1})([\w]*)$/g.test(str)
//4.4 字符串替换函数.Replace();
//5、浏览器类
//5.1 判断浏览器的类型
//window.navigator.appName
//5.2 判断ie的版本
//window.navigator.appVersion
//5.3 判断客户端的分辨率
//window.screen.height; window.screen.width;

//6、结合类
//6.1 email的判断。
function ismail(mail)
{
    return(new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(mail));
}
//6.2 手机号码的验证
//6.3.1 身份证的验证
function isIdCardNo(num)
{
    if (isNaN(num)) {
        alert("输入的不是数字！");
        return false;
    }
    var len = num.length, re;
    if (len == 15)
        re = new RegExp(/^(\d{6})()?(\d{2})(\d{2})(\d{2})(\d{3})$/);
    else if (len == 18)
        re = new RegExp(/^(\d{6})()?(\d{4})(\d{2})(\d{2})(\d{3})(\d)$/);
    else {
        alert("输入的数字位数不对！");
        return false;
    }
    var a = num.match(re);
    if (a != null)
    {
        if (len == 15)
        {
            var D = new Date("19" + a[3] + "/" + a[4] + "/" + a[5]);
            var B = D.getYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];
        }
        else
        {
            var D = new Date(a[3] + "/" + a[4] + "/" + a[5]);
            var B = D.getFullYear() == a[3] && (D.getMonth() + 1) == a[4] && D.getDate() == a[5];
        }
        if (!B) {
            alert("输入的身份证号 " + a[0] + " 里出生日期不对！");
            return false;
        }
    }
    return true;
}
//6.3.2 身份证的验证
//<script>
var aCity = {11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外"}

function cidInfo(sId) {
    var iSum = 0
    var info = ""
    if (!/^\d{17}(\d|x)$/i.test(sId))
        return false;
    sId = sId.replace(/x$/i, "a");
    if (aCity[parseInt(sId.substr(0, 2))] == null)
        return "Error:非法地区";
    sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));
    var d = new Date(sBirthday.replace(/-/g, "/"))
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()))
        return "Error:非法生日";
    for (var i = 17; i >= 0; i --)
        iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11)
    if (iSum % 11 != 1)
        return "Error:非法证号";
    return aCity[parseInt(sId.substr(0, 2))] + "," + sBirthday + "," + (sId.substr(16, 1) % 2 ? "男" : "女")
}

document.write(cidInfo("380524198002300016"), "<br/>");
document.write(cidInfo("340524198002300019"), "<br/>")
document.write(cidInfo("340524197711111111"), "<br/>")
document.write(cidInfo("34052419800101001x"), "<br/>");
//</script>

//２．验证ＩＰ地址
//<SCRIPT LANGUAGE="JavaScript">
function isip(s) {
    var check = function(v) {
        try {
            return (v <= 255 && v >= 0)
        } catch (x) {
            return false
        }
    };
    var re = s.split(".")
    return (re.length == 4) ? (check(re[0]) && check(re[1]) && check(re[2]) && check(re[3])) : false
}

var s = "202.197.78.129";
alert(isip(s))
//</SCRIPT>

//针对javascript的几个对象的扩充函数
function checkBrowser()
{
    this.ver = navigator.appVersion
    this.dom = document.getElementById ? 1 : 0
    this.ie6 = (this.ver.indexOf("MSIE 6") > -1 && this.dom) ? 1 : 0;
    this.ie5 = (this.ver.indexOf("MSIE 5") > -1 && this.dom) ? 1 : 0;
    this.ie4 = (document.all && !this.dom) ? 1 : 0;
    this.ns5 = (this.dom && parseInt(this.ver) >= 5) ? 1 : 0;
    this.ns4 = (document.layers && !this.dom) ? 1 : 0;
    this.mac = (this.ver.indexOf('Mac') > -1) ? 1 : 0;
    this.ope = (navigator.userAgent.indexOf('Opera') > -1);
    this.ie = (this.ie6 || this.ie5 || this.ie4)
    this.ns = (this.ns4 || this.ns5)
    this.bw = (this.ie6 || this.ie5 || this.ie4 || this.ns5 || this.ns4 || this.mac || this.ope)
    this.nbw = (!this.bw)

    return this;
}


//是否是正确的IP地址
//===========================================
//*/
String.prototype.isIP = function()
{

    var reSpaceCheck = /^(\d+)\.(\d+)\.(\d+)\.(\d+)$/;

    if (reSpaceCheck.test(this))
    {
        this.match(reSpaceCheck);
        if (RegExp.$1 <= 255 && RegExp.$1 >= 0
                && RegExp.$2 <= 255 && RegExp.$2 >= 0
                && RegExp.$3 <= 255 && RegExp.$3 >= 0
                && RegExp.$4 <= 255 && RegExp.$4 >= 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }

}

/*
 ===========================================
 //是否是正确的长日期
 ===========================================
 */
String.prototype.isDate = function()
{
    var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/);
    if (r == null)
    {
        return false;
    }
    var d = new Date(r[1], r[3] - 1, r[4], r[5], r[6], r[7]);
    return (d.getFullYear() == r[1] && (d.getMonth() + 1) == r[3] && d.getDate() == r[4] && d.getHours() == r[5] && d.getMinutes() == r[6] && d.getSeconds() == r[7]);

}

/*
 ===========================================
 //是否是手机
 ===========================================
 */
String.prototype.isMobile = function()
{
    return /^0{0,1}13[0-9]{9}$/.test(this);
}

/*
 ===========================================
 //是否是邮件
 ===========================================
 */
String.prototype.isEmail = function()
{
    return /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/.test(this);
}

/*
 ===========================================
 //是否是邮编(中国)
 ===========================================
 */

String.prototype.isZipCode = function()
{
    return /^[\\d]{6}$/.test(this);
}

/*
 ===========================================
 //是否是有汉字
 ===========================================
 */
String.prototype.existChinese = function()
{
//[\u4E00-\u9FA5]為漢字﹐[\uFE30-\uFFA0]為全角符號
    return /^[\x00-\xff]*$/.test(this);
}

/*
 ===========================================
 //是否是合法的文件名/目录名
 ===========================================
 */
String.prototype.isFileName = function()
{
    return !/[\\\/\*\?\|:"<>]/g.test(this);
}

/*
 ===========================================
 //是否是有效链接
 ===========================================
 */
String.Prototype.isUrl = function()
{
//return /^http:\/\/([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/.test(this);
}

/*
 ===========================================
 //是否是有效的身份证(中国)
 ===========================================
 */
String.prototype.isIDCard = function()
{
    var iSum = 0;
    var info = "";
    var sId = this;

    var aCity = {11: "北京", 12: "天津", 13: "河北", 14: "山西", 15: "内蒙古", 21: "辽宁", 22: "吉林", 23: "黑龙江", 31: "上海", 32: "江苏", 33: "浙江", 34: "安徽", 35: "福建", 36: "江西", 37: "山东", 41: "河南", 42: "湖北", 43: "湖南", 44: "广东", 45: "广西", 46: "海南", 50: "重庆", 51: "四川", 52: "贵州", 53: "云南", 54: "西藏", 61: "陕西", 62: "甘肃", 63: "青海", 64: "宁夏", 65: "新疆", 71: "台湾", 81: "香港", 82: "澳门", 91: "国外"};

    if (!/^\d{17}(\d|x)$/i.test(sId))
    {
        return false;
    }
    sId = sId.replace(/x$/i, "a");
//非法地区
    if (aCity[parseInt(sId.substr(0, 2))] == null)
    {
        return false;
    }

    var sBirthday = sId.substr(6, 4) + "-" + Number(sId.substr(10, 2)) + "-" + Number(sId.substr(12, 2));

    var d = new Date(sBirthday.replace(/-/g, "/"))

//非法生日
    if (sBirthday != (d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate()))
    {
        return false;
    }
    for (var i = 17; i >= 0; i--)
    {
        iSum += (Math.pow(2, i) % 11) * parseInt(sId.charAt(17 - i), 11);
    }

    if (iSum % 11 != 1)
    {
        return false;
    }
    return true;

}

/*
 ===========================================
 //是否是有效的电话号码(中国)
 ===========================================
 */
String.prototype.isPhoneCall = function()
{
    return /(^[0-9]{3,4}\-[0-9]{3,8}$)|(^[0-9]{3,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}13[0-9]{9}$)/.test(this);
}


/*
 ===========================================
 //是否是数字
 ===========================================
 */
String.prototype.isNumeric = function(flag)
{
//验证是否是数字
    if (isNaN(this))
    {

        return false;
    }

    switch (flag)
    {

        case null://数字
        case "":
            return true;
        case "+"://正数
            return/(^\+?|^\d?)\d*\.?\d+$/.test(this);
        case "-"://负数
            return/^-\d*\.?\d+$/.test(this);
        case "i"://整数
            return/(^-?|^\+?|\d)\d+$/.test(this);
        case "+i"://正整数
            return/(^\d+$)|(^\+?\d+$)/.test(this);
        case "-i"://负整数
            return/^[-]\d+$/.test(this);
        case "f"://浮点数
            return/(^-?|^\+?|^\d?)\d*\.\d+$/.test(this);
        case "+f"://正浮点数
            return/(^\+?|^\d?)\d*\.\d+$/.test(this);
        case "-f"://负浮点数
            return/^[-]\d*\.\d$/.test(this);
        default://缺省
            return true;
    }
}


/*
 ===========================================
 //转换成全角
 ===========================================
 */
String.prototype.toCase = function()
{
    var tmp = "";
    for (var i = 0; i < this.length; i++)
    {
        if (this.charCodeAt(i) > 0 && this.charCodeAt(i) < 255)
        {
            tmp += String.fromCharCode(this.charCodeAt(i) + 65248);
        }
        else
        {
            tmp += String.fromCharCode(this.charCodeAt(i));
        }
    }
    return tmp
}

