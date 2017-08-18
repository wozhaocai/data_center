<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util_Xml{
    private $_oXmlContent = "";
    public function __construct($sXmlFile="",$sXmlContent="") {
        if(!empty($sXmlFile)){
            $this->_oXmlContent = simplexml_load_file($sXmlFile);
        }elseif(!empty($sXmlContent)){
            $this->_oXmlContent = simplexml_load_string($sXmlContent);
        }else{
            echo "please intut params";
            exit;
        }
    }   
    
    public function getContent(){
        return $this->_oXmlContent;
    }
}