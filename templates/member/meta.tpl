<{include file="./header.tpl"}>
<script>
var MyForm = function(){
	var syncFields = [<{$sSearchStr}>];
	var field;
	var i;
	var submitForm = function(){
		for (i in syncFields){
			field = syncFields[i];
			$('#' + field).val($('#qs_' + field).val());
		}
		$('#my_form').submit();
	}
	this.search = function() {
		$('#form_act').val('search');
		submitForm();
		return true;
	};
	this.download = function() {
		$('#form_act').val('download');
		submitForm();
		return true;
	};        
	this.import = function() {
		$('#form_act').val('import');
		$('#my_form').submit();
		return true;
	};
        this.add = function(addUrl) {
            alert(addUrl);
		$('#dialog_iframe').attr({
			src: addUrl,
			frameborder: 0,
			scrolling: 'no',
			width: 800,
			height: 750
		});
		var dialogOptions = {
			minWidth: 820,
			minHeight: 750,
			modal: true,
			closeText: "关闭",
			closeOnEscape: true
		};
		$('#dialog_iframe').load(function() {
			$("#my_dialog").dialog(dialogOptions);
		});
	};
};
var myForm = new MyForm();
</script>
<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> <{$current_menu}></ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#"><{$current_menu}></a></dl>
      
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


    <form class="am-form am-g" id="main_form" action="<{$main_form_url}>" method="post">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                  <th class="table-check"><input type="checkbox" /></th>
                <{foreach $aColumn as $val}>                
                <th class="table-title"><{$val}></th>
                <{/foreach}>                
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
		</tr>
		<{else}>
		<tr id="tr_<{$v}>" class="gradeA">
                    <td><input name='ids[]' type="checkbox" value="<{$aValue[0]}>" <{$aOptionHtml[$v]}>/></td>
			<{foreach from=$aValue key=k item=val}>
			<{if $k == "id" }>
				<td><{$val}><input type="hidden" name="gp_id[]" value="<{$val}>"/></td>
			<{else}>
				<td><{$val}></td>
			<{/if}>
			<{/foreach}>    
                        <{$sHiddenHtml}>
		</tr>
		<{/if}>
		<{/foreach}>  
            </tbody>
          </table>
          <{$ext_action}>
          <ul class="am-pagination am-fr">
                <{$sPageStr}>                
              </ul>
              
           <hr/>
          <p>注：<{$sMemo}></p>
        </form>      

 <{include file="./footer.tpl"}>
 
