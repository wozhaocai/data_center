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
        $server_name = php_uname('n');
        foreach($this->_aConfig as $sEnv => $aEnv){
            if(!empty($aEnv["host"]["ip"])){
                $sCurrentServer = explode(",", $aEnv["host"]["ip"]);            
                if (in_array($server_name,$sCurrentServer)) {
                    define("IDC", $sEnv);
                    break;
                }
            }
        }
        if(!defined('IDC')){
            define("IDC", 'online');
        }
        if (isset($this->_aConfig['common']["template"]["engine"])){
            if($this->_aConfig['common']["template"]["engine"] == "smarty"){
                if (isset($this->_aConfig['common']["smarty"]["dir"])) {
                    define("SMARTY_DIR", $this->_aConfig['common']["smarty"]["dir"]);
                }
            }
        }        
    }
    
    private function reloadConfig(){
        $aConfig = $this->_aConfig;
        $this->_aConfig = array_merge($aConfig["common"],$aConfig[IDC]);        
    }

}
