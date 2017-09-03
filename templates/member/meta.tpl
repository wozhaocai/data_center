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


    <form class="am-form am-g">
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
			<td><input type="checkbox" /></td>
			<{foreach from=$aValue key=k item=val}>
			<{if $k == "id" }>
				<td><{$val}><input type="hidden" name="gp_id[]" value="<{$val}>"/></td>
			<{else}>
				<td><{$val}></td>
			<{/if}>
			<{/foreach}>                        
		</tr>
		<{/if}>
		<{/foreach}>  
            </tbody>
          </table>
          <!--
                 <div class="am-btn-group am-btn-group-xs">

              <button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 上架</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-plus"></span> 新增</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 移动</button>
              <button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>
            </div>
          -->
          <ul class="am-pagination am-fr">
                <{$sPageStr}>                
              </ul>
              <style>
.tablemain table{width:400px; padding:10px; margin-top:50px; overflow:hidden; border:1px solid #CCC;} 
.tablemain thead{background:#eee;font-size:14px;} 
.tablemain th, .tablemain td {border:1px solid #ccc;padding: 0.3em;}
.tablemain td label{padding:0.2em;margin-right:0.1em;font-size:12px;font-family:Arial;}
.tablemain tr.line td{border-top:2px solid #999;font-size:12px;font-family:Arial;}
.tablemain img{border-top:2px solid #999;font-size:12px;font-family:Arial;}
</style>
              <table class="tablemain">
                    <tr>
                      <th>分时线</th>
                      <th>日k线</th>
                      <th>周k线</th>
                      <th>月k线</th>
                    </tr>
                    <tr>
                        <td><img src='http://image2.sinajs.cn/newchart/min/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/daily/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/weekly/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/monthly/n/sh000001.gif?' onload="AutoResizeImage(400,0,this)"></td>
                    </tr>
                    <tr>
                        <td><img src='http://image2.sinajs.cn/newchart/min/n/hk_01063.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://222.73.54.228/EM_Quote2007/PictureK.aspx?StockCode=hk_01063&StockMarket=1&StockLayer=2&StockCurve=9&StockStyle=1' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/weekly/n/ccih.gif?' onload="AutoResizeImage(400,0,this)"></td>
                        <td><img src='http://image2.sinajs.cn/newchart/monthly/n/ccih.gif?' onload="AutoResizeImage(400,0,this)"></td>
                    </tr>
              </table>
              
              
          <iframe src="http://stockpage.10jqka.com.cn/HQ.html#usa_CCIH#prefix_1#prefix_0#hqt_zkx" width="580" height="565" marginheight="0" marginwidth="0" frameborder="0" scrolling="no"></iframe>
                <iframe style="margin-left:-5px" width="770" height="460" name="myiframe" marginheight="0" marginwidth="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="http://hkquote.stock.hexun.com/CandleLine.aspx?stockid=01013&type=1&period=5&segment=7"></iframe>
      <iframe style="margin-left:-5px" width="770" height="460" name="myiframe" marginheight="0" marginwidth="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="http://hkquote.stock.hexun.com/CandleLine.aspx?stockid=01013&type=1&period=6&segment=7"></iframe>
         <!-- <hr />
          <p>注：.....</p>-->
        </form>      

 <{include file="./footer.tpl"}>
 
