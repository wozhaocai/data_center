<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GliderSky{
    private $_sConfPath = '';
    private $_oLog = null;
    private $_oMsg = null;
    private $_oConfig = null;
    public function __construct($sConfPath) {
        $this->loadConf();
        if(empty($sConfPath)){
            $this->_oMsg->sendErrorExit(1);
        }else{
            $this->_sConfPath = $sConfPath;
        }
    }
    
    public function run(){
        var_dump($this->_sConfPath);
    }
    
    public function loadConf(){
        $this->_oLog = new UtilLog();
        $this->_oMsg = new UtilMsg();
        $this->_oConfig = new ConfigLoader($this->_sConfPath);
        $this->_oConfig->loadSysFile();
    }
}
