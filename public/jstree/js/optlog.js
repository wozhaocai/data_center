/**
 * 日志查看
 */
(function($ns) {
	/**
	 * 获取单一用户的操作日志
	 * 
	 * @param uid
	 */
	$ns.showSingleUserOptLog = function(uid) {
		Qadmin.FW.Ajax.get({
			url : [ "operationlog/showSingleUserOptLog?uid=", uid ].join(""),
			hideSuccTip : true,
			hideFailTip : true
		}, function(xhr) {
			var content = xhr.data;
			if (content.length == 0)
				content = "暂无记录";
			Qadmin.FW.Dialog.alert({
				title : '操作日志',
				msg : content
			});
		});
	};

	/**
	 * 获取单一用户组的操作日志
	 * 
	 * @param gid
	 */
	$ns.showSingleGroupOptLog = function(gid) {
		Qadmin.FW.Ajax.get({
			url : [ "operationlog/showSingleGroupOptLog?gid=", gid ].join(""),
			hideSuccTip : true,
			hideFailTip : true
		}, function(xhr) {
			var content = xhr.data;
			if (content.length == 0)
				content = "暂无记录";
			Qadmin.FW.Dialog.alert({
				title : '操作日志',
				msg : content
			});
		});
	};

	/**
	 * 获取单一资源的操作日志
	 * 
	 * @param rid
	 */
	$ns.showSingleResourceOptLog = function(rid) {
		Qadmin.FW.Ajax.get({
			url : [ "operationlog/showSingleResourceOptLog?rid=", rid ].join(""),
			hideSuccTip : true,
			hideFailTip : true
		}, function(xhr) {
			var content = xhr.data;
			if (content.length == 0)
				content = "暂无记录";
			Qadmin.FW.Dialog.alert({
				title : '操作日志',
				msg : content
			});
		});
	};

})(using("Qadmin.App.OptLog"));
