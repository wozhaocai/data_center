<?php
/* Smarty version 3.1.30, created on 2017-09-02 00:20:30
  from "D:\glider_sky\data_center\templates\member\resource_edit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a988ce09a2f6_67376541',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c274a719f85bf37b5578fbdcbfb34ea8b4029fc' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\member\\resource_edit.tpl',
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
function content_59a988ce09a2f6_67376541 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="admin-biaogelist">
	
    <div class="listbiaoti am-cf">
      <ul class="am-icon-flag on"> 资源列表</ul>
      
      <dl class="am-icon-home" style="float: right;"> 当前位置： 首页 > <a href="#">资源列表</a></dl>

      
      
    </div>
	
    <div class="fbneirong">
      <form class="am-form" id="resource_form" action="/service.php?business=dc&controller=member_resource&action=edit_submit" method="post">
        <div class="am-form-group am-cf">
          <div class="zuo">service_id：</div>
          <div class="you">
              <input type="text" name="service_id" class="am-input-sm" id="doc-ipt-text-1" value="<?php echo $_smarty_tpl->tpl_vars['service_id']->value;?>
">
          </div>
        </div>        
        <div class="am-form-group am-cf">
          <div class="zuo">资源类型</div>
          <div class="you">
            <select name="source_type" data-am-selected="{btnSize: 'sm'}">
              <option value="table" <?php if ($_smarty_tpl->tpl_vars['source_type']->value == "table") {?>selected<?php }?>>table</option>
              <option value="workflow" <?php if ($_smarty_tpl->tpl_vars['source_type']->value == "workflow") {?>selected<?php }?>>workflow</option>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">文件类型</div>
          <div class="you">
            <select name="content_type" data-am-selected="{btnSize: 'sm'}">
              <option value="xml" <?php if ($_smarty_tpl->tpl_vars['content_type']->value == "xml") {?>selected<?php }?>>xml</option>
            </select>
          </div>
        </div>
        <div class="am-form-group am-cf">
          <div class="zuo">内容：</div>
          <div class="you">
            <textarea name="resource_content" id="resource_content" class="" rows="30" id="doc-ta-1"><?php echo $_smarty_tpl->tpl_vars['resource_content']->value;?>
</textarea>
          </div>
        </div> 
        <div class="am-form-group am-cf">
          <div class="you" style="margin-left: 11%;">
              <button type="submit" id="sub" class="am-btn am-btn-secondary am-radius">保存</button>
              <input type="hidden" id="submit_action" name="submit_action" value="<?php echo $_smarty_tpl->tpl_vars['submit_action']->value;?>
">
              <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
          </div>
        </div>
      </form>
    </div>
<!--[if (gte IE 9)|!(IE)]><!--> 
<?php echo '<script'; ?>
 src="/js/query.js"><?php echo '</script'; ?>
>
<!--<![endif]-->
 <?php $_smarty_tpl->_subTemplateRender("file:./footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 
<?php }
}
