<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");
debugVar($_SESSION);
if(empty($_SESSION["username"])){
    Header("Location:/index.php");
}

$oTemplate = new GS_Template();

if(empty($_REQUEST["controller"])){    
    Header("Location:/service.php?business={$_SESSION['business']}&controller=member&action=index");
}else{
    $oView = new GS_Service($oTemplate);
    $oView->route();
}
