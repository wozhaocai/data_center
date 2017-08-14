$('#sub').click(function(){
    var resource_content = $("#resource_content").val();
    $("#resource_content").val(encodeURIComponent(encodeURIComponent(resource_content)));
    $("#resource_form").submit();
});