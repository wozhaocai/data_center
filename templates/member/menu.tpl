<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">  
<html>  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
<link rel="stylesheet" href="/ztree/css/demo.css" type="text/css">  
<link rel="stylesheet" href="/ztree/css/zTreeStyle/zTreeStyle.css"  type="text/css">  
<script type="text/javascript" src="/ztree/js/jquery-1.4.4.min.js"></script>  
<script type="text/javascript" src="/ztree/js/jquery.ztree.core.js"></script>  
<script type="text/javascript" src="/ztree/js/jquery.ztree.excheck.js"></script>  
<script type="text/javascript" src="/ztree/js/jquery.ztree.exedit.js"></script>  
<script type="text/javascript">  
    var setting = {  
        async : {  
            enable : true,//开启异步加载处理  
            url : encodeURI(encodeURI("/service.php?business=dc&controller=member_menu&action=show")),  
            autoParam : [ "id" ],  
            dataFilter : filter,  
            contentType : "application/json",  
            type : "get"  
        },  
        view : {  
            expandSpeed : "",  
            addHoverDom : addHoverDom,  
            removeHoverDom : removeHoverDom,  
            selectedMulti : false  
        },  
        edit : {  
            enable : true  
        },  
        data : {  
            simpleData : {  
                enable : true  
            }  
        },  
        callback : {  
            beforeRemove : beforeRemove,  
            beforeRename : beforeRename,  
        }  
    };  
    function filter(treeId, parentNode, childNodes) {  
        if (!childNodes)  
            return null;  
        for (var i = 0, l = childNodes.length; i < l; i++) {  
            childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');  
        }  
        return childNodes;  
    }  
    function beforeRemove(treeId, treeNode) {  
        if (confirm("确认删除菜单--" + treeNode.name + "--吗?")) {  
            var param = "id=" + treeNode.id;  
            $.post(encodeURI(encodeURI("/service.php?business=dc&controller=member_menu&action=delete&"  + param)));  
        } else {  
            return false;  
        }  
    }  
    function beforeRename(treeId, treeNode, newName) {  
        if (newName.length == 0) {  
            alert("菜单名称不能为空.");  
            return false;  
        }  
        var param = "id=" + treeNode.id + "&name=" + encodeURIComponent(newName);  
        $.post(encodeURI(encodeURI("/service.php?business=dc&controller=member_menu&action=update&"  + param)));  
        return true;  
    }  
  
    function addHoverDom(treeId, treeNode) {  
        var sObj = $("#" + treeNode.tId + "_span");  
        if (treeNode.editNameFlag || $("#addBtn_" + treeNode.tId).length > 0)  
            return;  
        var addStr = "<span class='button add' id='addBtn_" + treeNode.tId  
                + "' title='add node' onfocus='this.blur();'></span>";  
        sObj.after(addStr);  
        var btn = $("#addBtn_" + treeNode.tId);  
        if (btn)  
            btn.bind("click", function() {  
                var Ppname = prompt("请输入新菜单名称及超链接，以“|”分隔");                  
                if (Ppname == null) {  
                    return;  
                } else if (Ppname == "") {  
                    alert("菜单名称不能为空");  
                } else {  
                    var param ="&pId="+ treeNode.id + "&name=" + encodeURIComponent(Ppname);  
                    var zTree = $.fn.zTree.getZTreeObj("treeDemo");  
                    $.post(  
                            encodeURI(encodeURI("/service.php?business=dc&controller=member_menu&action=add&" + param)), function(data) {  
                                if ($.trim(data) != null) {  
                                    var treenode = $.trim(data);  
                                    zTree.addNodes(treeNode, {  
                                        pId : treeNode.id,  
                                        name : Ppname  
                                    }, true);  
                                }  
                            })  
                }  
  
            });  
    };  
    function removeHoverDom(treeId, treeNode) {  
        $("#addBtn_" + treeNode.tId).unbind().remove();  
    };  
    $(document).ready(function() {  
        $.fn.zTree.init($("#treeDemo"), setting);  
  
    });  
</script>  
<style type="text/css">  
.ztree li span.button.add {  
    margin-left: 2px;  
    margin-right: -1px;  
    background-position: -144px 0;  
    vertical-align: top;  
    *vertical-align: middle  
}  
</style>  
</head>  
<body>  
    <div class="content_wrap">  
        <div class="zTreeDemoBackground left">  
            <ul id="treeDemo" class="ztree"></ul>  
        </div>  
    </div>  
</body>  
</html>  