<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Module_Entity extends GS_Module_Base{
    public function run(){
        if($this->_bIsApplication){
            return $this->_aResult;
        }
        $sAction = $this->_aParam['action'];
        return $this->$sAction();
    }
    
    public function gets(){
        return $this->_oDB->gets($this->_aParam["query"]);
    }
    
    public function input(){
        return $this->_oDB->input($this->_aParam["query"]);
    }
}