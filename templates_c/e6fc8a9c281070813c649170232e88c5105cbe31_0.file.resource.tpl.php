<?php
/* Smarty version 3.1.30, created on 2017-09-02 00:20:26
  from "D:\glider_sky\data_center\templates\member\resource.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a988ca0e3e12_01373826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6fc8a9c281070813c649170232e88c5105cbe31' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\member\\resource.tpl',
      1 => 1504275476,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./footer.tpl' => 1,
  ),
),false)) {
function content_59a988ca0e3e12_01373826 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

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
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['aResource']->value, 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?>
              <tr>
                <td><input type="checkbox" /></td>
                <td><?php echo $_smarty_tpl->tpl_vars['val']->value->id;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['val']->value->service_id;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['val']->value->source_type;?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['val']->value->content_type;?>
</td>
                <td class="am-hide-sm-only"><?php echo $_smarty_tpl->tpl_vars['val']->value->ctime;?>
</td>
                <td><div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <a class="am-btn am-btn-default am-btn-xs am-text-secondary" href="/service.php?business=dc&controller=member_resource&action=edit_show&id=<?php echo $_smarty_tpl->tpl_vars['val']->value->id;?>
'"><span class="am-icon-pencil-square-o"></span>编辑</a>
                  </div>
                  </div></td>
              </tr>
              <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
              
            </tbody>
          </table>    
        </form>
 <?php $_smarty_tpl->_subTemplateRender("file:./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 
<?php }
}
