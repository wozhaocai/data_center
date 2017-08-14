<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_MenuView extends BaseView{
    public function show(){
        $oMenu = new Admin_MenusController($this->_aParams);
        $aMenus = $this->$oMenu($this->_aParams);
        echo json_encode($aMenus);
        exit(0);
    }
    
    public function add(){
        list($sTitle,$sPath) = explode("|",urldecode(urldecode($this->_aParams["name"])));
        $aMenu = array(
            "title" => $sTitle,
            "path" => $sPath,
            "parent_id" => $this->_aParams["pId"]
        );
        $oMenu = new Admin_MenusController($this->_aParams);
        $aRs = $oMenu->insert($aMenu);
        $aMenus = $oMenu->query($aMenu);  
        echo json_encode($aMenus);
        exit(0);
    }
    
    public function update(){
        list($sTitle,$sPath) = explode("|",urldecode(urldecode($this->_aParams["name"])));
        $aMenu = array(
            "title" => $sTitle,
            "path" => $sPath,
            "id" => $this->_aParams["id"]
        );
        $oMenu = new Admin_MenusController($this->_aParams);
        $aRs = $oMenu->updateDB($aMenu);
        exit(0);  
    }
    
    public function delete(){
        $aMenu = array(
            "id" => $this->_aParams["id"]
        );
        $oMenu = new Admin_MenusController($this->_aParams);
        $oMenu->delete($aMenu);
        exit(0);  
    }
    
    
}
