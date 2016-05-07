<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEOPlus</title>

    <!-- Vendor CSS -->

    <link href="{{URL::to('assets')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">

    <link href="{{URL::to('assets')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweetalert.css" rel="stylesheet">

    <link href="{{URL::to('assets')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="{{URL::to('assets')}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">

    <!-- CSS -->
    <link href="{{URL::to('assets')}}/css/app.min.1.css" rel="stylesheet">
    <link type="text/css" href="{{URL::to('assets')}}/js/plugins/export/export.css" rel="stylesheet">

    <link href="{{URL::to('assets')}}/css/app.min.2.css" rel="stylesheet">


</head>

<body>
    <header id="header" class="clearfix" data-current-skin="blue">
<div class="row">
    <ul class="header-inner">
        <li class="logo">
            <a href="{{URL::to('/dashboard')}}">Seo-Plus</a>
        </li>


        <li class="pull-right">

            <ul class="top-menu">

                @if (Auth::guest())
                <li>
                    <a href="{{ url('/login') }}"><span class="tm-label">Login</span></a>
                </li>
                <li>
                    <a href="{{ url('/register') }}"><span class="tm-label">Register</span></a>
                </li>
                @else

                    @if($link != '')
                    <li>
                        <a href="{{ url('/dashboard') }}"><span class="tm-label">{{ $link }}</span></a>
                    </li>
                    @endif


                    @if($history != '')
                        <li>
                            <a href="{{ url('/history') }}"><span class="tm-label">{{ $history }}</span></a>
                        </li>
                    @endif


                    <li class="dropdown">
                    <a data-toggle="dropdown" href="">
                        <span class="tm-label">{{ Auth::user()->user_name }}<span class="caret"></span> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm pull-right">
                        <div class="listview">
                              <a class="lv-item" href="{{ url('/cancel') }}" id="cancel">Cancel Subscription </a>
                            <a class="lv-item" href="{{ url('/logout') }}" id="logout" > Logout</a>
                        </div>
                    </div>
                    </li>


                @endif


            </ul>
        </li>


    </ul>

</div>

<!-- Top Search Content -->
</header>

    <section id="main" data-layout="layout-1">


        @if( !Auth::guest() )
            <div  style="text-align: center;cursor: pointer;" id="questions">
                <h4><a id="feedback" data-id="buy">How much would you pay to buy this product ??</a></h4>
                <h4><a id="feedback" data-id="subscribe">How much would you pay for monthly subscription ??</a></h4>
            </div>
        @endif

        @yield('content')

    </section>

<!-- Page Loader -->
<div class="page-loader">
    <div class="preloader pls-blue">
        <svg class="pl-circular" viewBox="25 25 50 50">
            <circle class="plc-path" cx="50" cy="50" r="20" />
        </svg>

        <p>Please wait...</p>
    </div>
</div>

<!-- Javascript Libraries -->
<script src="{{URL::to('assets')}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{URL::to('assets')}}/js/bootstrap.min.js"></script>
<script src="{{URL::to('assets')}}/js/jquery.min.js"></script>


<script src="{{URL::to('assets')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{URL::to('assets')}}/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="{{URL::to('assets')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>


<script src="{{URL::to('assets')}}/vendors/bower_components/moment/min/moment.min.js"></script>

<script src="{{URL::to('assets')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
<script src="{{URL::to('assets')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>



<script src="{{URL::to('assets')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweetalert.min.js"></script>



<!-- Placeholder for IE9 -->
<!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->



<script src="{{URL::to('assets')}}/js/functions.js"></script>

<script src="{{URL::to('assets')}}/js/sorttable.js"></script>
<!-- <script src="{{URL::to('assets')}}/js/amcharts.js"></script>
        <script src="{{URL::to('assets')}}/js/serial.js"></script>
        <script src="{{URL::to('assets')}}/js/light.js"></script>-->


<script src="{{URL::to('assets')}}/js/amcharts.js"></script>
<script src="{{URL::to('assets')}}/js/serial.js"></script>
<script src="{{URL::to('assets')}}/js/plugins/export/export.min.js"></script>
<script src="{{URL::to('assets')}}/js/light.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $('#logout').click(function() {
        var url = "{{ URL::to('/updatedb') }}";

        $.get(url, function() {});
    });

    $('#questions').on('click', '#feedback', function(){
        var id = $(this).attr('data-id');

        swal({  title: "Enter your bid in dollars",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
            },
            function(inputValue){
                if (inputValue === false)
                    return false;
                else if (inputValue === "") {
                    swal.showInputError("You need to write something!");
                    return false
                }
                else{
                    var num = /[0-9]/;
                    var ch = 0;

                    for( i = 0; i < inputValue.length; i++)
                        if( ! inputValue[i].match(num) )
                        {   ch = 1;
                            break;
                        }
                    if( ch == 1 ){
                        swal.showInputError("Only digits are allowed!");
                        return false
                    }
                    else
                        saveFeedback(id, inputValue);
                }
            }
        );
    });

    function saveFeedback(id, bid){
        var url = '{{ url("saveFeedback") }}';

        $.get(url, {'id': id, 'bid': bid}, function(){
            swal({
                title: "Thank you!!!",
                text: "Thank you for giving your opinion. We will contact you in future.",
                type: "success",
                timer: 1500,
                showConfirmButton: false
            });
        });
    }
</script>

<!-- <script src="{{URL::to('assets')}}/js/demo.js"></script>-->

@yield('footer')
</body>

</html>
