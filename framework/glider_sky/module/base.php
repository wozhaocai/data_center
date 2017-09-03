<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class GS_Module_Base {

    protected $_aParam = array();
    protected $_oApplicationObj = null;
    protected $_bIsApplication = false;
    protected $_aResult = array();
    protected $_oDB = null;
    protected $_iDBAffectNum = 0;
    protected $_aSpecialField = array();

    public abstract function run();
    
    public function setParams($aParam) {
        $this->_aParam = $aParam;
        $this->checkApplication();
        if($aParam["module"] != "Entity"){
            $this->loadApplication();
        }
    }

    public function loadApplication() {
        if ($this->_bIsApplication) {            
            $sAction = $this->_aParam['action'];
            $this->_aResult = $this->_oApplicationObj->$sAction();
        }
    }
    
    public function checkApplication(){
        if (strstr($this->_aParam["controller"], "_")) {
            list($sDirName, $sFileName) = explode("_", strtolower($this->_aParam["controller"]));
            $sClassFile = APPLICATION_PATH . "/application/controller/{$sDirName}/{$sFileName}.php";
            if (file_exists($sClassFile)) {
                require_once($sClassFile);
                $sClass = $this->_aParam["controller"] . "Controller";
                $this->_oApplicationObj = new $sClass($this->_aParam);                
                $this->_bIsApplication = true;                
            }
        }
    }

}
