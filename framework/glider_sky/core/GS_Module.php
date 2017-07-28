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
        if(Util_Class::checkClass($sClass,$this->_sAction)){
            $oObj = new $sClass();
        }
        debugVar($this);
        return "abc";
    }

}
