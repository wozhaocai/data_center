<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_View {
    private $_sBusiness = "";
    private $_aView = "";
    private $_sAction = "";
    private $_aParam = array();
    private $_aQuery = array();
    private $_oViewObj = null;
    private $_oTemplate = null;

    public function __construct($sBusiness="",$aView="",$sAction="",$aParam = array()) {
        $this->_sBusiness = $sBusiness;
        $this->_aView = $aView;
        $this->_sAction = $sAction;
        $this->_aParam = $aParam;
    }
    
    public function setPage($iPage) {
        $this->_iPage = $iPage;
    }

    public function setNumPagePer($iNumPagePer) {
        $this->_iNumPagePer = $iNumPagePer;
    }

    public function setBaseUrl() {
        list($sPageUrl, $sParam) = explode("?", $_SERVER['REQUEST_URI']);
        $aParam = explode("&", $sParam);
        $aUrlParam = array();
        foreach ($aParam as $sKey => $sOption) {
            if (strstr($sOption, "page=")) {
                $aParam[$sKey] = 'page=1';
            }
            if (strstr($sOption, "c_order") or strstr($sOption, "order_status"))
                continue;
            $aUrlParam[$sKey] = $sOption;
        }
        $this->_sBaseUrl = $sPageUrl . "?" . implode('&', $aUrlParam);
    }

    public function getPageQuery() {
        $this->_aQuery['limit']['offset'] = $this->_iNumPagePer;
        if ($this->_iPage < 2) {
            $this->_aQuery['limit']['start_num'] = 0;
        } else {
            $this->_aQuery['limit']['start_num'] = $this->_iNumPagePer * $this->_iPage - 1;
        }
        return true;
    }
    
    private function filterParams(){
        $aParams = $this->_aParam;
        $aFilterArr = array("controller","business","action");
        foreach($aParams as $sKey=>$sVal){
            if(!in_array($sKey,$aFilterArr)){
                $this->_aQuery[$sKey] = $sVal;
            }
        }
        $this->_aQuery["business"] = $aParams['business'];
    }
    
    public function fetchDivPage($aData){
        if (empty($this->_aParam['is_divpage']) or $this->_aParam['is_divpage'] == 1) {
            $iPage = isset($this->_aParam['page']) ? $this->_aParam['page'] : 1;
            $iPageNum = 20;
            list($sPageUrl, $sTemp) = explode("?", $_SERVER['REQUEST_URI']);
            $oDivPage = new Util_DivPage($aData['num'], $iPage, $iPageNum, $sPageUrl);
            $sPageStr = $oDivPage->GetPageStr2();
            
            $this->_oTemplate->assign("sPageStr", $sPageStr);

            $this->setPage($iPage);
            $this->setNumPagePer($iPageNum);
            $this->getPageQuery();
        }
    }
    
    public function run(&$oTemplate){
        $this->_oTemplate = $oTemplate;
        $this->filterParams();
        if(strstr($this->_aView["class"],"_")){
            list($sDirName,$sFileName) = explode("_",  strtolower($this->_aView["class"]));
            $sClassFile = APPLICATION_PATH."/application/view/{$sDirName}/{$sFileName}.php";
            if(file_exists($sClassFile)){
                require_once($sClassFile);
                $sClass = $this->_aView["class"]."View";
                $this->_oViewObj = new $sClass($oTemplate,$this->_aQuery);
                $sAction = $this->_aParam['action'];                
                if($this->_aView["class"] == "Member_Meta"){
                    $i = strpos($sAction, '_', 0);
                    $sMethod = trim(substr($sAction,0,$i));
                    $sMeta = trim(substr($sAction,$i+1));
                    $aRs = $this->_oViewObj->$sMethod($sMeta);                       
                }else{
                    $aRs = $this->_oViewObj->$sAction();
                }             
                $this->fetchDivPage($aRs);
                $oTemplate->display($this->_aView['tpl']);
            }else{
                echo "not find {$sClassFile}";
                exit;
            }
        }
    }

}
