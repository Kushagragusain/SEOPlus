@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                Home Page
                <form method="POST" action="demo">
                    <textarea name="asd"></textarea>
                    <input type="submit" value="click">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
