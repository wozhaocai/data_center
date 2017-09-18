<?php
///usr/local/bin/php php_job.php -bdc -tscript -sSpider_us_china_code_list -aget
///usr/local/bin/php php_job.php -bdc -tworkflow -sus_china -asave_price
///usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_sh_code_list -aget
///usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_sz_code_list -aget
///usr/local/bin/php php_job.php -bdc -tscript -sSpider_china_hk_code_list -aget
///usr/local/bin/php php_job.php -bdc -tworkflow -schina_sh -asave_price
///usr/local/bin/php php_job.php -bdc -tworkflow -schina_sz -asave_price
///usr/local/bin/php php_job.php -bdc -tworkflow -schina_hk -asave_price

define("APPLICATION_PATH", dirname(dirname(__FILE__)));
include_once(APPLICATION_PATH."/config/config.inc.php");

$sHelp =<<<_HELP
此脚本进行sql转换，拆分表的字段
/usr/local/bin/php php_job.php -t<type> -b<business_id> -s<script_id> -a<action> [-d<YYYYmmdd>] [-m<YYYYmm>]

options: 
  t : 必选，类型,script(单个命令脚本）,workflow（工作流脚本)
  b : 必选，business_id
  s : 必选，脚本id
  a : 必选，action
  d : 可选，日期
  m : 可选, 月份
              
_HELP;


$aOption = checkOpt($sHelp,'t::b::s::a::d::m::','t,b,s');
foreach($aOption as $sKey=>$sVal){
    $_POST[$sKey] = $sVal;
}
$oView = new GS_Service();
$oView->route($aOption["t"]);

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
