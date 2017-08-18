<?php

class Util_DataType {

    public static function replace($string, $data) {
        preg_match_all('/\{(\w)+\}/', $string, $matches);
        foreach ($matches[0] as $val) {
            $replace_string = '';
            $key = substr($val, 1, -1);
            if (is_object($data) and !empty($data->$key)) {
                $replace_string = $data->$key;
            } elseif (is_array($data) and isset($data[$key]) and $data[$key]) {
                $replace_string = $data[$key];
            }
            if ($replace_string)
                $string = str_replace($val, $replace_string, $string);
        }
        return $string;
    }

}
