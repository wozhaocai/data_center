<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Admin_UsersController Extends BaseController{
    
    public function search(){
        var_dump("search");
        debugVar($this->_oDB->queryDB("select * from users"));
        debugVar($this->_aParams);
    }
}

