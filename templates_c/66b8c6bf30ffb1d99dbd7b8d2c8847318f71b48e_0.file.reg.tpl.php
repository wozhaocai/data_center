<?php
/* Smarty version 3.1.30, created on 2017-09-09 14:07:23
  from "D:\glider_sky\data_center\templates\reg.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59b3851bafe186_48068712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '66b8c6bf30ffb1d99dbd7b8d2c8847318f71b48e' => 
    array (
      0 => 'D:\\glider_sky\\data_center\\templates\\reg.tpl',
      1 => 1504937216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_59b3851bafe186_48068712 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div style="background-color:#FAFAFA;height:700px;margin:0 auto;">
        <div class="login-topBg1">        
            <div class="login-topStyle" >          
                <!--在点击注册时出现样式login-topStyle3登录框，而login-topStyle2则消失-->
                <div class="login-topStyle2" id="loginStyle" style="margin-top: 75px;">
                    <h3><font color="#000000">注册</font></h3>
                    <p>&nbsp;</p>
                    <!--输入错误提示信息，默认是隐藏的，把display:none，变成block可看到-->
                    <form action="/guest.php" method="post" name="f" id="f">
                    <span class="error-information" id="usernameCheck" hidden="false">用户名不能为空</span> 
                    <span class="error-information" id="passwordCheck" hidden="false">密码长度不能少于8位</span> 
                    <span class="error-information" id="cpasswordCheck" hidden="false">两次密码不一致</span> 
                    <span class="error-information" id="emailCheck" hidden="false">邮箱名不合法</span> 
                    <span class="error-information" id="regsignCheck" hidden="false">接受协议才可以继续注册</span> 
                    <div><p>&nbsp;</p></div>
                    <div class="ui-form-item loginUsernameReg">
                        <span class="ui-form-item input_text">&nbsp;&nbsp;&nbsp;&nbsp用户名</span> 
                        <input type="username" id="username" name="username" placeholder="" onChange='check("username")'>
                        <input id="is_reg" name="is_reg" type="hidden" value="reg">
                    </div>
                    <div class="ui-form-item loginPasswordReg">
                        <span class="ui-form-item input_text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码</span> 
                        <input type="password" name="password" id="password" placeholder="" onChange='check("password")'>
                    </div>
                    <div class="ui-form-item loginPasswordReg">
                        <span class="ui-form-item input_text">请再次输入密码</span> 
                        <input type="password" name="cpassword" id="cpassword" placeholder="" onChange='check("cpassword")'>
                    </div>
                    <div class="ui-form-item loginUsernameReg">
                        <span class="ui-form-item input_text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱</span> 
                        <input type="username" id="email" name="email" placeholder="" onChange='check("email")'>
                    </div>
                    <div class="ui-form-item">
                        <input type="checkbox" id="regsign" name="regsign" value="accept"/>
                        <span class="ui-form-item input_text">我同意签署下面《用户注册协议》</a></span>
                    </div>
                    <div class="ui-form-item">
                        <iframe src="reg_text.html" id="iframe1" width="50%" height="300" frameborder="1" scrolling="auto"></iframe>
                    </div>
                    <div class="login_reme">
                        <a class="btnStyle btn-register" href="javascript:void(0);" onclick="validate();"> 注册</a> </div>
                        <input type="hidden" id="business" name="business" value="dc">
                        <input type="hidden" id="controller" name="controller" value="reg">
                        <input type="hidden" id="action" name="action" value="register">    
                        <input type="hidden" id="action" name="vendor" value="guest"> 
                    </div>
                    </form>
                </div>
            </div>
        </div>        
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
