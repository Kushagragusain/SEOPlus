@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3>History</h3>
            </div>
            <div class="panel panel-default">
                <div class="panel panel-default">
                    &nbsp;&nbsp;
                    <I><a id="url_history" style="color:red;text-decoration:none;font-size:18px;cursor:pointer">URLs</a></I>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <I><a id="keyword_history" style="text-decoration:none;font-size:18px;cursor:pointer">Keywords</a></I>
                </div>

                <div id="contents"></div>
            </div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script>
                $(document).ready(function(){
                    //load url history on page load
                    $('#contents').load('history #url_data', function(){
                        $('#url_data').css('display', 'block');
                    });

                    //load url history on clicking urls
                    $('#url_history').click(function(){
                        $('#contents').load('history #url_data', function(){
                            $('#url_data').css('display', 'block');
                        });
                        $("#url_history").css('color', 'red');
                        $("#keyword_history").css('color', 'blue');
                    });

                    //load keyword history on clicking keywords
                    $('#keyword_history').click(function(){
                        $('#contents').load('history #keyword_data', function(){
                            $('#keyword_data').css('display', 'block');
                        });
                        $("#keyword_history").css('color', 'red');
                        $("#url_history").css('color', 'blue');
                    });1
                });
            </script>

             <div id="url_data" style="display:none;">
                @if($urls->count() == 0)
                    No searches
                @else
                    @foreach($urls as $i)
                        &nbsp;&nbsp;{{$i->url}} <br />
                    @endforeach
                @endif
            </div>
            <div id="keyword_data" style="display:none;">
                @if($keywords->count() == 0)
                    No searches
                @else
                    @foreach($keywords as $i)
                        &nbsp;&nbsp;{{$i->keyword}} <br />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
