<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define("APPLICATION_PATH",  dirname(dirname(__FILE__)));
define("DIR_SPLIT", "\\");
include_once(APPLICATION_PATH.DIR_SPLIT."framework".DIR_SPLIT."glider_sky".DIR_SPLIT."core".DIR_SPLIT."GliderSky.php");

register_shutdown_function(function() {
    
});

$oApp = new GliderSky(APPLICATION_PATH."/config/application.ini");

echo "hello world";