<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Layout {

    private $_oTemplate = "";
    private $_sResource = "";
    private $_sNodeType = "";
    private $_sLayout = "";
    private $_oXml = null;
    private $_sBaseUrl = "";
    private $_aParams = array();
    private static $_iInputSizeUnit = 60;

    public function __construct(&$oTemplate, $sReource, $sNodeType, $aParams, $sLayout = "") {
        $this->_oTemplate = $oTemplate;
        $this->_sResource = $sReource;
        $this->_sNodeType = $sNodeType;
        $this->_aParams = $aParams;
        $this->_sLayout = $sLayout;
    }

    private function setBaseUrl() {
        list($sPageUrl, $sParam) = explode("?", $_SERVER['REQUEST_URI']);
        $aParam = explode("&", $sParam);
        $aUrlParam = array();
        $aDiffKey = array();
        $aUrlStrParam = array();
        foreach ($aParam as $sKey => $sOption) {
            if (!strstr($sOption, "="))
                continue;
            list($sField, $sVal) = explode("=", $sOption);
            if (strstr($sOption, "page=") and isset($this->_aParams["form_act"]) and $this->_aParams["form_act"] == "search") {
                $sOption = "page=1";
            }
            if (!isset($aDiffKey[$sField])) {
                $aUrlStrParam[] = $sOption;
                $aDiffKey[$sField] = $sVal;
            }
        }
        foreach ($aUrlStrParam as $sKey => $sOption) {
            if (strstr($sOption, "page=")) {
                $aUrlStrParam[$sKey] = 'page=1';
            }
            if (strstr($sOption, "c_order") or strstr($sOption, "order_status")) {
                continue;
            }
            $aUrlParam[$sKey] = $sOption;
        }
        $this->_sBaseUrl = $sPageUrl . "?" . implode('&', $aUrlParam);
    }

    public function run() {
        $this->_sResource = str_replace("\\", "", $this->_sResource);
        $oXml = new Util_Xml("", $this->_sResource);
        $this->_oXml = $oXml->getContent();
        if ($this->_sNodeType == "show") {
            return $this->parseDataTables($this->_oXml->datatables);
        } elseif ($this->_sNodeType == "edit") {
            return $this->parseFormEdit($this->_oXml->formedit);
        } elseif ($this->_sNodeType == "add") {
            return $this->parseFormAdd($this->_oXml->formadd);
        } elseif ($this->_sNodeType == "get") {
            return $this->parseDataTables($this->_oXml->datatables);
        } elseif ($this->_sNodeType == "group") {
            return $this->parseGroup($this->_oXml->group_form, $this->_aParams["group_action"]);
        }
    }

    public function parseGroup($oNode, $action = "show") {
        if ($action == "show") {
            $this->getGroupData($oNode);
            return $this->generateGroupHtml($oNode);
        }elseif($action == "save"){
            return $this->saveGroupData($oNode);
        }
    }
    
    private function saveGroupData($oNode){
        $aParams = array();
        foreach($oNode->save->params->param as $oParam){
            $sField = (string)$oParam;
            $sMapField = empty($oParam["map_field"]) ? $sField : (string)$oParam["map_field"];
            if($sField != "ids"){                
                $aParams[$sMapField] = $this->_aParams[$sField];
            }else{
                $aIds[$sMapField] = $this->_aParams[$sField];
            }
        }
        $sEntity = (string)$oNode->save->data->entity;
        $oModule = new GS_Module($this->_aParams['business'],"Entity",$sEntity,"deleteByParam",$this->_aParams);
        $oModule->run();
        if(!empty($aIds)){
            foreach($aIds as $sKey => $aRow){
                foreach($aRow as $sVal){
                    $aParams[$sKey] = $sVal;
                    debugVar($aParams);
                    $oModule = new GS_Module($this->_aParams['business'],"Entity",$sEntity,"insert",$aParams);
                    $oModule->run();
                }
            }
        }
    }

    private function getGroupData($oNode) {
        foreach ($oNode->input->params->param as $oParam) {
            $sMapField = (string) $oParam["map_field"];
            $sInputField = (string) $oParam;
            $this->_aParams["where"][":" . $sMapField] = $this->_aParams[$sInputField];
        }
        $sEntityStr = " ";
        $this->_aParams["select"] = (string) $oNode->input->data->select;
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
    }

    private function generateGroupHtml($oNode) {
        $oModule = new GS_Module($this->_aParams['business'], "Entity", "Union", $this->_aParams["action"], $this->_aParams);
        $aRsNow = $oModule->run();        
        $sShowEntity = (string)$oNode->show->data->entity;
        $oModule = new GS_Module($this->_aParams['business'], "Entity", $sShowEntity, "gets", $this->_aParams);
        $aRs = $oModule->run();
        $aParams = $oModule->getParams();
        $data = $this->getDataList($aRs, $aParams);
        $aData = $this->parseDataTables($oNode->show, $data);
        $this->generateOptionHtml($aData["list"],$aRsNow,(string)$oNode->show->columns["option_field"]);
        $this->_oTemplate->assign("action_des", (string) $oNode->show["name"]);
        $this->generateExtAction($oNode->show);
        return $aData;
    }
    
    private function generateOptionHtml($aData,$aRsNow=array(),$sOptionField=""){
        $aOptionHtml = array();        
        foreach($aData as $i=>$row){
            if(!empty($aRsNow[$i]) and !empty($sOptionField)){
                list($sFieldName,$sFieldNum) = explode(":", $sOptionField);
                if($aRsNow[$i]->$sFieldName == $row[$sFieldNum]){
                    $aOptionHtml[$i] = " checked ";
                }else{
                    $aOptionHtml[$i] = "";
                }
            }else{
                $aOptionHtml[$i] = "";
            }
        }
        $this->_oTemplate->assign("aOptionHtml", $aOptionHtml);
    }
    
    private function generateExtAction($oNode){
        $sExtAction =<<<EOB
            <div class="am-btn-group am-btn-group-xs">
                {ext_action}            
                 <input type='hidden' name='main_form_act' id='main_form_act' value=''>
            </div>
EOB;
        $aHtml = array();
        if(!empty($oNode->ext_action)){
            foreach($oNode->ext_action->option as $oAction){                
                $aHtml[]= '<button type="button" onclick="ext_action(\''. (string)$oAction["act"] .'\')" class="am-btn am-btn-default"><span class="am-icon-save"></span>&nbsp;&nbsp;' .(string)$oAction . '</button>';
            }
        }
        $this->_oTemplate->assign("ext_action",  str_replace("{ext_action}", implode("\n",$aHtml), $sExtAction));
    }

    public function parseFormEdit($oNode) {
        $sGetUrl = (string) $oNode->data->get_url;
        $aData = $this->getData($sGetUrl);
        $sSubmitUrl = $this->parseUrl((string) $oNode->data->submit_url);
        $aHost = Util_Html::getHiddenForm($sSubmitUrl);
        if ($aData["list"]) {
            $aFillData = $aData["list"][0];
            $aColumnHtml = array();
            foreach ($oNode->columns->column as $oColumn) {
                $aColumnHtml[] = Util_Html::formatAmazeInputByObj($oColumn, $aFillData, $aHost["query"]);
            }
            $aColumnHtml[] = <<<EOB
                    <div class="am-form-group am-cf">
                            <div class="meta-form-button">
                                <p>
                                    <button type="submit" class="am-btn am-btn-success am-radius">提交</button>
                                    {$aHost["query"]}
                                    <input type="hidden" name="submit_action" value="edit">
                                </p>
                            </div>
                    </div>
EOB;
            $popup_form_max_height = count($aColumnHtml) * self::$_iInputSizeUnit;
            $sColumnStr = implode("\n", $aColumnHtml);
            echo json_encode(array("data" => $sColumnStr, "title" => "编辑", "meta_form_action" => $aHost["path"], "popup_form_max_height" => $popup_form_max_height . "px"));
        } else {
            $this->_oTemplate->assign("errormsg", "没有要找的数据，请核实");
        }
    }

    public function parseFormDelete($oNode) {
        $return_url = (string) $oNode->data->return_url;
        $sSuccess = $this->getData($data_url);
        if ($sSuccess) {
            $this->_oTemplate->assign("msg", "删除成功，请关闭本窗口，并刷新当前页面！");
        } else {
            $this->_oTemplate->assign("msg", "删除失败，请检查！");
        }
    }
    
    private function parseHidden($sUrl){
        $sSubmitUrl = $this->parseUrl($sUrl);
        return Util_Html::getHiddenForm($sSubmitUrl);
    }

    public function parseFormAdd($oNode) {
        $aHost = $this->parseHidden((string) $oNode->data->submit_url);
        $aColumnHtml = array();
        foreach ($oNode->columns->column as $oColumn) {
            $aColumnHtml[] = Util_Html::formatAmazeInput($oColumn);
        }
        $aColumnHtml[] = <<<EOB
                    <div class="am-form-group am-cf">
                            <div class="meta-form-button">
                                <p>
                                    <button type="submit" class="am-btn am-btn-success am-radius">提交</button>
                                    {$aHost["query"]}
                                    <input type="hidden" name="submit_action" value="add">
                                </p>
                            </div>
                    </div>
EOB;
        $popup_form_max_height = count($aColumnHtml) * self::$_iInputSizeUnit;
        $sColumnStr = implode("\n", $aColumnHtml);
        echo json_encode(array("data" => $sColumnStr, "title" => "添加", "meta_form_action" => $sSubmitUrl, "popup_form_max_height" => $popup_form_max_height . "px"));
    }

    private function parseDataTables($oNode, $data = array()) {
        $aColumn = array();
        $i = 0;
        $this->setBaseUrl();
        $sGroupField = '';
        if ($sTemp = (string) $oNode->columns['group']) {
            $sGroupField = $sTemp;
        } else {
            $sGroupField = '';
        }
        $aRowSpan = array();
        foreach ($oNode->columns->column as $oColumn) {
            $sField = (string) $oColumn->field;
            $sName = (string) $oColumn->name;
            $sView = (string) $oColumn->view;
            if ($sView == "false") {
                continue;
            }
            if ($oColumn['rowspan']) {
                $aRowSpan[] = (string) $oColumn['rowspan'];
            } else {
                $aRowSpan[] = "1";
            }
            $aSpecialFields = array("module", "action", "is_divpage", "page", "form_act", "c_order", "order_status");
            $aHostParam = parse_url($this->_sBaseUrl);
            $aUrlParam = explode("&", $aHostParam["query"]);
            $aPostParam = array();
            foreach ($_REQUEST as $sKey => $sVal) {
                if (!in_array($sKey, $aSpecialFields)) {
                    if (!in_array($sKey . "=" . $sVal, $aUrlParam)) {
                        $aPostParam[$sKey] = $sVal;
                    }
                }
            }
            $sRequestStr = "";
            if (!empty($aPostParam)) {
                $sRequestStr = "&" . http_build_query($aPostParam);
            }
            if (isset($_GET["c_order"]) and $_GET['c_order']) {
                if ($_GET["order_status"] == "desc" and $_GET["c_order"] == $sField) {
                    $imgstr = "<img src='/img/upo.gif' onclick=\"window.location='{$this->_sBaseUrl}&c_order={$sField}&order_status=asc{$sRequestStr}';\">";
                } else {
                    $imgstr = "<img src='/img/jjo.gif' onclick=\"window.location='{$this->_sBaseUrl}&c_order={$sField}&order_status=desc{$sRequestStr}';\">";
                }
            } else {
                if ($i == 0) {
                    $imgstr = "<img src='/img/upo.gif' onclick=\"window.location='{$this->_sBaseUrl}&c_order={$sField}&order_status=asc{$sRequestStr}';\">";
                } else {
                    $imgstr = "<img src='/img/jjo.gif' onclick=\"window.location='{$this->_sBaseUrl}&c_order={$sField}&order_status=desc{$sRequestStr}';\">";
                }
                $_GET['c_order'] = 'id';
                $_GET['order_status'] = 'asc';
            }
            $aColumn[] = "{$sName}&nbsp;{$imgstr}";
            $i++;
        }
        $this->_oTemplate->assign('aRowSpan', $aRowSpan);
        $this->_oTemplate->assign('aColumn', $aColumn);
        if ($oNode->data->add_url and (string) $oNode->data->add_url['hidden'] == 'false') {
            $sHtml = "<a class='am-btn am-btn-danger am-round am-btn-xs am-icon-plus' href=\"javascript:;\" onclick=\"loadEditForm('" . $this->parseUrl((string) $oNode->data->add_url) . "');\">添加新记录</a>";
            $this->_oTemplate->assign('action_des', $sHtml);
        }
        if (empty($data)) {
            $data = $this->get_data($oNode);
        }
        $aData = $this->get_data_table($data, $oNode, $sGroupField, $aRowSpan);
        $this->generateOptionHtml($aData["list"],array(),(string)$oNode->columns["option_field"]);
        $this->generateExtAction($oNode);
        return $aData;
    }

    private function get_data($oNode) {
        $sGetUrl = (string) $oNode->data->get_url;
        return $this->getData($sGetUrl);
    }

    private function get_data_table($data, $oNode, $sGroupField = '', $aRowSpan = array()) {
        $aKey = array();

        $i = 0;
        $aTempText = array();
        $sTextField = $sTextValue = '';
        $aSearchValue = array();
        $aSearch = array();
        $aSearchSpecial = array();
        $oHtml = new Util_Html();
        foreach ($oNode->columns->column as $oColumn) {
            $type = isset($oColumn['type']) ? (string) $oColumn['type'] : 'db';
            $format = isset($oColumn->format) ? (string) $oColumn->format : '';
            $aKey[$i]['view'] = isset($oColumn->view) ? (string) $oColumn->view : '';
            if ($type == "text") {
                $aKey[$i]['type'] = $type;
                $aTempText = array();
                foreach ($oColumn->text as $oTempText) {
                    $sTextField = isset($oTempText['field']) ? (string) $oColumn['field'] : '';
                    $sTextvalue = isset($oTempText['value']) ? (string) $oColumn['value'] : '';
                    $aTempText[$sTextField . ":" . $sTextValue] = (string) $oColumn->text;
                }
                $aKey[$i]['value'] = $aTempText;
            } else {
                $aKey[$i]['type'] = 'db';
                $aKey[$i]['format'] = $format;
                $aKey[$i]['value'] = (string) $oColumn->field;
                $aKey[$i]['name'] = (string) $oColumn->name;
                $sSearch = (string) $oColumn->search;
                if ($sSearch == "true") {
                    $aSearch[$aKey[$i]['value']] = $aKey[$i]['name'];
                    if (isset($_REQUEST[$aKey[$i]['value']])) {
                        $aSearchValue[$aKey[$i]['value']] = $_REQUEST[$aKey[$i]['value']];
                    } else {
                        $aSearchValue[$aKey[$i]['value']] = "";
                    }
                    if (strstr($sSearch, "|")) {
                        $aSearch[$aKey[$i]['value']] = $aKey[$i]['name'];
                        $aSearchSpecial[$aKey[$i]['value']] = $oHtml->formatSearchByObj($sSearch, $aKey[$i]['value'], $aKey[$i]['name'], $aSearch, $aSearchValue, $_REQUEST);
                    }
                }
            }
            $i++;
        }
        if (!empty($data)) {
            $aData["num"] = $data["num"];
        } else {
            $aData['num'] = 0;
        }

        $sLast = '';
        $sEmpty = false;
        $aDataGroup = array();
        $iCnt = 0;
        if (!empty($data["list"])) {

            foreach ($data["list"] as $index => $row) {
                $row = (array) $row;
                if (!empty($sGroupField) and $row[$sGroupField] != $sLast) {
                    $sLast = $row[$sGroupField];
                    $sEmpty = false;
                    $aDataGroup[$index] = "N";
                    $iCnt++;
                } elseif (!empty($sGroupField) and $row[$sGroupField] == $sLast) {
                    $sEmpty = true;
                    $aDataGroup[$index - 1] = "Y";
                    $iCnt = 0;
                } else {
                    $aDataGroup[$index] = "N";
                }
                foreach ($aKey as $i => $val) {
                    if (isset($aRowSpan[$i]) and $aRowSpan[$i] > 1 and $sEmpty) {
                        continue;
                    }
                    if ($val["view"] == "false") {
                        continue;
                    }
                    if ($val['type'] == "text") {
                        $sTextValue = '';
                        foreach ($val['value'] as $key => $sTemp) {
                            if ($key == ':') {
                                $sTextValue .= $sTemp;
                            } else {
                                list($sTempKey, $sTempVal) = explode(":", $key);
                                if ($row[$sTempKey] == $sTempVal) {
                                    $sTextValue .= $sTemp;
                                }
                            }
                        }
                        $sTextValue = Util_DataType::replace($sTextValue, $row);
                        $sTextValue = Util_DataType::replace($sTextValue, $this->_aParams);
                        $sTextValue = Util_DataType::special_replace($sTextValue);
                        $aData['list'][$index][] = $sTextValue;
                    } else {
                        if (isset($row[$val['value']]) and $row[$val['value']]) {
                            $sTempVal = $row[$val['value']];
                        } else {
                            $sTempVal = '&nbsp';
                        }
                        if ($val['format'] == "amount_round_div_100") {
                            $sTempVal = $this->format_money($sTempVal / 100);
                        }
                        $aData['list'][$index][] = $sTempVal;
                    }
                }
                $iCnt++;
            }
        }

        $this->_oTemplate->assign("aParam", $_REQUEST);
        $this->_oTemplate->assign("aDataGroup", $aDataGroup);
        $this->_oTemplate->assign("aSearch", $aSearch);
        $this->_oTemplate->assign("aSearchValue", $aSearchValue);
        $this->_oTemplate->assign("aSearchSpecial", $aSearchSpecial);
        $aSearchStr = '';
        foreach ($aSearch as $sKey => $sValue) {
            $aSearchStr[] = "'{$sKey}'";
        }
        if (!empty($aSearchStr)) {
            $this->_oTemplate->assign("sSearchStr", implode(",", $aSearchStr));
        }
        //debugVar($this->_sBaseUrl);
        //exit;
        $this->_oTemplate->assign("form_url", $this->_sBaseUrl);
        if (!empty($aData["list"])) {
            $this->_oTemplate->assign("aData", $aData["list"]);
        } else {
            $this->_oTemplate->assign("aData", array());
        }
        $aHost = $this->parseHidden($this->_sBaseUrl);
        $this->_oTemplate->assign("main_form_url",$aHost["path"]);
        $this->_oTemplate->assign("sHiddenHtml",$aHost["query"]);
        return $aData;
    }

    private function getData($sUrl) {
        list($module, $controller, $action) = explode(":", $sUrl);
        $oModule = new GS_Module($this->_aParams['business'], $module, $controller, $action, $this->_aParams);
        $aRs = $oModule->run();
        $aParams = $oModule->getParams();
        return $this->getDataList($aRs, $aParams);
    }

    private function getDataList($aRs, $aParams) {
        $aData = array(
            "list" => $aRs,
            "num" => $aParams["iDbAffectNum"]
        );
        return $aData;
    }

    private function parseUrl($sUrl) {
        foreach ($this->_aParams as $sKey => $sVal) {
            if (strstr($sUrl, "{" . $sKey . "}")) {
                $sUrl = str_replace("{" . $sKey . "}", $sVal, $sUrl);
            }
        }
        return $sUrl;
    }

}
