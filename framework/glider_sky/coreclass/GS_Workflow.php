<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Workflow {

    private $_sBusiness = "";
    private $_sWorkflowId = "";
    private $_sAction = "";
    private $_aParam = array();
    private $_aQuery = array();
    private $_oObj = null;
    private $_aFlowData = array();

    public function __construct($sBusiness = "", $sWorkflowId = "", $sAction = "", $aParam = array()) {
        $this->_sBusiness = $sBusiness;
        $this->_sWorkflowId = $sWorkflowId;
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
        if (!empty(GS_Route::$_aConfig["workflow"][$this->_sWorkflowId])) {
            $aScriptClass = GS_Route::$_aConfig["workflow"][$this->_sWorkflowId];
            if (strstr($aScriptClass, "_")) {
                list($sDirName, $sFileName) = explode("_", strtolower($aScriptClass));
                $sClassFile = APPLICATION_PATH . "/application/workflow/{$sDirName}/{$sFileName}.php";
                if (file_exists($sClassFile)) {
                    require_once($sClassFile);
                    $sClass = $this->_aView["class"] . "WorkFlow";
                    $this->_oObj = new $sClass($this->_aQuery);
                    $sAction = $this->_sAction;
                    return $this->_oObj->$sAction();
                } else {
                    echo "not find {$sClassFile}";
                    exit;
                }
            }
        }else{  
            $oConfig = $this->getWorkflowConfig();
            $this->parseConfig($oConfig);
            exit;
        }
    }
    
    private function runFlow($oFlow){
        if(!empty($oFlow->data)){
            $this->runFlowData($oFlow->data);
        }elseif(!empty($oFlow->job)){
            $this->runFlowJob($oFlow->job);
        }
    }
    
    private function runFlowData($oData){
        $sModule = (string) $oData->module;
        $this->_aQuery["business"] = (string) $oData->business_id;
        $this->_aQuery["controller"] = (string) $oData->service_id;
        $this->_aQuery["action"] = (string) $oData->action;
        $sIsNull = (string) $oData->is_null;
        if($sModule == "entity"){
            $oModule = new GS_Module($this->_aQuery["business"],"Entity",$this->_aQuery["controller"],$this->_aQuery["action"],$this->_aQuery);
            $aRs = $oModule->run();
            if($sIsNull == "false" and empty($aRs)){
                echo "没找到数据，请确认\n";
                exit(0);
            }
            $this->_aFlowData = $aRs;       
        }
    }
    
    private function runFlowJob($oJob){
        $sModule = (string) $oJob->module;
        $this->_aQuery["business"] = (string) $oJob->business_id;
        $this->_aQuery["controller"] = (string) $oJob->service_id;
        $this->_aQuery["action"] = (string) $oJob->action;
        $sIsNull = (string) $oJob->is_null;
        if($sModule == "spider"){      
            foreach($this->_aFlowData as $row){
                $this->_aQuery["data"] = $row;
                $this->_aQuery["code"] = $this->_aQuery["action"];
                $oModule = new GS_Module($this->_aQuery["business"],"Spider",$this->_aQuery["controller"],"gets",$this->_aQuery);
                $aRs = $oModule->run();
                if($sIsNull == "false" and empty($aRs)){
                    echo "没找到数据，请确认\n";
                    exit(0);
                }
            }
        }
    }
    
    private function parseConfig($oConfig){
        foreach($oConfig->flows as $oFlows){
            if($this->_sAction != (string)$oFlows["id"]){
                continue;
            }
            foreach($oFlows as $oFlow){
                $this->runFlow($oFlow);
            }
        }
    }
    
    private function getWorkflowConfig(){
        $this->_aQuery["service_id"] = $this->_sWorkflowId;
        $oModule = new GS_Module($this->_sBusiness,"Entity","resource","gets",$this->_aQuery);
        $aRs = $oModule->run();
        if(!empty($aRs)){         
            $sConfig = urldecode(urldecode($aRs[0]->content));
            $sConfig = str_replace("\\", "", $sConfig);
            $oXml = new Util_Xml("", $sConfig);
            return $oXml->getContent(); 
        }else{
            echo "没找到相应的工作流配置，请确认\n";
            exit;
        }
    }

}
