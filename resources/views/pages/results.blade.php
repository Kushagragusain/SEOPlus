@extends('layouts.app', ['link' => 'Add URL'])
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@section('content')

<div style="position: fixed; top: 100px; left: 30px;"><a href="{{ URL::to('history') }}"><button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-arrow-back"></i></button></a></div>
<div class="container">
<div class="col-md-10 col-md-offset-1">


            <!-- Result for URL search -->
            <div class="card">
                <div class="card-header bgm-blue m-b-20">
                    <h2>Results for <h3><div class="c-white text-uppercase">{{ $heading }}</div></h3><small>all in one place</small></h2>
                    <form action="{{ url('url_rank/history') }}">
                        <input type="hidden" name="id" value="{{ $id }}" />
                        <input type="submit" value="See history graph" class="btn bgm-blue btn-float waves-effect"  />
                        <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-chart"></i></button>
                    </form>
                </div>
                <div class="card-body card-padding">

                </div>
                <div class="card-body card-padding">
                    <div class="pmo-contact">
                        <ul>
             <li class="ng-binding">
    <i class="zmdi zmdi-gps-dot"></i> Origin Country<div class="pull-right">{{ $origin_country['country'] }}</div>
                                <div class="media-body">

                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-star-half"></i> Alexa Rank<div class="pull-right">{{ $alexa_rank }}              </div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-google"></i> Google Page Rank<div class="pull-right">{{ $google_page_rank }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $google_page_rank }}%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-widgets"></i>Total Backlinks<div class="pull-right">{{ $backlinks }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                        </div>
                                    </div>
                                </div>
                            </li>



                            <li class="ng-binding"><i class="zmdi zmdi-flash"></i> Origin Country Rank<div class="pull-right">{{ $origin_country['rank'] }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-globe"></i> {{ $specified_country }}{{$mes}} Rank<div class="pull-right">{{ $country_rank }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

<!-- add key word -->

            <div class="card">
                    <div class="card-header">
                        <h2>Add keyword(s)<small></small></h2>
                    </div>
                <div class="card-body card-padding">
                    {{ Form::open(array('url' => 'keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_data', 'onSubmit' => 'return false')) }}
                        {!! csrf_field() !!}
                        <input type="hidden" value="{{ $heading }}" name="url" id="url" />
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="keyword" placeholder="eg.apple" id="keyword">
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="col-md-4">
                                <input type="button" value="Add" class="btn btn-default bgm-blue waves-input-wrapper waves-effect"       id="add_keyword" />
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="panel panel-default">

                <div style="text-align:center;" id="key_mes"></div>
            </div>
                </div>

                </div>

<!-- Key word list -->
            <div class="card" >
            <div class="card-header bgm-blue m-b-20">
            <h2>Keywords List</h2>
            </div>

            <div class="card-body" id="keywords_list" style="display:none;">
            <div class="table-responsive">
				<table class="table table-hover">
                    <thead>
                        <tr><th>Id</th><th>KeyWord</th><th>Action</th></tr>

                    </thead>

                    <tbody id="tbody">

                    </tbody>
				</table>
            </div>
        </div>
    </div>

    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
    //$('#example').DataTable();
    var pattern = /[0-9a-zA-Z]/;

    //validate keywords while writing
    $('#keyword').focusin(function(){
        $("#key_mes").text('');
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

    //fetch keywords on page load

    var url = "{{ URL::to('/fetchkey') }}";
    $.get(url, {domain : $('#url').val()}, function(data){
        console.log('ghjghj');
        var result = $.parseJSON(data);
        if( result.length > 0 ){
            $('#keywords_list').show();
            for(i = 0; i < result.length; i++){
             $('#tbody').append('<tr><td>'+result[i].id+'</td><td>'+result[i].keyword+'</td><td><a class="btn bgm-orange waves-effect" data-method="delete" href=keyword/'+result[i].id+'><i class="zmdi zmdi-check"></i></a>    <a class="btn btn-danger waves-effect" data-method="delete" href=delete/'+result[i].id+'><i class="zmdi zmdi-close"></i></a></td></tr>');
                count++;
            }


        }
    });

    //add new keywords
    $('#add_keyword').click(function(){
        var x = $('#keyword').val();
        if(x == ''){
            $("#error").text('Field should not be empty.').css('font-weight', 'bold');
        }
        else if( document.getElementById('error').innerHTML == '' ){

            //code after keyword gets validated
            $('#keywords_list').show();
            var d = $('#form_data').serializeArray();
            var url = "{{ URL::to('/addkey') }}";

            $('#keyword').val('');
            $.post(url, d, function(data){
                var result = $.parseJSON(data);
                //console.log(data);
                if( result.id != 'null' ){
                 $('#tbody').append('<tr><td>'+result.id+'</td><td>'+result.keyword+'</td><td><a class="btn bgm-orange waves-effect" data-method="delete" href=keyword/'+result.id+'><i class="zmdi zmdi-check"></i></a>  <a class="btn btn-danger waves-effect" data-method="delete" href=delete/'+result.id+'><i class="zmdi zmdi-close"></i></a></td></tr>');
                 $("#key_mes").text('Keyword added successfully !!').css('font-weight', 'bold');

                    count++;
                }
                else
                    $("#key_mes").text('Keyword not already added !!').css('font-weight', 'bold');
            });
        }
    });
} );
</script>

@endsection
