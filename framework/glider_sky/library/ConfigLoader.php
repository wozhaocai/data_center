<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ConfigLoader{
    private $_sConfigFile = "";
    public function __construct($sConfigFile) {
        $this->_sConfigFile = $sConfigFile;
    }
    
    public function loadSysFile(){
        var_dump("test");
    }
}
