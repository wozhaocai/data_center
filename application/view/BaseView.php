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
     
     protected function checkVar($sOption){
        $this->_aParams[$sOption] = $this->_aParams["query_id"];
        $aRs = $this->gets();
        $aUsers = array();
        if($aRs){
            $aUsers = $aRs[0];
        }
        echo json_encode($aUsers);    
        exit(0);
    }
     
 }
