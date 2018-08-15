<?php
define("APPLICATION_PATH", dirname(dirname(__FILE__)));

include_once(APPLICATION_PATH."/config/config.inc.php");
$oTemplate = new GS_Template();
if(!empty($_REQUEST["url"])){
    $ch = curl_init(); //初始化CURL句柄 
    curl_setopt($ch, CURLOPT_URL, $_REQUEST["url"]); //设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout); // 设置超时限制防止死循环    
    curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-HTTP-Method-Override: $method")); //设置HTTP头信息
    $document = curl_exec($ch); //执行预定义的CURL 
    if (!curl_errno($ch)) {
        $info = curl_getinfo($ch);
            //	echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
    } else {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
    $oTemplate->assign("sInputUrl", $_REQUEST["url"])->assign("sInputContents",$document)->display("se.tpl");
}else{
    $oTemplate->assign("sInputUrl", "")->assign("sInputContents","")->display("se.tpl");
}
