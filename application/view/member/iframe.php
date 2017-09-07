<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_IframeView extends BaseView{    
    
    public function show($sMeta){ 
        $sUrl = "/service.php?";   
        $this->_aParams["controller"] = $sMeta;
        $this->_aParams["action"] = $this->_aParams["method"];
        unset($this->_aParams["method"]);
        unset($this->_aParams["limit"]);
        $sUrl .= http_build_query($this->_aParams);
        $this->_oTemplate->assign("iframe_url",$sUrl);
    }  
}
