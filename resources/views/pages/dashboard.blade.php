@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="cursor:pointer;">
                    <a id="url" style="text-decoration:none;">Search URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a id="keyword" style="text-decoration:none;">Search Keyword</a>
                </div>
                <div class="panel-body" id="url_keyword">
                    
                    <!-- for url search -->
                    <div class="panel-body" id="url_form">    
                        {{ Form::open(array('url' => 'search/url', 'method' => 'POST', 'class' => 'form-horizontal')) }}
                            @include ('pages.searchform', ['name' => 'Enter URL', 'example' => 'eg. google.com', 'fieldName' => 'url'])
                        {{ Form::close() }}
                    </div>
                    
                    <!-- for keyword search -->
                    <div class="panel-body" id="keyword_form">    
                        {{ Form::open(array('url' => 'search/keyword', 'method' => 'POST', 'class' => 'form-horizontal')) }}
                            @include ('pages.searchform', ['name' => 'Enter Keyword', 'example' => 'eg. apple', 'fieldName' => 'keyword'])
                        {{ Form::close() }}
                    </div>
                    
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                    <script>
                        $(document).ready(function(){
                            $("#url").css('color', 'red');
                            $("#keyword_form").css('display', 'none');
                        });
                        //to switch b/w url & keyword search form
                        $("#url").click(function(){
                            $("#url").css('color', 'red');
                            $("#keyword").css('color', 'blue');
                            $("#url_form").show();
                            $("#keyword_form").hide();
                        });
                        $("#keyword").click(function(){
                            $("#keyword").css('color', 'red');
                            $("#url").css('color', 'blue');
                            $("#keyword_form").show();
                            $("#url_form").hide();
                        });
                        
                        //to show country field
                        $(":checkbox").click(function(){
                            $('#country_div').toggle();
                        });
                        
                        //to change submit button text on click
                        $(":submit").click(function(){
                            $(":submit").attr('value', 'Checking..');
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
