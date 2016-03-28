@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="cursor:pointer;">
                    <a id="url" style="text-decoration:none;color:red;">Search URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                    <a id="keyword" style="text-decoration:none">Search Keyword</a>
                </div>
                <div class="panel-body" id="url_keyword">
                    
                </div>

                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $('#url_keyword').load('loadForm #url_form', function(){
                            $.getScript('{{ URL::asset("assets/js/form.js") }}');
                        });
                    });

                    $('#keyword').click(function(){
                        $('#url_keyword').load('loadForm #keyword_form', function(){
                            $.getScript('{{ URL::asset("assets/js/form.js") }}');
                        });
                        $("#keyword").css('color', 'red');
                        $("#url").css('color', 'blue');
                    });

                    $('#url').click(function(){
                        $('#url_keyword').load('loadForm #url_form', function(){
                            $.getScript('{{ URL::asset("assets/js/form.js") }}');
                        });
                        $("#url").css('color', 'red');
                        $("#keyword").css('color', 'blue');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
