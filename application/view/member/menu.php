<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_MenuView extends BaseView{
    public function index(){        
    }
    
    public function show(){
        $aMenus = $this->query($this->_aParams);
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
        $aRs = $this->insert($aMenu);
        $aMenus = $this->query($aMenu);  
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
        $aRs = $this->updateDB($aMenu);
        exit(0);  
    }
    
    public function delete(){
        $aMenu = array(
            "id" => $this->_aParams["id"]
        );
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","delete",$aMenu);
        $oModule->run();   
        exit(0);  
    }
    
    private function insert($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","insert",$aMenu);
        return $oModule->run();   
    }
    
   private function updateDB($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","update",$aMenu);
        return $oModule->run();   
    }
    
    private function query($aParams){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","gets",$aParams);
        $aRs = $oModule->run();
        $aMenus = array();
        foreach($aRs as $row){
            $aMenu = array(
                "id" => $row->id,
                "pId" => $row->parent_id,
                "name" => $row->title
            );
            $aMenus[] = $aMenu;
        }
        return $aMenus;        
    }
}
