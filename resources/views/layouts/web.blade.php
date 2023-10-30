<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <!-- Basic Page Needs

     ================================================== -->

    <meta charset="utf-8">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png')}}">

    <title>@yield('title') Hallovet - Konsultasi Dengan Dokter Hewan</title>

    <meta name="description" content="@yield('description')">

    <meta name="keywords" content="">

    <meta name="author" content="Hellovet by OmahTI UGM">


    <!-- Mobile Specific Metas
    
     ================================================== -->

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">


    <!-- Web Font
	 ============================================= -->
    <link href="https://fonts.googleapis.com/css?family=Archivo|Fjalla+One|Roboto" rel="stylesheet">


    <!-- Theme Color
	============================================= -->
    <link rel="stylesheet" id="color" href="{{ asset('css/blue.css')}}">

    <!-- OmahTI Style 
	============================================= -->
    <link rel="stylesheet" href="{{ asset('css/oti.css')}}">

    <!--  Hover.css ======================================================  -->
    <link rel="stylesheet" href="{{ asset('css/hover-min.css')}}">

    <!--  AOS.css ====================================================  -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!--  Font Awesome  ========================================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">





    <!-- This page
	============================================= -->
    <link href="{{ asset('css/revolution_style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/settings.css')}}" rel="stylesheet">


    <!-- Bootstrap
	============================================= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css')}}">
    
@yield('css')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->



    <!-- Header Scripts
    
    ================================================== -->
        
    <script src="{{ asset('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- All Javascript 
	============================================= -->
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/jquery.stellar.js')}}"></script>
    <script src="{{ asset('js/jquery-ui-1.10.3.custom.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.js')}}"></script>
    <script src="{{ asset('js/counter.js')}}"></script>
    <script src="{{ asset('js/waypoints.js')}}"></script>
    <script src="{{ asset('js/jquery.uniform.js')}}"></script>
    <script src="{{ asset('js/easyResponsiveTabs.js')}}"></script>
    <script src="{{ asset('js/jquery.fancybox.pack.js')}}"></script>
    <script src="{{ asset('js/jquery.fancybox-media.js')}}"></script>
    <script src="{{ asset('js/jquery.mixitup.js')}}"></script>
    <script src="{{ asset('js/forms-validation.js')}}"></script>
    <script src="{{ asset('js/jquery.jcarousel.min.js')}}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <!-- This page
	============================================= -->
    <script src="{{ asset('js/jquery.themepunch.plugins.min.js')}}"></script>
    <script src="{{ asset('js/jquery.themepunch.revolution.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/aos.js') }}"></script>

</head>

<body class="fixed-header">

    <!--  Preloader ===============================================  -->
    <div id="loader"></div>

    <!-- Document Wrapper
		============================================= -->
    <div id="wrapper" class="clearfix">


        <!-- Header
		============================================= -->
        <header id="header" class="">

            <!-- Top Row
			============================================= -->

            <nav id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation" data-nav-status="toggle">
                <div class="container">


                    <!-- Primary Navigation
				============================================= -->


                    <!-- Brand and toggle get grouped for better mobile display
					============================================= -->

                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-nav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="{{ url('/')}}"><img src="{{asset('images/logo.png')}}" alt="" style="width:44.33px; height:44.33px;" title=""></a>

                    </div>


                    <div class="collapse navbar-collapse navbar-right navbar-medium-center" id="primary-nav">

                        <ul class="nav navbar-nav">
                            {{--<li><a href="{{ url('/')}}">Home</a></li>--}}
                            <li><a class="btn-default rounded-border hvr-shutter-out-horizontal" href="{{ url('konsultasi') }}">Konsultasi</a></li>
                            <li><a class="btn-default rounded-border hvr-shutter-out-horizontal" href="{{ url('carilokasi') }}">Cari Dokter Hewan</a></li>
                            <li><a class="btn-default rounded-border hvr-shutter-out-horizontal" href="{{ url('artikel') }}">Artikel</a></li>
                            <li><a class="btn-default rounded-border hvr-shutter-out-horizontal" href="{{ url('karir') }}">Lowongan Kerja</a></li>

                            @if(Auth::check())

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn-default btn-outline hvr-shutter-out-horizontal" data-toggle="dropdown">{{Auth::user()->name}}
                                    <i class="fas fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="hvr-wobble-top" href="{{ url('/dashboard/')}}">Dashboard</a></li>
                                    <li><a class="hvr-wobble-top" href="{{ url('setting/reset#target') }}">Ubah Password</a></li>

                                    <li><a class="hvr-wobble-top" href="{{ url('/logout/') }}">Log Out</a></li>
                                </ul>
                            </li>
                            @else
                            <li><a class="btn-default btn-outline hvr-shutter-out-horizontal" href="{{ url('/login') }}">Masuk &amp; Daftar</a></li>
                            {{-- <li><a href="{{ url('/register') }}">Daftar</a></li> --}}
                            @endif

                        </ul>

                    </div>



                </div>
            </nav>
        </header>

        <div id="content-index">
            @if (notify()->ready())
            <script type="text/javascript">
                swal({
                    title: "{!! notify()->message() !!}",
                    text: "{!! notify()->option('text') !!}",
                    icon: "{{ notify()->type() }}",
                    //                    if(notify() - > option('timer'))
                    //                    timer: {
                    //                        {
                    //                            notify() - > option('timer')
                    //                        }
                    //                    },
                    //                    showConfirmButton: false
                    //                    endif
                });

            </script>
            @endif

            @yield('js')
            @yield('content')
        </div>

        <br>
        <br>
        <br>

        <!--    <div class="colourfull-row"></div>-->


        <!-- Footer
	============================================= -->
        <footer id="footer" class="light">

            <div class="container">

                <div class="row">

                    <div class="col-md-6 text-center-mobile">

                        <!-- Footer Widget
					============================================= -->
                        <div class="footer-widget">

                            <h4><span>Explore Hallovet</span></h4>

                            <ul class="footer-nav list-unstyled clearfix">
                                <li><a href="{{ url('konsultasi') }}"><i class=""></i>Konsultasi</a></li>
                                <li><a href="{{ url('penyakit') }}"><i class=""></i>Penyakit Hewan</a></li>
                                <li><a href="{{ url('carilokasi') }}"><i class=""></i>Cari Dokter Hewan</a></li>
                                <li><a href="{{ url('register/dokter') }}"><i class=""></i>Daftar Sebagai Dokter</a></li>
                                <li><a href="{{ url('artikel') }}"><i class=""></i>Artikel Hewan</a></li>
                                <li><a href="{{ url('contact') }}"><i class=""></i>Kontak Kami</a></li>
                                <li><a href="{{ url('tutorial') }}" target="_blank"><i class=""></i>Panduan Penggunaan</a></li>
                                <li><a href="{{ url('page/about-hallovet') }}"><i class=""></i>Tentang Kami</a></li>



                            </ul>

                        </div>

                    </div>

                    {{--<div class="col-md-4 text-center-mobile">
                        <div class="footer-widget">

                            <h4><span>Part of Hallovet</span></h4>

                            <ul class="footer-nav list-unstyled clearfix">
                                <li><a href="http://klinik.hallovet.com"><i class=""></i>klinik.hallovet.com</a></li>
                                <li><a href="http://toko.hallovet.com"><i class=""></i>toko.hallovet.com</a></li>
                                <li><a href="http://anime.hallovet.com"><i class=""></i>anime.hallovet.com</a></li>
                                <li><a href="http://film.hallovet.com"><i class=""></i>film.hallovet.com</a></li>
                                <li><a href="http://tv.hallovet.com"><i class=""></i>tv.hallovet.com</a></li>



                            </ul>

                        </div>
                    </div>--}}


                    <div class="col-md-4 col-md-offset-2">
                        <div class="text-center">
                            <!-- Footer Widget
					============================================= -->
                            <div class="footer-widget">
                                <h4><span>get in touch</span></h4>
                                <ul class="social3 clearfix">
                                    <li><a href="#."><img src="{{asset('icon/facebook.png')}}" alt=""></a></li>
                                    <li><a href="#."><img src="{{asset('icon/instagram.png')}}" alt=""></a></li>
                                    <li><a href="#."><img src="{{asset('icon/twitter.png')}}" alt=""></a></li>
                                    <li><a href="#."><img src="{{asset('icon/youtube.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                    </div>



                </div>
            </div>
            <br>
            <br>
            <br>


            <!-- Copyright
		============================================= -->
            
            <!-- back to top -->
            <!--            <a href="#" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a>-->
            <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" data-toggle="tooltip" data-placement="left"><i class="fa fa-angle-up"></i></a>





        </footer>

        @yield('js')
    </div>
    <script>
        function hideLoader() {
            window.onload = function() {
                //display loader on page load 
                $('.loader').fadeOut();
            }
        }

    </script>
    <script>
        AOS.init({
            once: true,
        });

    </script>
    <script type="text/javascript">
        var loader;

        function loadNow(opacity) {
            if (opacity <= 0) {
                displayContent();
            } else {
                loader.style.opacity = opacity;
                window.setTimeout(function() {
                    loadNow(opacity - 0.01)
                }, 1);
            }
        }

        function displayContent() {
            loader.style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }

        document.addEventListener("DOMContentLoaded", function() {
            loader = document.getElementById('loader');
            loadNow(1);
        });

    </script>


</body>

</html>
