<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module_Spider extends GS_Module_Base{
    public function run(){     
        $aSpider = $this->gets();
        $aData = $this->getData($aSpider[0]->spider_url,$aSpider[0]->keyword_rule);
        $this->saveData($aData,$aSpider[0]->save_rule);
        exit;
        //return $this->fetchResource($sAction);
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
            $this->_oDB->setTable($aRules[1]);
            $aFields = explode(",", $aRules[2]);
            if(count($aFields) == 1 and count($aData) > 1){
                foreach($aData as $sVal){
                    $this->_aParam["query"] = array(
                        $aRules[2] => $sVal
                    );
                    $this->insert();
                }                
            }
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
        }elseif($aOption[0] == "substr"){
            if($aOption[1] == "start"){
                $aContent = substr($aContent,$sPrev);
                return "";
            }elseif($aOption[1] == "0" and $aOption[2] == "end"){
                $aContent = substr($aContent,0,$sPrev);
                return "";
            }
        }elseif($aOption[0] == "explode"){
            $aContent = explode($aOption[1],$aContent);
            return "";
        }
    }
    
}