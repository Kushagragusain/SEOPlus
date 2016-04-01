@extends('layouts.app', ['link' => 'Add URL'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                {{ Form::open(array('url' => 'search/keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}
                    <div class="form-group">
                        <input type="text" value="{{ $heading }}" name="url" style="display:none" />

                        <label class="col-md-2 control-label">Enter keyword(s)</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="keyword" placeholder="eg. apple">
                            <span class="help-block" id="error"></span>
                        </div>
                        <div class="col-md-4">
                            {{Form::submit('Search', array('class' => 'btn btn-primary'))}}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script>
                var pattern = /[0-9a-zA-Z]/;

                //to change submit button text on click
                $(":submit").click(function(){
                    $(":submit").attr('value', 'Searching...');
                });

                //validate keywords while writing
                $(':input[name="keyword"]').focusin(function(){
                    $(this).keyup(function(){
                        var value = $(this).val();
                        $('#error').text('');
                        for( var i = 0 ; i < value.length ; i++ ){
                            if( ! value.charAt(i).match(pattern) ){
                                $("#error").text('Keyword should contain only alphabets');
                                break;
                            }
                        }
                    });
                });

                //validate form
                function validate(){
                    var x = $(':input[name="keyword"]').val();
                    var check = 0;
                    if(x == ''){
                        $("#error").text('Field should not be empty.').css('font-weight', 'bold');
                        check = 1;
                    }else if( document.getElementById('error').innerHTML != '' ){
                        check = 1;
                    }

                    if(check == 1){
                        $(":submit").attr('value', 'Search');
                        return false;
                    }
                    $(":submit").attr('disabled', 'disabled');
                }
            </script>

            @if( $tp == 'url' )
            <div class="panel panel-default">
                <h3><B>Results for "{{ $heading }}"</B></h3><br/><br/>
                <table width="50%">
                    <tr><td><h4>Alexa Rank</h4></td>            <td><h4>{{ $alexa_rank }}</h4></td></tr>
                    <tr><td><h4>Google Page Rank</h4></td>      <td><h4>{{ $google_page_rank }}</h4></td></tr>
                    <tr><td><h4>Total Backlinks</h4></td>      <td><h4>{{ $backlinks }}</h4></td></tr>
                    <tr><td><h4>Origin Country</h4></td>        <td><h4>{{ $origin_country['country'] }}</h4></td></tr>
                    <tr><td><h4>Origin Country Rank</h4></td>   <td><h4>{{ $origin_country['rank'] }}</h4></td></tr>
                    <tr><td><h4>{{ $specified_country }} Rank</h4></td>   <td><h4>{{ $country_rank['Rk'] }}</h4></td></tr>
                </table>

            </div>
            @else
            <div class="panel panel-default">
                <h3><B>Results for "{{ $keyword }}" in {{ $heading }}</B></h3><br/><br/>
                @if( collect($x)->count() == 0 )
                    <h2>No results</h2>
                @else
                    <table>
                    @foreach( $x as $j )
                        <tr>
                            <td>{{ $j['position'] }}</td>
                            <td>{{ $j['url'] }}</td>
                        </tr>
                    @endforeach
                    </table>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
