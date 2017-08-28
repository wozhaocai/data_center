<{include file="./header.tpl"}>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> 资源列表</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#">资源列表</a></dl>
      
      <dl>
        <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="/service.php?business=dc&controller=member_resource&action=edit_show"><span class="am-icon-pencil-square-o"></span>添加资源</a>
      </dl>      
      
    </div>
	
	<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">  
</div>


    <form class="am-form am-g">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                <th class="table-check"><input type="checkbox" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">service_id</th>
                <th class="table-type">资源类型</th>
                <th class="table-type">文件类型</th>
                <th class="table-date am-hide-sm-only">创建日期</th>
                <th width="20%" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
                <{foreach $aResource as $key=>$val}>
              <tr>
                <td><input type="checkbox" /></td>
                <td><{$val->id}></td>
                <td><{$val->service_id}></td>
                <td><{$val->source_type}></td>
                <td><{$val->content_type}></td>
                <td class="am-hide-sm-only"><{$val->ctime}></td>
                <td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="/service.php?business=dc&controller=member_resource&action=edit_show&id=<{$val->id}>'"><span class="am-icon-pencil-square-o"></span>编辑</a>
                  </div>
                  </div></td>
              </tr>
              <{/foreach}>              
            </tbody>
          </table>    
        </form>
 <{include file="./footer.tpl"}>
 
