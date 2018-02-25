<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <form name="form1" action="tool.php" method="post">
            请输入网址：<input type="text" name="code_text" value="<{$code_text}>">&nbsp;&nbsp;<input type="submit" name="submit" value="提交"><br>
            <p>
            <pre>
                <{$code_transfer}>
            </pre>
            </p>        
        </form>
    </body>
</html>