<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("APPLICATION_PATH",  dirname(dirname(__FILE__)));
include_once(APPLICATION_PATH."/framework/glider_sky/core/GliderSky.php");

register_shutdown_function(function() {
    
});

$oApp = new GliderSky(APPLICATION_PATH."/config/application.ini");

echo "hello world";