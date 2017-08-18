<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_IframeView extends BaseView{    
    public static $_aMap = array(
        "menu" => "/service.php?business=dc&controller=member_menu&action=index"
    );
    
    public function show(){
        if(!empty($this->_aParams['page'])){
            $this->_oTemplate->assign("iframe_url",self::$_aMap[$this->_aParams['page']]);
        }else{
            $this->_oTemplate->assign("iframe_url","#");
        }    
    }    
    
}
