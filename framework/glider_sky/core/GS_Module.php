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
        $this->_aParam = $aParam;
    }
    
    public function run(){
        $sClass = "GS_Module_".$this->_sModule;     
        if(class_exists($sClass)){
            $oObj = new $sClass();
        }
        $sAction = $this->_sAction;
        $this->_aParam["business"] = $this->_sBusiness;
        $this->_aParam["controller"] = $this->_sController;
        $this->_aParam["action"] = $this->_sAction;
        $oObj->setParams($this->_aParam);
        return $oObj->run();
    }

}
