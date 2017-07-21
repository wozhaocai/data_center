<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Util_IniFile{
    private $_sIniFile = "";
    private $_aConfig = array();
    public function __construct($sIniFile) {
        $this->_sIniFile = $sIniFile;
    }
    
    public function parse(){
        $oFile = new Util_File();
        $aContent = $oFile->readIni($this->_sIniFile);
        $sEnv = '';
        foreach($aContent as $sContent){            
            if(!empty($sContent)){
                preg_match('/^\[\w+\]$/i', $sContent,$res);
                if(!empty($res[0])){
                    $sEnv = substr($res[0],1,-1);
                    continue;
                }
                list($sField,$sValue) = explode("=",$sContent);
                $this->_aConfig[$sEnv][trim($sField)] = $this->assign($sValue,$sEnv);
            }
        }
        debugVar($this->_aConfig);
    }
    
    public function assign($sValue, $sEnv) {
        $sValue = trim($sValue);
        $aConstant = get_defined_constants(true);
        foreach ($aConstant["user"] as $sKey => $sVal) {
            if (strstr($sValue, "{" . $sKey . "}")) {
                $sValue = str_replace("{" . $sKey . "}", $sVal, $sValue);
            };
        }
        if (!empty($this->_aConfig[$sEnv])) {
            foreach ($this->_aConfig[$sEnv] as $sSubKey => $sSubVal) {
                if (strstr($sValue, "{" . $sSubKey . "}")) {
                    $sValue = str_replace("{" . $sSubKey . "}", $sSubVal, $sValue);
                };
            }
        }
        return $sValue;
    }

}
