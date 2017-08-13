<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GS_Service {

    private $_oTemplate = null;
    private $_aRequest = array();    

    public function __construct(&$oTemplate) {
        $this->setTemplate($oTemplate);
        $this->filterRequest();
    }

    private function setTemplate(&$oTemplate) {
        $this->_oTemplate = $oTemplate;
    }

    public function route() {
        $oRoute = new GS_Route();
        if(!empty($this->_aRequest["controller"])){
            $sController = $this->_aRequest["controller"];
            if(isset(GS_Route::$_aConfig["view"][$sController])){
                $aViewClass = GS_Route::$_aConfig["view"][$sController];
                $this->callView($aViewClass);
            }elseif(isset(GS_Route::$_aConfig["module"][$sController])){
                $this->callMoudule();
            }
        }else{
            Header("Location:/index.php");
        }
    }
    
    private function callView($aViewClass){
        debugVar($this->_aRequest);
        exit;
        $oView = new GS_View($this->_aRequest['business'],$aViewClass,$this->_aRequest['action'],$this->_aRequest);
        $oView->run($this->_oTemplate);
    }
    
    private function callMoudule(){
        $oModule = new GS_Module("dc","Entity","users","gets",array("username"=>"fengwei"));
        //$oModule = new GS_Module("dc","Entity","Admin_Users","search",array("username"=>"fengwei"));
        debugVar($oModule->run());
    }

    private function filterRequest() {
        //unset($GLOBALS,$_ENV,$HTTP_ENV_VARS,$_REQUEST,$HTTP_POST_VARS,$HTTP_GET_VARS,$HTTP_POST_FILES,$HTTP_COOKIE_VARS); //销毁预定义变量
        unset($HTTP_POST_VARS, $HTTP_GET_VARS); //销毁预定义变量

        $this->init(); //GPC过滤
        $this->_aRequest = array_merge((array) $_GET, (array) $_POST); //合并_GET _POST 变量，POST具有优先级.有同名直接使用$_GET
    }

    private function init() {
        if (!get_magic_quotes_gpc()) {
            $_POST = $this->Quotes($_POST);
            $_GET = $this->Quotes($_GET);
        }

        //不考虑GPC，直接过滤了再说。$_SERVER的Referer不受GPC保护
    }

    private function Quotes($content) {
        if (is_array($content)) {
            foreach ($content as $key => $value) {
                $key = addslashes($key);
                if (is_array($value)) {
                    $content[$key] = $this->Quotes($value);
                } else {
                    $content[$key] = addslashes($value);
                }
            }
        } else {
            $content = addslashes($content);
        }
        return $content;
    }

}
