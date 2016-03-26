@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                Results:
                <br/>
                <div>Alexa Rank of {{$url}} is {{$alexa_rank}}</div>
                <br/>
                <div>Google Page Rank of {{$url}} is {{$google_page_rank}}</div>
            </div>
        </div>
    </div>
</div>
@endsection