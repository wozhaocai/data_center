<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Util_Class {

    public static function checkClass($sClass, $sMethod) {
        if (class_exists($sClass)) {
            $obj = new $sClass();
            if (method_exists($obj, $sMethod)) {
                unset($obj);
                return true;
            } else {
                echo "没有找到{$sClass}的方法{$sMethod}";
                exit(0);
            }
        } else {
            echo "没有找到类{$sClass}";
            exit(0);
        }
    }

}
