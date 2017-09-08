<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util_XmlParse{
    protected $oXml = "";
    protected $_aParams = array(); 
    
    public function __construct($oXml,&$aParams) {
        $this->oXml = $oXml;
        $this->_aParams = $aParams;
    }
    
    protected function getEntity($sShowEntity,$aQuery,$sAction="gets"){
        $oModule = new GS_Module($this->_aParams['business'], "Entity", $sShowEntity, $sAction, $aQuery);        
        return $oModule->run();
    }
    
    public function parseInputNode($oNode){
        foreach ($oNode->input->params->param as $oParam) {
            $sMapField = (string) $oParam["map_field"];
            $sInputField = (string) $oParam;
            $this->_aParams["where"][":" . $sMapField] = $this->_aParams[$sInputField];
        }
        $sEntityStr = " ";
        $this->_aParams["select"] = (string) $oNode->input->data->select;
        $this->_aParams["select_field"] = empty($oNode->input->data->select['field']) ? "" : (string)$oNode->input->data->select['field'];
        foreach ($oNode->input->data->entity as $oEntity) {
            $sEntity = (string) $oEntity;
            if (!empty($oEntity["union"])) {
                $sUnion = (string) $oEntity["union"];
                $sEntityStr .= " left join {$sEntity} on {$sUnion} ";
            } else {
                $sEntityStr .= $sEntity;
            }
        }
        $this->_aParams["action"] = "getUnionResult";
        $this->_aParams["table"] = $sEntityStr;
        return $this->getEntity("Union",$this->_aParams,$this->_aParams["action"]);
    }
}