<{include file="./header.tpl"}>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> <{$current_menu}></ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#">商品列表</a></dl>
      
      <dl>
        <{$action_des}>
      </dl>
      
      
    </div>
	
	<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">
            <form id="my_form" target="_self" method="post" action="<{$form_url}>&is_divpage=1">
	<{if count($aSearch) gt 0 }>
	<{foreach from=$aSearch key=key item=item name=name}>
		<input type='hidden' name='<{$key}>' id='<{$key}>' value=''>
	<{/foreach}>
	<{/if}>
	<input type='hidden' name='form_act' id='form_act' value='<{$aParam.form_act}>'>
</form>
  <ul>
      <{if count($aSearch) gt 0 }>
	<{foreach from=$aSearch key=key item=item name=name}>
        <li>
      <div class="am-btn-group am-btn-group-xs">
        <input type='text' class="am-form-field am-input-sm am-input-xm" placeholder="<{$item}>"  name='qs_<{$key}>' id='qs_<{$key}>' value='<{$aSearchValue[$key]}>'>
      </div>
    </li>	
	<{/foreach}>
            <li><input type="text" class="am-form-field am-input-sm am-input-xm" placeholder="关键词搜索" /></li>
            <li><button type="button" onclick="myForm.search()" class="am-btn am-radius am-btn-xs am-btn-success" style="margin-top: -1px;">搜索</button></li>
       <{/if}>	  
  </ul>
</div>


    <form class="am-form am-g">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                  <th class="table-check"><input type="checkbox" /></th>
                <{foreach $aColumn as $val}>                
                <th class="table-title"><{$val}></th>
                <{/foreach}>
                <th width="20%" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
                <{foreach from=$aData key=v item=aValue name=name}>
		<{if $aDataGroup[$v] == "Y"}>
		<tr id="tr_<{$v}>" class="gradeA">
		<tr class="a1">
			<td><input type="checkbox" /></td>
			<{foreach from=$aValue key=k item=val}>
			<{if $k == "id" }>
			<td rowspan='<{$aRowSpan[$k]}>'>
			<{$val}>
			<input type="hidden" name="gp_id[]" value="<{$val}>"/> 
			</td>
			<{else}>
			<td rowspan='<{$aRowSpan[$k]}>'><{$val}></td>
			<{/if}>
			<{/foreach}>
			<td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 组成员</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 权限</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                  </div></td>
		</tr>
		<{else}>
		<tr id="tr_<{$v}>" class="gradeA">
			<td><input type="checkbox" /></td>
			<{foreach from=$aValue key=k item=val}>
			<{if $k == "id" }>
				<td><{$val}><input type="hidden" name="gp_id[]" value="<{$val}>"/></td>
			<{else}>
				<td><{$val}></td>
			<{/if}>
			<{/foreach}>
                        <td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 组成员</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 权限</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                  </div></td>
		</tr>
		<{/if}>
		<{/foreach}>  
            </tbody>
          </table>
          
                 <div class="am-btn-group am-btn-group-xs">

              <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 上架</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 移动</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          
          <ul class="am-pagination am-fr">
                <li class="am-disabled"><a href="#">«</a></li>
                <li class="am-active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
              </ul>
          
          
          
      
          <hr />
          <p>注：.....</p>
        </form>
 <{include file="./footer.tpl"}>
 
