<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class User_RegView extends BaseView{
    
    public function show(){
    }
    
    public function register(){     
        $this->_aParams["password"] = md5($this->_aParams["password"]);
        $oModule = new GS_Module($this->_aParams['business'],"Entity","users","insert",$this->_aParams);
        $this->_aParams["uid"] = $oModule->run();
        $this->_aParams["gid"] = GliderSky::$aConfig["group"]["init_id"];
        $oModule = new GS_Module($this->_aParams['business'],"Entity","user_group_map","insert",$this->_aParams);
        $aResult = $oModule->run();
        $_SESSION["username"] = $this->_aParams["username"];
        $_SESSION["business"] = $this->_aParams["business"];
        header("Location:/service.php?business={$this->_aParams['business']}&controller=member&action=index");
    }
    
    public function login() {
        $sInputPwd = md5($this->_aParams["password"]);
        unset($this->_aParams["password"]);
        $aUsers = $this->gets();
        if(empty($aUsers)){
            header("Location:/index.php?err_msg=没有该用户{$this->_aParams["username"]}");
        }else{
            if($sInputPwd != $aUsers[0]->password){
                header("Location:/index.php?err_msg=登录密码错误");
            }else{
                $_SESSION["username"] = $this->_aParams["username"];
                $_SESSION["business"] = $this->_aParams["business"];
                header("Location:/service.php?business={$this->_aParams['business']}&controller=member&action=index");
            }
        }
    }
    
    public function gets(){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","users","gets",$this->_aParams);
        return $oModule->run();
    }
    
    public function check_username(){
        $this->checkVar("username");
    }
    
    public function check_email(){
        $this->checkVar("email");
    }
}
