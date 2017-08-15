<?php

class Util_File {

    private $_aData = array();

    public function find($sFile, &$oObj, $sFunction, $sStatic = true, $sOrder = true) {
        if (empty($this->_aData)) {
            $this->_aData = $this->getData($sFile);
        }
        $aMatched = false;
        $bFinded = false;
        foreach ($this->_aData as $aResult) {
            if ($sStatic) {
                if ($oObj::$sFunction($aResult)) {
                    $aMatched[] = $aResult;
                    $bFinded = true;
                } elseif ($bFinded) {
                    break;
                }
            } else {
                if ($oObj->$sFunction($aResult)) {
                    $aMatched[] = $aResult;
                    $bFinded = true;
                } elseif ($bFinded) {
                    break;
                }
            }
        }
        return $aMatched;
    }

    public function findInFile($sFile, $str) {
        $aFiled = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = fgets($handle, 8192)) != false) {
                if (strstr($str, $buffer)) {
                    return true;
                }
            }
            fclose($handle);
        }
        return false;
    }

    public function getData($sFile) {
        $aFiled = array();
        $aData = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            $n = 0;
            while (($buffer = fgets($handle, 8192)) != false) {
                $buffer = str_replace("\r\n", '', $buffer);
                $buffer = str_replace("\n", '', $buffer);
                $buffer = str_replace("\"", '', $buffer);
                $buffer = str_replace("\'", '', $buffer);
                $aLine = explode("\t", $buffer);
                if ($n == 0) {
                    $aField = $aLine;
                    ++$n;
                    continue;
                } else {
                    if (count($aField) != count($aLine)) {
                        var_dump($aField);
                        var_dump($aLine);
                        exit;
                    }
                    $aData[] = array_combine($aField, $aLine);
                }
                ++$n;
            }
            fclose($handle);
        }
        return $aData;
    }

    public function getDataByField($sFile, $aField, $sDelimiter = "\t", $sCode = "utf8") {
        $aData = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = fgets($handle, 8192)) != false) {
                if ($sCode == "GBK") {
                    $buffer = mb_convert_encoding($buffer, "GBK", "UTF-8");
                }
                $buffer = str_replace("\r\n", '', $buffer);
                $buffer = str_replace("\"", '', $buffer);
                $buffer = str_replace("\'", '', $buffer);
                $aLine = explode($sDelimiter, $buffer);
                $aLine = array_map("trim", $aLine);
                $aTemp = array();
                foreach ($aField as $i => $sKey) {
                    $aTemp[$sKey] = empty($aLine[$i]) ? '' : $aLine[$i];
                }
                $aData[] = $aTemp;
                $buffer = '';
            }
            fclose($handle);
        }
        return $aData;
    }

    public function getDataInField($sFile, $aField, $sDelimiter = "\t", $sCode = "utf8") {
        $aData = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = fgets($handle, 8192)) != false) {
		if ($sCode == "GBK") {
                    $buffer = mb_convert_encoding($buffer, "GBK", "UTF-8");
                }
                $buffer = str_replace("\r\n", '', $buffer);
                $buffer = str_replace("\"", '', $buffer);
                $buffer = str_replace("\'", '', $buffer);
                $aLine = explode($sDelimiter, $buffer);
                $aLine = array_map("trim", $aLine);
                $aTemp = array();
                foreach ($aLine as $i => $sVal) {
                    if (isset($aField["f_{$i}"])) {
                        $aTemp[$aField["f_{$i}"]] = empty($sVal) ? '' : $sVal;
                    }
                }
                $aData[] = $aTemp;
                $buffer = '';
            }
            fclose($handle);
        }
        return $aData;
    }

    public function readIni($sFile) {
        $aRs = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = trim(fgets($handle, 4096))) != false) {
                $aRs[] = $buffer;
            }
            fclose($handle);
        }
        return $aRs;
    }
    
    public function readIniToStr($sFile) {
        $sStr = "";
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = trim(fgets($handle, 4096))) != false) {
                $sStr .= $buffer."\r\n";
            }
            fclose($handle);
        }
        return $sStr;
    }

    public function replaceIni($sFile, $aData, $sSign) {
        $aRs = array();
        $handle = fopen($sFile, 'r');
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) != false) {
                if (strstr($buffer, $sSign)) {
                    $aRs[] = QReplace::replace($buffer, $aData);
                } else {
                    $aRs[] = $buffer;
                }
            }
            fclose($handle);
        }
        return $aRs;
    }

    function mk_dir($path) {
        $arr = array();
        while (!is_dir($path)) {
            array_push($arr, $path); 
            $path = dirname($path); 
        }
        if (empty($arr)) {
            return true;
        }
        while (count($arr)) {
            $parentdir = array_pop($arr); 
            @mkdir($parentdir);
        }
    }

}