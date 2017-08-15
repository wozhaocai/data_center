<?php

class Db_MysqlTable{
    private $_sTable = '';
    private $_oDb = null;
    private static $_aSystemFeilds = array("id","ctime","mtime");
    
    public function __construct($aDB,$sTable,$sAfterSetDB = false) {
        $this->_sTable = $sTable;
        if($sAfterSetDB == false){
            $this->_oDb = new Db_Adapter($aDB);
        }
    }
    
    public function setDB(&$oDB){
        $this->_oDb = $oDB;
    }
    
    public function getField($sType){        
        switch($sType){
            case "field_list":
                return $this->getFieldList();
                break;
            case "unique_field":
                return $this->getUniqueField();
            case "full_field_list":
                return $this->getFullFieldList();
            default :
                break;
        }
    }
    
    private function getFullFieldList(){      
        return $this->_oDb->queryDB("show full columns from {$this->_sTable};");               
    }
    
    private function getFieldList(){      
        $aTableDesc = $this->_oDb->queryDB("desc {$this->_sTable};");
        $aFields = array();
        foreach($aTableDesc as $oField){
            if(in_array($oField->field,self::$_aSystemFeilds)){
                continue;
            }
            $aFields[] = $oField->field;
        }
        return $aFields;        
    }
    
    private function getUniqueField(){     
        $aTableDesc = $this->_oDb->queryDB("show index from {$this->_sTable};");
        $aFields = array();
        foreach($aTableDesc as $oField){
            if($oField->non_unique == "0" and $oField->key_name != "PRIMARY"){
                //if(!in_array($oField->column_name,array('since','till'))){                    
                    $aFields[] = $oField->column_name;
                //}
            } 
        }
        return $aFields;
    }
    
}
