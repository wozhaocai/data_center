<?php
require_once("ServiceLocator.php");

//Define some sort of service locator to attach...
class PearLocator implements Locator
{
    protected $base = '.';
    
    public function __construct($directory='.')
    {
        $this->base = (string) $directory;
    }
    
    public function canLocate($class)
    {
        $path = $this->getPath($class);
        if (file_exists($path)) return true;
        else return false;
    }
    
    public function getPath($class)
    {
        return $this->readFileFromDir($this->base);
    }
    
    public function readFileFromDir($dir) {
        if (!is_dir($dir)) {
            return false;
        }
        //打开目录
        $handle = opendir($dir);
        while (($file = readdir($handle)) !== false) {
            //排除掉当前目录和上一个目录
            if ($file == "." || $file == "..") {
                continue;
            }
            $file = $dir . DIRECTORY_SEPARATOR . $file;
            //如果是文件就打印出来，否则递归调用
            if (is_file($file)){
                require_once $file;          
            }elseif (is_dir($file)) {
                $this->readFileFromDir($file);                
            }else{
                return false;
            }
        }
    }

}