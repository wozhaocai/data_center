<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');

include_once(APPLICATION_PATH."/config/config.inc.php");

$oModule = new GS_Module("dc","Entity","users","gets",array("username"=>"fengwei"));
//$oModule = new GS_Module("dc","Entity","Admin_Users","search",array("username"=>"fengwei"));
debugVar("result");
debugVar($oModule->run());
/**WW
$oTemplate = new GS_Template();
$oTemplate->loadTemplate();  
$oTemplate->assign("helloworld", "hello world")->display("index.tpl");
*/
