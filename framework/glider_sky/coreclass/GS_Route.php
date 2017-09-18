<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GS_Route{
    public static $_aConfig = array();
    public function __construct() {
        if(empty(self::$_aConfig)){
            self::loadRoute();
        }
    }
    
    private function loadRoute(){
        $oFile = new Util_IniFile(APPLICATION_PATH . "/config/route.ini");
        self::$_aConfig = $oFile->parse()->getConfig();
    }
}
