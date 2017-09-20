$(function(){   
    setInterval(function(){   
        $("#currentTime").text(new Date().toLocaleString());   
        $("#currentServerTime").text(new Date(new Date().getTime() - 1000*60*60*8).toLocaleString());
        $("#currentAmericanTime").text(new Date(new Date().getTime() - 1000*60*60*12).toLocaleString());   
    },1000);   
});   

function outputObj(obj) {
    var description = "";
    for (var i in obj) {
        description += i + " = " + obj[i] + "\n";
    }
    alert(description);
}

function ext_action(act){
    $('#main_form_act').val(act);
    $('#main_form').submit();
}

function AutoResizeImage(maxWidth, maxHeight, objImg) {
    var img = new Image();
    img.src = objImg.src;
    var hRatio;
    var wRatio;
    var Ratio = 1;
    var w = img.width;
    var h = img.height;
    wRatio = maxWidth / w;
    hRatio = maxHeight / h;
    if (maxWidth == 0 && maxHeight == 0) {
        Ratio = 1;
    } else if (maxWidth == 0) {//  
        if (hRatio < 1)
            Ratio = hRatio;
    } else if (maxHeight == 0) {
        if (wRatio < 1)
            Ratio = wRatio;
    } else if (wRatio < 1 || hRatio < 1) {
        Ratio = (wRatio <= hRatio ? wRatio : hRatio);
    }
    if (Ratio < 1) {
        w = w * Ratio;
        h = h * Ratio;
    }
    objImg.height = h;
    objImg.width = w;
}
