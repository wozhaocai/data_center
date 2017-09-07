<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>系统菜单树列表</title>
<link href="css/admin.css?v=2011019131226" type="text/css" rel="stylesheet" />
<link href="css/customer.css?v=2011019131226" type="text/css" rel="stylesheet" />
<link href="css/core.css?v=2011019131226" type="text/css" rel="stylesheet" />
<link href="css/treeview.css?v=2011019131226" type="text/css" rel="stylesheet" />
<script src="js/jquery.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/core.js"></script>
<script src="js/ajax.js"></script>
<script src="js/url.js"></script>
<script src="js/dialog.js"></script>
<script src="js/resource.js"></script>
<script src="js/optlog.js"></script>
</head>
<body>
<table class="comm_tree">
	<thead>
        <tr>
            <th>用 户 组 权 限 绑 定</th>
        </tr>
    </thead>
	<{$sMenu}>
    </tbody>
	 <tfoot>
        <tr>
            <td>
                <input type="button" class="button_style" value="更新权限绑定" onclick="bindGroupResource()"/>
                <input type="button" class="button_style" value="刷新" onclick="location.reload();"/>
            </td>
        </tr>
    </tfoot>
</table>
    
<script>
var bindRidList = [$<{sGroupResource}>]; // binded resource id list
$(document).ready(function() {
    for(var i =0; i<bindRidList.length; i++) {
        $('#node_'+ bindRidList[i]).attr("checked", true);
    }
});
function selChildren(e, children) {
    if(children!="") {
		var arr = children.slice(0, children.length-1).split(",");
		for(var i =0; i<arr.length; i++) {
			$('#node_'+arr[i]).attr("checked", e.checked);
		}
    }
}
</script>
</body>
</html>