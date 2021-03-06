<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module {
    private $_sBusiness = "";
    private $_sModule = "";
    private $_sController = "";
    private $_sAction = "";
    private $_aParam = array();

    public function __construct($sBusiness="",$sModule="",$sController="",$sAction="",$aParam = array()) {
        $this->_sBusiness = $sBusiness;
        $this->_sModule = $sModule;
        $this->_sController = $sController;
        $this->_sAction = $sAction;
        $this->_aParam["query"] = $aParam;
    }
    
    public function getParams(){
        return $this->_aParam;
    }
    
    public function run($one=false){
        $sClass = "GS_Module_".$this->_sModule;     
        if(class_exists($sClass)){
            $oObj = new $sClass();
        }else{
            return false;
        }
        $sAction = $this->_sAction;
        $this->_aParam["business"] = $this->_sBusiness;
        $this->_aParam["controller"] = $this->_sController;
        $this->_aParam["action"] = $this->_sAction;
        $this->_aParam["module"] = $this->_sModule;
        $oObj->setParams($this->_aParam);
        $aRs = $oObj->run();
        if($this->_sModule == "Entity"){
            $this->_aParam['iDbAffectNum'] = $oObj->getDbAffectNum();
            if($one){
                return $aRs[0];
            }
        }
        return $aRs;
    }    
}
