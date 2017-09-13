/**
 * URL相关
 * 
 * @author zijing.zhang
 */
(function($ns) {

	$ns.titleIdKey = "tid";

	/**
	 * 适用于iframe嵌套页面的跳转，自动更新title标签
	 * 
	 * @param url
	 */
	$ns.goToUrl = function(url) {
		var baseElements = $('base');
		var baseUrl = "";
		
		if(baseElements.length > 0){
			baseUrl = baseElements[0].href;
		}
		
		if (!url)
			return;
		
		if(baseUrl != ""){
			url = baseUrl + url;
		}
		
		var titleId = this.getUrlParam(this.titleIdKey);
		var str = "";
		if (url.indexOf("?") != -1) {
			str = 'location.href="' + url + '&tid=' + titleId + '"';
		} else {
			str = 'location.href="' + url + '?tid=' + titleId + '"';
		}
		window.setTimeout(str, 0);
		window.status = "over";
	};

	/**
	 * 获取当前页面的url
	 */
	$ns.getUrl = function() {
		return location.href;
	};

	$ns.parseUrl = function() {
		var arr = {};
		var url = this.getUrl();
		var index = url.indexOf('?');
		if (index != -1) {
			url = url.substring(index + 1, url.length);
			var attr = url.split("&");
			for ( var i = 0; i < attr.length; i++) {
				if (attr[i].indexOf("=") != -1) {
					var t = attr[i].split("=");
					arr[t[0]] = t[1];
				}
			}
		}
		return arr;
	}

	/**
	 * 根据url参数
	 * 
	 * @param key
	 */
	$ns.getUrlParam = function(key) {
		var params = this.parseUrl();
		return params[key];
	}
})(using("Qadmin.FW.Url"));
