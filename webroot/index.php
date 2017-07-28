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

register_shutdown_function(function() {
    
});

$oApp = new GliderSky(APPLICATION_PATH . "/config/application.ini");
$oApp->run();
debugVar(IDC);
echo "hello world";
