<?php

class Util_Layout {

    private $_aField = array();
    private $_sContent = "";
    private $_aChartColumn = array();
    private $_sChartData = "";
    private $_aDataTableColumn = array();
    private $_sDataTableData = "";
    private $_aFormAddColumn = array();
    private $_sFormAddData = "";
    private $_aFormEditColumn = array();
    private $_sFormEditData = "";
    private $_sFormDeleteData = "";
    private $_aParams = array();
    private $_sParamXml = "";
    private $_sSeparator = "\r\n";
    private $_aViewFalseField = array("password","ctime", "mtime");
    private $_sResourceId = "";

    public function __construct($aField, $aParams, $sResourceId) {
        $this->_aField = $aField;
        $this->_aParams = $aParams;
        $this->_sResourceId = $sResourceId;
        $this->loadLayoutTemplate();
    }

    private function loadLayoutTemplate() {
        $oFile = new Util_File();
        $this->_sContent = $oFile->readIniToStr($this->_aParams["layout"]["conf"] . "/layout.xml");
    }

    public function generateLayout() {
        $this->toParamXml();
        foreach ($this->_aField as $row) {
            $this->toChartColumn($row);
            $this->toDataTableColumn($row);
            $this->toFormAddColumn($row);
            $this->toFormEditColumn($row);
        }        
        $this->toChartData();
        $this->toDataTableData();
        $this->toFormAddData();
        $this->toFormEditData();
        $this->toFormDeleteData();
        $this->mergeToContent();
        return $this->_sContent;
    }

    private function toChartColumn($row) {
        
    }

    private function toChartData() {
        
    }

    private function toDataTableColumn($row) {
        $sColumn = <<<EOB
<column>
	<field>{Field}</field>
	<name>{Name}</name>
	<search>{Search}</search>
        <view>{View}</view>
</column>
EOB;
        $sColumn = str_replace("{Field}", $row->field, $sColumn);
        if (!empty($row->comment)) {
            $sColumn = str_replace("{Name}", $row->comment, $sColumn);
        } else {
            $sColumn = str_replace("{Name}", $row->field, $sColumn);
        }
        if (in_array($row->field, $this->_aViewFalseField)) {
            $sColumn = str_replace("{Search}", "false", $sColumn);
        } else {
            if ($row->type == "varchar(6)") {
                $sColumn = str_replace("{Search}", "true|month|b:e", $sColumn);
            } elseif (strstr($row->type, "varchar(")) {
                $sColumn = str_replace("{Search}", "true", $sColumn);
            } elseif ($row->type == "timestamp") {
                $sColumn = str_replace("{Search}", "true|day|b:e", $sColumn);
            } else {
                $sColumn = str_replace("{Search}", "false", $sColumn);
            }
        }
        if (in_array($row->field, $this->_aViewFalseField)) {
            $sColumn = str_replace("{View}", "false", $sColumn);
        } else {
            $sColumn = str_replace("{View}", "true", $sColumn);
        }
        $this->_aDataTableColumn[] = $sColumn;
    }

    private function toDataTableData() {
        $this->_aDataTableColumn[] =<<<EOB
<column type='text'>
    <name>操作</name>
    <text><![CDATA[
                <a data-am-modal="{target: '#my-popups-edit'}" class="am-btn am-btn-default am-btn-xs am-text-secondary" href="javascript:;" onclick="loadEditForm('{$this->_aParams["layout"]["edit"]}&id={id}');"><span class="am-icon-pencil-square-o"></span>编辑</a>
                <a data-am-modal="{target: '#my-popups-delete'}" class="am-btn am-btn-default am-btn-xs am-text-secondary" href="javascript:;" onclick="loadDeleteForm('{$this->_aParams["layout"]["edit"]}&id={id}');"><span class="am-icon-trash-o"></span>删除</a>
        ]]></text>
</column>
EOB;
        $this->_sDataTableData = <<<EOB
        <params>
            {Params}
        </params>
        <download>           
        </download>
        <get_url>Entity:{$this->_sResourceId}:gets</get_url>
	<add_url hidden="false"><![CDATA[{AddUrl}]]></add_url>
EOB;
        $this->_sDataTableData = str_replace("{Params}", $this->_sParamXml, $this->_sDataTableData);
        $this->_sDataTableData = str_replace("{AddUrl}", $this->_aParams["layout"]["add"], $this->_sDataTableData);
    }

    private function toFormAddColumn($row) {
        $this->_aFormAddColumn[] = $this->toCommonModifyColumn($row,"add");
    }

    private function toFormAddData() {
        $this->_sFormAddData = $this->ToOnlyReturnData();
    }

    private function toFormEditColumn($row) {
        $this->_aFormEditColumn[] = $this->toCommonModifyColumn($row,"edit");
    }

    private function toFormEditData() {
        $this->_sFormEditData = <<<EOB
        <params>
            {Params}
        </params>
        <get_url>Entity:{$this->_sResourceId}:gets</get_url>
        <submit_url><![CDATA[{submit_url}]]></submit_url>
        <return_url hidden="false"><![CDATA[{ReturnUrl}]]></return_url>
EOB;
        $this->_sFormEditData = str_replace("{Params}", $this->_sParamXml, $this->_sFormEditData);
        $this->_sFormEditData = str_replace("{submit_url}", $this->_aParams["layout"]["submit"], $this->_sFormEditData);
        $this->_sFormEditData = str_replace("{ReturnUrl}", $this->_aParams["layout"]["return"], $this->_sFormEditData);
    }

    private function toFormDeleteData() {
        $this->_sFormDeleteData = $this->ToOnlyReturnData();
    }

    private function mergeToContent() {
        $this->_sContent = str_replace("<{chart_column}>", implode($this->_sSeparator, $this->_aChartColumn), $this->_sContent);
        $this->_sContent = str_replace("<{chart_data}>", $this->_sChartData, $this->_sContent);
        $this->_sContent = str_replace("<{datables_column}>", implode($this->_sSeparator, $this->_aDataTableColumn), $this->_sContent);
        $this->_sContent = str_replace("<{datables_data}>", $this->_sDataTableData, $this->_sContent);
        $this->_sContent = str_replace("<{formadd_column}>", implode($this->_sSeparator, $this->_aFormAddColumn), $this->_sContent);
        $this->_sContent = str_replace("<{formadd_data}>", $this->_sFormAddData, $this->_sContent);
        $this->_sContent = str_replace("<{formedit_column}>", implode($this->_sSeparator, $this->_aFormEditColumn), $this->_sContent);
        $this->_sContent = str_replace("<{formedit_data}>", $this->_sFormEditData, $this->_sContent);
        $this->_sContent = str_replace("<{formdelete_data}>", $this->_sFormDeleteData, $this->_sContent);
    }

    private function toCommonModifyColumn($row,$sAction) {
        $sColumn = <<<EOB
<column>
	<field>{Field}</field>
	<name>{Name}</name>
	<edit>{Edit}</edit>
        <view>{View}</view>
        <type>{Type}</type>
</column>
EOB;
        $sColumn = str_replace("{Field}", $row->field, $sColumn);
        if (!empty($row->comment)) {
            $sColumn = str_replace("{Name}", $row->comment, $sColumn);
        } else {
            $sColumn = str_replace("{Name}", $row->field, $sColumn);
        }
        if($sAction =='edit' and ($row->key == "PRI" or $row->key == "UNI" or in_array($row->field, $this->_aViewFalseField))){
            $sColumn = str_replace("{Edit}", "false", $sColumn);
        }elseif($sAction =='add' and ($row->field == "id" or in_array($row->field, $this->_aViewFalseField))){
            $sColumn = str_replace("{Edit}", "false", $sColumn);
        }elseif ($row->type == "varchar(6)") {
            $sColumn = str_replace("{Edit}", "true|month|b:e", $sColumn);
        } elseif ($row->type == "timestamp") {
            $sColumn = str_replace("{Edit}", "true|day|b:e", $sColumn);
        } else {
            $sColumn = str_replace("{Edit}", "true", $sColumn);
        }
        if (in_array($row->field, $this->_aViewFalseField)) {
            $sColumn = str_replace("{View}", "false", $sColumn);
        } else {
            $sColumn = str_replace("{View}", "true", $sColumn);
        }
        if(strstr($row->type,"text")){
            $sColumn = str_replace("{Type}", "textarea", $sColumn);
        }else{
            $sColumn = str_replace("{Type}", "input", $sColumn);
        }
        return $sColumn;
    }

    private function ToOnlyReturnData() {
        $sParams = <<<EOB
        <params>
            {Params}
        </params>
        <submit_url><![CDATA[{submit_url}]]></submit_url>
        <return_url hidden="false"><![CDATA[{ReturnUrl}]]></return_url>
EOB;
        $sParams = str_replace("{Params}", $this->_sParamXml, $sParams);
        $sParams = str_replace("{submit_url}", $this->_aParams["layout"]["submit"], $sParams);
        return str_replace("{ReturnUrl}", $this->_aParams["layout"]["return"], $sParams);
    }

    private function toParamXml() {
        $aParams = explode(",", $this->_aParams["layout"]["params"]);
        foreach ($aParams as $sParam) {
            $this->_sParamXml .= "<param>{$sParam}</param>" . $this->_sSeparator;
        }
    }

}
