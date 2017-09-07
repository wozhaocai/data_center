<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 class BaseController{
     protected $_aParams = array();
     protected $_oDB = null;
     
     public function __construct($aParams) {
         $this->_aParams = $aParams;
     }
 }
