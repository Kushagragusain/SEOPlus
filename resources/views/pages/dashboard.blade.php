@extends('layouts.app', ['link' => '', 'history' => 'History']) @section('content')
<div class="container">

    <div class="col-md-10 col-md-offset-1">

        <div class="card">

            <div class="card-header bgm-blue m-b-20">
                <h2>Search URL <i class="zmdi zmdi-search zmdi-hc-fw"></i><small>Start here</small></h2>
            </div>

            <div class="card-body card-padding ">

                <div class="panel-body">
                    {{ Form::open(array('url' => 'search/url', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate();')) }}

                    <div class="row">
                            <div class="badge col-md-3 col-sm-3 col-xs-12 m-r-15 " style="height:3em;">
                                <label class=" control-label p-t-5 f-15"><span class="c-blue">....</span>Enter URL</label>
                            </div>
                            <center>
                            <div class="col-md-9 col-sm-9 col-xs-12 form-group{{ $errors->has('url') ? ' has-error' : '' }}  ">

                                <div class="input-group m-l-30">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="url" placeholder="eg. google.com" id="searched_input">

                                    </div>
                                    <span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span>
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                            </center>
                        </div>
                        <div class="row">
                            <div class="badge col-md-3 col-sm-3 col-xs-12 m-r-15" style="height: 3em;"> {{Form::label('country_label', 'Select Country', array('class' => ' control-label p-t-5 f-15'))}}
                            </div>

                            <div class="form-group col-md-9 col-sm-9 col-xs-12" id="country">
                                <div class="input-group m-l-30">
                                    <div class="select">
                                        {{Form::select('country', array( 'us' => 'United States', 'au' => 'Australia', 'br' => 'Brazil', 'by' => 'Belarus', 'ca' => 'Canada', 'ch' => 'Switzerland', 'cn' => 'China', 'cz' => 'Czech Republic', 'fi' => 'Finland', 'fr' => 'France', 'ge' => 'Georgia', 'de' => 'Germany', 'hk' => 'Hong Kong', 'in' => 'India', 'id' => 'Indonesia', 'iq' => 'Iraq', 'ie' => 'Ireland', 'it' => 'Italy', 'jp' => 'Japan', 'ru' => 'Russia', 'kr' => 'South Korea', 'es' => 'Spain', 'mx' => 'Mexico', 'ng' => 'Nigeria', 'nz' => 'New Zealand', 'ph' => 'Philippines', 'sk' => 'Slovakia', 'th' => 'Thailand', 'tr' => 'Turkey', 'ua' => 'Ukraine', 'uk' => 'United Kingdom', 'zw' => 'Zimbabwe', ), 'us', array('class' => 'form-control selectpicker bs-select-hidden', ' data-live-search'=>'true') )}}
                                    </div>
                                    <span class="input-group-addon last"><i class="zmdi zmdi-my-location"></i></span>
                                </div>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <br>
                            <br>
                            <button type="submit" value="check" class="btn btn-primary btn-block btn-lg waves-effect" id="submit">check</button>


                        </div>
                    </div>


                    {{ Form::close() }}



                </div>

            </div>

        </div>

    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    //to change submit button text on click
    $('#submit').click(function() {
        $("#submit").html('Checking...');
    });
    /*$("#submit").click(function(){
        $("#submit").attr('value', 'Checking...');
    });*/
    //validate URL field while writing
    $(':input').focusin(function() {
        $(this).keyup(function() {
            var value = $(this).val();
            if (value == '') {
                $("#error").text('');
            } else if (value.indexOf('.') <= 0 || value.indexOf('.') >= (value.length - 2))
                $("#error").text('Invalid URL.').css('font-weight', 'bold');
            else
                $("#error").text('');
        });
    });
    //validate form
    function validate()
    {
        var x = $('#searched_input').val();
        var check = 0;
        if (x == '') {
            $("#error").text('Field should not be empty.').css('font-weight', 'bold');
            check = 1;
        }
        else if (document.getElementById('error').innerHTML != '') {
            check = 1;
        }
        if (check == 1) {
            $("#submit").html('Check');
            return false;
        }

        $("#submit").html('Checking...');
        $("#submit").attr('disabled', 'disabled');
        //return false;
    }



</script>
@endsection
