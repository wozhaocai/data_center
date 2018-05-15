<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");

if(!empty($_SESSION["username"])){
    Header("Location:/service.php?business=dc&controller=member&action=index");
}

$oTemplate = new GS_Template();
if()
if(!empty($_REQUEST["err_msg"])){
    $oTemplate->assign("err_msg", $_REQUEST["err_msg"])->display("index.tpl");
}else{
    $oTemplate->assign("err_msg", "")->display("index.tpl");  
}
