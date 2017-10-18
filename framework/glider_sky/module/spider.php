<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module_Spider extends GS_Module_Base{
    public function run(){ 
        $aParam = $this->_aParam["query"];
        $oModule = new GS_Module($this->_aParam['business'], "Entity", "spider", "gets",$aParam);        
        $aSpider = $oModule->run();
        $sSpiderUrl = $this->parseUrlByParam($aSpider[0]->spider_url);
        $aParamScope = array();
        if(!empty($aSpider[0]->spider_url_param)){
            $aParamScope = $this->parseUrlParam($sSpiderUrl,$aSpider[0]->spider_url_param);
        }        
        if(empty($aParamScope)){
            debugVar($sSpiderUrl);
            $this->dealWithData($sSpiderUrl, $aSpider);
        }else{
            foreach($aParamScope as $sKey => $sVal){
                list($sStart,$sEnd) = explode(",",$sVal);
                for($i=$sStart;$i<= $sEnd;$i++){
                    $sTempSpiderUrl = str_replace("{".$sKey."}", $i, $sSpiderUrl);
                    usleep(100000);
                    debugVar($sTempSpiderUrl);
                    $this->dealWithData($sTempSpiderUrl, $aSpider);
                }
            }
        }
        
    }   
    
    private function dealWithData($sSpiderUrl,$aSpider){
        $aData = $this->getData($sSpiderUrl,$aSpider[0]->keyword_rule);
        if(!empty($aData[0])){
            if(strstr($aSpider[0]->save_rule,":more:")){
                foreach($aData as $row){     
                    if(!is_array($row)){
                        $this->saveData(array($row),$aSpider[0]->save_rule);
                    }else{
                        $this->saveData($row,$aSpider[0]->save_rule);
                    }
                }
            }else{
                $this->saveData($aData,$aSpider[0]->save_rule);
            }
        }
    }
    
    private function parseUrlParam($sSpiderUrl,$sSpiderUrlParam){
        $aParams = explode(":",$sSpiderUrlParam);
        $aParamScope = array();
        foreach($aParams as $sParam){
            list($sField,$sRule) = explode("@",$sParam);
            $aOption = explode("-",$sRule);
            if($aOption[0] == "Controller"){
                $this->_aParam["spider_url"] = $sSpiderUrl;
                $this->_aParam["spider_field"] = $sField;
                $this->_aParam["spider_init_value"] = $aOption[3];
                $oModule = new GS_Module($this->_aParam["business"],"Controller",$aOption[1],$aOption[2],$this->_aParam);
                $aParamScope[$sField] = $oModule->run();
            }
        }
        return $aParamScope;
    }
    
    private function parseUrlByParam($sSpiderUrl){
        if(!empty($this->_aParam["query"])){
            $aParams = $this->_aParam["query"];
            if(!empty($aParams["data"])){
                $sSpiderUrl = Util_DataType::replace($sSpiderUrl, $aParams["data"]);
                unset($aParams["data"]);
            }
            $sSpiderUrl = Util_DataType::replace($sSpiderUrl, $aParams);  
        }
        $sSpiderUrl = Util_DataType::replaceDate($sSpiderUrl); 
        return $sSpiderUrl;
    }
    
    private function getData($sSpiderUrl,$sRule){
        $aContent = Util_Curl::execute($sSpiderUrl);
        $aRules = explode("|", $sRule);
        $sPrev = "";
        $sIsArray = false;
        $aResult = array();
        foreach($aRules as $m=>$sRuleOption){
            if(!$sIsArray){
                $this->parseRule($sRuleOption,$aContent,$sPrev); 
                if(is_array($aContent)){
                    $sIsArray = true;
                }
            }else{
                foreach($aContent as $i=>$row){
                    $x = $m;
                    if(substr($sRuleOption,0,6) == "array@"){
                        list($sType,$sIndex) = explode("@",$sRuleOption);
                        if($i < $sIndex) continue;
                    }     
                    if(substr($sRuleOption,0,6) == "array@"){
                        $x++;
                    }
                    for($n=$x;$n<count($aRules);$n++){       
                        $this->parseRule($aRules[$n],$row,$sPrev);                        
                    }
                    $aResult[] = $row;
                }
            }
        }
        return $aResult;        
    }
    
    private function saveData($aData,$sSaveRule){  
        $aRules = explode(":", $sSaveRule);
        if($aRules[0] == "table"){
            $aFields = explode(",", $aRules[3]);
            foreach($aFields as $row){
                $aOption = explode("@",$row);    
                $sField = $aOption[0];
                if(substr($aOption[1],0,10) == "Controller"){
                    list($sType,$sModule,$sAction) = explode("-",$aOption[1]);
                    $oModule = new GS_Module($this->_aParam["business"],"Controller",$sModule,$sAction,$aData);
                    $this->_aParam["query"][$sField] = $oModule->run();
                }elseif(strstr($aOption[1],"const")){
                    list($sType,$sConstVal) = explode("-", $aOption[1]);
                    $this->_aParam["query"][$sField] = $sConstVal;
                }else{                    
                    $sIndex = $aOption[1];
                    if(strstr($sIndex,"{")){
                        $this->_aParam["query"][$sField] = Util_DataType::replace($sIndex, $this->_aParam["query"]["data"]);
                    }else{   
                        $this->_aParam["query"][$sField] = $aData[$sIndex];
                        if(!empty($aOption[2])){    
                            $aOption[2] = str_replace("-", "@", $aOption[2]);
                            $sPrev = "";
                            $this->parseRule($aOption[2], $this->_aParam["query"][$sField], $sPrev);
                        }
                    }
                }
                if(isset($aOption[2]) and strstr($aOption[2],"notnull") and empty($this->_aParam["query"][$sField])){
                    return false;
                }
            }   
            $oModule = new GS_Module($this->_aParam['business'], "Entity", $aRules[1], "updateOrInsert",$this->_aParam["query"]);        
            $oModule->run();
        }     
    }
    
    private function parseRule($sRuleOption,&$aContent,&$sPrev){
        $aOption = explode("@",$sRuleOption);
        if($aOption[0] == "iconv"){
            if($aOption[2] == "utf_8"){
                $aOption[2] = "utf-8";
            }
            $aContent = iconv($aOption[1],$aOption[2],$aContent);
        }elseif($aOption[0] == "json_decode"){
            $aContent = json_decode($aContent);
        }elseif($aOption[0] == "strpos"){
            if(!empty($aOption[3])){
                $sTempIndex = $aOption[3];
            }else{
                $sTempIndex = 0;
            }
            if(empty($aOption[2])){
                $sPrev = strpos($aContent, $aOption[1],$sTempIndex);
            }else{
                $sPrev = strpos($aContent, $aOption[1],$sTempIndex)+$aOption[2];
            }
        }elseif($aOption[0] == "reg"){
            if($aOption[1] == "json"){
                preg_match_all("/\[(.*)\]/", $aContent, $aMatchs);                
            }else{
                preg_match_all(addslashes($aOption[1]), $aContent, $aMatchs);
            }
            if(isset($aOption[2])){                
                $aContent = $aMatchs[0][$aOption[2]];
            }else{
                $aContent = $aMatchs[0];
            }
            return "";
        }elseif($aOption[0] == "substr"){
            if($aOption[1] == "start"){
                $sPrev = $aContent = substr($aContent,$sPrev);
                return "";
            }elseif($aOption[1] == "0" and $aOption[2] == "end"){
                $sPrev = $aContent = substr($aContent,0,$sPrev);
                return "";
            }else{
                if($aOption[2] == "end"){
                    $sPrev = $aContent = substr($aContent,$aOption[1],$sPrev);
                }else{
                    $sPrev = $aContent = substr($aContent,$aOption[1],$aOption[2]);
                }
                return "";
            }
        }elseif($aOption[0] == "str_replace"){
            $aContent = str_replace($aOption[1], $aOption[2], $aContent);
            return "";
        }elseif($aOption[0] == "strtolower"){
            $aContent = strtolower($aContent);
            return "";
        }elseif($aOption[0] == "explode"){
            $aContent = explode($aOption[1],$aContent);
            return "";
        }
    }
    
}