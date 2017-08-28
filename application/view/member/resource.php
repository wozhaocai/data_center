<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Member_ResourceView extends BaseView{
    public function show(){
        $_SESSION["current_show_page"] = $_SERVER["REQUEST_URI"];
        $oModule = new GS_Module($this->_aParams['business'],"Entity","resource","gets");
        $aResource = $oModule->run();       
        $this->_oTemplate->assign("aResource",$aResource);
    } 
    
    public function add_show(){
        
    }
    
    public function edit_show(){
        if(!empty($this->_aParams["id"])){
            $aResource = array(
                "id" => $this->_aParams["id"]            
            );
            $oModule = new GS_Module($this->_aParams['business'],"Entity","resource","gets",$aResource);
            $aRs = $oModule->run();
            $sSourceType = $aRs[0]->source_type;
            $sContentType = $aRs[0]->content_type;
            $sServiceId = $aRs[0]->service_id;
            $sServiceContent = $aRs[0]->content;
            $sAction = "update";
            $iId = $aRs[0]->id;
        }else{
            $sServiceId = "";
            $sServiceContent = "";
            $sAction = "insert";
            $sSourceType = "";
            $sContentType = "";
            $iId = "";
        }
        $sContent = str_replace("\\","",urldecode(urldecode($sServiceContent)));
        $sContent = str_replace("\"","",$sContent);
        $this->_oTemplate->assign("id",$iId);
        $this->_oTemplate->assign("submit_action",$sAction);
        $this->_oTemplate->assign("service_id",$sServiceId);
        $this->_oTemplate->assign("source_type",$sSourceType);
        $this->_oTemplate->assign("content_type",$sContentType);
        $this->_oTemplate->assign("resource_content",$sContent);
        $this->_oTemplate->display("member/resource_edit.tpl");
        exit(0);
    } 
    
    public function edit_submit(){
        $aResource = array(
            "id" => $this->_aParams["id"],
            "service_id" => $this->_aParams["service_id"],
            "source_type" => $this->_aParams["source_type"],
            "content_type" => $this->_aParams["content_type"],
            "content" => $this->_aParams["resource_content"]
        );
        $oModule = new GS_Module($this->_aParams['business'],"Entity","resource",$this->_aParams["submit_action"],$aResource);
        $oModule->run();
        Header("Location:{$_SESSION["current_show_page"]}");
    } 
}