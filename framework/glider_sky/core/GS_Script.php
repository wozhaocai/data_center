<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Script {

    private $_sBusiness = "";
    private $_sScriptId = "";
    private $_sAction = "";
    private $_aParam = array();
    private $_aQuery = array();
    private $_oObj = null;

    public function __construct($sBusiness = "", $sScriptId = "", $sAction = "", $aParam = array()) {
        $this->_sBusiness = $sBusiness;
        $this->_sScriptId = $sScriptId;
        $this->_sAction = $sAction;
        $this->_aParam = $aParam;
    }

    private function filterParams() {
        $aParams = $this->_aParam;
        $aFilterArr = array("s", "b", "a");
        foreach ($aParams as $sKey => $sVal) {
            if (!in_array($sKey, $aFilterArr)) {
                $this->_aQuery[$sKey] = $sVal;
            }
        }
        $this->_aQuery["business"] = $aParams['b'];
    }

    public function run() {
        $this->filterParams();
        if (!empty(GS_Route::$_aConfig["script"][$this->_sScriptId])) {
            $aScriptClass = GS_Route::$_aConfig["script"][$this->_sScriptId];
            if (strstr($aScriptClass, "_")) {
                list($sDirName, $sFileName) = explode("_", strtolower($aScriptClass));
                $sClassFile = APPLICATION_PATH . "/application/script/{$sDirName}/{$sFileName}.php";
                if (file_exists($sClassFile)) {
                    require_once($sClassFile);
                    $sClass = $this->_aView["class"] . "Script";
                    $this->_oObj = new $sClass($this->_aQuery);
                    $sAction = $this->_sAction;
                    return $this->_oObj->$sAction();
                } else {
                    echo "not find {$sClassFile}";
                    exit;
                }
            }
        }else{            
            $i = strpos($this->_sScriptId, '_', 0);
            $sModule = trim(substr($this->_sScriptId,0,$i));
            $this->_aQuery["code"] = trim(substr($this->_sScriptId,$i+1));
            $sController = "";
            if($sModule == "Spider"){
                $sController = "spider";   
            }
            if(!empty($sController)){
                $oModule = new GS_Module($this->_sBusiness,$sModule,$sController,$this->_sAction,$this->_aQuery);
                debugVar($oModule->run());
            }
        }
    }

}
