@extends('layouts.app', ['link' => 'Add URL', 'history' => 'History'])@section('content')


<div class="container">

    <body class="four-zero-content">
        <div class="four-zero p-absolute m-t-25">
            <h2>Sorry</h2>
            <small>you can only use 2 urls and 10 keywords per month</small>

            <footer>
                <a href="{{URL::to('/new')}}"><i class="zmdi zmdi-arrow-back m-t-10"></i></a>
                <a href="{{URL::to('/new')}}"><i class="zmdi zmdi-home m-t-10"></i></a>
            </footer>
        </div>
    </body>
</div>


@endsection
