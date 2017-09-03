<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module_Resource extends GS_Module_Base{
    public function run(){
        if($this->_bIsApplication){
            return $this->_aResult;
        }
        $sAction = $this->_aParam['action'];
        return $this->fetchResource($sAction);
    }        
    
    private function fetchResource($sAction){
        $this->_aParam["query"] = array(
            "content_type" => "xml",
            "source_type" => "table",
            "service_id" => $sAction
        );
        $aParam = $this->_aParam["query"];
        $oModule = new GS_Module($this->_aParam['business'], "Entity", "resource", "gets",$aParam);        
        $aResource = $oModule->run();
        if(empty($aResource)){
            $oTable = new Db_MysqlTable("", $sAction, true);
            $oTable->setDB($this->_oDB);
            $aField = $oTable->getField("full_field_list");
            $oLayout = new Util_Layout($aField,GliderSky::$aConfig,$sAction);             
            $sXmlContent = urlencode(urlencode($oLayout->generateLayout()));    
            $this->_aParam["query"]["content"] = $sXmlContent;
            $aParam = $this->_aParam["query"];
            $oModule = new GS_Module($this->_aParam['business'], "Entity", "resource", "updateOrInsert",$aParam);        
            $oModule->run();
            $oModule = new GS_Module($this->_aParam['business'], "Entity", "resource", "gets",$aParam);        
            $aResource = $oModule->run();
            return $aResource;
        }else{
            return $aResource;
        }
    }
    
    
}