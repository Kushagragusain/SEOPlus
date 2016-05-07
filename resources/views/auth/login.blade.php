<!DOCTYPE html>
<html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('assets')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::to('assets')}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/css/app.min.2.css" rel="stylesheet">
    </head>

    <body class="login-content">

        <div class="row">

            </div>
        <!-- Login -->
        <div class="lc-block toggled" id="l-login">
            <h2 style="">User Login</h2>
            <br><br>
            @if (count($errors) > 0)
            <p>
                <strong class="c-red">The email/password combination doesn't exists !!</strong>
            </p>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="input-group m-b-20 ">
                <span class="input-group-addon f-20"><i class="zmdi zmdi-account"></i></span>
                <div class="fg-line f-20 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" placeholder="Email address" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon f-20"><i class="zmdi zmdi-lock"></i></span>
                <div class="fg-line f-20 {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
            </div>
            <br><br>
            <div class="form-group">
            <button href="" class="btn btn-warning btn-lg btn-block bgm-blue waves-effect" style="border-radius: 30px;" type="submit">Login</button>
            </div>

            </form>

            <ul class="login-navigation">
                <a href="{{ url('/password/reset') }}" class="c-black">Forgot Password?</a>
                <br><br><br>
                <span class="f-15">Don't have an account, yet?<a href="{{ url('/register') }}" class="c-red" style="font-weight: bold;"> Sign Up</a></span>

            </ul>
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
        <script src="{{URL::to('assets')}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="{{URL::to('assets')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>

        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="{{URL::to('assets')}}/js/functions.js"></script>

    </body>
</html>
