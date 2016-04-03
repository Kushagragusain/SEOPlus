@extends('layouts.app', ['link' => 'Add Url'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div id="list" style="height: 300px; width: 100%;">
                    <input type="button" value="{{$url}}" uid="{{$id}}" name="url" >
                    @if( $keywords->count() != 0 )
                        @foreach($keywords as $i)
                            <input type="button" value="{{$i['keyword']}}" uid="{{$i['id']}}" name="key">
                        @endforeach
                    @else
                           <h3>No keywords</h3>
                    @endif
                </div>
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>

            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>

    $(document).ready(function () {
        $(':button').click(function(){
            var url = "{{ url('demo') }}";
            var t = $(this).attr('name');
            $.get(url,{ uid : $(this).attr('uid'), type : $(this).attr('name') }  ,function(data){
                var result = $.parseJSON(data);
                if( result.length == 0 )
                    $('#chartContainer').text('No Data');
                else
                {   $('#chartContainer').text('');
                    for(var i = 0; i < result.length; i++)
                    {   if( t == 'url' )
                            $('#chartContainer').append(result[i].alexa_rank+'<br />');
                        else
                            $('#chartContainer').append(result[i].keyword_rank+'<br />');
                    }
                }
                console.log(result);
            });
        });
    });

</script>
