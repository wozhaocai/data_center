<?php
/* Smarty version 3.1.30, created on 2017-08-26 21:40:51
  from "D:\glider_sky\data_center\templates\member\iframe.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a17a635d35b9_34596327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95bac1e2bd3967886c4d0bc766db369e427df06b' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\member\\iframe.tpl',
      1 => 1503150977,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./header.tpl' => 1,
    'file:./footer.tpl' => 1,
  ),
),false)) {
function content_59a17a635d35b9_34596327 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> <?php echo $_smarty_tpl->tpl_vars['current_menu']->value;?>
</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#"><?php echo $_smarty_tpl->tpl_vars['current_menu']->value;?>
</a></dl>
      
    </div>
	
	<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">
            <iframe src="<?php echo $_smarty_tpl->tpl_vars['iframe_url']->value;?>
" id="iframe1" width="700" height="500" frameborder="0" scrolling="auto"></iframe>
        </div>     
</div>  
      
<?php $_smarty_tpl->_subTemplateRender("file:./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
 <?php }
}
