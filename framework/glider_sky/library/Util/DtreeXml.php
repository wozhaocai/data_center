<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(dirname(__FILE__)."/XmlParse.php");

class Util_DtreeXml extends Util_XmlParse{
    private $_sTreeEntity = '';
    
    function getResourceByParam($aGroupResource){
        $aGroupR = array();
        foreach($aGroupResource as $oGroupResource){
            $sField = $this->_aParams['select_field'];
            $aGroupR[] = $oGroupResource->$sField;
        }
        return implode(",",$aGroupR);
    }
    
    function getAllResource($oNode){
        $this->_sTreeEntity = (string)$oNode->show->data->entity;
        list($sRootField,$sRootId) = explode(":",(string)$oNode->show->data->entity["root_id"]);
        $aQuery = array($sRootField => $sRootId);  
        $aResource = $this->getEntity($this->_sTreeEntity, $aQuery);
        
        $sResource = "";
        $deep = 1;
        for ($i = 0; $i < count($aResource); $i++) {
            $sResource .= $this->loopTree($aResource[$i], $deep, $aResource[$i]->id);
        }
        return $sResource;
    }
    
    function loopTree($aResource, $deep, $id) {
        $sResource = "";
        $aQuery = array(
            "parent_id" => $id
        );
        $aResource1 = $this->getEntity($this->_sTreeEntity, $aQuery);
        if ($aResource != null) {
            $sResource .= $this->buildNodeStr($aResource, $deep * 20);
            for ($m = 0; $m < count($aResource1); $m++) {
                if ($aResource1[$m]->child_count > 0) {
                    $sResource .= $this->loopTree($aResource1[$m], $deep + 1, $aResource1[$m]->id);
                } else {
                    $sResource .= $this->buildNodeStr($aResource1[$m], ($deep + 1) * 20);
                }
            }
        }
        return $sResource;
    }
    
    function buildNodeStr($aResource, $marginLeft) {        
        $aChild = array();
        if($aResource->child_count != 0){
            $aQuery = array(
                "parent_id" => $aResource->id
            );
            $aResource1 = $this->getEntity($this->_sTreeEntity, $aQuery);
            $sChild = $this->getChild($aResource1[0]);
        }else{
            $sChild = 0;
        }

        $sResourceStr = "";
        $sResourceStr .= "<tr>";
        $sResourceStr .= "<td class=\"res_add\" style=\"padding-left:{$marginLeft}px;\">";
        $sResourceStr .= "<input type=\"checkbox\" id=\"node_{$aResource->id}\" name=\"node[]\" value=\"{$aResource->id}\" onclick=\"selChildren(this, '{$sChild}');\" />&nbsp;&nbsp;";
        $sResourceStr .= $aResource->title;
        $sResourceStr .= "</td>";
        $sResourceStr .= "</tr>\r\n";
        return $sResourceStr;
    }

    function getChild($aResource) {
        $sIds = "";
        $aQuery = array(
            "parent_id" => $aResource->id
        );
        $aResource1 = $this->getEntity($this->_sTreeEntity, $aQuery);
        foreach ($aResource1 as $oResource) {
            $sIds .= $oResource->id . ",";
            if ($oResource->child_count > 0) {
                $sIds .= $this->getChild($oResource);
            }
        }
        return $sIds;
    }
    
    function getResourceEntity($aQuery){
        $oModule = new GS_Module($this->_aParams['business'], "Entity", $sShowEntity, "gets", $aQuery);        
        return $oModule->run();
    }
    
}
