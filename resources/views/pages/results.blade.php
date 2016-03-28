@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <h3><B>Results for "{{ $heading }}"</B></h3><br/><br/>
                @if($id == 'url')
                    <table width="50%">
                        <tr><td><h4>Alexa Rank</h4></td>            <td><h4>{{ $alexa_rank }}</h4></td></tr>
                        <tr><td><h4>Google Page Rank</h4></td>      <td><h4>{{ $google_page_rank }}</h4></td></tr>
                        <tr><td><h4>Origin Country</h4></td>        <td><h4>{{ $origin_country['country'] }}</h4></td></tr>
                        <tr><td><h4>Origin Country Rank</h4></td>   <td><h4>{{ $origin_country['rank'] }}</h4></td></tr>
                    </table>
                @else
                    <table width="50%">
                        <tr><td><h4>Total results</h4></td>            <td><h4>{{ $total_results }}</h4></td></tr>
                    </table>
                    <h4>Top 100 searches</h4><br />
                    @foreach( $top100 as $i )
                        {{ $i }}<br />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
