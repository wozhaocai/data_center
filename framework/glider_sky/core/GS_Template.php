<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Template {

    public static $aConfig = array();
    private $_oTemplate = null;
    
    public function __construct() {
        $this->loadTemplate();
    }

    public function loadTemplate() {
        if (GliderSky::$aConfig['template']['engine'] == "smarty") {
            $this->loadSmarty();
        }
        return $this;
    }    

    private function loadSmarty() {
        include_once(GliderSky::$aConfig["smarty"]["class"]);
        include_once(APPLICATION_PATH . "/config/smarty.inc.php");
        $this->_oTemplate = new GliderSkySmarty();
    }

    public function assign($sKey, $sVal) {
        $this->_oTemplate->assign($sKey, $sVal);
        return $this;
    }

    public function display($sTpl) {
        $this->_oTemplate->display($sTpl);
        return $this;
    }

}
