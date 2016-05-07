<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Seo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{{URL::to('assets')}}/front/assets/css/main.css" />
		<style>

        #header1 {

		color: rgba(255, 255, 255, 0.75);
		cursor: default;
		height: 3.25em;
		left: 0;
		line-height: 3.25em;
		position: relative;
		text-align: right;
		top: 0;
		width: 100%;
		z-index: 10001;
	}

		#header1 > h2 {
			color: #fff;
			display: inline-block;
			height: inherit;
			left: 1.25em;
			line-height: inherit;
			margin: 0;
			padding: 0;
			position: absolute;
			top: 0;
		}

			#header1 > h2 a {
				font-size: 1.25em;
			}

		#header1 a {
			-moz-transition: color 0.2s ease-in-out;
			-webkit-transition: color 0.2s ease-in-out;
			-ms-transition: color 0.2s ease-in-out;
			transition: color 0.2s ease-in-out;
			color: #fff;
			display: inline-block;
			margin-right: 1.25em;
			text-decoration: none;
		}

			#header1 a[href="#nav"] {
				text-decoration: none;
				-webkit-tap-highlight-color: transparent;
			}

				#header1 a[href="#nav"]:before {
					content: "";
					-moz-osx-font-smoothing: grayscale;
					-webkit-font-smoothing: antialiased;
					font-family: FontAwesome;
					font-style: normal;
					font-weight: normal;
					text-transform: none !important;
				}

				#header1 a[href="#nav"]:before {
					margin: 0 0.5em 0 0;
				}

			#header1 a + a[href="#nav"]:last-child {
				border-left: solid 1px transparent;
				padding-left: 1.25em;
				margin-left: 0.5em;
			}



			#header1.alt a[href="#nav"] {
				margin-right: 0;
			}

        </style>
	</head>
	<body>


    <div id="header1">
        <h2> <a href="{{URL::to('/dashboard')}}">Seo-Plus</a></h2>
       <a href="{{ url('/login') }}"><span class="tm-label">Login</span></a>
         <a href="{{ url('/register') }}"><span class="tm-label">Register</span></a>
    </div>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">

						<h1>This is <strong>Visualize</strong>, a responsive site template designed by TEMPLATED<br />
						and released for free under the Creative Commons License.</h1>

					</header>

				<!-- Main -->
					<section id="main">

						<!-- Thumbnails -->
							<section class="thumbnails">
								<div>
									<a href="{{URL::to('assets')}}/front/images/fulls/01.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/01.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
									<a href="{{URL::to('assets')}}/front/images/fulls/02.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/02.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
								</div>
								<div>
									<a href="{{URL::to('assets')}}/front/images/fulls/03.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/03.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
									<a href="{{URL::to('assets')}}/front/images/fulls/04.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/04.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
									<a href="{{URL::to('assets')}}/front/images/fulls/05.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/05.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
								</div>
								<div>
									<a href="{{URL::to('assets')}}/front/images/fulls/06.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/06.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
									<a href="{{URL::to('assets')}}/front/images/fulls/07.jpg">
										<img src="{{URL::to('assets')}}/front/images/thumbs/07.jpg" alt="" />
										<h3>Lorem ipsum dolor sit amet</h3>
									</a>
								</div>
							</section>

					</section>

				<!-- Footer -->


			</div>

		<!-- Scripts -->
			<script src="{{URL::to('assets')}}/front/assets/js/jquery.min.js"></script>
			<script src="{{URL::to('assets')}}/front/assets/js/jquery.poptrox.min.js"></script>
			<script src="{{URL::to('assets')}}/front/assets/js/skel.min.js"></script>
			<script src="{{URL::to('assets')}}/front/assets/js/main.js"></script>

	</body>
</html>
