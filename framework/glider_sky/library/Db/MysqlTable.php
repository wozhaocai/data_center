<?php

class Db_MysqlTable{
    private $_sTable = '';
    private $_oDb = null;
    private static $_aSystemFeilds = array("id","ctime","mtime");
    
    public function __construct($aDB,$sTable) {
        $this->_sTable = $sTable;
        $this->_oDb = new Db_Adapter($aDB);        
    }
    
    public function getField($sType){        
        switch($sType){
            case "field_list":
                return $this->getFieldList();
                break;
            case "unique_field":
                return $this->getUniqueField();
            default :
                break;
        }
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
