@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                Home Page
                <div class="col-sm-3">
                                    <p class="f-500 c-black m-b-20">A title with a text under</p>

                                    <button class="btn btn-info" id="sa-title">Click me</button>
                                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')

<script type="text/javascript">
            $('#sa-title').click(function(){
                swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis")
            });
        </script>
@endsection
