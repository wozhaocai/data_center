<?php
class Util_Layout{
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
    private $_aViewFalseField = array("ctime","mtime");
    private $_sResourceId = "";
    
    public function __construct($aField,$aParams,$sResourceId) {
        $this->_aField = $aField;
        $this->_aParams = $aParams;
        $this->_sResourceId = $sResourceId;
        $this->loadLayoutTemplate();
    }
    
    private function loadLayoutTemplate(){
        $oFile = new Util_File();
        $this->_sContent = $oFile->readIniToStr($this->_aParams["layout"]["conf"]."/layout.xml"); 
    }
    
    public function generateLayout(){
        $this->toParamXml();
        foreach($this->_aField as $row){
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
    
    private function toChartColumn($row){        
    }
    
    private function toChartData(){
    }
    
    private function toDataTableColumn($row){        
        $sColumn =<<<EOB
<column>
	<field>{Field}</field>
	<name>{Name}</name>
	<search>{Search}</search>
        <view>{View}</view>
</column>
EOB;
        $sColumn = str_replace("{Field}", $row->field, $sColumn);
        if(!empty($row->comment)){
            $sColumn = str_replace("{Name}", $row->comment, $sColumn);
        }else{
            $sColumn = str_replace("{Name}", $row->field, $sColumn);
        }
        if($row->type == "varchar(6)"){
            $sColumn = str_replace("{Search}", "true|month|b:e", $sColumn);
        }elseif(strstr($row->type,"varchar(")){
            $sColumn = str_replace("{Search}", "true", $sColumn);
        }elseif($row->type == "timestamp"){
            $sColumn = str_replace("{Search}", "true|day|b:e", $sColumn);
        }else{
            $sColumn = str_replace("{Search}", "false", $sColumn);
        }
        if(in_array($row->field,$this->_aViewFalseField)){
            $sColumn = str_replace("{View}", "false", $sColumn);
        }else{
            $sColumn = str_replace("{View}", "true", $sColumn);
        }
        $this->_aDataTableColumn[] = $sColumn;                                 
    }
    
    private function toDataTableData(){
$this->_sDataTableData =<<<EOB
        <params>
            {Params}
        </params>
        <download>           
        </download>
        <get_url>Entity:{$this->_sResourceId}:gets</get_url>
	<edit_url hidden="false"><![CDATA[{EditUrl}]]></edit_url>
	<add_url hidden="false"><![CDATA[{AddUrl}]]></add_url>
        <delete_url hidden="true"><![CDATA[{DeleteUrl}]]></delete_url>
EOB;
        $this->_sDataTableData = str_replace("{Params}",$this->_sParamXml,$this->_sDataTableData);
        $this->_sDataTableData = str_replace("{EditUrl}",$this->_aParams["layout"]["edit"],$this->_sDataTableData);
        $this->_sDataTableData = str_replace("{AddUrl}",$this->_aParams["layout"]["add"],$this->_sDataTableData);
        $this->_sDataTableData = str_replace("{DeleteUrl}",$this->_aParams["layout"]["delete"],$this->_sDataTableData);
    }
    
    private function toFormAddColumn($row){
        $this->_aFormAddColumn[] = $this->toCommonModifyColumn($row);
    }
    
    private function toFormAddData(){
        $this->_sFormAddData = $this->ToOnlyReturnData();
    }
    
    private function toFormEditColumn($row){
        $this->_aFormEditColumn[] = $this->toCommonModifyColumn($row);
    }
    
    private function toFormEditData(){
        $this->_sFormEditData = $this->ToOnlyReturnData();
    }
    
    private function toFormDeleteData(){
        $this->_sFormDeleteData = $this->ToOnlyReturnData();
    }
    
    private function mergeToContent(){
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
    
    private function toCommonModifyColumn($row){
 $sColumn =<<<EOB
<column>
	<field>{Field}</field>
	<name>{Name}</name>
	<edit>{Edit}</edit>
        <view>{View}</view>
</column>
EOB;
        $sColumn = str_replace("{Field}", $row->field, $sColumn);
        if(!empty($row->comment)){
            $sColumn = str_replace("{Name}", $row->comment, $sColumn);
        }else{
            $sColumn = str_replace("{Name}", $row->field, $sColumn);
        }
        if($row->type == "varchar(6)"){
            $sColumn = str_replace("{Edit}", "true|month|b:e", $sColumn);
        }elseif($row->type == "timestamp"){
            $sColumn = str_replace("{Edit}", "true|day|b:e", $sColumn);
        }else{
            $sColumn = str_replace("{Edit}", "true", $sColumn);
        }
        if(in_array($row->field,$this->_aViewFalseField)){
            $sColumn = str_replace("{View}", "false", $sColumn);
        }else{
            $sColumn = str_replace("{View}", "true", $sColumn);
        }
        return $sColumn;
    }
    
    private function ToOnlyReturnData(){
        $sParams =<<<EOB
        <params>
            {Params}
        </params>
        <return_url hidden="false"><![CDATA[{ReturnUrl}]]></return_url>
EOB;
        $sParams= str_replace("{Params}",$this->_sParamXml,$sParams);
        return str_replace("{ReturnUrl}",$this->_aParams["layout"]["return"],$sParams);
    }
    
    private function toParamXml(){
        $aParams = explode(",",$this->_aParams["layout"]["params"]);
        foreach ($aParams as $sParam){
            $this->_sParamXml .= "<param>{$sParam}</param>".$this->_sSeparator;
        }        
    }
}
