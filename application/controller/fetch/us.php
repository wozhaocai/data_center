<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Fetch_UsController Extends BaseController {

    public function getChinese() {
        $sContents = file_get_contents("http://mat1.gtimg.com/finance/js/st/p/mstats/list_v20161208195437.js");
        preg_match_all("/us[A-Z]+/",$sContents,$arr);
        print_r($arr);
    }

    private function getMenuByName($name) {
        return $this->_oDB->queryDB("select gm.* from user gu "
                        . "join user_group_map gugm on gu.id=gugm.uid "
                        . "join group_menu_map ggmm on gugm.gid=ggmm.gid "
                        . "join menus gm on ggmm.mid=gm.id "
                        . "where gu.name=:name", array(":name" => $name));
    }

    private function getAll() {
        return $this->_oDB->queryDB("select * from menus;");
    }

    private function getTree($data, $pId) {
        $tree = '';
        $temp = array();
        foreach ($data as $k => $v) {
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
                }
                $tree['menu_' . $v->id] = $temp;
            }
        }
        return $tree;
    }

}
