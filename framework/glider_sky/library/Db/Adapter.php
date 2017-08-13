<?php

class Db_Adapter {

    static protected $oDB = null;
    protected $_sTable = '';
    static protected $sDbConnectShort = true;
    protected $_aParam = array();
    protected $_aLimit = array();
    public $iAffectNum = 0;
    protected $_sOrderStr = '';
    public $bRet = true;
    protected $_bMemcacheEnable = false;
    private $_sCurrentDb = '';
    protected $aField = array();
    protected $aNotNullField = array();
    protected $_sViewId = '';

    function __construct($aDB) {
        $this->init($aDB);
    }

    function setFieldList($aField) {
        $this->aField = $aField;
    }

    function setNotNullField($aField) {
        $this->aNotNullField = $aField;
    }

    function setLimit($aLimit) {
        $this->_aLimit = $aLimit;
    }

    function setOrderStr($sOrder) {
        $this->_sOrderStr = $sOrder;
    }

    function setParam($sKey, $sVal) {
        $this->_aParam[$sKey] = $sVal;
    }

    function logDB($sType, $sDesc) {
        $aLog = array();
        $aLog["actor"] = "";
        $aLog["act_ip"] = "";
        $aLog["log_type"] = $sType;
        $aLog["description"] = json_encode($sDesc);
    }

    function init($aDB) {
        $this->startLog();
        $this->startDB($aDB);
    }

    function startLog() {
        
    }

    function setTable($sTable) {
        $this->_sTable = $sTable;
    }

    function startDB($aDB) {
        $this->_sCurrentDb = $aDB['dbname'];
        //if (empty(self::$oDB[$this->_sCurrentDb])) {
            self::$oDB[$this->_sCurrentDb] = Db_PDO::getInstance($aDB);
        //}
    }

    function filter($aField, $aData) {
        $aRs = array();
        if (empty($aField)) {
            return $aRs;
        }
        foreach ($aField as $sKey) {
            if (isset($aData[$sKey])) {
                $aRs[$sKey] = $aData[$sKey];
            }
        }
        return $aRs;
    }

    function setViewId($sViewId) {
        $this->_sViewId = $sViewId;
    }

    function getView() {
        var_dump($this);
        exit;
    }

    function setOrderSql(&$sql) {
        if (!empty($this->_sOrderStr)) {
            if(substr($sql,-1,1) == ";"){
                $sql = substr($sql,0,-1)." order by {$this->_sOrderStr};";
            }else{
                $sql .= " order by {$this->_sOrderStr};";
            }
        }
    }

    function setLimitSql(&$sql) {
        if (count($this->_aLimit) > 0) {
            if(substr($sql,-1,1) == ";"){
                $sql = substr($sql,0,-1)." limit {$this->_aLimit['start_num']},{$this->_aLimit['offset']};";
            }else{
                $sql .= " limit {$this->_aLimit['start_num']},{$this->_aLimit['offset']};";
            }            
        }
    }

    function queryDB($sql, $aParam = array(), $one = false, $debug = false) {
        self::$oDB[$this->_sCurrentDb]->debug = $debug;
        if (strstr($sql, "limit")) {
            $aSqlTemp = explode("limit", $sql);            
            $sCountSql = "select count(1) as cnt from ({$aSqlTemp[0]}) a;";
        } else {
            $sCountSql = "select count(1) as cnt from ({$sql}) a;";
        }
        
        $this->setOrderSql($sql);
        $this->setLimitSql($sql);
        $aData = self::$oDB[$this->_sCurrentDb]->query($sql, $aParam);
        if ($aData) {
            if ($one) {
                $this->iAffectNum = 1;
                return $aData[0];
            } else {
                $sCountSql = str_replace(";) a;", ") a;", $sCountSql);
                $aRsCount = self::$oDB[$this->_sCurrentDb]->query($sCountSql, $aParam);    
                if (isset($aRsCount[0])) {
                    $this->iAffectNum = $aRsCount[0]->cnt;
                }else{
                    if(count($aData) > 0){
                        $this->iAffectNum = count($aData);
                    }else{
                        $this->iAffectNum = 0;
                    }
                }
                return $aData;
            }
        } else {
            return false;
        }
    }

    function getRecord($iId = 0) {
        if ($iId > 0) {
            return $this->selectDB(array('where' => array(":id" => $iId)));
        } else {
            return $this->selectDB();
        }
    }

    function executeSql($strSql, $aParam = array()) {
        $aRs = self::$oDB[$this->_sCurrentDb]->execTransaction($strSql, $aParam);
        if (empty($aRs)) {
            $this->bRet = false;
            $this->rollback();
            return false;
        } else {
            return $aRs;
        }
    }

    function getRet() {
        return $this->bRet;
    }

    function insertDB($aData, $update = false) {
        $aData['ctime'] = date("Y-m-d H:i:s");
        $aRs = self::$oDB[$this->_sCurrentDb]->insert($this->_sTable, $aData, $update);
        $this->logDB($this->_sTable, $aData);
        return $aRs['lastid'];
    }

    function updateDB($iId, $aData, $sInId = false) {
        unset($aData['id']);
        $sSql = "update {$this->_sTable} set ";
        $aUpdate = array();
        $aParam = array();
        foreach ($aData as $sKey => $sVal) {
            $aUpdate[] = "{$sKey}=:{$sKey}";
            $aParam[":{$sKey}"] = $sVal;
        }
        if (count($aUpdate) > 0) {
            $aParam[":id"] = $iId;
            if ($sInId) {
                $sSql .= implode(",", $aUpdate) . " where id=:id";
            } else {
                $sSql .= implode(",", $aUpdate) . " where id in(:id)";
            }
        }
        $aLog = array("sql" => $sSql, "param" => $aParam);
        $this->logDB($this->_sTable, $aLog);
        return self::$oDB[$this->_sCurrentDb]->update($sSql, $aParam);
    }

    function updateByParam($aData, $aWhere, $sWhere) {
        unset($aData['id']);
        $sSql = "update {$this->_sTable} set ";
        $aUpdate = array();
        $aParam = array();
        $aWhereArr = array();
        foreach ($aData as $sKey => $sVal) {
            $aUpdate[] = "{$sKey}=:{$sKey}";
            $aParam[":{$sKey}"] = $sVal;
        }
        foreach ($aWhere as $sKey => $sVal) {
            $aParam[":{$sKey}"] = $sVal;
        }
        if (count($aUpdate) > 0) {
            $sSql .= implode(",", $aUpdate) . " where {$sWhere}";
        }
        $aLog = array("sql" => $sSql, "param" => $aParam);
        $this->logDB($this->_sTable, $aLog);
        return self::$oDB[$this->_sCurrentDb]->update($sSql, $aParam);
    }

    function getByUniq($aData, $aUniqField) {
        $aParam = array();
        foreach ($aData as $sKey => $sVal) {
            if (in_array($sKey, $aUniqField)) {
                $aParam['where'][":{$sKey}"] = $sVal;
            }
        }
        return $this->selectDB($aParam, true);
    }

    function getById($iId) {
        $sql = "select * from  {$this->_sTable} where id=:id";
        return $this->queryDB($sql, array(":id" => $iId), true);
    }

    function selectDB($aParam = array(), $one = false, $sSql = '', $sField = '*', $debug = false) {
        if (empty($sSql)) {
            $sSql = "select {$sField} from {$this->_sTable}";
        } else {
            $sSql = str_replace(";", "", $sSql);
        }
        if (isset($aParam['where']) and count($aParam['where']) > 0) {
            $sSql .= ' where ';
            foreach ($aParam['where'] as $sKey => $sVal) {
                $aWhere[] = " " . substr($sKey, 1) . " = {$sKey} ";
            }
            $sSql .= implode("and", $aWhere);
        }
        if (isset($aParam['order']) and count($aParam['order']) > 0) {
            $sSql .= " order by " . implode(",", $aParam['order']);
        }
        if(empty($aParam["where"])){
            return $this->queryDB(trim($sSql) . ";", array(), $one, $debug);
        }else{
            return $this->queryDB(trim($sSql) . ";", $aParam['where'], $one, $debug);
        }        
    }

    function pushExec($sql, $aParam) {
        return self::$oDB[$this->_sCurrentDb]->pushExec($sql, $aParam);
    }

    function buildParam($aParam, $aField, $aSpecial = array()) {
        $aWhere = array();
        $aCondition = array();
        foreach ($aParam as $sKey => $sVal) {
            if (!empty($sVal) and in_array($sKey, $aField)) {
                $aWhere[] = " {$sKey} = :{$sKey}";
                $aCondition[":{$sKey}"] = $sVal;
            }
        }
        return array("where" => $aWhere, "condition" => $aCondition);
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
                    if (!empty($aParam['start_month']) and ! empty($aParam['end_month'])) {
                        $aWhere[] = " {$sVal} between :start_month and :end_month";
                        $aCondition[":start_month"] = $aParam['start_month'];
                        $aCondition[":end_month"] = $aParam['end_month'];
                    } elseif (!empty($aParam['start_month']) or ! empty($aParam['end_month'])) {
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

    function startExec() {
        return self::$oDB[$this->_sCurrentDb]->execUpdate();
    }

    function gets($aParam, $one = false) {
        $aParam = $this->filter($this->aField, $aParam);

        if(!empty($aParam['order'])){
            $aParam['order'] = str_replace("<>","|",$aParam['order']);
            $this->setOrderStr(str_replace("|"," ",$aParam['order']));
            unset($aParam['order']);
        }
        if(!empty($aParam['limit'])){
            $aParam['limit'] = str_replace("<>","|",$aParam['limit']);
            $aLimitArr = explode("|",$aParam['limit']);
            $aLimit = array(
                "start_num" => $aLimitArr[0],
                "offset" => $aLimitArr[1]
            );
            $this->setLimit($aLimit);
            unset($aParam['limit']);
        }      
        foreach ($aParam as $sKey => $sVal) {
            if (!empty($sVal)) {
                $aRequest[":" . $sKey] = $sVal;
            }
        }
        if(!empty($aRequest)){
            return $this->selectDB(array("where" => $aRequest), $one);
        }else{
            return $this->selectDB(array(), $one);
        }        
    }

    function getList($aData, $one = false) {
        $sql = "select * from {$this->_sTable}";
        $aParam = $this->buildParamMap($aData, array());
        if (count($aParam['where']) > 0) {
            $sql .= " and " . implode(" and ", $aParam['where']);
            return $this->queryDB($sql, $aParam['condition']);
        } else {
            return $this->queryDB($sql);
        }
    }

    function checkTrue($aData, $aField) {
        $sRs = true;
        if (!empty($aField)) {
            foreach ($aField as $sKey) {     
                if(in_array("since",$aField) and in_array("till",$aField) and $sKey == "till"){
                    continue;
                }
                if (!isset($aData[$sKey]) or trim($aData[$sKey]) == '') {
                    $sRs = false;
                }
            }
        }
        return $sRs;
    }

    function checkDiffTrue($aData, $aField) {
        $aRs = array();
        foreach ($aField as $sKey) {
            if (!isset($aData[$sKey]) or trim($aData[$sKey]) == '') {
                $aRs[] = $sKey;
            }
        }
        return $aRs;
    }

    function checkExist($aData, $aUniqField) {
        $aExists = $this->getByUniq($aData, $aUniqField);
        if (empty($aExists)) {
            return false;
        } else {
            return $aExists['id'];
        }
    }

    function checkData($aData) {
        $aData = $this->filter($this->aField, $aData);
        $aDiff = $this->checkDiffTrue($aData, $this->aNotNullField);
        if (empty($aDiff)) {
            return true;
        } else {
            print_r($aDiff);
            exit;
            return true;
        }
    }

    function deleteByParam($aParam = array()) {
        if (count($aParam) < 1) {
            return false;
        } else {
            $sSql .= "delete from {$this->_sTable} where ";
            foreach ($aParam as $sKey => $sVal) {
                $aWhere[] = " " . substr($sKey, 1) . " = {$sKey} ";
            }
            $sSql .= implode("and", $aWhere) . ";";
        }
        return self::$oDB[$this->_sCurrentDb]->query($sSql, $aParam);
    }

    function isExist($aKeys, $aValues) {
        foreach ($aKeys as $sKey) {
            if (in_array($sKey, $aValues)) {
                return true;
            }
        }
        return false;
    }

    function input($aInput) {
        $aInput = $this->filter($this->aField, $aInput);
        if ($this->checkTrue($aInput, $this->aNotNullField)) {
            $aInputDB = $this->getByInput($aInput);
            if ($aInputDB === 0) {
                return false;
            }
            if (!empty($aInputDB->id)) {
                return $aInputDB->id;
            }
            return $this->insertDB($aInput);
        } else {
            return 0;
        }
    }

    function saveBase($aInput) {
        return $this->updateByKey($aInput);
    }

    function updateByKey($aInput) {
        $aInput = $this->filter($this->aField, $aInput);
        if ($this->checkTrue($aInput, $this->aNotNullField)) {
            $aInputDB = $this->getByInput($aInput);
            if ($aInputDB === 0)
                return false;
            $aInputDBArr = (array) $aInputDB;
            if (!empty($aInputDB->id)) {
                $aData = array_diff_assoc($aInput, $aInputDBArr);
                if (count($aData) > 0) {
                    $this->updateDB($aInputDB->id, $aData);
                    return $aInputDB->id;
                } else {
                    return $aInputDB->id;
                }
            }
            return $this->insertDB($aInput);
        } else {
            return 0;
        }
    }

    function saveData($aInput) {
        $aInput = $this->filter($this->aField, $aInput);
        if ($this->checkTrue($aInput, $this->aNotNullField)) {
            $aQuery = $this->filter($this->aNotNullField, $aInput);
            $aInputDB = $this->getByInput($aQuery);
            if ($aInputDB === 0)
                return false;
            $aInputDBArr = (array) $aInputDB;
            if (!empty($aInputDB->id)) {
                $aData = array_diff_assoc($aInput, $aInputDBArr);
                if (count($aData) > 0) {
                    $this->updateDB($aInputDB->id, $aData);
                    return $aInputDB->id;
                } else {
                    return $aInputDB->id;
                }
            }
            return $this->insertDB($aInput);
        } else {
            return 0;
        }
    }

    function getByInput($aInput) {
        if (!empty($this->aNotNullField)) {
            foreach ($this->aNotNullField as $sField) {
                if ($sField === 'sourceid') {
                    continue;
                }
                if (!empty($aInput[$sField])) {
                    $aWhere[":{$sField}"] = $aInput[$sField];
                }
            }
            if (count($aWhere) > 0) {
                return $this->selectDB(array("where" => $aWhere), true);
            } else {
                return 0;
            }
        } else {
            return true;
        }
    }

    function querySql($sSql, $aParam = array(), $one = false) {
        if (count($aParam) > 0) {
            return $this->queryDB($sSql, $aParam, $one);
        } else {
            return $this->queryDB($sSql);
        }
    }

    function buildDay($sField, &$aParam, $aData) {
        if (!empty($aData['start_day']) and ! empty($aData['end_day'])) {
            $aParam['where'][] = " {$sField} between :start_day and :end_day";
            $aParam['condition'][":start_day"] = $aData['start_day'] . " 00:00:00";
            $aParam['condition'][":end_day"] = $aData['end_day'] . " 23:59:59";
        } elseif (!empty($aData['start_day']) or ! empty($aData['end_day'])) {
            if (!empty($aData['start_day'])) {
                $day = $aData['start_day'];
            }
            if (!empty($aData['end_day'])) {
                $day = $aData['end_day'];
            }
            $aParam['where'][] = " {$sField} between :start_day and :end_day";
            $aParam['condition'][":start_day"] = $day . " 00:00:00";
            $aParam['condition'][":end_day"] = $day . " 23:59:59";
        }
        return true;
    }

    function addByFiltered($aData) {
        $aData = $this->filter($this->aField, $aData);
        return $this->insertDB($aData);
    }

}
