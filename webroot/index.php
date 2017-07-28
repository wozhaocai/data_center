<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");

$oApp->loadTemplate();
        
$oApp->assign("helloworld", "hello world")->display("index.tpl");

