<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 class BaseView{
     protected $_aParams = array();
     protected $_oTemplate = null;
     
     public function __construct(&$oTemplate,$aParams) {
         $this->_aParams = $aParams;
         $this->_oTemplate = $oTemplate;
     }
     
 }
