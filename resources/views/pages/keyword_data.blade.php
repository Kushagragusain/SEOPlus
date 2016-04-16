@extends('layouts.app', ['link' => 'Add URL', 'history' => 'History'])
@section('content')

<div style="position: fixed; top: 80px; left: 5px; z-index: 9999;">
    <a href="{{URL::to('url_rank')}}/{{ $keyrank['url_id'] }}">
        <button class="btn bgm-red btn-float"><i class="zmdi zmdi-arrow-back"></i></button>
    </a>
</div>

<div class="col-md-10 col-md-offset-1">

        <div id="tittle"></div>
        <div class="row">
            <br>
                            <div class="col-sm-12 col-md-4">
                                <div class="mini-charts-item bgm-teal">
                                    <div class="clearfix">
                                        <div class="count text-center">
                                            <small>URL</small>
                                            <h2>{{ $keyrank['url'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="mini-charts-item bgm-orange">
                                    <div class="clearfix">
                                        <div class="count text-center">
                                            <small>Keyword</small>
                                            <h2>{{ $keyrank['keyword'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="mini-charts-item bgm-green">
                                    <div class="clearfix">
                                        <div class="count text-center">
                                            <small>Rank</small>
                                            <h2>{{ $keyrank['latest_rank'] }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

    <div class="card">
        <div class="card-header bgm-blue  m-b-20">
            <h2>Rank Chart</h2>
        </div>
        <div class="card-body card-padding">

            <div class="clearfix"></div>
            <div id="chartdiv" style="height: 35em; width: 100%;"></div>
        </div>
    </div>



    <div class="card">
        <div class="card-header bgm-blue c-white">
            <h2>Top 100 results</h2>
        </div>

        <div class="card-body card-padding">
            <blockquote class="m-b-25 ">

                    <?php $cc = 1; ?>
                    @if( !empty($res) )
                    @for( $i = 0; $i < count($res); $i++)
                        <h5>
                            {{ $cc }}<a href="http://{{ $res[$i] }}" @if($keyrank['latest_rank'] == $cc) style="color:red;"@endif > {{ $res[$i] }} </a>
                        </h5>
                        <div class="clearfix"></div>
                        <?php $cc++; ?>
                    @endfor
                    @endif

            </blockquote>
            Details over
        </div>

    </div>

</div>

@endsection @section('footer')

<script type="text/javascript">
    $(document).ready(function() {

        //$('#tittle').text("{{count($fetch)}}");

        if ({{count($fetch)}} > 0) {

            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "theme": "light",
                "marginRight": 40,
                "marginLeft": 40,
                "marginTop": 40,
                "autoMarginOffset": 20,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "reversed": true,
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth": true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon": {
                        "drop": true,
                        "adjustBorderColor": false,
                        "color": "#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 1,
                    "cursorColor": "#258cbb",
                    "limitToGraph": "g1",
                    "valueLineAlpha": 0.2
                },
                "valueScrollbar": {
                    "oppositeAxis": false,
                    "offset": 50,
                    "scrollbarHeight": 10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },

                "dataProvider": [@foreach($fetch as $i) {
                    "date": "{{$i['searched_at'] }}",
                    "value": "{{ $i['keyword_rank'] }}"
                }, @endforeach]
            });
            chart.addListener("rendered", zoomChart);

            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
            }
        } else
            $('#chartdiv').html('<h3>Sorry, No previous search data available !!!</h3>').css('text-align', 'center');
    });
</script>

@endsection
