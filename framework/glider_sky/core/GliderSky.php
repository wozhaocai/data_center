<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GliderSky{
    private $_sConfPath = '';
    private $_oLog = null;
    private $_oMsg = null;
    private $_oConfig = null;
    public static $aConfig = array();
    private $_oTemplate = null;
    public function __construct($sConfPath) {     
        if(empty($sConfPath)){
            $this->_oMsg->sendErrorExit(1);
        }else{
            $this->_sConfPath = $sConfPath;
        }
        $this->loadConf();
    }
    
    public function run(){        
    }
    
    private function loadConf() {
        $this->_oLog = new Util_Log();
        $this->_oMsg = new Util_Msg();
        $this->_oConfig = new ConfigLoader($this->_sConfPath);
        self::$aConfig = $this->_oConfig->loadSysFile();
    }
    
    public function setTemplate(GS_Template &$oTemplate){
        $this->_oTemplate = $oTemplate;
    }
    
}
