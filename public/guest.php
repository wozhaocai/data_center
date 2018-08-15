<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
include_once(APPLICATION_PATH."/config/config.inc.php");

$oTemplate = new GS_Template();

if(!empty($_SESSION["username"])){
    Header("Location:/service.php?business=dc&controller=member&action=index");
}

if(empty($_REQUEST["controller"])){    
    Header("Location:./index.php");
}else{
    $oView = new GS_Service();
    $oView->setTemplate($oTemplate);
    $oView->route();
}
