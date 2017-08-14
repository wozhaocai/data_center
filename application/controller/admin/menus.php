<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Admin_MenusController Extends BaseController{    
    
    public function insert($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","input",$aMenu);
        return $oModule->run();   
    }
    
    public function updateDB($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","update",$aMenu);
        return $oModule->run();   
    }
    
    public function delete($aMenu){
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","delete",$aMenu);
        $oModule->run();   
        exit(0);    
    }
    
    public function query($aParams){
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

