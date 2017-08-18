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

    function formatAmadaInputByObj($oInput, $aData) {
        $field = (string) $oInput->field;
        $name = (string) $oInput->name;
        $edit = (string) $oInput->edit;
        if(isset($oInput->size)){
            $size = (string) $oInput->size;
        }else{
            $size = 30;
        }
        if ($oInput) {
            $str = "";
        }
        if ($edit == 'false') {
            $str .= <<<EOB
<label>{$name}</label>
<span class="field">{$aData[$field]}</span>
EOB;
        } else {
            $str .= <<<EOB
<label>{$name}</label>
<span class="field">
<input type="text" size='{$size}' value="{$aData[$field]}" class="width100" name='{$field}' id="{$field}">
</span>
EOB;
        }
        return $str;
    }

    function formatAmadaInputByObjNoData($oInput) {
        $field = (string) $oInput->field;
        $name = (string) $oInput->name;
        $edit = (string) $oInput->edit;
        if(isset($oInput->size)){
            $size = (string) $oInput->size;
        }else{
            $size = 30;
        }
        if ($oInput) {
            $str = "";
        }
        if ($edit == 'false') {
            $str .= <<<EOB
<label>{$name}</label>
<span class="field">{$aData[$field]}</span>
EOB;
        } else {
            $str .= <<<EOB
<label>{$name}</label>
<span class="field">
<input type="text" size='{$size}' value="" name='{$field}' id="{$field}">
</span>
EOB;
        }
        return $str;
    }

    function formatSearchByObj($sSearch, $sSeachKey, $sSearchName, &$aQueryField, &$aQueryValue, $aRequest, $sSplit = '') {
        $aSearch = explode("|", $sSearch);
        if ($aSearch[0] == "true") {
            if (isset($aSearch[1]) and $aSearch[1] == "month") {
                if (isset($aSearch[2]) and $aSearch[2] == "b:e") {
                    $aQueryField['start_month'] = '开始月份';
                    $aQueryField['end_month'] = '结束月份';
                    if (isset($aRequest['start_month'])) {
                        $aQueryValue['start_month'] = $aRequest['start_month'];
                    }
                    if (isset($aRequest['end_month'])) {
                        $aQueryValue['end_month'] = $aRequest['end_month'];
                    }
                    return "开始月份:<input type='text' name='start_month' id='start_month' value=''>&nbsp;&nbsp;结束月份<input type='text' name='end_month' id='end_month' value=''>{$sSplit}";
                } else {
                    return "{$sSearchName}:<input type='text' name='{$sSearchKey}' id='{$sSearchKey}' value=''>{$sSplit}";
                }
            } elseif (isset($aSearch[1]) and $aSearch[1] == "day") {
                if (isset($aSearch[2]) and $aSearch[2] == "b:e") {
                    $aQueryField['start_day'] = '开始日期';
                    $aQueryField['end_day'] = '结束日期';
                    if (isset($aRequest['start_day'])) {
                        $aQueryValue['start_day'] = $aRequest['start_day'];
                    }
                    if (isset($aRequest['end_day'])) {
                        $aQueryValue['end_day'] = $aRequest['end_day'];
                    }
                    return "开始日期:<input type='text' name='start_day' id='start_day' value=''>&nbsp;&nbsp;结束日期<input type='text' name='end_day' id='end_day' value=''>{$sSplit}";
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
}