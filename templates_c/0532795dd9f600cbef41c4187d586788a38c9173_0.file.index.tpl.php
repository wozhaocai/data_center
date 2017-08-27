<?php
/* Smarty version 3.1.30, created on 2017-08-26 21:36:13
  from "D:\glider_sky\data_center\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59a1794dcb3e34_83688601',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0532795dd9f600cbef41c4187d586788a38c9173' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\index.tpl',
      1 => 1502511357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_59a1794dcb3e34_83688601 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form action="/guest.php" method="post" name="f" id="f">
    <table width="800">
        <tr>
            <td width="200">&nbsp;</td>
            <td width="200">&nbsp;</td>
            <td width="400">&nbsp;</td>
        </tr>
        <tr>
            <td align="right">
                <div>账户名：</div>
            </td>
            <td>
                <div class="input_outer">                                                            
                    <span class="u_user"></span>
                    <input id="username" name="username" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户" onChange='check("username")'>
                </div>
            <td>
            <td id="usernameCheck" class="check" hidden="true">*账户名不能为空</td> 
        </tr>
        <tr>
            <td align="right">
                <div>输入密码：</div>
            </td>
            <td>
                <div class="input_outer">
                    <span class="us_uer"></span>
                    <input name="password" id="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码" onChange='check("password")'>
                </div>
            </td>
            <td id="passwordCheck" class="check" hidden="true">*password length less than 8</td> 
        </tr>        
        <tr>
            <td></td>
            <td>
                <div class="mb2">
                    <a class="act-but submit" href="javascript:void(0);" onclick="login();" style="color: #FFFFFF">登录</a>
                </div>
                <div class="mb2">
                    <a class="text" href="./guest.php?business=dc&controller=reg&action=show" style="color: #FFFFFF">注册</a>
                </div>
            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['err_msg']->value;?>

                <input type="hidden" id="business" name="business" value="dc">
                <input type="hidden" id="controller" name="controller" value="reg">
                <input type="hidden" id="action" name="action" value="login">
            </td>
        </tr>
    </table>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
