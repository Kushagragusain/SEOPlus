@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3>History</h3>
            </div>
            <div class="panel panel-default">
                <h4>Previously searched URLs</h4>
                @if($urls->count() == 0)
                    No searches
                @else
                    @foreach($urls as $i)
                        {{$i->url}} <br />
                    @endforeach
                @endif
            </div>
            <div class="panel panel-default">
                <h4>Previously searched Keywords</h4>
                @if($keywords->count() == 0)
                    No searches
                @else
                    @foreach($keywords as $i)
                        {{$i->keyword}} <br />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection