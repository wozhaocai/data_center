<?php
/* Smarty version 3.1.30, created on 2017-08-18 11:22:37
  from "D:\wozhaocai\data_center\templates\member\meta.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59965d7da3c614_85344469',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6372dbeef88ed67d2bdaec6f15002b6e975e896d' => 
    array (
      0 => 'D:\\wozhaocai\\data_center\\templates\\member\\meta.tpl',
      1 => 1503026552,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./footer.tpl' => 1,
  ),
),false)) {
function content_59965d7da3c614_85344469 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> <?php echo $_smarty_tpl->tpl_vars['current_menu']->value;?>
</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#"><?php echo $_smarty_tpl->tpl_vars['current_menu']->value;?>
</a></dl>
      
      <dl>
        <?php echo $_smarty_tpl->tpl_vars['action_des']->value;?>

      </dl>
      
      
    </div>
	
	<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">
            <form id="my_form" target="_self" method="post" action="<?php echo $_smarty_tpl->tpl_vars['form_url']->value;?>
&is_divpage=1">
	<?php if (count($_smarty_tpl->tpl_vars['aSearch']->value) > 0) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aSearch']->value, 'item', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
?>
		<input type='hidden' name='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' id='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' value=''>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	<?php }?>
	<input type='hidden' name='form_act' id='form_act' value='<?php echo $_smarty_tpl->tpl_vars['aParam']->value['form_act'];?>
'>
</form>
  <ul>
      <?php if (count($_smarty_tpl->tpl_vars['aSearch']->value) > 0) {?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aSearch']->value, 'item', false, 'key', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
?>
        <li>
      <div class="am-btn-group am-btn-group-xs">
        <input type='text' class="am-form-field am-input-sm am-input-xm" placeholder="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"  name='qs_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' id='qs_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
' value='<?php echo $_smarty_tpl->tpl_vars['aSearchValue']->value[$_smarty_tpl->tpl_vars['key']->value];?>
'>
      </div>
    </li>	
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <li><input type="text" class="am-form-field am-input-sm am-input-xm" placeholder="关键词搜索" /></li>
            <li><button type="button" onclick="myForm.search()" class="am-btn am-radius am-btn-xs am-btn-success" style="margin-top: -1px;">搜索</button></li>
       <?php }?>	  
  </ul>
</div>


    <form class="am-form am-g">
          <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped">
            <thead>
              <tr class="am-success">
                  <th class="table-check"><input type="checkbox" /></th>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aColumn']->value, 'val');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['val']->value) {
?>                
                <th class="table-title"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</th>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <th width="20%" class="table-set">操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aData']->value, 'aValue', false, 'v', 'name', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value => $_smarty_tpl->tpl_vars['aValue']->value) {
?>
		<?php if ($_smarty_tpl->tpl_vars['aDataGroup']->value[$_smarty_tpl->tpl_vars['v']->value] == "Y") {?>
		<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" class="gradeA">
		<tr class="a1">
			<td><input type="checkbox" /></td>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aValue']->value, 'val', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
			<?php if ($_smarty_tpl->tpl_vars['k']->value == "id") {?>
			<td rowspan='<?php echo $_smarty_tpl->tpl_vars['aRowSpan']->value[$_smarty_tpl->tpl_vars['k']->value];?>
'>
			<?php echo $_smarty_tpl->tpl_vars['val']->value;?>

			<input type="hidden" name="gp_id[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"/> 
			</td>
			<?php } else { ?>
			<td rowspan='<?php echo $_smarty_tpl->tpl_vars['aRowSpan']->value[$_smarty_tpl->tpl_vars['k']->value];?>
'><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
			<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			<td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 组成员</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 权限</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                  </div></td>
		</tr>
		<?php } else { ?>
		<tr id="tr_<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" class="gradeA">
			<td><input type="checkbox" /></td>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aValue']->value, 'val', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
			<?php if ($_smarty_tpl->tpl_vars['k']->value == "id") {?>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
<input type="hidden" name="gp_id[]" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
"/></td>
			<?php } else { ?>
				<td><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</td>
			<?php }?>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        <td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 组成员</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 权限</button>
                    <button class="am-btn am-btn-default am-btn-xs am-text-danger"><span class="am-icon-trash-o"></span> 删除</button>
                  </div>
                  </div></td>
		</tr>
		<?php }?>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
  
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
 <?php $_smarty_tpl->_subTemplateRender("file:./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 
<?php }
}
