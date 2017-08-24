<?php

Class Util_DivPage {

    //类开始
    /*     * ******************************************************
     * $total       记录总数
     * $pageNum     每页显示的条数
     * $url = ''    链接
     * $page->StartPage(显示分类统计,字符分类/数字分页,跳转);
     * $page->StartPage(true/false, true/false, true/false);
     * 
     * ******************************************************* */
    private $total;   //记录总数 
    private $pageNum = 20; //每页显示数 
    private $page;    //当前页数 
    private $pages;   //总的页数 
    private $url;     //页面url 
    private $Aque;    //URL参数

    /* 构造函数 */

    public function __construct($total, $page, $pageNum, $url = "?") {
        $this->total = $total;                 //总记录数.
        $this->pageNum = $pageNum;             //每页显示数.
        $this->url = $this->StrSift($url);     //判断$url的值是否合法.
        $this->Aque = $_GET;                   //页面原来所传递参数.
        $this->page = $this->StrSift($page);             //当前页面GET(全局变量)方式参数,当前页码.  
        $this->page = is_numeric($this->page) ? $this->page : 1; //当前页码不为数字时，则把其设为1.
        $this->pages = ceil($total / $pageNum);                    //总页数.
        if ($this->page < 1)
            $this->page = 1;                       //当页码小于1时，则把其设为1.
        if ($this->page > $this->pages)
            $this->page = $this->pages; //当页码大于最大页码时，则把其设为最大页码.
    }

    /*     * ****************
     * 分页方法
     * ***************** */

    function StartPage($str, $view = true, $jump = true) {
        if ($view == true)
            $PageStr .= $this->GetCount();    //分页统计信息  
        if ($str == 'str') {
            $PageStr .= $this->GetPageStr(); //选择字符分页形式
        } else {
            $PageStr .= $this->GetPageNum();        //选择数字分页形式
        }
        if ($jump == true)
            $PageStr .= $this->JumpSelect(); //跳转
        return $PageStr;
    }

    /*     * ********************************************
     * 显示统计信息. 格式：共5条记录 页:2/3
     * ********************************************* */

    function GetCount() {
        $CountStr = "共<span>" . $this->total . "</span>条记录&nbsp;页:" . $this->page . "/" . $this->pages . "&nbsp;&nbsp;";
        return $CountStr;
    }

    /*     * *********************************************
     * 分页格式形一：第一页 上一页 下一页 末 页
     * ********************************************** */

    function GetPageStr() {
        $url = $this->url; //获取URL
        //对URL参数进行处理:数组的键是URL变量，数组的值是URL变量的值.
        $Sque = $pagestr = '';
        foreach ($this->Aque as $key => $val) {
            switch ($key) {
                case "page":
                    $Next = $val + 1;
                    $Prev = $val - 1;
                    break;
                default:
                    $Sque .= "&$key=" . $this->StrSift($val);
            }
        }
        if ($Next == 0)
            $Next = 2;
        $pagestr .= "总计{$this->total}条&nbsp;&nbsp;";
        $pagestr .= "共{$this->pages}页&nbsp;&nbsp;";

        //首 页    上一页
        switch ($this->page) {
            case $this->page <= 1:
                $pagestr .= "首 页&nbsp;&nbsp;";
                $pagestr .= "上一页&nbsp;&nbsp;";
                break;
            default:
                $pagestr .= "<a href='" . $url . "?page=1$Sque'>首 页</a>&nbsp;&nbsp;";
                $pagestr .= "<a href='" . $url . "?page=$Prev$Sque'>上一页</a>&nbsp;&nbsp;";
        }
        //下一页    末 页
        switch ($this->page) {
            case $this->page >= $this->pages:
                $pagestr .= "下一页&nbsp;&nbsp;";
                $pagestr .= "末 页&nbsp;&nbsp;";
                break;
            default:
                $pagestr .= "<a href='" . $url . "?page=$Next$Sque'>下一页</a>&nbsp;&nbsp;";
                $pagestr .= "<a href='" . $url . "?page=$this->pages$Sque'>末 页</a>&nbsp;&nbsp;";
        }
        $pagestr .= "到第<input id=gotopage name=gotopage type=text size=6 maxlength=10>页<input type=submit name='submit' value=\"提交\" onclick=\"window.location='{$url}?1{$Sque}&page='+document.getElementById('gotopage').value\">";
        //返回分页字符串.
        return $pagestr;
    }

    /*     * *********************************************
     * 分页格式形一：第一页 上一页 下一页 末 页
     * ********************************************** */

    function GetPageStr2() {
        $url = $this->url; //获取URL
        //对URL参数进行处理:数组的键是URL变量，数组的值是URL变量的值.
        $Sque = $pagestr = '';
        $Next = 0;
        $Prev = 0;
        foreach ($this->Aque as $key => $val) {
            switch ($key) {
                case "page":
                    $Next = $val + 1;
                    $Prev = $val - 1;
                    break;
                default:
                    $Sque .= "&$key=" . $this->StrSift($val);
            }
        }
        if ($Next == 0)
            $Next = 2;
        $pagestr .= "<li>总计{$this->total}条&nbsp;&nbsp;</li>";
        $pagestr .= "<li>共{$this->pages}页&nbsp;&nbsp;</li>";

        //首 页    上一页
        switch ($this->page) {
            case $this->page <= 1:
                $pagestr .= "<li class='am-disabled'>首 页&nbsp;&nbsp;</li>";
                $pagestr .= "<li class='am-disabled'>上一页&nbsp;&nbsp;</li>";
                break;
            default:
                $pagestr .= "<li><a href='" . $url . "?page=1$Sque'>首 页</a>&nbsp;&nbsp;</li>";
                $pagestr .= "<li><a href='" . $url . "?page=$Prev$Sque'>上一页</a>&nbsp;&nbsp;</li>";
        }
        //下一页    末 页
        switch ($this->page) {
            case $this->page >= $this->pages:
                $pagestr .= "<li class='am-disabled'>下一页&nbsp;&nbsp;</li>";
                $pagestr .= "<li class='am-disabled'>末 页&nbsp;&nbsp;</li>";
                break;
            default:
                $pagestr .= "<li><a href='" . $url . "?page=$Next$Sque'>下一页</a>&nbsp;&nbsp;</li>";
                $pagestr .= "<li><a href='" . $url . "?page=$this->pages$Sque'>末 页</a>&nbsp;&nbsp;</li>";
        }
        $pagestr .= "<li><input id=gotopage class='am-form-field am-input-sm am-input-xm' name=gotopage type=text size=6 maxlength=10 placeholder='到第几页'></li>"
            . "<li>&nbsp;<button type=\"button\" class=\"am-btn am-radius am-btn-xs am-btn-success\" style=\"margin-top: -1px;\" onclick=\"window.location='{$url}?1{$Sque}&page='+document.getElementById('gotopage').value\">提交</button></li>";
        //返回分页字符串.
        return $pagestr;
    }

    /*     * *********************************************************
     * 分页格式形如：共4307条记录 页:1/72   1 2 3 4 5 6 7 8 9 10
     * ********************************************************** */

    function GetPageNum() {
        $url = $this->url;
        //对URL参数进行处理:数组的键是URL变量，数组的值是URL变量的值.
        foreach ($this->Aque as $key => $val) {
            switch ($key) {
                case $key != "page":
                    $Sque .= "&$key=" . $this->StrSift($val);
            }
        }
        switch ($this->pages) {
            //总页数大于12页：
            case $this->pages > 12:
                //分页数字前：< <<
                switch ($this->page) {
                    case $this->page > 1:
                        $pagestr .= "<a href='$url?page=1" . $Sque . "'><</a>&nbsp;";
                        $pagestr .= "<a href='$url?page=" . ($this->page - 1) . $Sque . "'><<</a>&nbsp;";
                        break;
                    default:
                        $pagestr .= "<&nbsp;";
                        $pagestr .= "<<&nbsp;";
                }
                //分页数字：1 2 3 4 5 6     当前页码左边6个分页链接，右边6个分页链接.
                for ($i = $this->page - 6; $i <= $this->page + 6; $i++) {
                    if ($i > $this->pages)
                        break;
                    if ($i == $this->page)
                        $pagestr .= $i . "&nbsp;";
                    elseif ($i >= 1)
                        $pagestr .= "<a href='$url?page=$i" . $VarFields . "'>$i</a>&nbsp;";
                }
                //分页数字后: > >>
                switch ($this->page) {
                    case $this->page < $this->pages:
                        $pagestr .= "<a href='$url?page=" . ($this->page + 1) . $Sque . "'>>></a>&nbsp;";
                        $pagestr .= "<a href='$url?page=" . $this->pages . $Sque . "'>></a>&nbsp;";
                        break;
                    default:
                        $pagestr .= ">&nbsp;";
                        $pagestr .= ">>&nbsp;";
                }
                break;
            default:
                //总页数小于12页：
                for ($i = 1; $i <= $this->pages; $i++) {
                    switch ($i) {
                        case $i == $this->page:
                            $pagestr .= $i . "&nbsp;";
                            break;
                        default:
                            $pagestr .= "<a href='$url?page=$i" . $Sque . "'>$i</a>&nbsp;";
                    }
                }
                break;
        }
        //返回分页字符串.
        return $pagestr;
    }

    /*     * **********************
     * 定义跳转页. BEGIN
     * *********************** */

    function JumpSelect() {
        $url = $this->url;
        //对URL参数进行处理:数组的键是URL变量，数组的值是URL变量的值.
        foreach ($this->Aque as $key => $val) {
            if ($key != "page")
                $Sque .= "&$key=" . $this->StrSift($val);
        }
        $SelectStr = "\n<select id='JumpSelect' name='NowPage' size='1' ";
        $SelectStr .= "onChange=\"window.location='" . $url . "?page='+this.value+'" . $Sque . "'\">\n";
        for ($i = 1; $i <= $this->pages; $i++) {
            if ($i == $this->page)
                $selected = " selected";
            else
                $selected = "";
            $SelectStr .= "<option value=$i" . $selected . ">$i</option>\n";
        }
        $SelectStr .= "</select>\n";
        //返回分页字符串.
        return $SelectStr;
    }

    /*     * ********************************
     * 过滤特殊字符.
     * ********************************* */

    private function StrSift($str) {
        return $str;
        $str = str_replace("\"", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace("\/", "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace(">", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace("%", "", $str);
        $str = str_replace("*", "", $str);
        $str = str_replace("&", "", $str);
        return $str;
    }

//类结束
}
