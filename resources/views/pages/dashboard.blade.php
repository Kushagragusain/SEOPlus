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



                    <ul class="list-group">
                        <li class="list-group-item col-md-12" style="border: 0px;">

                            <span class="badge col-md-3 pull-left m-r-30" style="height:3em;">
                                <label class=" control-label pull-right p-t-5 f-15"><span class="c-blue">....</span>Enter URL</label>
                                            </span>
                            <div class="col-md-9 form-group{{ $errors->has('url') ? ' has-error' : '' }}  ">
                                <div class="input-group">
                                    <div class="fg-line">
                                        <input type="text" class="form-control" name="url" placeholder="eg. google.com" id="searched_input">

                                    </div>
                                    <span class="input-group-addon c-white"><i class="zmdi zmdi-globe"></i></span>
                                    <span class="input-group-addon"><i class="zmdi zmdi-globe"></i></span>
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>


                        </li>
                        <li class="list-group-item col-md-12" style="border: 0px;">

                            <span class="badge pull-left col-md-3 m-r-30" style="height: 3em;"> {{Form::label('country_label', 'Select Country', array('class' => ' control-label pull-right p-t-5 f-15'))}}</span>

                            <div class="form-group col-md-9" id="country">
                                <div class="input-group">
                                    <div class="select">
                                        {{Form::select('country', array( 'us' => 'United States', 'au' => 'Australia', 'br' => 'Brazil', 'by' => 'Belarus', 'ca' => 'Canada', 'ch' => 'Switzerland', 'cn' => 'China', 'cz' => 'Czech Republic', 'fi' => 'Finland', 'fr' => 'France', 'ge' => 'Georgia', 'de' => 'Germany', 'hk' => 'Hong Kong', 'in' => 'India', 'id' => 'Indonesia', 'iq' => 'Iraq', 'ie' => 'Ireland', 'it' => 'Italy', 'jp' => 'Japan', 'ru' => 'Russia', 'kr' => 'South Korea', 'es' => 'Spain', 'mx' => 'Mexico', 'ng' => 'Nigeria', 'nz' => 'New Zealand', 'ph' => 'Philippines', 'sk' => 'Slovakia', 'th' => 'Thailand', 'tr' => 'Turkey', 'ua' => 'Ukraine', 'uk' => 'United Kingdom', 'zw' => 'Zimbabwe', ), 'us', array('class' => 'form-control selectpicker bs-select-hidden', ' data-live-search'=>'true') )}}
                                    </div>

                                    <span class="input-group-addon last"><i class="zmdi zmdi-my-location"></i></span>
                                </div>
                            </div>

                        </li>
                    </ul>

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


        var url="{{url('demo')}}";
        $.get(url,function(data)
             {
            //alert(data);
            if(data =='pay')
                {   swal({
                        title: "Are you sure?",
                        text: "The keyword will be deleted permanently !!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    }, function(isConfirm){
                        if (isConfirm) {

                            window.location="{{URL::to('pay')}}";

                        }

                       else
                    {
                            swal("Cancelled", "Deletion has been cancelled !!", "error");
                        }
                    });

                    $("#submit").html('Check');
                    return false;

                }
            else
                return true;

        });

        $("#submit").html('Checking...');
        $("#submit").attr('disabled', 'disabled');
        //return false;
    }



</script>
@endsection
