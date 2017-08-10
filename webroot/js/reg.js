function check(str)
{
    var x = document.getElementById(str);
    var y = document.getElementById(str + "Check");
//alert("check!"); 

    if (str == "username")
    {
        if (x.value == "")
            y.hidden = false;
        else
            y.hidden = true;
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
    else if (str == "email")
    {
        x = x.value.indexOf("@")
        if (x == -1)
            y.hidden = false;
        else
            y.hidden = true;
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
            alert(arr[i] + " wrong!");
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

function login()
{
    var arr = ["username", "password"];
    var i = 0;
    submitOK = true;
    while (i < 2)
    {
        if (!check(arr[i]))
        {
            alert(arr[i] + " wrong!");
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