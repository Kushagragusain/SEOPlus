@extends('layouts.app', ['link' => 'Add URL'])

@section('content')

<div style="position: fixed; top: 100px; left: 30px;"><a href="{{ URL::to('url_rank/') }}"><button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-arrow-back"></i></button></a></div>

<div class="container">
<div class="col-md-10 col-md-offset-1">
                            <div class="card">
                                <div class="card-header bgm-blue m-b-20">
                                    <h2>Serarch Results for <h3><div class="c-white text-uppercase">{{ $keyword }}</div></h3></h2>

                                </div>

                                <div class="card-body card-padding">

                                        <blockquote class="m-b-25">
                                   <h3>Total seraches for {{$keyword }}  :  {{ $totsearch }}</h3>
                                            <div class="clearfix"></div>
                <h3>Top links in {{ $url }} for {{$keyword }}</h3>
                                            <div class="clearfix"></div>
                @if( count( $res ) == 0 )
                    <h5>No results</h5>
                                            <div class="clearfix"></div>
                @else
                    @foreach( $res as $i )
                        <h5><a href="{{ $i['url'] }}">{{ $i['url'] }}</a></h5>
                                            <div class="clearfix"></div>
                    @endforeach
                @endif
                                        </blockquote>
                                <hr>
                                   Details over
                            </div>
                        </div>
    </div>
</div>


@endsection
