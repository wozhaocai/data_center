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
    private $_oXml = null;
    private $_sBaseUrl = "";
    private $_aParams = array();

    public function __construct(&$oTemplate, $sReource, $sNodeType, $aParams) {
        $this->_oTemplate = $oTemplate;
        $this->_sResource = $sReource;
        $this->_sNodeType = $sNodeType;
        $this->_aParams = $aParams;
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
            if (strstr($sOption, "page=") and $_REQUEST["form_act"] == "search") {
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
        $oXml = new Util_Xml("", $this->_sResource);
        $this->_oXml = $oXml->getContent();        
        if ($this->_sNodeType == "show") {
            $this->parseDataTables($this->_oXml->datatables);            
        }elseif($this->_sNodeType == "edit"){
            $this->parseFormEdit($this->_oXml->formedit);
        }
    }    
    
    public function parseFormEdit($oNode) {       
        $sGetUrl = (string) $oNode->data->get_url;
        $aData = $this->getData($sGetUrl);        
        if ($aData) {
            $aFillData = $aData[0];
            $aColumnHtml = array();            
            foreach ($oNode->columns->column as $oColumn) {
                $aColumnHtml[] = Util_Html::formatAmazeInputByObj($oColumn, $aFillData);
            }            
            $aColumnHtml[] =<<<EOB
                    <div class="am-form-group am-cf">
                            <div class="you">
                                <p>
                                    <button type="submit" class="am-btn am-btn-success am-radius">提交</button>
                                </p>
                            </div>
                    </div>
EOB;
            $sColumnStr = implode("<br>\n", $aColumnHtml);
            echo json_encode(array("data"=>$sColumnStr));
        } else {
            $this->_oSmarty->assign("errormsg", "没有要找的数据，请核实");
        }
    }

    public function parseFormDelete($oNode) {
        $return_url = (string) $oNode->data->return_url;
        $sSuccess = $this->getData($data_url);
        if ($sSuccess) {
            $this->_oSmarty->assign("msg", "删除成功，请关闭本窗口，并刷新当前页面！");
        } else {
            $this->_oSmarty->assign("msg", "删除失败，请检查！");
        }
    }

    public function parseFormAdd($oNode) {        
        $return_url = (string) $oNode->data->return_url;
        $aColumnHtml = array();
        foreach ($oNode->columns->column as $oColumn) {
            $aColumnHtml[] = Util_Html::formatAmazeInputByObjNoData($oColumn);
        }
        $aColumnHtml[] = "<input type='hidden' name='data' value='" . base64_encode($post_url) . "'>";
        $aColumnHtml[] = "<input type='hidden' name='return' value='" . base64_encode($return_url) . "'>";
        $aColumnHtml[] = "<input type='hidden' name='act_type' value='post'>";
        $sColumnStr = implode("<br>\n", $aColumnHtml);
        $this->_oSmarty->assign("htmlstr", $sColumnStr);
    }
    
    public function loadFormHeaderHtml($sAction){
        $sHeaderHtml =<<<EOB
                <div class="am-popup-hd">
                    <h4 class="am-popup-title">{$sAction}</h4>
                    <span data-am-modal-close
                          class="am-close">&times;</span> </div>
                <div class="am-popup-bd">
                    <form class="am-form tjlanmu">
                        <div class="am-form-group">
                            <div class="zuo">栏目名称：</div>
                            <div class="you">
                                <input type="email" class="am-input-sm" id="doc-ipt-email-1" placeholder="请输入标题">
                            </div>
                        </div>
                        <div class="am-form-group">
                            <div class="zuo">栏目关键词：</div>
                            <div class="you">
                                <input type="password" class="am-input-sm" id="doc-ipt-pwd-1" placeholder="请输入关键词">
                            </div>
                        </div>
                        <div class="am-form-group am-cf">
                            <div class="zuo">栏目描述：</div>
                            <div class="you">
                                <textarea class="" rows="2" id="doc-ta-1"></textarea>
                            </div>
                        </div> 

                        <div class="am-form-group am-cf">
                            <div class="zuo">简介：</div>
                            <div class="you">
                                <textarea class="" rows="2" id="doc-ta-1"></textarea>
                            </div>
                        </div>
                        <div class="am-form-group am-cf">
                            <div class="zuo">状态：</div>
                            <div class="you" style="margin-top: 3px;">
                                <label class="am-checkbox-inline">
                                    <input type="checkbox" value="option1">
                                    显示 </label>
                                <label class="am-checkbox-inline">
                                    <input type="checkbox" value="option2">
                                    隐藏 </label>
                            </div>
                        </div>
                        <div class="am-form-group am-cf">
                            <div class="you">
                                <p>
                                    <button type="submit" class="am-btn am-btn-success am-radius">提交</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
EOB;
    }

    private function parseDataTables($oNode) {
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
        $this->get_data_table($oNode, $sGroupField, $aRowSpan);
        $this->_oTemplate->assign('aRowSpan', $aRowSpan);
        $this->_oTemplate->assign('aColumn', $aColumn);
        if ($oNode->data->add_url and (string) $oNode->data->add_url['hidden'] == 'false') {
            $sHtml = "<a class='am-btn am-btn-danger am-round am-btn-xs am-icon-plus' href='" . (string) $oNode->data->add_url . "'>添加新记录</a>";
            $this->_oTemplate->assign('action_des', $sHtml);
        }
    }

    private function get_data_table($oNode, $sGroupField = '', $aRowSpan = array()) {
        $sGetUrl = (string) $oNode->data->get_url;
        $data = $this->getData($sGetUrl);

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
        $aData['num'] = 0;

        $sLast = '';
        $sEmpty = false;
        $aDataGroup = array();
        $iCnt = 0;
        if (!empty($data)) {

            foreach ($data as $index => $row) {
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
        $this->_oTemplate->assign("form_url", $this->_sBaseUrl);
        if(!empty($aData["list"])){
            $this->_oTemplate->assign("aData", $aData["list"]);
        }else{
            $this->_oTemplate->assign("aData", array());
        }
    }

    private function getData($sUrl) {
        list($module, $controller, $action) = explode(":", $sUrl);
        $oModule = new GS_Module($this->_aParams['business'], $module, $controller, $action, $this->_aParams);
        return $oModule->run();
    }

}
