<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module_Entity extends GS_Module_Base{
    
    public function loadDB() {
        if (empty($this->_aParam['business'])) {
            echo "请指定应用平台";
            exit;
        }
        $this->_oDB = new Db_Adapter(GliderSky::$aConfig['mysql'][$this->_aParam['business']]);
        if($this->_aParam["controller"] == "Union"){
            return true;
        }
        if (in_array($this->_aParam["module"],array("Resource","Spider")) or ($this->_aParam["module"] == "Entity" and !$this->_bIsApplication and in_array($this->_aParam["action"], array("updateOrInsert","gets","insert", "update", "input",'deleteByParam')))) {
            $oMysqlTable = new Db_MysqlTable(GliderSky::$aConfig['mysql'][$this->_aParam['business']], $this->_aParam["controller"]);
            $aFieldList = $oMysqlTable->getField("field_list");
            $this->_oDB->setFieldList($aFieldList);
            $aUniqueField = $oMysqlTable->getField("unique_field");
            $this->_oDB->setNotNullField($aUniqueField);  
            $this->_aSpecialField = $oMysqlTable->getField("special_field");
        }
        if(in_array($this->_aParam["module"],array("Resource","Spider","Entity"))){            
            $this->_oDB->setTable($this->_aParam["controller"]);
            if(!empty($this->_aSpecialField)){
                $this->dealWithSpecialField($this->_aParam["query"]);
            }
        }
    }
    
    public function run(){
        $this->loadDB();
        if($this->_bIsApplication){
            $this->_oApplicationObj->setDB($this->_oDB);
            $sAction = $this->_aParam['action'];
            $this->_aResult = $this->_oApplicationObj->$sAction();            
            return $this->_aResult;
        }elseif($this->_aParam["controller"] == "Union"){
            $sAction = $this->_aParam['action'];
            $this->_aResult = $this->$sAction();            
            return $this->_aResult;
        }
        $sAction = $this->_aParam['action'];
        return $this->$sAction();
    }         
    
    private function getUnionResult(){
        $this->_oDB->setTable($this->_aParam["query"]["table"]);
        return $this->_oDB->selectDB($this->_aParam["query"], false, '', $this->_aParam["query"]["select"]);
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
            return Util_Base64::urlsafe_b64decode($sVal);
        }else{
            $sVal = str_replace('\\', "", $sVal);
            return Util_Base64::urlsafe_b64encode($sVal);
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
            return $this->_oDB->deleteByParam(array("id"=>$iId));
        }else{
            return false;
        }
    }
    
    public function deleteByParam(){
        return $this->_oDB->deleteByParam($this->_aParam["query"]);
    }
    
}