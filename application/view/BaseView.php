<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 class BaseView{
     protected $_aParams = array();
     protected $_oTemplate = null;
     private static $_aMenuSessionId = array("main_id","menu_main_id","menu_sub_id");
     
     public function __construct(&$oTemplate,$aParams) {
         $this->_aParams = $aParams;
         $this->_oTemplate = $oTemplate;
         $this->initMenu();
     }
     
     protected function checkVar($sOption){
        $this->_aParams[$sOption] = $this->_aParams["query_id"];
        $aRs = $this->gets();
        $aUsers = array();
        if($aRs){
            $aUsers = $aRs[0];
        }
        echo json_encode($aUsers);    
        exit(0);
    }
    
    public function initMenu(){
        foreach(self::$_aMenuSessionId as $sField){
            if(!empty($this->_aParams[$sField])){
                $_SESSION[$sField] = $this->_aParams[$sField];
            }elseif(!empty($_SESSION[$sField])){
                $this->_aParams[$sField] = $_SESSION[$sField];
            }
        }
        if(empty($this->_aParams['main_id'])){
            if(!empty($this->_aParams["menu_sub_id"])){
                $aPassMenusId = array();
                $aPassMenu = array();
                $this->getParentMenu($this->_aParams["menu_sub_id"], $aPassMenusId,$aPassMenu);  
                $this->_oTemplate->assign("aCheckMenu",$aPassMenusId);
                $aPassMenu = array_reverse($aPassMenu);                
                $this->_oTemplate->assign("aPassMenu",$aPassMenu);
                $sMainId = array_pop($aPassMenusId);
            }else{
                $sMainId = 14;
            }
        }else{
            $sMainId = $this->_aParams['main_id'];
        }
        
        $this->_oTemplate->assign("username",$_SESSION["username"]);
        $oModule = new GS_Module($this->_aParams['business'],"Entity","Admin_Menus","getMenus",array());
        $aMenus = $oModule->run(); 
        $this->_oTemplate->assign("aMainMenu",$aMenus); 
        $this->_oTemplate->assign("aSubMenu",$aMenus["menu_{$sMainId}"]);
        if(!empty($this->_aParams["menu_sub_title"])){
            $this->_oTemplate->assign("current_menu",$this->_aParams["menu_sub_title"]);
        }else{
            $this->_oTemplate->assign("current_menu","");
        }
    } 
    
    function getParentMenu($id,&$arr,&$arr2){
        $aParams = array(
            "id" => $id
        );
        $oModule = new GS_Module($this->_aParams['business'],"Entity","menus","gets",$aParams);
        $aMenus = $oModule->run();        
        if($aMenus[0]->parent_id != "99999999"){
            $arr[]=$aMenus[0]->id;// $arr[$v['id']]=$v['name'];
            $arr2[]=$aMenus[0];
            $this->getParentMenu($aMenus[0]->parent_id,$arr,$arr2);             
        }
        return true;
    }     
 }
