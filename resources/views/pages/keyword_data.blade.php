@extends('layouts.app', ['link' => 'Add URL'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3>Serarch Results for {{ $keyword }}</h3>
                @if($check == 'fail')
                    <h4>Sorry, some error ocuured. Please try again</h4>
                @else
                    @if(count($res) == 0)
                        <h4>No result in top 100</h4>
                    @else
                        <h4>Rank of {{ $domain }} for {{ $keyword }}      :      {{ $res[0]['rank'] }}</h4>
                        <h4>Top links</h4>
                        @foreach($res as $i)
                            <h5><a href="{{ $i['url'] }}"> {{ $i['url'] }} </a></h5>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
