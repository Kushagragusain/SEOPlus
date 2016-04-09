<!DOCTYPE html>
<html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('assets')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::to('assets')}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{URL::to('assets')}}/css/app.min.2.css" rel="stylesheet">
    </head>

    <body class="login-content">

<!-- Reset blade -->
          <div class="lc-block toggled" id="l-login">

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">
<!-- Email Address -->
        <div class="input-group m-b-20 ">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                        <div class="fg-line {{ $errors->has('email') ? ' has-error' : '' }}">
                           <input type="email" class="form-control" placeholder="Email address" name="email" value="{{ $email or old('email') }}">
                            </div>
                                @if ($errors->has('email'))
                                    <strong class="c-red">{{ $errors->first('email') }}</strong>
                                    @endif
                            </div>

        <!-- End Email Address -->
        <!-- Password -->
<div class="input-group m-b-20 ">
    <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                         <div class="fg-line{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                              </div>
                                @if ($errors->has('password'))
                                     <strong class="c-red">{{ $errors->first('password') }}</strong>
                                @endif

                        </div>
<!-- End Password -->
        <!-- Confirm Password -->

        <div class="input-group m-b-20 ">
                <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                       <div class="fg-line {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
            </div>
                            @if ($errors->has('password_confirmation'))
                                      <strong class="c-red">{{ $errors->first('password_confirmation') }}</strong>
                                @endif
                            </div>
         <div class="clearfix"></div>

 <!-- End Confirm Password -->

         <!-- Reset Button -->

                        <div class="form-group">
                            <button href="" class="btn btn-login btn-danger btn-float" type="submit"><i class="zmdi zmdi-arrow-forward"></i></button>
                            </div>

        <!-- End Reset Button -->

                    </form>




        </div>

        <!-- Reset blade -->
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
