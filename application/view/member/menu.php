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
        $aRs = $this->getAllMenu();
        echo json_encode($aRs);
        exit(0);
    }
    
    public function updateParentMenu($sParentId,$num){
        $aMenu = array(
            "id" => $sParentId    
        );
        $aMenuParent = $this->gets($aMenu);
        $aMenu["child_count"] = $aMenuParent[0]->child_count + $num;
        $this->updateDB($aMenu);
        return $aMenuParent[0];
    }
    
    public function add(){
        $oParentMenu = $this->updateParentMenu($this->_aParams["pId"],1);
        list($sTitle,$sPath) = explode("|",urldecode(urldecode($this->_aParams["name"])));
        $aMenu = array(
            "title" => $sTitle,
            "path" => $sPath,
            "parent_id" => $this->_aParams["pId"],
            "mlevel" => $oParentMenu->mlevel+1
        );
        $iMenuId = $this->insert($aMenu);      
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
        $aRs = $this->gets($aMenu);
        $this->updateParentMenu($aRs[0]->parent_id,-1);
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","delete",$aMenu);
        $oModule->run();   
        exit(0);  
    }
    
    private function insert($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","insert",$aMenu);
        return $oModule->run();   
    }
    
    private function gets($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","gets",$aMenu);
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
                "name" => $row->title,
                "mlevel" => $row->mlevel
            );
            $aMenus[] = $aMenu;
        }
        //exit;
        return $aMenus;        
    }
    
    private function getAllMenu(){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","gets");
        $aRs = $oModule->run();
        $aMenus = array();
        foreach($aRs as $row){
            $aMenu = array(
                "id" => $row->id,
                "pId" => $row->parent_id,
                "name" => $row->title,
                "mlevel" => $row->mlevel
            );
            $aMenus[] = $aMenu;
        }
        //exit;
        return $aMenus;        
    }
}
