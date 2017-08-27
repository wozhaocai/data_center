<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
include_once(APPLICATION_PATH."/config/config.inc.php");

$sHelp =<<<_HELP
此脚本进行sql转换，拆分表的字段
php job.php -b<business_id> -s<script_id> -a<action> [-d<YYYYmmdd>] [-m<YYYYmm>]

options: 
  b : 必选，business_id
  s : 必选，脚本id
  a : 必选，action
  d : 可选，日期
  m : 可选, 月份
              
_HELP;


$aOption = checkOpt($sHelp,'b::s::a::d::m::','s');
foreach($aOption as $sKey=>$sVal){
    $_POST[$sKey] = $sVal;
}

$oView = new GS_Service();
$oView->route("scripts");

function usage_help($sHelp) {
    echo str_replace("{script}", FILENAME, $sHelp);
    exit(0);
}

function checkOpt($sHelp, $sOption, $sMustOptionStr = '') {
    $aOption = getopt($sOption);
    if (!empty($sMustOptionStr)) {
        $aMustOption = explode(",", $sMustOptionStr);
        if (count($aMustOption) > 0) {
            foreach ($aMustOption as $sMustOption) {
                if (empty($aOption[$sMustOption])) {
                    usage_help($sHelp);
                }
            }
            return $aOption;
        } else {
            usage_help($sHelp);
        }
    } else {
        return $aOption;
    }
}
