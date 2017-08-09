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
<script src="js/html5.js"></script>
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
						<form action="#" name="f" onSubmit="return validate()">
                                                    <table width="600">
                                                        <tr>
                                                        <td width="100">&nbsp;</td>
                                                        <td width="200">&nbsp;</td>
                                                        <td width="300">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="right">
                                                                <div>账户名：</div>
                                                            </td>
                                                            <td>
                                                                <div class="input_outer">                                                            
                                                                    <span class="u_user"></span>
                                                                    <input name="username" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户" onChange='check("username")'>
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
                                                            <td align="right" width="100">
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
                                                                    <a class="act-but submit" href="javascript:;" style="color: #FFFFFF">注册提交</a>
                                                                </div>
                                                            </td>
                                                            <td></td>
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
		<script src="js/TweenLite.min.js"></script>
		<script src="js/EasePack.min.js"></script>
                <script src="js/reg.js"></script>
		<script src="js/rAF.js"></script>
		<script src="js/demo-1.js"></script>		
	</body>
</html>