<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");

$oModule = new GS_Module();

$oTemplate = new GS_Template();
$oTemplate->loadTemplate();        
$oApp->setTemplate($oTemplate);
$oTemplate->assign("helloworld", "hello world")->display("index.tpl");

