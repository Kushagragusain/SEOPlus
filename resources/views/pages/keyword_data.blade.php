@extends('layouts.app', ['link' => 'Add URL'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3>Serarch Results for {{ $keyword }}</h3>
                <h4>Total seraches for {{$keyword }}  :  {{ $totsearch }}</h4>
                <h4>Top links in {{ $url }} for {{$keyword }}</h4>
                @if( count( $res ) == 0 )
                    <h5>No results</h5>
                @else
                    @foreach( $res as $i )
                        <h5><a href="{{ $i['url'] }}">{{ $i['url'] }}</a></h5>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
