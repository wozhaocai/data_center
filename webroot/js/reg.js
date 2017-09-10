function query_has_reg(id,name) {
    var regVar = $("#" + id).val();
    $.post("/guest.php?business=dc&controller=reg&action=check_" + id, {query_id: regVar}, function (result) { 
        var oUser = eval('(' + result + ')');
        if (oUser.id) {
            alert(name+regVar + "已经注册过了", '提示');
            $("#"+id).val("");
        }
    });
}

function query_to_reg(id,name) {
    var regVar = $("#" + id).val();
    $.post("/guest.php?business=dc&controller=reg&action=check_" + id, {query_id: regVar}, function (result) { 
        var oUser = eval('(' + result + ')');
        if (oUser == "") {
            alert(name+regVar + "用户不存在，请先注册", '提示');
            $("#"+id).val("");
        }
    });
}

function check(str)
{
    var x = document.getElementById(str);
    var y = document.getElementById(str + "Check");
//alert("check!"); 
    if (str == "username")
    {        
        if (x.value == ""){
            y.hidden = false;
        }else{
            y.hidden = true;
        }        
        if(y.hidden == true){
            if($("#is_reg").val() == "reg"){
                query_has_reg("username","用户名");  
            }else{
                query_to_reg("username","用户名");
            }
        }   
    }
    else if (str == "nickname")
    {        
        if (x.value == ""){
            y.hidden = false;
        }else{
            y.hidden = true;
        }        
        if(y.hidden == true){
            if($("#is_reg").val() == "reg"){
                query_has_reg("nickname","昵称");  
            }else{
                query_to_reg("nickname","昵称");
            }
        }         
    } 
    else if (str == "password")
    {
        x = x.value.length;
        if (x < 8)
        {
            y.hidden = false;
//alert("check!"); 
        }
        else
            y.hidden = true;
    }
    else if (str == "cpassword")
    {
        var z = document.getElementById("password").value;
        x = x.value;
        if (x != z)
            y.hidden = false;
        else
            y.hidden = true;
    }
    else if ((str == "email"))
    {
        x = x.value.indexOf("@")
        if (x == -1)
            y.hidden = false;
        else
            y.hidden = true;
        if(y.hidden == true) query_has_reg("email"); 
    }     
    return y.hidden;
}

function validate()
{
    var arr = ["username", "password", "cpassword", "email"];
    var i = 0;
    submitOK = true;
    while (i < 4)
    {
        if (!check(arr[i]))
        {
            //alert(arr[i] + " wrong!");
            submitOK = false;
            break;
        }
        i++;
    }
    if (submitOK)
    {
        if(!$("#regsign").is(':checked')){            
            document.getElementById("regsignCheck").hidden = false;
            return false;
        }
        document.getElementById("f").submit();
        return true;
    }
    else
    {
        return false;
    }
} 

function login()
{
    var arr = ["username", "password"];
    var i = 0;
    submitOK = true;
    while (i < 2)
    {
        if (!check(arr[i]))
        {
            //alert(arr[i] + " wrong!");
            submitOK = false;
            break;
        }
        i++;
    }
    if (submitOK)
    {
        document.getElementById("f").submit();
        return true;
    }
    else
    {
        return false;
    }
} 
