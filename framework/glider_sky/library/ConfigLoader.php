<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ConfigLoader{
    private $_sConfigFile = "";
    private $_aConfig = array();
    public function __construct($sConfigFile) {
        $this->_sConfigFile = $sConfigFile;
    }
    
    public function loadSysFile(){
        $oFile = new Util_IniFile($this->_sConfigFile);
        $this->_aConfig = $oFile->parse()->getConfig();
        $this->loadEnv();
        $this->reloadConfig();
        return $this->_aConfig;
    }

    private function loadEnv() {
        if (isset($this->_aConfig['common']["test"]["host"])) {
            $aTestServer = explode(",", $this->_aConfig['common']["test"]["host"]);
            $server_name = php_uname('n');
            if (in_array($server_name,$aTestServer)) {
                define("IDC", 'test');
            } else {
                define("IDC", 'online');
            }
        }        
    }
    
    private function reloadConfig(){
        $aConfig = $this->_aConfig;
        $this->_aConfig = array_merge($aConfig["common"],$aConfig[IDC]);        
    }

}
