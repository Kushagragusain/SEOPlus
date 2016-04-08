
<html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SEOPlus</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('assets')}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::to('assets')}}/css/app.min.1.css" rel="stylesheet">
<link  type="text/css" href="{{URL::to('assets')}}/js/plugins/export/export.css" rel="stylesheet">

        <link href="{{URL::to('assets')}}/css/app.min.2.css" rel="stylesheet">


    </head>
    <body>
        <header id="header" class="clearfix" data-current-skin="blue">






            <ul class="header-inner">


                <li class="logo">
                    <a href="{{URL::to('/dashboard')}}">Seo-Plus</a>
                </li>

             <!--   <li class="pull-right">
                    <ul class="top-menu">
                        <li id="top-search">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else

                            <li><a href="{{ url('/dashboard') }}">{{ $link }}</a></li>
                            @if($link != '')
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                            @endif
                            <li><a href="{{ url('/history') }}">History</a></li>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <li class="dropdown" style="margin-right:50px">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->user_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{ url('/logout') }} " id="logout">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>-->





                <li class="pull-right">
                    <ul class="top-menu">

                        @if (Auth::guest())
                       <li >
                            <a href="{{ url('/login') }}"><span class="tm-label">Login</span></a>
                        </li>
                         <li >
                            <a href="{{ url('/register') }}"><span class="tm-label">Register</span></a>
                        </li>
                        @else
                          <li >
                            <a href="{{ url('/dashboard') }}"><span class="tm-label">{{ $link }}</span></a>
                        </li>
                        @if($link != '')
                         @endif
                                     <li >
                            <a href="{{ url('/history') }}"><span class="tm-label">History</span></a>
                        </li>


                        <li class="dropdown">
                            <a data-toggle="dropdown" href="">
                                <span class="tm-label">{{ Auth::user()->user_name }}<span class="caret"></span> </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm pull-right">

                                     <div class="listview">

                                        <a class="lv-item" href="{{ url('/logout') }}" id="logout"> Logout</a>

                            </div>
                            </div>
                        </li>

                        @endif


                    </ul>
                </li>







            </ul>



            <!-- Top Search Content -->

        </header>

        <section id="main" data-layout="layout-1">




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

        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

        <!-- Javascript Libraries -->
        <script src="{{URL::to('assets')}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{URL::to('assets')}}/js/bootstrap.min.js"></script>
         <script src="{{URL::to('assets')}}/js/jquery.min.js"></script>


               <script src="vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>

        <script src="vendors/bower_components/moment/min/moment.min.js"></script>



        <script src="{{URL::to('assets')}}/vendors/bower_components/moment/min/moment.min.js"></script>

        <script src="{{URL::to('assets')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>


        <script src="{{URL::to('assets')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

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
    $('#logout').click(function(){
        var url = "{{ URL::to('/updatedb') }}";

        $.get(url, function(){
        });
    });
</script>

       <!-- <script src="{{URL::to('assets')}}/js/demo.js"></script>-->

        @yield('footer')
    </body>

  </html>
