@extends('layouts.app', ['link' => 'Add Url'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div id="chartContainer" style="height: 300px; width: 100%;"></div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="{{url('\assets\jquery\canvasjs.js')}}"></script>
<script>

    $(document).ready(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title:{
                text: "Alexa Rank chart for {{ $data[0]['url'] }}"
            },
            data: [
            {
                // Change type to "doughnut", "line", "splineArea", etc.
                type: "line",
                dataPoints: [
                    @foreach( $data as $i )
                        { label: "{{ $i['searched_at'] }}",  y: {{ $i['alexa_rank'] }}  },
                    @endforeach
                ]
            }
            ]
        });
        chart.render();
    });

</script>

@endsection
