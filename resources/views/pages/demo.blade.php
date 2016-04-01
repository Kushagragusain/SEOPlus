@extends('layouts.app')

@section('content')
<form id="ddd" onSubmit="return validate();">
<input type="text" id="t" name="dta" />
<input type="button" value="click" id="sign_in" />
</form>
<div id="msg"></div>
@endsection


@section('footer')
<script src="js/jquery-2.2.1.min.js"></script>
<script type="text/javascript">
$(function(){
    $('#sign_in').click(function(){
        var d = $('#ddd').serializeArray();
        var url = "{{ URL::to('/demoo') }}";
        $.post(url, d, function(data){
            $('#msg').text(data);
        });
    });
});

function validate(){
    return false;
}
</script>
@endsection
