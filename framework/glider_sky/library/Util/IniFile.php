<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Util_IniFile{
    private $_sIniFile = "";
    public function __construct($sIniFile) {
        $this->_sIniFile = $sIniFile;
    }
    
    public function parse(){
        $oFile = new Util_File();
        $sContent = $oFile->readIni($this->_sIniFile);
        var_dump($sContent);
    }
}
