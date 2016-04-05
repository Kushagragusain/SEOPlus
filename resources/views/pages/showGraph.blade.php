@extends('layouts.app', ['link' => 'Add Url'])

@section('content')
<div style="position: fixed; top: 100px; left: 30px;"><a href="{{ URL::to('url_rank') }}/{{ $id }}"><button class="btn bgm-red btn-float"><i class="zmdi zmdi-arrow-back"></i></button></a></div>
<div class="container">
<div class="col-md-10 col-md-offset-1">

    <div class="card">
        <div class="card-header bgm-blue  m-b-20">
            <h2>Alexa Rank Chart for <h3><div class="c-White text-uppercase"><div id="tittle"></div></div></h3></h2>
        </div>

        <div class="card-body card-padding">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="{{url('/assets/jquery/canvasjs.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#tittle').text("{{ $data[0]['url'] }}");
            var chart = new CanvasJS.Chart("chartContainer",{ title:{ text: "", fontSize: 20 }, animationEnabled: true,

			theme: "theme2",
			axisY: { gridColor: "Silver", tickColor: "silver" },
			data: [ { type: "line", showInLegend: true, name: "Alexa Rank", color: "#20B2AA", lineThickness: 3,
                     dataPoints: [
                        @foreach( $data as $i )
                            {label:("{{ $i['searched_at'] }}"),  y: {{ $i['alexa_rank'] }}  },
                        @endforeach
                  ]
                }],
                legend:{ cursor:"pointer", itemclick:function(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = true;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart.render();
                }
            }
        });
        chart.render();
    });
</script>

@endsection
