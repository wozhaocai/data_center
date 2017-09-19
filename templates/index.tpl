<{include file="./header.tpl"}>    
    <div class="login-topBg">
      <div class="login-topBg1">        
        <div class="login-topStyle" >          
          <!--在点击注册时出现样式login-topStyle3登录框，而login-topStyle2则消失-->
          <div class="login-topStyle3" id="loginStyle" style="margin-top: 75px;">
            <h3>用户平台登录</h3>
            <!--输入错误提示信息，默认是隐藏的，把display:none，变成block可看到-->
            <form action="/guest.php" method="post" name="f" id="f">
            <div class="error-information" style="display:none;">您输入的密码不正确，请重新输入</div>
            <div class="ui-form-item loginUsername">
              <input type="username" id="username" name="username" placeholder="用户名" onChange='check("username")'>
              <input id="is_reg" name="is_reg" type="hidden" value="login">
            </div>
            <div class="ui-form-item loginPassword">
              <input type="password" name="password" id="password" placeholder="请输入密码" onChange='check("password")'>
            </div>
            <div class="login_reme">
              <!--<input type="checkbox">
              <a class="reme1">记住账号</a> <a class="reme3" href="password.html">忘记密码?</a>--><a class="reme2" href="./guest.php?business=dc&controller=reg&action=show&vendor=guest">立即注册</a> </div>
            <span class="error_xinxi" id="usernameCheck" hidden="false">用户名不能为空</span> 
            <span class="error_xinxi" id="passwordCheck" hidden="false">密码长度不能少于8位</span> 
            <a class="btnStyle btn-register" href="javascript:void(0);" onclick="login();"> 立即登录</a> </div>
            <input type="hidden" id="business" name="business" value="dc">
            <input type="hidden" id="controller" name="controller" value="reg">
            <input type="hidden" id="action" name="action" value="login">
            <input type="hidden" id="action" name="vendor" value="guest"> 
           </form>
        </div>
      </div>
    </div>
  </div>
  <div class="loginCen" style="margin-top: 55px;">
    <div class="login-center">
      <div class="loginCenter-moudle">
        <div class="loginCenter-moudleLeft" style="margin-right: 60px;"> &nbsp;</div>
        <div class="loginCenter-moudleRight" style="  width: 1067px;"> 
          <!--第一个--> 
          <a class="loginCenter-mStyle loginCenter-moudle1" id="moudleRemove" style=" display:block;width: 340px;">
           <span class="moudle-img"><img src="img/login_bg_01.png"></span>
            <span class="moudle-text"> 
            <span class="moudle-text1" style="font-family:'微软雅黑'">悟心，悟道
</span>
            <span class="moudle-text2" style="font-family:'微软雅黑'">成就人生大道</span> 
            </span>
             </a> 
           <!--第二个--> 
          <a class="loginCenter-mStyle loginCenter-moudle2" style=" display:block; width: 357px;" id="moudleRemove2" > 
          <span class="moudle-img"><img src="img/login_bg_02.png"></span> 
           <span class="moudle-text">
            <span class="moudle-text1" style="font-family:'微软雅黑'">惜一兵一卒 
</span>
            <span class="moudle-text2" style="font-family:'微软雅黑'">善谋投资之局</span> 
           </span>
             </a> 
            <!--第三个--> 
                 <a class="loginCenter-mStyle loginCenter-moudle3" style=" display:block;" id="moudleRemove3" > 
                 <span class="moudle-img"><img src="img/login_bg_03.png"></span> 
                   <span class="moudle-text"> 
                 <span class="moudle-text"> <span class="moudle-text1" style="font-family:'微软雅黑'">砥砺前行，勤于耕耘 
</span>
                  <span class="moudle-text2" style="font-family:'微软雅黑'">不论成败，只求无悔于心</span>
            </span>
            </span>
                    </a> 
         
             </div>
      </div>
    </div>
  </div>  
  <{include file="./footer.tpl"}>