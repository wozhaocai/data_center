<{include file="header.tpl"}>
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
                <{$err_msg}>
                <input type="hidden" id="business" name="business" value="dc">
                <input type="hidden" id="controller" name="controller" value="reg">
                <input type="hidden" id="action" name="action" value="login">
            </td>
        </tr>
    </table>
</form>
<{include file="footer.tpl"}>
