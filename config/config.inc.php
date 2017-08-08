<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPLICATION_PATH."/framework/glider_sky/library/PearLocator.php";
require_once APPLICATION_PATH."/application/controller/BaseController.php";
ServiceLocator::attachLocator(new PearLocator(APPLICATION_PATH."/framework/glider_sky"), 'PEAR');
function debugVar($sVal){
    var_dump("<pre>");
    var_dump($sVal);
    var_dump("</pre>");
}

register_shutdown_function(function() {
    
});

$oApp = new GliderSky(APPLICATION_PATH . "/config/application.ini");
$oApp->run();





;
