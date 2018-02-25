<html>
    <head>
        <meta charset="utf8">
    </head>
    <body>
        <form name="form1" action="se.php" method="post">
            请输入网址：<input type="text" name="url" value="<{$sInputUrl}>">&nbsp;&nbsp;<input type="submit" name="submit" value="提交">
            <input type="hidden" name="tea" value="http://www.google.com.hk/search?q=习">
            <br>
            <p>
                <{$sInputContents}>
            </p>        
        </form>
    </body>
</html>