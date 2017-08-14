<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_UserView extends BaseView{
    public function index(){
        $this->_oTemplate->assign("username",$_SESSION["username"]);        
        $oModule = new GS_Module($this->_aParams['business'],"Entity","Admin_Menus","getMenus",array());
        $aMenus = $oModule->run(); 
        $this->_oTemplate->assign("aMainMenu",$aMenus); 
        if(empty($this->_aParams['main_id'])){
            $this->_oTemplate->assign("aSubMenu",$aMenus["menu_14"]);
        }else{
            $this->_oTemplate->assign("aSubMenu",$aMenus["menu_{$this->_aParams['main_id']}"]);
        }
    } 
}