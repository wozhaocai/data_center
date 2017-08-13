<?php
/* Smarty version 3.1.30, created on 2017-08-13 03:21:42
  from "D:\glider_sky\data_center\templates\reg.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_598fc5c67c4f50_27124354',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66b8c6bf30ffb1d99dbd7b8d2c8847318f71b48e' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\reg.tpl',
      1 => 1502594106,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_598fc5c67c4f50_27124354 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <input id="is_reg" name="is_reg" type="hidden" value="reg">
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
            <td align="right">
                <div>再次输入密码：</div>
            </td>
            <td>
                <div class="input_outer">
                    <span class="us_uer"></span>
                    <input name="cpassword" id="cpassword" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码"  onChange='check("cpassword")'>
                </div>
            </td>
            <td id="cpasswordCheck" class="check" hidden="true">*Two passwd is not same</td> 
        </tr>
        <tr>
            <td align="right">
                <div>邮箱：</div>
            </td>
            <td>
                <div class="input_outer">                                                            
                    <span class="u_user"></span>
                    <input  name="email" id="email" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户" onChange='check(this.id)'>
                </div>
            </td>
            <td id="emailCheck" class="check" hidden="true">*电子邮件名非法！</td> 
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="mb2">
                    <a class="act-but submit" href="javascript:void(0);" onclick="validate();" style="color: #FFFFFF">注册提交</a>
                </div>
            </td>
            <td>
                <input type="hidden" id="business" name="business" value="dc">
                <input type="hidden" id="controller" name="controller" value="reg">
                <input type="hidden" id="action" name="action" value="register">
            </td>
        </tr>
    </table>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
