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
                    {{ Form::open(array('url' => 'keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="keyword" placeholder="eg.apple">
                                <span class="help-block" id="error"></span>
                            </div>
                            <div class="col-md-4">
                                {{Form::submit('Add', array('class' => 'btn btn-login btn-primary  waves-input-wrapper waves-effect'))}}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>

            <!-- Result for URL search -->
            <div class="card">
                <div class="card-header ch-alt">
                    <h2>Results for "{{ $heading }}"<small>all in one place</small></h2>
                </div>
                <div class="card-body card-padding">
                    <div class="pmo-contact">
                        <ul>
                            <li class="ng-binding"><i class="zmdi zmdi-phone"></i> Alexa Rank<div class="pull-right">{{ $alexa_rank }}              </div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> Google Page Rank<div class="pull-right">{{ $google_page_rank }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-facebook-box"></i>Total Backlinks<div class="pull-right">{{ $backlinks }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-twitter"></i> Origin Country<div class="pull-right">{{ $origin_country['country'] }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-pin"></i> Origin Country Rank<div class="pull-right">{{ $origin_country['rank'] }}</div>
                                <div class="media-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="ng-binding"><i class="zmdi zmdi-email"></i> {{ $specified_country }} Rank<div class="pull-right">{{ $country_rank['Rk'] }}</div>
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

                        <tbody>

                                <tr>
                                    <td>gffv</td>
                                    <td>jnk</td>
                                    <td>
                                        <button class="btn btn-primary waves-effect"><i class="zmdi zmdi-check"></i></button>
                                        <button class="btn btn-danger waves-effect"><i class="zmdi zmdi-close"></i></button>
                                    </td>
                                </tr>

                        </tbody>

                </table>
            </div>
        </div>
    </div>


@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
    var pattern = /[0-9a-zA-Z]/;

    //to change submit button text on click
    $(":submit").click(function(){
        $(":submit").attr('value', 'Added');
    });

    //validate keywords while writing
    $(':input[name="keyword"]').focusin(function(){
        $(this).keyup(function(){
            var value = $(this).val();
            if( value == '' )

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

<script>
    $(document).ready(function() {
        $('#example').DataTable();
} );
</script>

@endsection
