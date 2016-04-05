@extends('layouts.app', ['link' => 'Add URL'])
@section('content')


<div class="container">
        <body class="four-zero-content">
<div class="four-zero p-absolute m-t-25" >
            <h2>WIT!</h2>
            <small>Nah.. it's 404</small>

            <footer>
                <a href="{{URL::to('/dashboard')}}"><i class="zmdi zmdi-arrow-back m-t-10"></i></a>
                <a href="{{URL::to('/dashboard')}}"><i class="zmdi zmdi-home m-t-10"></i></a>
            </footer>
        </div>
            </body>
</div>


@endsection
