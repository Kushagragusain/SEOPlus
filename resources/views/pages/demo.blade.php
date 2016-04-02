@extends('layouts.app', ['link' => 'Add URL'])
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="card">
                    <div class="card-header">
                        <h2>Add keyword(s)<small></small></h2>
                    </div>
                <div class="card-body card-padding">
                    {{ Form::open(array('url' => 'keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_data', 'onSubmit' => 'return false')) }}
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="keyword" placeholder="eg.apple" id="keyword">
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="col-md-4">
                                <input type="button" value="Add" class="btn btn-login btn-primary  waves-input-wrapper waves-effect"       id="add_keyword" />
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>


    <div class="card">
        <div class="card-header bgm-orangem-b-20">
            <h2><small>all at one place</small></h2>
        </div>

        <div class="card-body card-padding">
            <div class="table-responsive">
               <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr><th>Id</th><th>KeyWord</th><th>Action</th></tr>
                        </thead>

                        <tbody id="tbody">

                        </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
    var pattern = /[0-9a-zA-Z]/;

    //to change submit button text on click
    $(":submit").click(function(){
        $(":submit").attr('value', 'Added');
    });

    //validate keywords while writing
    $('#keyword').focusin(function(){
        if( $(this).val() == '' )
            $("#error").text('Enter a keyword !').css('font-weight', 'bold');
        $(this).keyup(function(){
            var value = $(this).val();
            if( $(this).val() == '' )
                $("#error").text('Enter a keyword !').css('font-weight', 'bold');
            else{
                $('#error').text('');
                for( var i = 0 ; i < value.length ; i++ ){
                    if( ! value.charAt(i).match(pattern) ){
                        $("#error").text('Keyword should contain only alphabets').css('font-weight', 'bold');
                        break;
                    }
                }
            }
        });
    });
</script>



<script>
$(document).ready(function() {
    var count = 1;
    $('#add_keyword').click(function(){
        var x = $('#keyword').val();
        if(x == ''){
            $("#error").text('Field should not be empty.').css('font-weight', 'bold');
        }
        else if( document.getElementById('error').innerHTML == '' ){
            //code after keyword gets validated

            var d = $('#form_data').serializeArray();
            var url = "{{ URL::to('/demoo') }}";

            $('#keyword').val('');
            $.post(url, d, function(data){
                var result = $.parseJSON(data);

                $('#tbody').append('<tr><td>'+result.id+'</td><td>'+result.keyword+'</td><td><input type="button" value="See Results" /></td></tr>');

                //for see result url='keyword'

                count++;
            });
        }
    });


/*    $('#add_keyword').live({
        click: function(){
            alert('kghjhj');
        }
    });*/
} );
</script>

@endsection

