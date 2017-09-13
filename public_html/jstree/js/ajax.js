/**
 * Ajax封装
 * 
 * @author zijing.zhang
 */
(function($ns) {

	var succ_status = 0;

	/**
	 * ajax post, 带处理表单验证
	 * 
	 * @param config {
	 *            formId: '' 
	 *            url: '' 
	 *            hideSuccTip: 是否隐藏成功回调提示, true - 隐藏
	 *            hideFailTip: 是否隐藏失败回调提示, true - 隐藏 
	 *        }
	 * @param callback
	 * @return boolean
	 */
	$ns.post = function(config, callback) {
		if (!config || !config.url)
			return false;
		var data = null, url = config.url, hideSuccTip = config.hideSuccTip, hideFailTip = config.hideFailTip, dataType = config.dataType
				|| 'json';

		if (config.data) {
			data = config.data;
		} else if (config.formId) {
			data = $("#" + config.formId).serializeArray();
		}

		$.ajax({
			type : "post",
			url : url,
			data : data,
			cache : false,
			dataType : dataType,
			error : function(xhr) {
				try {
					var errMsg = xhr.responseText
							|| "\u64cd\u4f5c\u5f02\u5e38!";
					Qadmin.FW.Dialog.alert({
						msg : errMsg
					});
				} catch (e) {
				}
			},
			success : function(xhr) {
				try {
					if (xhr && xhr.status == succ_status) {
						!hideSuccTip && Qadmin.FW.Dialog.succ({
							msg : xhr.msg
						});
						if (callback) {
							callback(xhr);
						}
					} else {
						// 检测是否有表单验证失败的返回
						if (Qadmin.FW.Validator && xhr && xhr.data) {
							Qadmin.FW.Validator.showServerValiResult(xhr);
							return;
						}
						!hideFailTip && Qadmin.FW.Dialog.fail({
							msg : xhr.msg
						});
					}
				} catch (e) {
					log.error(e.description);
				}
			}
		});
		return false;
	};

	/**
	 * ajax get
	 * 
	 * @param config {
	 *            url: '' 
	 *            hideSuccTip: 是否隐藏成功回调提示, true - 隐藏 
	 *            hideFailTip: 是否隐藏失败回调提示, true - 隐藏 
	 *         }
	 * @param callback
	 * @return boolean
	 */
	$ns.get = function(config, callback) {
		if (!config || !config.url)
			return false;
		var url = config.url, hideSuccTip = config.hideSuccTip, hideFailTip = config.hideFailTip;
		dataType = config.dataType || 'json';

		$.ajax({
			type : "get",
			url : url,
			cache : false,
			dataType : dataType,
			error : function(xhr) {
				try {
					var errMsg = xhr.responseText
							|| "\u64cd\u4f5c\u5f02\u5e38!";
					Qadmin.FW.Dialog.alert({
						msg : errMsg
					});
				} catch (e) {
				}
			},
			success : function(xhr) {
				try {
					if (xhr && xhr.status == succ_status) {
						!hideSuccTip && Qadmin.FW.Dialog.succ({
							msg : xhr.msg
						});
						if (callback) {
							callback(xhr);
						}
					} else {
						!hideFailTip && Qadmin.FW.Dialog.fail({
							msg : xhr.msg
						});
					}
				} catch (e) {
					log.error(e.description);
				}
			}
		});
		return false;
	};
})(using("Qadmin.FW.Ajax"));
