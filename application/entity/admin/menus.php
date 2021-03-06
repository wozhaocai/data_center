<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin_MenusEntity Extends BaseEntity {

    public function getMenus() {
        if (!empty($this->_aParams["query"]["username"])) {
            $aMenus = $this->getMenuByName($this->_aParams["query"]["username"]);
        } else {
            return false;
        }        
        $aTree = $this->getTree($aMenus, 99999999);
        foreach ($aTree as $key => $val) {
            $aMenu = $val['sub_menu'];
            break;
        }
        return $aMenu;
    }

    private function getMenuByName($name) {
        return $this->_oDB->queryDB("select gm.* from users gu "
                        . "join user_group_map gugm on gu.id=gugm.uid "
                        . "join group_menu_map ggmm on gugm.gid=ggmm.gid "
                        . "join menus gm on ggmm.mid=gm.id "
                        . "where gu.username=:username order by sort asc", array(":username" => $name));
    }

    private function getAll() {
        return $this->_oDB->queryDB("select * from menus;");
    }

    private function getTree($data, $pId) {
        $tree = array();
        foreach ($data as $k => $v) {
            $temp = array();
            if ($v->parent_id == $pId) {         //父亲找到儿子
                if ($v->child_count != 0) {
                    $temp['id'] = $v->id;
                    $temp['parent_id'] = $v->parent_id;
                    $temp['title'] = $v->title;
                    $temp['css_style'] = $v->css_style;
                    $temp['path'] = $v->path;
                    $temp['sub_menu'] = $this->getTree($data, $v->id);
                } else {
                    $temp['id'] = $v->id;
                    $temp['parent_id'] = $v->parent_id;
                    $temp['title'] = $v->title;
                    $temp['css_style'] = $v->css_style;
                    $temp['path'] = $v->path;
                    $temp['sub_menu'] = array();
                }
                $tree['menu_' . $v->id] = $temp;
            }
        }
        return $tree;
    }

}
