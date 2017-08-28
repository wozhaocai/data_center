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
        $this->loadDB();
        $this->loadApplication();
    }

    public function loadApplication() {
        if (strstr($this->_aParam["controller"], "_")) {
            list($sDirName, $sFileName) = explode("_", strtolower($this->_aParam["controller"]));
            $sClassFile = APPLICATION_PATH . "/application/controller/{$sDirName}/{$sFileName}.php";
            if (file_exists($sClassFile)) {
                require_once($sClassFile);
                $sClass = $this->_aParam["controller"] . "Controller";
                $this->_oApplicationObj = new $sClass($this->_aParam);
                $this->_oApplicationObj->setDB($this->_oDB);
                $sAction = $this->_aParam['action'];
                $this->_bIsApplication = true;
                $this->_aResult = $this->_oApplicationObj->$sAction();
            }
        }
    }

    public function loadDB() {
        if (empty($this->_aParam['business'])) {
            echo "请指定应用平台";
            exit;
        }
        $this->_oDB = new Db_Adapter(GliderSky::$aConfig['mysql'][$this->_aParam['business']]);
        if (in_array($this->_aParam["module"],array("Resource","Spider")) or in_array($this->_aParam["action"], array("gets","insert", "update", "input"))) {
            $oMysqlTable = new Db_MysqlTable(GliderSky::$aConfig['mysql'][$this->_aParam['business']], $this->_aParam["controller"]);
            $aFieldList = $oMysqlTable->getField("field_list");
            $this->_oDB->setFieldList($aFieldList);
            $aUniqueField = $oMysqlTable->getField("unique_field");
            $this->_oDB->setNotNullField($aUniqueField);  
            $this->_aSpecialField = $oMysqlTable->getField("special_field");
        }
        $this->_oDB->setTable($this->_aParam["controller"]);
        if(!empty($this->_aSpecialField)){
            $this->dealWithSpecialField($this->_aParam["query"]);
        }
    }
    
    public function dealWithSpecialField(&$aData){
        foreach($aData as $sKey => $sVal){
            if(!empty($this->_aSpecialField[$sKey])){
                $sAction = $this->_aSpecialField[$sKey];
                if(is_object($aData)){
                    $aData->$sKey = $this->$sAction($sVal);
                }else{
                    $aData[$sKey] = $this->$sAction($sVal);
                }
            }
        }
    }
    
    public function to_base64($sVal){
        if(!in_array($this->_aParam["action"],array("insert", "update", "input"))){            
            return base64_decode($sVal);
        }else{
            $sVal = str_replace('\\', "", $sVal);
            return base64_encode($sVal);
        }
    }
    
    public function getDbAffectNum(){
        $this->_iDBAffectNum = $this->_oDB->iAffectNum;
        return $this->_iDBAffectNum;
    }
    
    public function gets(){    
        $this->_aParam["query"]["enable"] = 1;
        $aRs = $this->_oDB->gets($this->_aParam["query"]); 
        $aResult = array();
        if(!empty($aRs)){
            foreach($aRs as $i=>$row){
                $this->dealWithSpecialField($row);
                $aResult[$i] = $row;
            }
        }
        return $aResult;
    }
    
    public function insert(){
        return $this->_oDB->input($this->_aParam["query"]);
    }
    
    public function update(){        
        unset($this->_aParam["query"]["enable"]);
        unset($this->_aParam["query"]["ctime"]);
        unset($this->_aParam["query"]["mtime"]);
        debugVar($this->_aParam["query"]);
        return $this->_oDB->updateDB($this->_aParam["query"]['id'], $this->_aParam["query"]);
    }
    
    public function updateOrInsert(){        
        unset($this->_aParam["query"]["enable"]);
        unset($this->_aParam["query"]["ctime"]);
        unset($this->_aParam["query"]["mtime"]);
        return $this->_oDB->saveBase($this->_aParam["query"]);
    }
    
    public function delete(){
        $iId = intval($this->_aParam["query"]["id"]);
        if($iId > 0){
            return $this->_oDB->deleteByParam(array(":id"=>$iId));
        }else{
            return false;
        }
    }

}
