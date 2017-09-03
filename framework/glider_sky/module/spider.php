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
        if(!empty($this->_aParam["query"]["data"])){
            $sSpiderUrl = $this->parseUrlByParam($aSpider[0]->spider_url);
        }else{
            $sSpiderUrl = $aSpider[0]->spider_url;
        }
        $aData = $this->getData($sSpiderUrl,$aSpider[0]->keyword_rule);
        $this->saveData($aData,$aSpider[0]->save_rule);
        exit;
    }   
    
    private function parseUrlByParam($sSpiderUrl){
        $aParams = $this->_aParam["query"];
        $sSpiderUrl = Util_DataType::replace($sSpiderUrl, $aParams["data"]);
        unset($aParams["data"]);
        $sSpiderUrl = Util_DataType::replace($sSpiderUrl, $aParams);  
        $sSpiderUrl = Util_DataType::replaceDate($sSpiderUrl); 
        return $sSpiderUrl;
    }
    
    private function getData($sSpiderUrl,$sRule){
        $aContent = Util_Curl::execute($sSpiderUrl);
        $aRules = explode("|", $sRule);
        $sPrev = "";
        foreach($aRules as $sRuleOption){
            $this->parseRule($sRuleOption,$aContent,$sPrev);
        }
        return $aContent;        
    }
    
    private function saveData($aData,$sSaveRule){        
        $aRules = explode(":", $sSaveRule);
        if($aRules[0] == "table"){
            $aFields = explode(",", $aRules[2]);
            foreach($aFields as $row){
                list($sField,$sIndex) = explode("@",$row);               
                if(strstr($sIndex,"{")){
                    $this->_aParam["query"][$sField] = Util_DataType::replace($sIndex, $this->_aParam["query"]["data"]);
                }else{
                    $this->_aParam["query"][$sField] = $aData[$sIndex];
                }                   
            }      
            $oModule = new GS_Module($this->_aParam['business'], "Entity", $aRules[1], "insert",$this->_aParam["query"]);        
            $oModule->run();
            exit;
        }     
    }
    
    private function parseRule($sRuleOption,&$aContent,&$sPrev){
        $aOption = explode("@",$sRuleOption);
        if($aOption[0] == "strpos"){
            if(empty($aOption[2])){
                $sPrev = strpos($aContent,$aOption[1],0);
            }else{
                $sPrev = strpos($aContent,$aOption[1],0)+$aOption[2];
            }
        }elseif($aOption[0] == "reg"){
            preg_match_all(addslashes($aOption[1]), $aContent, $aMatchs);
            $aContent = substr($aMatchs[0][0],1,-1);
            return "";
        }elseif($aOption[0] == "substr"){
            if($aOption[1] == "start"){
                $aContent = substr($aContent,$sPrev);
                return "";
            }elseif($aOption[1] == "0" and $aOption[2] == "end"){
                $aContent = substr($aContent,0,$sPrev);
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