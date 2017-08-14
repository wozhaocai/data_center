<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_ResourceView extends BaseView{
    public function edit_show(){
        
    } 
    
    public function edit_submit(){
        debugVar($this->_aParams);
        $sXmlContent = json_encode($this->_aParams["resource_content"]);
        var_dump($sXmlContent);
        exit;
    } 
}