<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Business_SpiderController Extends BaseController {

    public function getChinaCodePage() {
        $sSpiderUrl = str_replace("{".$this->_aParams["query"]["spider_field"]."}",$this->_aParams["query"]["spider_init_value"],$this->_aParams["query"]["spider_url"]);
        $sContent = substr(Util_Curl::execute($sSpiderUrl),12,-1);
        preg_match_all("/total\:[0-9,]+/", $sContent,$matchs);
        $total = substr(str_replace("total:","",$matchs[0][0]),0,-1);
        return "1,{$total}";
    }
}
