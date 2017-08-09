<?php
/* Smarty version 3.1.30, created on 2017-08-09 12:55:25
  from "D:\wozhaocai\data_center\templates\reg.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_598a95bdb12238_25449797',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd682ead63d525639f573021f425b73c9f91cf780' => 
    array (
      0 => 'D:\\wozhaocai\\data_center\\templates\\reg.tpl',
      1 => 1502254523,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_598a95bdb12238_25449797 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>login</title>
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="css/component.css" />
<!--[if IE]>
<?php echo '<script'; ?>
 src="js/html5.js"><?php echo '</script'; ?>
>
<![endif]-->
</head>
<body>
		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>我找财</h3>
                                                <p>&nbsp;</p>
						<form action="#" name="f" method="post">
                                                    <table width="500">
                                                        <tr>
                                                            <td>
                                                                <div>账户名：</div>
                                                            </td>
                                                            <td>
                                                                <div class="input_outer">                                                            
                                                                    <span class="u_user"></span>
                                                                    <input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
                                                                </div>
                                                            <td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div>输入密码：</div>
                                                            </td>
                                                            <td>
                                                                <div class="input_outer">
                                                                    <span class="us_uer"></span>
                                                                    <input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div>再次输入密码：</div>
                                                            </td>
                                                            <td>
                                                                <div class="input_outer">
                                                                    <span class="us_uer"></span>
                                                                    <input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div>邮箱：</div>
                                                            </td>
                                                            <td>
                                                                <div class="input_outer">                                                            
                                                                    <span class="u_user"></span>
                                                                    <input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">
                                                                </div>
                                                            <td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td>
                                                                <div class="mb2">
                                                                    <a class="act-but submit" href="javascript:;" style="color: #FFFFFF">提交</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
						</form>
                                                <p>&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;</p>
                                                <p>&nbsp;&nbsp;</p>
                                                <div><a class="text" style="color: #00ff00 !important; position:absolute; z-index:500;">关于我们</a></div>
					</div>                                        
				</div>                            
			</div>                    
		</div><!-- /container -->
		<?php echo '<script'; ?>
 src="js/TweenLite.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/EasePack.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/rAF.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="js/demo-1.js"><?php echo '</script'; ?>
>		
	</body>
</html><?php }
}
