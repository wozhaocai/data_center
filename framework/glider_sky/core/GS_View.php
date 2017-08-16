<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_View {
    private $_sBusiness = "";
    private $_aView = "";
    private $_sAction = "";
    private $_aParam = array();
    private $_aQuery = array();
    private $_oViewObj = null;

    public function __construct($sBusiness="",$aView="",$sAction="",$aParam = array()) {
        $this->_sBusiness = $sBusiness;
        $this->_aView = $aView;
        $this->_sAction = $sAction;
        $this->_aParam = $aParam;
    }
    
    private function filterParams(){
        $aParams = $this->_aParam;
        $aFilterArr = array("controller","business","action");
        foreach($aParams as $sKey=>$sVal){
            if(!in_array($sKey,$aFilterArr)){
                $this->_aQuery[$sKey] = $sVal;
            }
        }
        $this->_aQuery["business"] = $aParams['business'];
    }
    
    public function run(&$oTemplate){
        $this->filterParams();
        if(strstr($this->_aView["class"],"_")){
            list($sDirName,$sFileName) = explode("_",  strtolower($this->_aView["class"]));
            $sClassFile = APPLICATION_PATH."/application/view/{$sDirName}/{$sFileName}.php";
            if(file_exists($sClassFile)){
                require_once($sClassFile);
                $sClass = $this->_aView["class"]."View";
                $this->_oViewObj = new $sClass($oTemplate,$this->_aQuery);
                $sAction = $this->_aParam['action'];
                if($this->_aView["class"] == "Member_Meta"){
                    $i = strpos($sAction, '_', 0);
                    $sMethod = trim(substr($sAction,0,$i));
                    $sMeta = trim(substr($sAction,$i+1));
                    $this->_oViewObj->$sMethod($sMeta);
                }else{
                    $this->_oViewObj->$sAction();
                }
                $oTemplate->display($this->_aView['tpl']);
            }else{
                echo "not find {$sClassFile}";
                exit;
            }
        }
    }

}
