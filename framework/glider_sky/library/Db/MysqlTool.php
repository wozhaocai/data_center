<?php

class Db_MysqlTool{   
    
    public function __construct() {                
    }
    
    function buildParamMap($aParam, $aFieldMap, $aSpecial = array()) {
        $aWhere = array();
        $aCondition = array();
        foreach ($aParam as $sKey => $sVal) {
            foreach ($aFieldMap as $sMapKey => $aField) {
                if (!empty($sVal) and in_array($sKey, $aField)) {
                    $aWhere[] = " {$sMapKey}.{$sKey} = :{$sKey}";
                    $aCondition[":{$sKey}"] = $sVal;
                }
            }
        }
        if (count($aSpecial) > 0) {
            foreach ($aSpecial as $sKey => $sVal) {
                if ($sKey == "date") {
                    if (!empty($aParam['start_month']) and !empty($aParam['end_month'])) {
                        $aWhere[] = " {$sVal} between :start_month and :end_month";
                        $aCondition[":start_month"] = $aParam['start_month'];
                        $aCondition[":end_month"] = $aParam['end_month'];
                    } elseif (!empty($aParam['start_month']) or !empty($aParam['end_month'])) {
                        if (!empty($aParam['start_month'])) {
                            $month = $aParam['start_month'];
                        }
                        if (!empty($aParam['end_month'])) {
                            $month = $aParam['end_month'];
                        }
                        $aWhere[] = " {$sVal} = :month";
                        $aCondition[":month"] = $month;
                    }
                }
            }
        }
        return array("where" => $aWhere, "condition" => $aCondition);
    }
    
    public function setLimitAndOrder(&$aParam,&$oDB){
        if (!empty($aParam['order'])) {
            $aParam['order'] = str_replace("<>", "|", $aParam['order']);
            $oDB->setOrderStr(str_replace("|", " ", $aParam['order']));
            unset($aParam['order']);
        }
        if (!empty($aParam['limit'])) {
            $aParam['limit'] = str_replace("<>", "|", $aParam['limit']);
            $aLimitArr = explode("|", $aParam['limit']);
            $aLimit = array(
                "start_num" => $aLimitArr[0],
                "offset" => $aLimitArr[1]
            );
            $oDB->setLimit($aLimit);
            unset($aParam['limit']);
        }        
    }
    
}
