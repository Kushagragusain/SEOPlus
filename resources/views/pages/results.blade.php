@extends('layouts.app', ['link' => 'Add URL'])
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"> @section('content')

<div style="position: fixed; top: 80px; left: 5px; z-index: 9999;">
    <a href="{{ URL::to('history') }}">
        <button class="btn bgm-red btn-float"><i class="zmdi zmdi-arrow-back"></i></button>
    </a>
</div>
<div class="container">
    <div class="col-md-10 col-md-offset-1">


        <div class="card">
            <div class="card-header bgm-blue" style="text-overflow: ellipsis;">
                <h2 class="hidden-xs">Results for <span class="text-uppercase">{{ $heading }}</span><small>All in one place</small></h2>
                <h6 class="hidden-sm hidden-md hidden-lg "><small ><span class="text-uppercase  c-white">{{ $heading }}</span><br></small></h6>

                <form action="{{ url('url_rank/history') }}">
                    <input type="hidden" name="id" value="{{ $id }}" />
                    <input type="submit" value="See history graph" class="btn bgm-blue btn-float waves-effect" />
                    <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-chart"></i></button>
                </form>
            </div>

            <div class="card-body">
                <br>
                <ul class="tab-nav tn-justified tn-icon" role="tablist">
                    <li role="presentation" class="active">
                        <a class="col-sx-4" href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab">
                                           Alexa / Backlinks &nbsp;<i class="zmdi zmdi-cloud-done icon-tab c-blue hidden-xs"></i>
                                        </a>
                    </li>
                    <li role="presentation">
                        <a class="col-xs-4" href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">
                                           Keyword Rankings &nbsp; <i class="zmdi zmdi-case-download icon-tab c-blue  hidden-xs"></i>
                                        </a>
                    </li>

                </ul>

                <div class="tab-content p-20">
                    <div role="tabpanel" class="tab-pane animated fadeIn in active" id="tab-1">
                        <div class="card-body card-padding">
                            <div class="pmo-contact">
                                <ul>
                                    <li class="ng-binding">
                                        <i class="zmdi zmdi-gps-dot"></i> Origin Country
                                        <div class="pull-right">{{ $origin_country['country'] }}</div>
                                        <div class="media-body">

                                        </div>
                                    </li>

                                    <li class="ng-binding"><i class="zmdi zmdi-star-half"></i> Alexa Rank
                                        <div class="pull-right">{{ $alexa_rank }} </div>
                                        <div class="media-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="ng-binding"><i class="zmdi zmdi-google"></i> Google Page Rank
                                        <div class="pull-right">{{ $google_page_rank }}</div>
                                        <div class="media-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $google_page_rank }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="ng-binding"><i class="zmdi zmdi-widgets"></i>Total Backlinks
                                        <div class="pull-right">{{ $backlinks }}</div>
                                        <div class="media-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                                </div>
                                            </div>
                                        </div>
                                    </li>



                                    <li class="ng-binding"><i class="zmdi zmdi-flash"></i> Origin Country Rank
                                        <div class="pull-right">{{ $origin_country['rank'] }}</div>
                                        <div class="media-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="ng-binding"><i class="zmdi zmdi-globe"></i> {{ $specified_country }} Rank
                                        <div class="pull-right">{{ $country_rank }}</div>
                                        <div class="media-body">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane animated fadeIn" id="tab-2">
                        <div class="card-body card-padding">
                            {{ Form::open(array('url' => 'keyword', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'form_data', 'onSubmit' => 'return false')) }} {!! csrf_field() !!}
                            <input type="hidden" value="{{ $heading }}" name="url" id="url" />
                            <div class="row">
                                <div class="col-md-4 col-sm-10 col-xs-12">
                                    <div class="fg-line">
                                        <textarea class="form-control" name="keyword" placeholder="Enter one keyword in one line" id="keyword" rows="3"></textarea>
                                    </div>
                                    <span class="help-block" id="error"></span>
                                    <br>
                                    <span class="pull-right" id="key_mes"></span>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <div class="m-b-30">
                                        <button type="submit" value="Add" class="btn btn-primary btn-lg btn-block waves-effect" id="add_keyword">Add</button>
                                    </div>

                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div id="keyavg">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <span class="badge" id="total_key">{{ $tot_key }}</span> Total keywords
                                            </li>
                                            <li class="list-group-item">
                                                <span class="badge">{{ $avg_rank }}</span> Average ranking
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}

                        </div>

                        <div id="dialog"></div>

                        <hr>
                        <div class="card">
                            <div class="card-header bgm-blue m-b-20">
                                <h2>Keywords List
                                    <input type="button" value="Refresh Ranking" id="refresh">
                                    <span class="pull-right" id="confirm_delete"></span>
                                </h2>
                            </div>

                            <div class="card-body" id="keywords_list" style="display:none;">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class=" hidden-xs">Id</th>
                                                <th>KeyWord</th>
                                                <th>Rank</th>
                                                <th>Action</th>
                                            </tr>

                                        </thead>

                                        <tbody id="tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



    </div>
</div>
<div class="col-sm-2 col-xs-6">
</div>
@endsection @section('footer')
<script>
    //$('#example').DataTable();
    var pattern = /[0-9a-zA-Z ]/;

    //validate keywords while writing
    /*$('#keyword').focusin(function() {
        $("#key_mes").text('');
        if ($(this).val() == '')
            $("#error").text('Enter a keyword !').css('font-weight', 'bold');
        $(this).keyup(function() {
            var value = $(this).val();
            if ($(this).val() == '')
                $("#error").text('Enter a keyword !').css('font-weight', 'bold');
            else {
                $('#error').text('');
                for (var i = 0; i < value.length; i++) {
                    if (!value.charAt(i).match(pattern)) {
                        $("#error").text('Keyword should contain only alphabets').css('font-weight', 'bold');
                        break;
                    }
                }
            }
        });
    });*/
</script>



<script>
    $(document).ready(function() {

        var count = 1;
        fetchKey();

        $(':button[class="confirm"]').click(function(){
            alert('jkjhj');
        });

        //fetch keywords on page load

        $('#tbody').on('click', '.delete-button', function() {
            var dom = $(this).closest('tr');
            deleteKey($(this).attr('data-id'), dom);
        });


        function fetchKey() {
            $('#tbody').html('');
            count = 1;
            //alert('in');
            var url = "{{ URL::to('/fetchkey') }}";
            $.get(url, {
                domain: $('#url').val()
            }, function(data) {
                // console.log('ghjghj');
                var result = $.parseJSON(data);
                if (result.length > 0) {
                    $('#keywords_list').show();
                    var content = '';
                    //console.log(pos);
                    for (i = 0; i < result.length; i++) {
                        var pos = '';
                        if (result[i].position_status == 'inc')
                            pos = '<span class="c-green f-15"><i class="zmdi zmdi-long-arrow-up"></i></span>';
                        else if (result[i].position_status == 'dec')
                            pos = '<span class="c-red "><i class="zmdi zmdi-long-arrow-down"></i></span>';

                        content += '<tr><td>' + count + '</td><td>' + result[i].keyword + '</td><td><p class="rank" keyid="'+ result[i].id +'" id="rank'+ count +'">' + result[i].latest_rank + '  ' + pos + '</p></td><td><a class="btn bgm-orange waves-effect" d data-method="delete" href=keyword/' + result[i].id + '><i class="zmdi zmdi-search"></i></a>  <a class="btn btn-danger waves-effect delete-button"  data-method="delete" data-id="' + result[i].id + '" ><i class="zmdi zmdi-close"></i></a></td></tr>';
                        count++;
                    }
                    $('#tbody').html(content);
                    //$('#confirm_delete').text('');

                } else {
                    $('#keywords_list').hide();
                }
            });
        }
        //add new keywords

        $('#add_keyword').click(function() {
            var countt = count;
            var x = $('#keyword').val();
            $('#confirm_delete').text('');
            if (x == '') {
                $("#error").text('Field should not be empty.').css('font-weight', 'bold');
            } else {

                //code after keyword gets validated
                $('#keywords_list').show();
                var d = $('#form_data').serializeArray();
                var url = "{{ URL::to('/addkey') }}";
                //var url = deletekey/+id;

                var tot = parseInt(document.getElementById('total_key').innerHTML) + 1;
                document.getElementById('total_key').innerHTML = tot;
                //alert(tot);

                $('#keyword').val('');
                $.post(url, d, function(data) {
                    $("#key_mes").fadeIn();
                    var result = $.parseJSON(data);
                    //console.log(data);
                    var repeat = '';
                    var xx = 0;

                    for(i = 0; i < result.length; i++){
                        if (result[i].id != 'null') {
                            //console.log(result);
                            $('#tbody').append('<tr><td>' + count + '</td><td>' + result[i].keyword + '</td><td><p class="rank" keyid="'+ result[i].id +'" id="rank'+ count +'"> loading...</p></td><td><a class="btn bgm-orange waves-effect" data-method="delete" href=keyword/' + count + '><i class="zmdi zmdi-search"></i></a>  <a class="btn btn-danger waves-effect delete-button" data-method="delete" data-id="' + result[i].id + '" ><i class="zmdi zmdi-close"></i></a></td></tr>');

                            $("#key_mes").text('Keyword added successfully !!').fadeOut(2000);

                            count++;
                        }
                        else{
                            if(xx == 0)
                                repeat = repeat+""+ result[i].keyword +" already exists";
                            else
                                repeat = result[i].keyword+ ", " +repeat;
                            xx = 1;
                        }

                        if( repeat != '' ){
                            //repeat = repeat.substring(0, (repeat.length-1));
                            $("#key_mes").text(repeat).fadeOut(4000);
                        }
                    }


                    //calculate rank of added keyword
                    var rankurl = "{{ URL::to('/getrank') }}";
                    $.get(rankurl, { 'url' : $('#url').val(), 'data' : result, 'countt' : countt }, function(data){
                        var rankres = $.parseJSON(data);
                        for( i = 0; i < rankres.length; i++ ){
                            $('#rank'+rankres[i]['id']).html(rankres[i]['rank']);
                            countt++;
                        }
                    });
                });
            }
        });

        function deleteKey(id, dom) {
            var url = "{{ URL::to('/delete') }}";

            //alert('Keyword deleted successfully.');
            $.get(url, {
                id: id
            }, function(data) {
                //dom.remove();

                fetchKey();
                var tot = parseInt(document.getElementById('total_key').innerHTML) - 1;
                document.getElementById('total_key').innerHTML = tot;

                $('#confirm_delete').fadeIn().text('Keyword deleted successfully.').fadeOut(2000);
            });
        }

        $('#refresh').click(function(){
            //var refresh = $('p[id^=rank]').text();
            swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis");

            var url = "{{ URL::to('/refresh') }}";

            $('.rank').text('loading...');

            for( i = 1; i < count; i++ ){
                var key_id = $('#rank'+i).attr('keyid');
                //alert($('#rank'+i).attr('keyid'));

                $.get(url, { 'key_id' : $('#rank'+i).attr('keyid'), 'ii' : i }, function(data){
                    var res = $.parseJSON(data);

                    var pos = '';
                    if (res['pos'] == 'inc')
                        pos = '<span class="c-green f-15"><i class="zmdi zmdi-long-arrow-up"></i></span>';
                    else if (res['pos'] == 'dec')
                        pos = '<span class="c-red "><i class="zmdi zmdi-long-arrow-down"></i></span>';
                    $('#rank'+res['ii']).html(res['rank']+"  "+pos);
                    //alert($('#rank'+res['ii']).text()+"  "+i);
                });

            }

            /*$.get(url, {'data' : $('#url').val()}, function(data){
                var res = $.parseJSON(data);

                for(i=0; i<res.length; i++){
                    var pos = '';
                    if (res[i]['pos'] == 'inc')
                        pos = '<span class="c-green f-15"><i class="zmdi zmdi-long-arrow-up"></i></span>';
                    else if (res[i]['pos'] == 'dec')
                        pos = '<span class="c-red "><i class="zmdi zmdi-long-arrow-down"></i></span>';
                    $('#rank'+(count-1)).html(res[i]['rank']+"  "+pos);
                }
            });*/
        });
    });
</script>

<script type="text/javascript">
    /*
     * Notifications
     */
    function notify(from, align, icon, type, animIn, animOut) {
        $.growl({
            icon: icon,
            title: ' Bootstrap Growl ',
            message: 'Turning standard Bootstrap alerts into awesome notifications',
            url: ''
        }, {
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 20,
                y: 85
            },
            spacing: 10,
            z_index: 1031,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
                '<button type="button" class="close" data-growl="dismiss">' +
                '<span aria-hidden="true">&times;</span>' +
                '<span class="sr-only">Close</span>' +
                '</button>' +
                '<span data-growl="icon"></span>' +
                '<span data-growl="title"></span>' +
                '<span data-growl="message"></span>' +
                '<a href="#" data-growl="url"></a>' +
                '</div>'
        });
    };

    $('#notis').click(function(e) {
        console.log("hi");
        e.preventDefault();
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');

        notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    });
</script>

@endsection
