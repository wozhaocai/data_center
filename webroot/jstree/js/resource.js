/**
 * 权限菜单处理模块
 */
(function($ns){
    /**
     * 绑定用户组权限
     */
    $ns.bindGroupResource = function() {
        Qadmin.FW.Ajax.post({
            url: "/view/module/menu/bind_resource.php?gid="+ Qadmin.FW.Url.getUrlParam('gid'),
            data: $(':checkbox').serializeArray()
        }, function(){
            Qadmin.FW.Url.goToUrl("/server.php?module=auto&action=g_group");
        });
    }
    
    $ns.showAddResource = function(trId) {
        var rand = new Date().getTime(),
            parentId = trId.replace(/node_/g, "");
        var str = '<tr id="dynamic_tab">\n\
                    <td style="padding-left:40px;" class="res_add">\n\
                        <form id="resAddForm_'+ rand +'" style=\"width:900px;\">\n\
                            <input type="hidden" id="parentId" name="parent_id" value="'+ parentId +'" />\n\
                            菜单名: <input type="text" id="name" name="title" value="" />\n\
			    &nbsp;&nbsp;&nbsp;href: <input type="text" id="description" name="path" value="" />\n\
                                 </select>';
		str += '&nbsp;&nbsp;菜单类型：<select id="type" name="type"><option value="0">菜单</option><option value="1">隐形菜单</option></select>\n';
		/**
	    str += '&nbsp;&nbsp;权重: <select id="sort" name="sort">';
	    for(var i =0; i<=999; i++) {
		str += '<option value="'+ i +'">'+ i +'</option>'
	    }
	    str += '</select>';*/
	    str += '&nbsp;&nbsp;<input type="button" class="button_style" value="提交" onclick="Qadmin.App.Resource.addResource('+ rand +');"/>\n\
			    <input type="hidden" name="valiFormId" value="resAddForm_'+ rand +'" />\n\
                        </form>\n\
                    </td>\n\
                </tr>';
	
	var dynamic_tab = $('#dynamic_tab');
	if($(dynamic_tab).size() != 0) {
	    $(dynamic_tab).remove();
	}
        $("#"+ trId).after(str);
    }
    
    $ns.addResource = function(formId) {
        Qadmin.FW.Ajax.post({
            url: '/view/module/menu/add_resource.php',
            data: $('#resAddForm_'+ formId).serializeArray()
        }, function(xhr){
            location.reload();
        });
    }
    
    $ns.updateResource = function(rid) {
        Qadmin.FW.Url.goToUrl("/view/module/menu/update_resource.php?rid="+ rid);
    }
    
    $ns.deleteResource = function(rid) {
	Qadmin.FW.Dialog.confirm({
	    msg: '确定要删除记录？',
	    ok: function() {
		Qadmin.FW.Ajax.get({
		    url: ["delete_resource.php?rid=", rid].join("")
		}, function(xhr){
		    location.reload();
		});
	    }
	})
    }
})(using("Qadmin.App.Resource"));
