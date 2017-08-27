<?php

class Util_Curl{
    private static $_aInfo = array();
    
    public static function execute($url, $method = 'get', $sPostData = array(), $timeout = 300) {
        $ch = curl_init(); //初始化CURL句柄 

        curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
        if ($method != "get") {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoUpper($method)); //设置请求方式
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $sPostData); //设置提交的字符串
        }
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
        self::$_aInfo = $info;
        return $document;
    }
}