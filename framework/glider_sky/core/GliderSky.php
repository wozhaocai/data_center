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
    public function __construct($sConfPath) {
        ;
    }
    
    public function run(){
        $this->loadConf();
        if(empty($this->_sConfPath)){
            $this->_oMsg->sendErrorExit(1);
        }
    }
    
    public function loadConf(){
        $this->_oLog = new Log();
        $this->_oMsg = new Msg();
    }
}
