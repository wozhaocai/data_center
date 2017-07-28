<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("APPLICATION_PATH", dirname(dirname(__FILE__)));
header('Content-Type: text/html; charset=utf-8');
require_once APPLICATION_PATH."/framework/glider_sky/library/PearLocator.php";
ServiceLocator::attachLocator(new PearLocator(APPLICATION_PATH."/framework/glider_sky"), 'PEAR');
function debugVar($sVal){
    var_dump("<pre>");
    var_dump($sVal);
    var_dump("</pre>");
}

register_shutdown_function(function() {
    
});

include_once(APPLICATION_PATH."/include/smarty.inc.php");

$oApp = new GliderSky(APPLICATION_PATH . "/config/application.ini");
$oApp->run();

debugVar(GliderSky::$aConfig);
debugVar($_SERVER);
echo "hello world";
