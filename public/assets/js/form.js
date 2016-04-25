var pattern = /[0-9a-zA-Z]/;

//to show country field
$(':checkbox').click(function(){
    $('#country').toggle();
});

//to change submit button text on click
$(":submit").click(function(){
    $(":submit").attr('value', 'Checking...');
});

//validate URL field
$(':input[name = "url"]').focusin(function(){
    $(this).keyup(function(){
        var value = $(this).val();
        if(value == ''){
            $("#error").text('');
        }
        else if(value.indexOf('.') <= 0 || value.indexOf('.') >= ( value.length - 2 ))
            $("#error").text('Invalid URL.').css('font-weight', 'bold');
        else
            $("#error").text('');
    });
});

//validate keyword field
$(':input[name = "keyword"]').focusin(function(){
    $(this).keyup(function(){
        var value = $(this).val();
        if(value.length > 0){
            $("#error").text('');
            if( ! value.charAt(value.length - 1).match( pattern ) )
                $("#error").text('Keyword should not special characters (including space).');
        }
    });
});

//validate form
function validate(){
    var x = $('#searched_input').val();
    var check = 0;
    if(x == ''){
        $("#error").text('Field should not be empty.').css('font-weight', 'bold');
        check = 1;
    }else if( document.getElementById('error').innerHTML != '' ){
        check = 1;
    }

    if(check == 1){
        $(":submit").attr('value', 'Check');
        return false;
    }
    $(":submit").attr('disabled', 'disabled');
}
