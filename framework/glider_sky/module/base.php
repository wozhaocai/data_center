<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GS_Module_Base{
    protected $_aParam = array();
    
    public function setParams($aParam){
        $this->_aParam = $aParam;
    }
}
