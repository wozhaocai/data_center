<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");
$oTemplate = new GS_Template();
if(!empty($_REQUEST["code_text"])){    
    $oTemplate->assign("code_text", $_REQUEST["code_text"])->assign("code_transfer",  urlencode($_REQUEST["code_text"]))->display("tool.tpl");
}else{
    $oTemplate->assign("code_text", "")->assign("code_transfer","")->display("tool.tpl");
}
