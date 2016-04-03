@extends('layouts.app', ['link' => 'Add URL'])

@section('content')

<div style="position: fixed; top: 100px; left: 30px;"><a href="{{URL::to('url_rank')}}/{{$urlid}}"><button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-arrow-back"></i></button></a></div>

<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <div class="card-header  m-b-20">
            <h2>Serarch Results for <h3><div class="c-blue text-uppercase">{{ $keyword }}</div></h3></h2>
        </div>
        <div class="card-body card-padding">
            <blockquote class="m-b-25">
                <div class="clearfix"></div>
                    @if($check == 'fail')
                        <h3>Sorry, some error ocuured. Please try again</h3>
                    @else
                        @if(count($res) == 0)
                            <h4>No result in top 100</h4>
                            <div class="clearfix"></div>
                        @else
                            <h4>Rank of {{ $domain }} for {{ $keyword }}:{{ $res[0]['rank'] }}</h4>
                            <div class="clearfix"></div>
                            <br>
                            <h4>Top links</h4>
                            <div class="clearfix"></div>
                            @foreach($res as $i)
                                <h5><a href="{{ $i['url'] }}"> {{ $i['url'] }} </a></h5>
                                <div class="clearfix"></div>
                            @endforeach
                        @endif
                    @endif
            </blockquote>
            Details over
        </div>

    </div>


    <div class="card">
    <div class="card-header bgm-blue  m-b-20">
            <h2>Keyword Rank Chart for<h3><div class="c-white text-uppercase"><div id="tittle"></div></div></h3></h2>
        </div>
    <div class="card-body card-padding">

                <div class="clearfix"></div>
    <div id="graph" style="height: 300px; width: 100%;"></div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript" charset="utf8" src="{{url('\assets\jquery\canvasjs.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        @if(count($fetch) > 0)
            $('#graph').show();
        @endif
        $('#tittle').text("{{ $keyword }}");
            var chart = new CanvasJS.Chart("graph",{ title:{ text: "", fontSize: 20 }, animationEnabled: true,
			axisX:{	gridColor: "Silver", tickColor: "silver", valueFormatString: "DD/MMM", }, toolTip:{ shared:true },
			theme: "theme2",
			axisY: { gridColor: "Silver", tickColor: "silver" },
			data: [ { type: "line", showInLegend: true, name: "Keyword Rank", color: "#F44336", lineThickness: 2,
                     dataPoints: [
                         @if(count($fetch) > 0)
                            @foreach( $fetch as $i )
                                { x: new Date("{{ $i['searched_at'] }}"),  y: {{ $i['keyword_rank'] }}  },
                            @endforeach
                        @endif
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
