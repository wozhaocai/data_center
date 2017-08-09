<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");

$oTemplate = new GS_Template();
if(empty($_REQUEST)){    
    $oTemplate->assign("helloworld", "hello world")->display("index.tpl");
}else{
    $oView = new GS_Service();
    $oView->route();
}

