function using(nameSpace, noCheckName) {
    nameSpace = (nameSpace || '').split(/\s*\.\s*/g);
    var m = window, d, ns;
    for(var i = 0, l = nameSpace.length; i < l; i++){
        ns = nameSpace[i];
        if(d) d += '.' + ns;
        else d = ns;
        if(!m[ns]) m[ns] = {};
        if(noCheckName !== true && !m[ns].$name) m[ns].$name = d;
        m = m[ns];
    }
    return m;
}


/**
 * 加入字符串的trim()方法,字符串两端去空格
 * @return
 */
String.prototype.trim = function(){
    return this.replace(/(^[\s]*)|([\s]*$)/g, "");
}
