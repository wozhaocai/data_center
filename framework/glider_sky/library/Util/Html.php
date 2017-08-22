<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util_Html{
    function formatHtmlByObj($oHtml) {
        $type = (string) $oHtml['type'];
        $sStr = "";
        switch ($type) {
            case 'input':
                $sStr = $this->formatInputByObj($oHtml);
                break;
            case 'file':
                $sStr = $this->formatFileByObj($oHtml);
                break;
            default :
                break;
        }
        return $sStr;
    }

    function formatInputByObj($oInput) {
        $name = (string) $oInput['name'];
        $text = (string) $oInput;
        var_dump($name);
        var_dump($text);
        exit;
    }

    function formatFileByObj($oInput) {
        $name = (string) $oInput['name'];
        $text = (string) $oInput;
        $sHtml = "<input id='{$name}' type='file' name='{$name}'>{$text}";
        return $sHtml;
    }

    public static function formatAmazeInputByObj($oInput, $oData, &$aHiddenArr=array()) {        
        $field = (string) $oInput->field;
        $name = (string) $oInput->name;
        $edit = (string) $oInput->edit;
        $view = (string) $oInput->view;
        $type = (string) $oInput->type;
        //debugVar($oInput);
        //debugVar($oData);
        if(isset($oInput->size)){
            $size = (string) $oInput->size;
        }else{
            $size = 30;
        }
        if ($view == "false") {
            return "";
        }    
        if($type == "textarea"){
            $aInput = "<textarea class='' name='{$oInput->field}' rows='5' id='doc-ipt-{$oInput->field}'>{$oData->$field}</textarea>";
        }elseif($type == "password"){
            $aInput = "<input type='password' name='{$oInput->field}' class='am-input-sm' id='doc-ipt-{$oInput->field}' value='{$oData->$field}' placeholder='请输入{$name}'>";
        }else{
            $aInput = "<input type='text' name='{$oInput->field}' size='{$size}' class='am-input-sm' id='doc-ipt-{$oInput->field}' value='{$oData->$field}' placeholder='请输入{$name}'>";
        }
        $str = "";
        if ($edit == 'false') {
            $aHiddenArr .= "\n<input type='hidden' name='{$field}' value='{$oData->$field}'>\n";
            $str .= <<<EOB
                    <div class="am-g am-margin-top-sm">
                            <div class="am-u-sm-2 meta-form-zuo">{$name}：</div>
                            <div class="am-u-sm-4 meta-form-you">
                                <span class="field">{$oData->$field}</span>
                            </div>
                    </div>
EOB;
        } else {
            $str .= <<<EOB
                    <div class="am-g am-margin-top-sm">
                            <div class="am-u-sm-2 meta-form-zuo">{$name}：</div>
                            <div class="am-u-sm-4 meta-form-you">
                                {$aInput}
                            </div>
                    </div>
EOB;
        }
        //debugVar($str);
        return $str;
    }

    public static function formatAmazeInput($oInput) {
        $field = (string) $oInput->field;
        $name = (string) $oInput->name;
        $edit = (string) $oInput->edit;
        $view = (string) $oInput->view;
        $type = (string) $oInput->type;
        //debugVar($oInput);
        //debugVar($oData);
        if(isset($oInput->size)){
            $size = (string) $oInput->size;
        }else{
            $size = 30;
        }
        if ($oInput or $view == "false") {
            $str = "";
        }    
        if($type == "textarea"){
            $aInput = "<textarea name='{$oInput->field}' class='' rows='5' id='doc-ipt-{$oInput->field}'></textarea>";
        }elseif($type == "password"){
            $aInput = "<input type='password' name='{$oInput->field}' class='am-input-sm' id='doc-ipt-{$oInput->field}' placeholder='请输入{$name}'>";
        }else{
            $aInput = "<input type='text' name='{$oInput->field}' size='{$size}' class='am-input-sm' id='doc-ipt-{$oInput->field}' placeholder='请输入{$name}'>";
        }
        $str = "";
        if ($edit == 'false') {
            $str .= <<<EOB
                    <div class="am-g am-margin-top-sm">
                            <div class="am-u-sm-2 meta-form-zuo">{$name}：</div>
                            <div class="am-u-sm-4 meta-form-you">
                                <span class="field"></span>
                            </div>
                    </div>
EOB;
        } else {
            $str .= <<<EOB
                    <div class="am-g am-margin-top-sm">
                            <div class="am-u-sm-2 meta-form-zuo">{$name}：</div>
                            <div class="am-u-sm-4 meta-form-you">
                                {$aInput}
                            </div>
                    </div>
EOB;
        }
        //debugVar($str);
        return $str;
    }

    public static function formatSearchByObj($sSearch, $sSeachKey, $sSearchName, &$aQueryField, &$aQueryValue, $aRequest, $sSplit = '') {
        $aSearch = explode("|", $sSearch);
        if ($aSearch[0] == "true") {
            if (isset($aSearch[1]) and $aSearch[1] == "month") {
                if (isset($aSearch[2]) and $aSearch[2] == "b:e") {
                    $aQueryField['start_month'] = '开始月份';
                    $aQueryField['end_month'] = '结束月份';
                    if (isset($aRequest['start_month'])) {
                        $aQueryValue['start_month'] = $aRequest['start_month'];
                    }else{
                        $aQueryValue['start_month'] = "";
                    }
                    if (isset($aRequest['end_month'])) {
                        $aQueryValue['end_month'] = $aRequest['end_month'];
                    }else{
                        $aQueryValue['end_month'] = "";
                    }
                    return <<<EOB
<li style="margin-right: 0;">
    	<span class="tubiao am-icon-calendar"></span>
      <input type="text" id="start_month" name="start_month" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="开始月份" data-am-datepicker="{theme: 'success',viewMode: 'months',}"  readonly/>
    </li>
       <li style="margin-left: -4px;">
    	<span class="tubiao am-icon-calendar"></span>
      <input type="text" id="end_month" name="end_month" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="结束月份" data-am-datepicker="{theme: 'success',viewMode: 'months',}"  readonly/>
    </li>
EOB;
                } else {
                    return "{$sSearchName}:<input type='text' name='{$sSearchKey}' id='{$sSearchKey}' value=''>{$sSplit}";
                }
            } elseif (isset($aSearch[1]) and $aSearch[1] == "day") {
                if (isset($aSearch[2]) and $aSearch[2] == "b:e") {
                    $aQueryField['start_day'] = '开始日期';
                    $aQueryField['end_day'] = '结束日期';
                    if (isset($aRequest['start_day'])) {
                        $aQueryValue['start_day'] = $aRequest['start_day'];
                    }else{
                        $aQueryValue['start_day'] = "";
                    }
                    if (isset($aRequest['end_day'])) {
                        $aQueryValue['end_day'] = $aRequest['end_day'];
                    }else{
                        $aQueryValue['end_day'] = "";
                    }
                    return <<<EOB
<li style="margin-right: 0;">
    	<span class="tubiao am-icon-calendar"></span>
      <input type="text" id="start_day" name="start_day" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="开始日期" data-am-datepicker="{theme: 'success',}"  readonly/>
    </li>
       <li style="margin-left: -4px;">
    	<span class="tubiao am-icon-calendar"></span>
      <input type="text" id="end_day" name="end_day" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="结束日期" data-am-datepicker="{theme: 'success',}"  readonly/>
    </li>
EOB;
                } else {
                    return "{$sSearchName}:<input type='text' name='{$sSearchKey}' id='{$sSearchKey}' value=''>{$sSplit}";
                }
            } else {
                return "{$sSearchName}:<input type='text' name='{$sSearchKey}' id='{$sSearchKey}' value=''>{$sSplit}";
            }
        } else {
            return '';
        }
    }
    
    public static function getHiddenForm($sHostUrl){
        $aHost = parse_url($sHostUrl);
        parse_str($aHost['query'],$aOutput);
        $aHidden = array();
        foreach($aOutput as $sKey=>$sVal){
            $aHidden[] = "<input type='hidden' name='{$sKey}' value='{$sVal}'>";
        }
        $aHost["query"] = implode("\n",$aHidden);
        return $aHost;        
    }
}