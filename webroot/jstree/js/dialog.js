/**
 * Dialog工具类
 * 
 * @author zijing.zhang
 */
(function($ns) {
	/**
	 * alert封装 - 基于jquery-ui
	 * 
	 * @param params
	 *            {msg: '提示信息', ok: function}
	 */
	$ns.alert = function(params) {
		var id = new Date().getTime();
		var html = '<div id="' + id + '">' + params.msg + '</div>';
		$(html).appendTo(document.body);
		var jqId = '#' + id;
		$(jqId).dialog({
			modal : true,
			title : params.title || '提示',
			buttons : [ {
				text : "确定",
				click : function() {
					params.ok && params.ok();
					$(this).dialog("close");
					$(jqId).remove();
				}
			} ]
		});
	}

	/**
	 * confirm封装
	 * 
	 * @param params
	 *            {msg: '提示信息', ok: function, cancel: function}
	 */
	$ns.confirm = function(params) {
		var id = new Date().getTime();
		var html = '<div id="' + id + '">' + params.msg + '</div>';
		$(html).appendTo(document.body);
		var jqId = '#' + id;
		$(jqId).dialog({
			modal : true,
			title : params.title || '提示',
			buttons : [ {
				text : "确定",
				click : function() {
					params.ok && params.ok();
					$(this).dialog("close");
					$(jqId).remove();
				}
			}, {
				text : "取消",
				click : function() {
					params.cancel && params.cancel();
					$(this).dialog("close");
					$(jqId).remove();
				}
			} ]
		});
	}

	/**
	 * 操作成功提示
	 * 
	 * @param params
	 *            {msg: '提示信息'}
	 */
	$ns.succ = function(params) {
		var popDiv = $('#dialog_popup'), popDivNew;

		if ($(popDiv).hasClass("dialog_succ")) {
			popDivNew = '<div id="dialog_popup" class="dialog_succ_new">'
					+ params.msg + '</div>'
		} else {
			popDivNew = '<div id="dialog_popup" class="dialog_succ">'
					+ params.msg + '</div>'
		}
		$(popDiv).remove();
		$(document.body).append(popDivNew);
		$('#dialog_popup').show().click(function() {
			$(this).remove();
		});
	}

	/**
	 * 操作失败提示
	 * 
	 * @params {msg: '提示信息'}
	 */
	$ns.fail = function(params) {
		this.succ(params);
	}
})(using("Qadmin.FW.Dialog"));
