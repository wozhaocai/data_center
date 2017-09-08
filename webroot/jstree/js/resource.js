/**
 * 权限菜单处理模块
 */
(function($ns){
    /**
     * 绑定用户组权限
     */
    $ns.bindGroupResource = function(submit_url,return_url) {
        Qadmin.FW.Ajax.post({
            url: submit_url,
            data: $(':checkbox').serializeArray()
        }, function(){
            location.reload();
        });
    }   
})(using("Qadmin.App.Resource"));
