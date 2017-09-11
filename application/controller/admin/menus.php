<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_MenusController Extends BaseController {

    public function getMenus() {
        $aMenu["id"] = 1;
        $aMenu = $this->getAllMenus($aMenu);
        $sMenu = "";
        $deep = 1;
        for ($i = 0; $i < count($aMenu); $i++) {
            $sMenu .= loopTree($aMenu[$i], $deep, $aMenu[$i]["id"]);
        }
        $aQuery = array(
            "gid" => $this->_aParams["gid"]
        );
        $oModule = new GS_Module($this->_aParams['business'], "Entity", $this->_aParams["table"], $this->_aParams["action"], $aQuery);
        $aGroupResource = $oModule->run();
        $aGroupR = array();
        foreach($aGroupResource["list"] as $oGroupResource){
            $aGroupR[] = $oGroupResource["rid"];
        }
        $sGroupResource = implode(",",$aGroupR);
    }

    private function getAllMenus($aMenu) {
        $aMenu["order"] = "sort<>asc";
        $oModule = new GS_Module($this->_aParams['business'], "Entity", "menus", "gets", $aMenu);
        return $oModule->run();
    }
    
    private function getGroupMenus($iGroupId) {
        $oModule = new GS_Module($this->_aParams['business'], "Entity", "Admin_Menus", "getGroupMenu", $aMenu);
        return $oModule->run();
    }

    function loopTree($aMenu, $deep, $id) {
        $sMenu = "";
        $aQuery = array(
            "parent_id" => $id
        );
        $aMenu1 = $this->getAllMenus($aQuery);
        if ($aMenu != null) {
            $sMenu .= buildNodeStr($aMenu, $deep * 20);
            for ($m = 0; $m < count($aMenu1["list"]); $m++) {
                if ($aMenu1["list"][$m]["childnum"] > 0) {
                    $sMenu .= loopTree($aMenu1["list"][$m], $deep + 1, $aMenu1["list"][$m]["id"]);
                } else {
                    $sMenu .= buildNodeStr($aMenu1["list"][$m], ($deep + 1) * 20);
                }
            }
        }
        return $sMenu;
    }

    function buildNodeStr($aMenu, $marginLeft) {
        $aChild = array();
        $aQuery = array(
            "parent_id" => $aMenu["id"]
        );
        $aMenu1 = $this->getAllMenus($aQuery);
        $sChild = getChild($aMenu);

        $sMenuStr = "";
        $sMenuStr .= "<tr>";
        $sMenuStr .= "<td class=\"res_add\" style=\"padding-left:{$marginLeft}px;\">";
        $sMenuStr .= "<input type=\"checkbox\" id=\"node_{$aMenu["id"]}\" name=\"node[]\" value=\"{$aMenu["id"]}\" onclick=\"selChildren(this, '{$sChild}');\" />&nbsp;&nbsp;";
        $sMenuStr .= $aMenu["name"];
        $sMenuStr .= "</td>";
        $sMenuStr .= "</tr>\r\n";
        return $sMenuStr;
    }

    function getChild($aMenu) {
        $sIds = "";
        $aQuery = array(
            "parent_id" => $aMenu["id"]
        );
        $aMenu1 = $this->getAllMenus($aQuery);
        foreach ($aMenu1["list"] as $oMenu) {
            $sIds .= $oMenu["id"] . ",";
            if ($oMenu["childnum"] > 0) {
                $sIds .= getChild($oMenu);
            }
        }
        return $sIds;
    }

}
