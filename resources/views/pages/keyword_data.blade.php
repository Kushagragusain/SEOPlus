@extends('layouts.app', ['link' => 'Add URL'])

@section('content')

<div style="position: fixed; top: 100px; left: 30px;"><a href="{{URL::to('url_rank')}}/{{$urlid}}"><button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-arrow-back"></i></button></a></div>

<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3>Serarch Results for {{ $keyword }}</h3>
                @if($check == 'fail')
                    <h4>Sorry, some error ocuured. Please try again</h4>
                @else
                    @if(count($res) == 0)
                        <h4>No result in top 100</h4>
                    @else
                        <h4>Rank of {{ $domain }} for {{ $keyword }}:{{ $res[0]['rank'] }}</h4>
                        <h4>Top links</h4>
                        @foreach($res as $i)
                            <h5><a href="{{ $i['url'] }}"> {{ $i['url'] }} </a></h5>
                        @endforeach
                    @endif
                @endif
    </div>
</div>
@endsection
