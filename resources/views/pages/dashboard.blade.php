@extends('layouts.app', ['link' => ''])

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="card">
<div class="card">
        <div class="card-header bgm-blue m-b-20">
            <h2>Search URL<small>Start here</small></h2>
        </div>
        <div class="card-body card-padding">
            <div class="panel-body">
                {{ Form::open(array('url' => 'search/url', 'method' => 'POST', 'class' => 'form-horizontal', 'onSubmit' => 'return validate()')) }}
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Enter URL</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="url" placeholder="eg. google.com" id="searched_input">
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="form-group" id="country">
                {{Form::label('country_label', 'Select Country', array('class' => 'col-md-4 control-label'))}}
                    <div class="col-md-6">
                        <div class="select">
                        {{Form::select('country', array(
                                'us' => 'United States',
                                'au' => 'Australia',
                                'br' => 'Brazil',
                                'by' => 'Belarus',
                                'ca' => 'Canada',
                                'ch' => 'Switzerland',
                                'cn' => 'China',
                                'cz' => 'Czech Republic',
                                'fi' => 'Finland',
                                'fr' => 'France',
                                'ge' => 'Georgia',
                                'de' => 'Germany',
                                'hk' => 'Hong Kong',
                                'in' => 'India',
                                'id' => 'Indonesia',
                                'iq' => 'Iraq',
                                'ie' => 'Ireland',
                                'it' => 'Italy',
                                'jp' => 'Japan',
                                'ru' => 'Russia',
                                'kr' => 'South Korea',
                                'es' => 'Spain',
                                'mx' => 'Mexico',
                                'ng' => 'Nigeria',
                                'nz' => 'New Zealand',
                                'ph' => 'Philippines',
                                'sk' => 'Slovakia',
                                'th' => 'Thailand',
                                'tr' => 'Turkey',
                                'ua' => 'Ukraine',
                                'uk' => 'United Kingdom',
                                'zw' => 'Zimbabwe',
                            ),
                            'us',
                            array('class' => 'form-control')
                        )}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{Form::submit('Check', array('class' => 'btn btn-login btn-primary  waves-input-wrapper waves-effect'))}}
                    </div>
                </div>
                {{ Form::close() }}
            </div>
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
        $(":submit").click(function(){
            $(":submit").attr('value', 'Checking...');
        });
        //validate URL field while writing
        $(':input').focusin(function(){
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
    </script>
@endsection
